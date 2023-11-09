<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Trainers;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($key=[])
    {
        //
        $courseslist = [];
        $coursesl = Courses::all();
        foreach($coursesl as $course){
            if(!in_array($course['name'], $courseslist, false)){
                array_push($courseslist, $course['name']);
            }
        }
        
        $courses = Courses::with('user.trainer')->where('approved', true)->whereHas('user', function ($query) {
            $query->where('type', false);
        })->get();
        
        return view("home_courses", [
            'courseslist' => $courseslist, 
            'courses' => $courses, 
        ]);
        
        
    }
    public function indexforTrainers($key=[])
    {
        //
        $courseslist = [];
        $coursesl = Courses::all();
        foreach($coursesl as $course){
            if(!in_array($course['name'], $courseslist, false)){
                array_push($courseslist, $course['name']);
            }
        }
        $trainers = Trainers::with('user.courses')->where('approved', true)->get();
        
        return view("home_trainers", [
            'courseslist' => $courseslist,
            'trainers' => $trainers, 
        ]);
        
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
