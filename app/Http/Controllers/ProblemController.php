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
        $user = auth()->user();
        $courseIds = $user->courses()->pluck('id');
    
        if (!empty($questId)) {
            $problems = Problem::with(['quest.topic.course'])
                ->where('quest_id', $questId)
                ->whereHas('quest.topic.course', function ($q) use ($courseIds, $courseId) {
                    $q->whereIn('id', $courseIds);
                    if (!empty($courseId)) {
                        $q->where('id', $courseId);
                    }
                })
                ->orderBy('index')
                ->get();
        } else {
            $problems = Problem::with(['quest.topic.course'])
                ->whereHas('quest.topic.course', function ($q) use ($courseIds, $courseId) {
                    $q->whereIn('id', $courseIds);
                    if (!empty($courseId)) {
                        $q->where('id', $courseId);
                    }
                })
                ->orderBy('index')
                ->get();
        }
    
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
        $user = auth()->user();
    
        $courses = $user->courses()->with('topics.quests.topic.course')->get();
    
        $courseId = $request->input('courseId');
        $topicId  = $request->input('topicId');
        $questId  = $request->input('questId');
    
        if (!empty($courseId)) {
            $topics = optional($courses->firstWhere('id', $courseId))->topics ?? collect();
        } else {
            $topics = $courses->flatMap->topics;
        }
    
        if (!empty($topicId)) {
            $quests = optional($topics->firstWhere('id', $topicId))->quests ?? collect();
        } else {
            $quests = $topics->flatMap->quests;
        }
    
        return !empty($questId)
            ? view('manage.problem.create')->with(['quests' => $quests, 'questId' => $questId])
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
            'name'     => 'required',
            'quest_id' => 'required',
            'index'    => 'required',
            'content'  => 'required',
            'links'    => 'required|valid_json'
        ]);
    
        $user = auth()->user();
        $courseIds = $user->courses()->pluck('id');
    
        $quest = Quest::with('topic.course')
            ->where('id', $request->input('quest_id'))
            ->whereHas('topic.course', function ($q) use ($courseIds) {
                $q->whereIn('id', $courseIds);
            })
            ->first();
    
        if (! $quest) {
            return redirect()->action('ProblemController@index')->with('error', 'Course problems!');
        }
    
        $problem = new Problem;
        $problem->index    = $request->input('index');
        $problem->name     = $request->input('name');
        $problem->quest_id = $quest->id;
        $problem->content  = $request->input('content');
        $problem->passwords = $request->input('passwords');
    
        $codeRegexPattern = '/^(([ \t]*> `{3,4}|`{3,4})([^\n]*)([\s\S]+?)(^[ \t]*\2))/m';
        $contentNoCode    = preg_replace($codeRegexPattern, '', $request->input('content'));
    
        $problem->content_no_code        = $contentNoCode;
        $problem->content_html           = Markdown::convertToHtml($request->input('content'));
        $problem->content_html_no_code   = Markdown::convertToHtml($contentNoCode);
    
        $problem->links     = $request->input('links');
        $problem->show_code = $request->input('show_code') === 'show_code';
        $problem->public    = $request->input('public') === 'public';
    
        $problem->save();
    
        return redirect()->route('problems.quests.topics.filter', [
            'courseId' => $quest->topic->course_id,
            'topicId'  => $quest->topic_id,
            'questId'  => $quest->id,
        ])->with('success', 'Problem saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = auth()->user();
        $courseIds = $user->courses()->pluck('id');
    
        $problem = Problem::with('quest.topic.course')
            ->where('id', $id)
            ->whereHas('quest.topic.course', function ($q) use ($courseIds) {
                $q->whereIn('id', $courseIds);
            })
            ->firstOrFail();
    
        $problem->content              = str_replace("{{", "{spc{", $problem->content);
        $problem->content_no_code      = str_replace("{{", "{spc{", $problem->content_no_code);
        $problem->content_html         = str_replace("{{", "{spc{", $problem->content_html);
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
        $user = auth()->user();
        $courseIds = $user->courses()->pluck('id');
    
        $problem = Problem::with('quest.topic.course')
            ->where('id', $id)
            ->whereHas('quest.topic.course', function ($q) use ($courseIds) {
                $q->whereIn('id', $courseIds);
            })
            ->firstOrFail();
    
        $courses = $user->courses()->with('topics.quests.topic.course')->get();
    
        $quests = $courses
            ->flatMap->topics
            ->flatMap->quests;
    
        $problem->content = str_replace("{{", "{spc{", $problem->content);
    
        return view('manage.problem.edit', [
            'problem' => $problem,
            'quests'  => $quests,
        ]);
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
            'name'     => 'required',
            'quest_id' => 'required',
            'index'    => 'required',
            'content'  => 'required',
            'links'    => 'required|valid_json'
        ]);
    
        $user = auth()->user();
        $courseIds = $user->courses()->pluck('id');
    
        $problem = Problem::with('quest.topic.course')
            ->where('id', $id)
            ->whereHas('quest.topic.course', function ($q) use ($courseIds) {
                $q->whereIn('id', $courseIds);
            })
            ->first();
    
        if (! $problem) {
            return redirect()->action('ProblemController@index')->with('error', 'Course problems!');
        }
    
        $problem->index    = $request->input('index');
        $problem->name     = $request->input('name');
        $problem->quest_id = $request->input('quest_id');
        $problem->content  = $request->input('content');
    
        $codeRegexPattern = '/^(([ \t]*> `{3,4}|`{3,4})([^\n]*)([\s\S]+?)(^[ \t]*\2))/m';
        $contentNoCode    = preg_replace($codeRegexPattern, '', $request->input('content'));
    
        $problem->content_no_code        = $contentNoCode;
        $problem->content_html           = Markdown::convertToHtml($request->input('content'));
        $problem->content_html_no_code   = Markdown::convertToHtml($contentNoCode);
    
        $problem->links     = $request->input('links');
        $problem->show_code = $request->input('show_code') === 'show_code';
        $problem->public    = $request->input('public') === 'public';
        $problem->passwords = $request->input('passwords');
    
        $problem->save();
    
        $problem->load('quest.topic.course');
    
        return redirect()->route('problems.quests.topics.filter', [
            'courseId' => $problem->quest->topic->course_id,
            'topicId'  => $problem->quest->topic_id,
            'questId'  => $problem->quest->id,
        ])->with('success', 'Problem saved!');
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
