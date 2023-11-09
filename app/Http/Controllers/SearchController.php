<?php

namespace App\Http\Controllers;
use App\Models\Trainers;
use App\Models\Courses;
use App\Models\User;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function search(Request $request)
    {
        $cat = $request->cat;
        $reg = $request->region;
        $cou = $request->course;
        
        $courseslist = [];
        $coursesl = Courses::all();
        foreach($coursesl as $course){
            if(!in_array($course['name'], $courseslist, false)){
                array_push($courseslist, $course['name']);
            }
        }
        
        if($cat == "course") {

            $courses = Courses::with('user.trainer')->where('approved', true)->where('name', 'like', '%' . $cou . '%')->where('region', 'like', '%' . $reg . '%')->whereHas('user', function ($query) {
                $query->where('type', false);
            })->get();
            return view("home_courses", [
                'courseslist' => $courseslist, 
                'courses' => $courses,
                'query' => [$reg, $cou] 
            ]);
        }else if($cat == "trainer") {
            
            $trainers = Trainers::with('user.courses')->whereHas('user.courses', function ($query) use ($reg, $cou) {
                $query->where('name', 'like', '%' . $cou . '%')->where('region', 'like', '%' . $reg . '%');
            })->get();
        
            return view("home_trainers", [
                'courseslist' => $courseslist,
                'trainers' => $trainers,
                'query' => [$reg, $cou] 
            ]);
        }else{
            abort(404);
        }
        
    }
}
