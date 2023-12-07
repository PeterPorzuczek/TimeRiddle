<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Collection;

use Illuminate\Http\Request;
use GrahamCampbell\Markdown\Facades\Markdown;

use App\Models\User;
use App\Models\Problem;

class ProblemController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($courseId = null, $topicId = null, $questId = null)
    {
        $userId = auth()->user()->id;
        $user = User::find($userId);
        $courses = $user->courses;

        if (!empty($courseId)) {
            $courses = [$user->courses->find($courseId)];
        }

        $problems = new Collection();
        if (!empty($questId)) {
            $topic = $courses[0]->topics->find($topicId);
            $quest = $topic->quests->find($questId);
            $problems = $quest->problems;
        } else {
            $topics = new Collection();
            foreach ($courses as $course) {
                $topics = $topics->merge($course->topics);
            }

            foreach ($topics as &$topic) {
                $topic = $topic->with('course');
            }

            $quests = new Collection();
            foreach ($topics as $topic) {
                $quests = $quests->merge($topic->quests);
            }

            foreach ($quests as &$quest) {
                $quest = $quest->with('topic');
            }

            $problems = new Collection();
            foreach ($quests as $quest) {
                $problems = $problems->merge($quest->problems);
            }

            foreach ($problems as &$problem) {
                $problem = $problem->with('quest');
            }
        }

        $problems = $problems->sortBy('index');

        $altEnd = !empty($courseId)
            ? view('manage.problem.index')->with(['problems'=> $problems, 'courseId'=> $courseId])
            : view('manage.problem.index')->with('problems', $problems);

        return !empty($courseId) && !empty($topicId) && !empty($questId)
            ? view('manage.problem.index')->with(['problems'=> $problems, 'courseId'=> $courseId, 'topicId'=> $topicId, 'questId' => $questId])
            : $altEnd;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $userId = auth()->user()->id;
        $user = User::find($userId);
        $courses = $user->courses;

        $topics = new Collection();
        if(!empty($request->input('courseId'))) {
            $topics = $courses->find($request->input('courseId'))->topics;
        } else {
            foreach ($courses as $course) {
                $topics = $topics->merge($course->topics);
            }
        }

        foreach ($topics as &$topic) {
            $topic = $topic->with('course');
        }

        $quests = new Collection();
        if(!empty($request->input('topicId'))) {
            $quests = $courses->find($request->input('courseId'))->topics->find($request->input('topicId'))->quests;
        } else {
            foreach ($topics as $topic) {
                $quests = $quests->merge($topic->quests);
            }
        }

        foreach ($quests as &$quest) {
            $quest = $quest->with('topic');
        }

        return !empty($request->input('questId'))
            ? view('manage.problem.create')->with(['quests'=>$quests, 'questId'=>$request->input('questId')])
            : view('manage.problem.create')->with('quests', $quests);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'quest_id' => 'required',
            'index' => 'required',
            'content' => 'required',
            'links' => 'required|valid_json'
          ]);

          $userId = auth()->user()->id;
          $user = User::find($userId);
          $courses = $user->courses;

          $topics = new Collection();
          foreach ($courses as $course) {
              $topics = $topics->merge($course->topics);
          }

          foreach ($topics as &$topic) {
              $topic = $topic->with('course');
          }

          $quests = new Collection();
          foreach ($topics as $topic) {
              $quests = $quests->merge($topic->quests);
          }

          foreach ($quests as &$quest) {
              $quest = $quest->with('topic');
          }

          $quest = $quests->find($request->input('quest_id'));

          if ($quest) {
              $problem = new Problem;
              $problem->index = $request->input('index');
              $problem->name = $request->input('name');
              $problem->quest_id = $request->input('quest_id');
              $problem->content = $request->input('content');
              $problem->passwords = $request->input('passwords');

              $codeRegexPattern = '/^(([ \t]*> `{3,4}|`{3,4})([^\n]*)([\s\S]+?)(^[ \t]*\2))/m';
              $problem->content_no_code = preg_replace($codeRegexPattern, '', $request->input('content'));

              $problem->content_html = Markdown::convertToHtml($request->input('content'));
              $problem->content_html_no_code = Markdown::convertToHtml(preg_replace($codeRegexPattern, '', $request->input('content')));

              $problem->links = $request->input('links');
              $problem->show_code = $request->input('show_code') === 'show_code';
              $problem->public = $request->input('public') === 'public';

              $problem->save();

              return redirect()->route('problems.quests.topics.filter', ["courseId"=>$problem->quest->topic->course_id, "topicId"=>$problem->quest->topic_id, "questId"=>$problem->quest->id])->with('success', 'Problem saved!');
          }

          return redirect()->action('ProblemController@index')->with('error', 'Course problems!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userId = auth()->user()->id;
        $user = User::find($userId);

        $_problem = Problem::find($id);
        $problem = $user->courses
            ->find($_problem->quest->topic->course_id)->topics
            ->find($_problem->quest->topic_id)->quests
            ->find($_problem->quest_id)->problems->find($id);

        $problem->content = str_replace("{{", "{spc{", $problem->content);
        $problem->content_no_code = str_replace("{{", "{spc{", $problem->content_no_code);

        $problem->content_html = str_replace("{{", "{spc{", $problem->content_html);
        $problem->content_html_no_code = str_replace("{{", "{spc{", $problem->content_html_no_code);

        return view('manage.problem.show')->with('problem', $problem);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userId = auth()->user()->id;
        $user = User::find($userId);

        $_problem = Problem::find($id);
        $problem = $user->courses
            ->find($_problem->quest->topic->course_id)->topics
            ->find($_problem->quest->topic_id)->quests
            ->find($_problem->quest_id)->problems->find($id);

        $courses = $user->courses;

        $topics = new Collection();
        foreach ($courses as $course) {
            $topics = $topics->merge($course->topics);
        }

        foreach ($topics as &$topic) {
            $topic = $topic->with('course');
        }

        $quests = new Collection();
        foreach ($topics as $topic) {
            $quests = $quests->merge($topic->quests);
        }

        foreach ($quests as &$quest) {
            $quest = $quest->with('topic');
        }

        $problems = new Collection();
        foreach ($problems as $problem) {
            $problems = $problems->merge($quest->problems);
        }

        foreach ($problems as &$problem) {
            $problem = $problem->with('quest');
        }

        $problem->content = str_replace("{{", "{spc{", $problem->content);

        return view('manage.problem.edit')->with('problem', $problem)->with('quests', $quests);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'quest_id' => 'required',
            'index' => 'required',
            'content' => 'required',
            'links' => 'required|valid_json'
          ]);

          $_problem = Problem::find($id);

          $userId = auth()->user()->id;
          $user = User::find($userId);

          $problem = $user->courses
            ->find($_problem->quest->topic->course_id)->topics
            ->find($_problem->quest->topic_id)->quests
            ->find($_problem->quest_id)->problems->find($id);

          if ($problem) {
              $problem->index = $request->input('index');
              $problem->name = $request->input('name');
              $problem->quest_id = $request->input('quest_id');
              $problem->content = $request->input('content');

              $codeRegexPattern = '/^(([ \t]*> `{3,4}|`{3,4})([^\n]*)([\s\S]+?)(^[ \t]*\2))/m';
              $problem->content_no_code = preg_replace($codeRegexPattern, '', $request->input('content'));

              $problem->content_html = Markdown::convertToHtml($request->input('content'));
              $problem->content_html_no_code = Markdown::convertToHtml(preg_replace($codeRegexPattern, '', $request->input('content')));

              $problem->links = $request->input('links');
              $problem->show_code = $request->input('show_code') === 'show_code';
              $problem->public = $request->input('public') === 'public';
              $problem->passwords = $request->input('passwords');

              $problem->save();

              return redirect()->route('problems.quests.topics.filter', ["courseId"=>$problem->quest->topic->course_id, "topicId"=>$problem->quest->topic_id, "questId"=>$problem->quest->id])->with('success', 'Problem saved!');
          }

          return redirect()->action('ProblemController@index')->with('error', 'Course problems!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $_problem= Problem::find($id);

        $userId = auth()->user()->id;

        $user = User::find($userId);

        $problem = $user->courses
            ->find($_problem->quest->topic->course_id)->topics
            ->find($_problem->quest->topic_id)->quests
            ->find($_problem->quest_id)->problems->find($id);

        $problem->delete();

        return redirect()->route('problems.quests.topics.filter', ["courseId"=>$problem->quest->topic->course_id, "topicId"=>$problem->quest->topic_id, "questId"=>$problem->quest->id])->with('success', 'Problem Deleted');
    }
}
