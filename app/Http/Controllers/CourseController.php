<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\User;
use App\Course;

class CourseController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = auth()->user()->id;

        $user = User::find($userId);

        $courses = $user->courses;

        foreach ($courses as &$course) {
            $course = $course->with('topics');
        }

        return view('manage.course.index')->with('courses', $courses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $themes = [
            "grey",
            "red",
            "orange",
            "yellow",
            "green",
            "teal",
            "blue",
            "indigo",
            "purple",
            "pink"
        ];

        return view('manage.course.create')->with("themes", $themes);
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
            'abbreviation' => 'required',
            'password' => 'required',
            'links' => 'required|valid_json',
            'theme' => 'required'
        ]);

        $course = new Course;
        $course->name = $request->input('name');
        $course->abbreviation = $request->input('abbreviation');
        $course->password = $request->input('password');
        $course->links = $request->input('links');
        $course->user_id = auth()->user()->id;
        $course->theme = $request->input('theme');
        $course->dark = $request->input('dark') === 'dark';

        $course->save();

        return redirect('/courses')->with('success', 'Course saved!');
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

        $course = $user->courses->find($id);

        return view('manage.course.show')->with('course', $course);
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

        $course = $user->courses->find($id);

        $themes = [
            "grey",
            "red",
            "orange",
            "yellow",
            "green",
            "teal",
            "blue",
            "indigo",
            "purple",
            "pink"
        ];

        return view('manage.course.edit')->with(['course'=>$course, 'themes'=>$themes]);
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
            'abbreviation' => 'required',
            'password' => 'required',
            'links' => 'required|valid_json',
            'theme' => 'required'
          ]);

        $userId = auth()->user()->id;

        $user = User::find($userId);

        $course = $user->courses->find($id);

        $course->name = $request->input('name');
        $course->abbreviation = $request->input('abbreviation');
        $course->password = $request->input('password');
        $course->links = $request->input('links');
        $course->user_id = auth()->user()->id;
        $course->theme = $request->input('theme');
        $course->dark = $request->input('dark') === 'dark';

        $course->save();

        return redirect('/courses')->with('success', 'Course updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userId = auth()->user()->id;

        $user = User::find($userId);

        $course = $user->courses->find($id);

        $course->delete();

        return redirect('/courses')->with('success', 'Course Deleted');
    }
}
