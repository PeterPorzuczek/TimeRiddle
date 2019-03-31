<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Course;

class LearnController extends Controller
{
    public function showBoard($courseName, $coursePassword)
    {
        return view('learn.board')->with(['courseName'=> $courseName, 'coursePassword'=> $coursePassword]);
    }

    public function learn($courseName, $coursePassword)
    {
        return Course
            ::select(
                'id',
                'name AS title',
                'links',
                'theme')
            ->where('abbreviation', '=' , $courseName)
            ->where('password', '=' , $coursePassword)
            ->with([
                'topics' => function($query) {
                    $query
                    ->where('public', '!=' , 0)
                    ->select([
                        'id',
                        'course_id',
                        'name AS title',
                        'index',
                        'links',
                        'description_html AS content'])
                    ->orderBy('index','ASC');
                },
                'topics.quests' => function($query) {
                    $query
                    ->where('public', '!=' , 0)
                    ->select([
                        'id',
                        'topic_id',
                        'name AS title',
                        'index',
                        'links',
                        DB::raw('(CASE WHEN show_code = 0 THEN content_html_no_code ELSE content_html END) AS content')])
                    ->orderBy('index','ASC');
                },
            ])
            ->get();
    }
}
