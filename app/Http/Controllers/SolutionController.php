<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Collection;

use Illuminate\Http\Request;
use GrahamCampbell\Markdown\Facades\Markdown;

use App\User;
use App\Solution;

class SolutionController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($courseId = null, $topicId = null, $questId = null, $problemId = null)
    {
        $userId = auth()->user()->id;
        $user = User::find($userId);
        $courses = $user->courses;

        if (!empty($courseId)) {
            $courses = [$user->courses->find($courseId)];
        }

        $problems = new Collection();
        if (!empty($problemId)) {
            $topic = $courses[0]->topics->find($topicId);
            $quest = $topic->quests->find($questId);
            $problem = $quest->problems->find($problemId);
            $solutions = $problem->solutions;
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

            $solutions = new Collection();
            foreach ($problems as $problem) {
                $solutions = $solutions->merge($problem->solutions);
            }

            foreach ($solutions as &$solution) {
                $solution = $solution->with('problem');
            }
        }

        $solutions = $solutions->groupBy('password')->flatMap(function ($items) {
            $quantity = $items->count(); return $items->map(function ($item) use ($quantity) {
                $item->quantity = $quantity; return $item; });
        });

        $solutions = $solutions->sortBy(function($solution)
        {
          return strtotime($solution->created_at) . '-' . $solution->quantity . '-' . $solution->problem->name . '-' . $solution->password;
        })->reverse();

        $altEnd = !empty($courseId)
            ? view('manage.solution.index')->with(['solutions'=> $solutions, 'courseId'=> $courseId])
            : view('manage.solution.index')->with('solutions', $solutions);

        return !empty($courseId) && !empty($topicId) && !empty($questId) && !empty($problemId)
            ? view('manage.solution.index')->with(['solutions'=> $solutions, 'courseId'=> $courseId, 'topicId'=> $topicId, 'questId' => $questId, 'problemId' => $problemId])
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

        $problems = new Collection();
        if(!empty($request->input('questId'))) {
            $problems = $courses->find($request->input('courseId'))->topics->find($request->input('topicId'))->quests->find($request->input('questId'))->problems;
        } else {
            foreach ($quests as $quest) {
                $problems = $problems->merge($quest->problems);
            }
        }

        foreach ($problems as &$problem) {
            $problem = $problem->with('quest');
        }

        return !empty($request->input('problemId'))
            ? view('manage.solution.create')->with(['problems'=>$problems, 'problemId'=>$request->input('problemId')])
            : view('manage.solution.create')->with('problems', $problems);
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
            'problem_id' => 'required',
            'password' => 'required',
            'summary' => 'required'
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

          $problems = new Collection();
          foreach ($quests as $quest) {
              $problems = $problems->merge($quest->problems);
          }

          foreach ($problems as &$problem) {
              $problem = $problem->with('quest');
          }

          $problem = $problems->find($request->input('problem_id'));

          if ($problem) {
              $solution = new Solution;
              $solution->link = empty($request->input('link')) ? '' : $request->input('link');
              empty($request->input('mark')) ? '' :  empty($request->input('mark')) ? '' : $request->input('mark');
              $solution->problem_id = $request->input('problem_id');
              $solution->password = $request->input('password');
              $solution->summary = $request->input('summary');

              $codeRegexPattern = '/^(([ \t]*> `{3,4}|`{3,4})([^\n]*)([\s\S]+?)(^[ \t]*\2))/m';
              $solution->summary_no_code = preg_replace($codeRegexPattern, '', $request->input('summary'));

              $solution->summary_html = Markdown::convertToHtml($request->input('summary'));
              $solution->summary_html_no_code = Markdown::convertToHtml(preg_replace($codeRegexPattern, '', $request->input('summary')));

              $solution->save();

              return redirect()->route('solutions.problems.quests.topics.filter', ["courseId"=>$solution->problem->quest->topic->course_id, "topicId"=>$solution->problem->quest->topic_id, "questId"=>$solution->problem->quest->id, "problemId"=>$solution->problem->id])->with('success', 'Solution saved!');
          }

          return redirect()->action('SolutionController@index')->with('error', 'Course problems!');
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

        $_solution= Solution::find($id);
        $solution = $user->courses
            ->find($_solution->problem->quest->topic->course_id)->topics
            ->find($_solution->problem->quest->topic_id)->quests
            ->find($_solution->problem->quest_id)->problems
            ->find($_solution->problem_id)->solutions->find($id);

        $solution->summary = str_replace("{{", "{spc{", $solution->summary);
        $solution->summary_no_code = str_replace("{{", "{spc{", $solution->summary_no_code);

        $solution->summary_html = str_replace("{{", "{spc{", $solution->summary_html);
        $solution->summary_html_no_code = str_replace("{{", "{spc{", $solution->summary_html_no_code);


        return view('manage.solution.show')->with('solution', $solution);
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

        $_solution = Solution::find($id);
        $solution = $user->courses
            ->find($_solution->problem->quest->topic->course_id)->topics
            ->find($_solution->problem->quest->topic_id)->quests
            ->find($_solution->problem->quest_id)->problems
            ->find($_solution->problem_id)->solutions->find($id);

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
        foreach ($quests as $quest) {
            $problems = $problems->merge($quest->problems);
        }

        foreach ($problems as &$problem) {
            $problem = $problem->with('quest');
        }

        $solutions = new Collection();
        foreach ($solutions as $solution) {
            $solutions = $solutions->merge($solution->problems);
        }

        foreach ($solutions as &$solution) {
            $solution = $solution->with('problem');
        }

        $solution->summary = str_replace("{{", "{spc{", $solution->summary);

        return view('manage.solution.edit')->with('solution', $solution)->with('problems', $problems);
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
            'problem_id' => 'required',
            'password' => 'required',
            'summary' => 'required'
          ]);

          $_solution = Solution::find($id);

          $userId = auth()->user()->id;
          $user = User::find($userId);

          $solution = $user->courses
            ->find($_solution->problem->quest->topic->course_id)->topics
            ->find($_solution->problem->quest->topic_id)->quests
            ->find($_solution->problem->quest_id)->problems
            ->find($_solution->problem_id)->solutions->find($id);

          if ($solution) {
              $solution->link = empty($request->input('link')) ? '' : $request->input('link');
              $solution->mark = empty($request->input('mark')) ? '' : $request->input('mark');
              $solution->problem_id = $request->input('problem_id');
              $solution->password = $request->input('password');
              $solution->summary = $request->input('summary');

              $codeRegexPattern = '/^(([ \t]*> `{3,4}|`{3,4})([^\n]*)([\s\S]+?)(^[ \t]*\2))/m';
              $solution->summary_no_code = preg_replace($codeRegexPattern, '', $request->input('summary'));

              $solution->summary_html = Markdown::convertToHtml($request->input('summary'));
              $solution->summary_html_no_code = Markdown::convertToHtml(preg_replace($codeRegexPattern, '', $request->input('summary')));

              $solution->save();

              return redirect()->route('solutions.problems.quests.topics.filter', ["courseId"=>$solution->problem->quest->topic->course_id, "topicId"=>$solution->problem->quest->topic_id, "questId"=>$solution->problem->quest->id, "problemId"=>$solution->problem->id])->with('success', 'Solution saved!');
          }

          return redirect()->action('SolutionController@index')->with('error', 'Course problems!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $_solution = Solution::find($id);

        $userId = auth()->user()->id;

        $user = User::find($userId);

        $solution = $user->courses
            ->find($_solution->problem->quest->topic->course_id)->topics
            ->find($_solution->problem->quest->topic_id)->quests
            ->find($_solution->problem->quest_id)->problems
            ->find($_solution->problem_id)->solutions->find($id);

        $solution->delete();

        return redirect()->route('solutions.problems.quests.topics.filter', ["courseId"=>$solution->problem->quest->topic->course_id, "topicId"=>$solution->problem->quest->topic_id, "questId"=>$solution->problem->quest->id, "problemId"=>$solution->problem->id])->with('success', 'Solution Deleted');
    }
}
