<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use GrahamCampbell\Markdown\Facades\Markdown;

use App\User;
use App\Topic;

class TopicController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($courseId = null)
    {
        $userId = auth()->user()->id;
        $user = User::find($userId);
        $courses = $user->courses;

        if (!empty($courseId)) {
            $courses = [$user->courses->find($courseId)];
        }

        $topics = new Collection();
        foreach ($courses as $course) {
            $topics = $topics->merge($course->topics);
        }

        foreach ($topics as &$topic) {
            $topic = $topic->with('course');
        }

        foreach ($topics as &$topic) {
            $topic = $topic->with('quests');
        }

        $topics = $topics->sortBy('index');

        return !empty($courseId)
        ? view('manage.topic.index')->with(['topics'=> $topics, 'courseId'=> $courseId])
        : view('manage.topic.index')->with('topics', $topics);
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

        return !empty($request->input('courseId'))
        ? view('manage.topic.create')->with(['courses'=> $user->courses, 'courseId'=> $request->input('courseId') ])
        : view('manage.topic.create')->with('courses', $user->courses);
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
          'course_id' => 'required',
          'index' => 'required',
          'links' => 'required|valid_json'
        ]);

        $userId = auth()->user()->id;
        $user = User::find($userId);
        $course = $user->courses->find($request->input('course_id'));

        if ($course) {
            $topic = new Topic;
            $topic->index = $request->input('index');
            $topic->name = $request->input('name');
            $topic->description = $request->input('description');
            $topic->description_html = Markdown::convertToHtml($request->input('description'));
            $topic->course_id = $request->input('course_id');
            $topic->links = $request->input('links');
            $topic->public = $request->input('public') === 'public';

            $topic->save();

            return redirect()->route('topics.filter', [$topic->course_id])->with('success', 'Topic saved!');
        }

        return redirect('/topics')->with('error', 'Course problems!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $_topic = Topic::find($id);

        $userId = auth()->user()->id;

        $user = User::find($userId);

        $topic = $user->courses->find($_topic->course_id)->topics->find($id);

        $topic->description_html = str_replace("{{", "{spc{", $topic->description_html);

        return view('manage.topic.show')->with('topic', $topic);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $_topic = Topic::find($id);

        $userId = auth()->user()->id;

        $user = User::find($userId);

        $topic = $user->courses->find($_topic->course_id)->topics->find($id);

        return view('manage.topic.edit')->with('topic', $topic)->with('courses', $user->courses);
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
            'course_id' => 'required',
            'index' => 'required',
            'links' => 'required|valid_json'
          ]);

          $_topic = Topic::find($id);

          $userId = auth()->user()->id;
          $user = User::find($userId);
          $topic = $user->courses->find($_topic->course_id)->topics->find($id);

          if ($topic) {
            $topic->index = $request->input('index');
            $topic->name = $request->input('name');
            $topic->description = $request->input('description');
            $topic->description_html = Markdown::convertToHtml($request->input('description'));
            $topic->course_id = $request->input('course_id');
            $topic->links = $request->input('links');
            $topic->public = $request->input('public') === 'public';

            $topic->save();

            return redirect()->route('topics.filter', [$topic->course_id])->with('success', 'Topic saved!');
          }

          return redirect('/topics')->with('error', 'Course problems!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $_topic = Topic::find($id);

        $userId = auth()->user()->id;

        $user = User::find($userId);

        $topic = $user->courses->find($_topic->course_id)->topics->find($id);

        $topic->delete();

        return redirect()->route('topics.filter', [$topic->course_id])->with('success', 'Topic Deleted!');
    }
}
