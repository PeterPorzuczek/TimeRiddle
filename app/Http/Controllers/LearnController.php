<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Course;
use App\Problem;
use App\Solution;

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
                'topics.quests.problems' => function($query) {
                    $query
                    ->where('public', '!=' , 0)
                    ->select(['id', 'quest_id']);
                },
                'topics.quests.problems.solutions' => function($query) {
                    $query
                    ->where('problem_id', '!=' , 0)
                    ->select(['problem_id']);
                }
            ])
            ->get();
    }

    public function findProblem($courseName, $coursePassword, $problemPassword)
    {
        if (strlen($problemPassword) < 10 ||
            substr_count($problemPassword, ".") !== 5 ||
            substr_count($problemPassword, "-") === 0 ||
            !is_numeric($problemPassword[strlen($problemPassword)-1])) {
            return array('error'=>'1');
        }

        return Course
        ::select(
            'id')
        ->where('abbreviation', '=' , $courseName)
        ->where('password', '=' , $coursePassword)
        ->with([
            'topics' => function($query) {
                $query
                ->where('public', '!=' , 0)
                ->select([
                    'id',
                    'course_id',]);
            },
            'topics.quests' => function($query) {
                $query
                ->where('public', '!=' , 0)
                ->select([
                    'id',
                    'topic_id']);
            },
            'topics.quests.problems' => function($query) use ($problemPassword) {
                $query
                ->select([
                    'id',
                    'quest_id',
                    'name AS title',
                    'index',
                    'links',
                    DB::raw('(CASE WHEN show_code = 0 THEN content_html_no_code ELSE content_html END) AS content')])
                ->where('public', '!=' , 0)
                ->where('passwords', 'like' , '%' . $problemPassword . '%');
            },
            'topics.quests.problems.solutions' => function($query) use ($problemPassword) {
                $query
                ->where('problem_id', '!=' , 0)
                ->where('password', '=' , $problemPassword)
                ->select([
                    'problem_id',
                    'link',
                    'mark AS grade',
                    'summary_html AS explanation'])
                ->orderBy('created_at','DESC');;
            }
        ])
        ->get();
    }

    public function addSolution($courseName, $coursePassword, $problemPassword, $questId, $topicId, Request $request)
    {
        if (strlen($problemPassword) < 10) {
            return array('error'=>'1');
        }

        $course = Course
        ::select(
            'id')
        ->where('abbreviation', '=' , $courseName)
        ->where('password', '=' , $coursePassword)
        ->with([
            'topics' => function($query) {
                $query
                ->where('public', '!=' , 0)
                ->select([
                    'id',
                    'course_id',]);
            },
            'topics.quests' => function($query) {
                $query
                ->where('public', '!=' , 0)
                ->select([
                    'id',
                    'topic_id']);
            },
            'topics.quests.problems' => function($query) use ($problemPassword) {
                $query
                ->select([
                    'id',
                    'quest_id',
                    'name AS title',
                    'index',
                    'links',
                    DB::raw('(CASE WHEN show_code = 0 THEN content_html_no_code ELSE content_html END) AS content')])
                ->where('public', '!=' , 0)
                ->where('passwords', 'like' , '%' . $problemPassword . '%');
            },
            'topics.quests.problems.solutions' => function($query) use ($problemPassword) {
                $query
                ->where('problem_id', '!=' , 0)
                ->where('password', '=' , $problemPassword)
                ->select([
                    'problem_id',
                    'link']);
            }
        ])
        ->get();

        if (count($course[0]->topics->find($topicId)->quests->find($questId)->problems) > 0) {
            $solution = new Solution;
            $solution->link = empty($request->input('link')) ? '' : $request->input('link');
            $solution->password = $problemPassword;
            $solution->problem_id = $course[0]->topics->find($topicId)->quests->find($questId)->problems[0]->id;

            $solution->save();

            return array('success'=>'1');
        }
    }

}
