<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Courses;
use App\Models\CourseTemplates;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {   

    }
    
    public function index()
    {
        $trainer_id;
        $isAdmin = false;
        if (Auth::check()) {
            $trainer_id = Auth::user()->id;
            $isAdmin = Auth::user()->type;
        }
        $courses;
        
        if($isAdmin){
            $courses = Courses::with('user')->get();
        }else{
            $courses = Courses::with('user')->where('trainer_id', $trainer_id)->get();
        }
        
        return view('courseslist', ['courses' => $courses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $courses = CourseTemplates::where('approved', true)->get();
        return view('create_course', ['courses' => $courses]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'duration' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'min_parts' => ['required', 'numeric'],
            'max_parts' => ['required', 'numeric', 'gte:min_parts'],
            'level' => ['required', 'string', 'max:255'],
            'format' => ['required', 'string', 'max:255'],
            'region' => ['required','array', 'min:1'],
            'certificate' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        $trainer_id;
        $isAdmin = false;
        if (Auth::check()) {
            $trainer_id = Auth::user()->id;
            $isAdmin = Auth::user()->type;
            // Use $userId as needed in your controller logic
        }
        $regions = "";
        $regions = implode(', ', $request->region);
        
        $user = Courses::create([
            'trainer_id' => $trainer_id,
            'name' => $request->name,
            'duration' => $request->duration,
            'dur_mode' => $request->dur_mode,
            'price' => $request->price,
            'min_parts' => $request->min_parts,
            'max_parts' => $request->max_parts,
            'level' => $request->level,
            'format' => $request->format,
            'region' => $regions,
            'certificate' => $request->certificate,
            'description' => $request->description,
            'approved' => $isAdmin
        ]);
        if($isAdmin){
            return redirect('courses');
        }

        
        return view('backsoon');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $trainer_id;
        $isAdmin = false;
        if (Auth::check()) {
            $trainer_id = Auth::user()->id;
            $isAdmin = Auth::user()->type;
        }
        $course = Courses::with('user.trainer')->where('id', $id)->get();
        
        return view('coursedetail', ['course' => $course]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        echo "edit";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->mode == "approve"){
            $this->validate($request, [
                'approved' => 'boolean',
            ]);
            $item = Courses::findOrFail($id);
            $item->update([
                'approved' => $request->approved
            ]);

            return redirect('courses');
        }else {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        echo "destroy";
    }
}
