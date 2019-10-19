<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Collection;

use Illuminate\Http\Request;
use GrahamCampbell\Markdown\Facades\Markdown;

use App\User;
use App\Quest;

class QuestController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($courseId = null, $topicId = null)
    {
        $userId = auth()->user()->id;
        $user = User::find($userId);
        $courses = $user->courses;

        if (!empty($courseId)) {
            $courses = [$user->courses->find($courseId)];
        }

        $quests = new Collection();
        if (!empty($topicId)) {
            $topic = $courses[0]->topics->find($topicId);
            $quests = $topic->quests;
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
        }

        $quests = $quests->sortBy('index');

        $altEnd = !empty($courseId)
            ? view('manage.quest.index')->with(['quests'=> $quests, 'courseId'=> $courseId])
            : view('manage.quest.index')->with('quests', $quests);

        return !empty($courseId) && !empty($topicId)
            ? view('manage.quest.index')->with(['quests'=> $quests, 'courseId'=> $courseId, 'topicId'=> $topicId])
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

        return !empty($request->input('topicId'))
            ? view('manage.quest.create')->with(['topics'=>$topics, 'topicId'=>$request->input('topicId')])
            : view('manage.quest.create')->with('topics', $topics);
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
            'topic_id' => 'required',
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

          $topic = $topics->find($request->input('topic_id'));

          if ($topic) {
              $quest = new Quest;
              $quest->index = $request->input('index');
              $quest->name = $request->input('name');
              $quest->topic_id = $request->input('topic_id');
              $quest->content = $request->input('content');

              $codeRegexPattern = '/^(([ \t]*> `{3,4}|`{3,4})([^\n]*)([\s\S]+?)(^[ \t]*\2))/m';
              $quest->content_no_code = preg_replace($codeRegexPattern, '', $request->input('content'));

              $quest->content_html = Markdown::convertToHtml($request->input('content'));
              $quest->content_html_no_code = Markdown::convertToHtml(preg_replace($codeRegexPattern, '', $request->input('content')));

              $quest->links = $request->input('links');
              $quest->show_code = $request->input('show_code') === 'show_code';
              $quest->public = $request->input('public') === 'public';

              $quest->save();

              return redirect()->route('quests.topics.filter', ["courseId"=>$quest->topic->course_id, "topicId"=>$quest->topic_id])->with('success', 'Quest saved!');
          }

          return redirect('/quests')->with('error', 'Course problems!');
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

        $_quest = Quest::find($id);
        $quest = $user->courses
            ->find($_quest->topic->course_id)->topics
            ->find($_quest->topic_id)->quests->find($id);

        $quest->content = str_replace("{{", "{spc{", $quest->content);
        $quest->content_no_code = str_replace("{{", "{spc{", $quest->content_no_code);

        $quest->content_html = str_replace("{{", "{spc{", $quest->content_html);
        $quest->content_html_no_code = str_replace("{{", "{spc{", $quest->content_html_no_code);

        return view('manage.quest.show')->with('quest', $quest);
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

        $_quest = Quest::find($id);
        $quest = $user->courses
            ->find($_quest->topic->course_id)->topics
            ->find($_quest->topic_id)->quests->find($id);

        $courses = $user->courses;

        $topics = new Collection();
        foreach ($courses as $course) {
            $topics = $topics->merge($course->topics);
        }
        foreach ($topics as &$topic) {
            $topic = $topic->with('course');
        }

        $quest->content = str_replace("{{", "{spc{", $quest->content);

        return view('manage.quest.edit')->with('quest', $quest)->with('topics', $topics);
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
            'topic_id' => 'required',
            'index' => 'required',
            'content' => 'required',
            'links' => 'required|valid_json'
          ]);

          $_quest = Quest::find($id);

          $userId = auth()->user()->id;
          $user = User::find($userId);

          $quest = $user->courses
            ->find($_quest->topic->course_id)->topics
            ->find($_quest->topic_id)->quests->find($id);

          if ($quest) {
              $quest->index = $request->input('index');
              $quest->name = $request->input('name');
              $quest->topic_id = $request->input('topic_id');
              $quest->content = $request->input('content');

              $codeRegexPattern = '/^(([ \t]*> `{3,4}|`{3,4})([^\n]*)([\s\S]+?)(^[ \t]*\2))/m';
              $quest->content_no_code = preg_replace($codeRegexPattern, '', $request->input('content'));

              $quest->content_html = Markdown::convertToHtml($request->input('content'));
              $quest->content_html_no_code = Markdown::convertToHtml(preg_replace($codeRegexPattern, '', $request->input('content')));

              $quest->links = $request->input('links');
              $quest->show_code = $request->input('show_code') === 'show_code';
              $quest->public = $request->input('public') === 'public';

              $quest->save();

              return redirect()->route('quests.topics.filter', ["courseId"=>$quest->topic->course_id, "topicId"=>$quest->topic_id])->with('success', 'Quest saved!');
          }

          return redirect('/quests')->with('error', 'Course problems!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $_quest = Quest::find($id);

        $userId = auth()->user()->id;

        $user = User::find($userId);

        $quest = $user->courses
            ->find($_quest->topic->course_id)->topics
            ->find($_quest->topic_id)->quests->find($id);

        $quest->delete();

        return redirect()->route('quests.topics.filter', ["courseId"=>$quest->topic->course_id, "topicId"=>$quest->topic_id])->with('success', 'Quest Deleted');
    }
}
