<?php

namespace App\Http\Controllers;
use App\Models\CourseTemplates;

use Illuminate\Http\Request;

class CourseTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $coursenames = CourseTemplates::all();
        return view('courses_name', [
            'coursenames' => $coursenames
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
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:'.CourseTemplates::class,],
        ]);
        $user = CourseTemplates::create([
            'name' => $request->name,
            'approved' => true
        ]);

        return redirect('coursetemplates');
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
        $template = CourseTemplates::findOrFail($id);
        $message = "";
        // if ($template->approved) {
        //     $message = "Successfully disapproved.";
        // }else{
        //     $message = "Successfully approved.";
        // }
        $template->update([
            'approved' => !$template->approved
        ]);
        
        return redirect('coursetemplates');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $template = CourseTemplates::findOrFail($id);
        $template->delete();
        return redirect('coursetemplates');
    }
}
