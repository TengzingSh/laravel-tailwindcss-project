<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Trainers;
use App\Models\Enquiries;
use App\Models\Courses;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trainers = Trainers::with('user.courses')->get();
        return view('trainerslist', ['trainers' => $trainers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.trainer-register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class, 'same:verify_email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'regex:/^[0-9\s]{1,20}$/'],
            'photo' => ['image','mimes:jpeg,png,jpg,gif','max:2048'],
            'jobTitle' => ['required', 'string', 'max:255'],
            'provider' => ['required', 'string', 'max:255'],
            'title' => ['string', 'max:255'],
        ]);

        $user = User::create([
            'title' => $request->title,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $path = "";
        if($request->photo) {
            $path = $request->file('photo')->store('photos', 'public');
        }

        $trainer = Trainers::create([
            'user_id' => $user->id,
            'jobTitle' => $request->jobTitle,
            'provider' => $request->provider,
            'phone' => $request->phone,
            'photo' => $path,
            'bio' => $request->bio,
            'approved' => false
        ]);

        event(new Registered($user));

        Auth::login($user);
        
        // $reveiverEmailAddress = User::where('type', true)->get('email');
        // $to = [];
        // foreach($reveiverEmailAddress as $reviver) {
        //     array_push($to, $reviver['email']);
        // }
        
        // $response = Mail::send('emails.register_to_admin', function($message){
        //     $message->to($to)->subject('Notifications');
        // });

        // $response = Mail::send('emails.register', function($message){
        //     $message->to($request->email)->subject('Notifications');
        // });
       
        if ($response) {
            return redirect('/courses');
        }else{
            return "Oops! There was some error sending the email.";
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $trainer = Trainers::with('user.courses')->where('id', $id)->get();
        return view('trainerdetail', ['trainer' => $trainer]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $trainer = Trainers::with('user')->where('id', $id)->get();
        return view('edittrainer', ['trainer' => $trainer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function approve(Request $request, string $id)
    {
        //
        if($request->mode == "approve"){
            $this->validate($request, [
                'approved' => 'boolean',
            ]);
            $item = Trainers::findOrFail($id);
            $item->update([
                'approved' => $request->approved
            ]);

            return redirect('trainers');
        }else {
            abort(404);
        }
    }
    
    public function update(Request $request, string $id)
    {
        $trainer = Trainers::with('user')->where('id', $id)->first();

        if ($request->hasFile('photo')){
            
            $request->validate([
                'firstName' => ['required', 'string', 'max:255'],
                'lastName' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($trainer['user']->id), 'same:verify_email'],
                'phone' => ['required', 'regex:/^\d{10,12}$/'],
                'photo' => ['image','mimes:jpeg,png,jpg,gif','max:2048'],
                'jobTitle' => ['required', 'string', 'max:255'],
                'provider' => ['required', 'string', 'max:255'],
                'title' => ['string', 'max:255'],
            ]);
            
        }else{
            $request->validate([
                'firstName' => ['required', 'string', 'max:255'],
                'lastName' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($trainer['user']->id), 'same:verify_email'],
                'phone' => ['required', 'regex:/^\d{10,12}$/'],
                'jobTitle' => ['required', 'string', 'max:255'],
                'provider' => ['required', 'string', 'max:255'],
                'title' => ['string', 'max:255'],
            ]);
        }
        
        $user = User::findOrFail($trainer['user']->id);
        $user->update([
            'title' => $request->title,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
        ]);
        $trainer = Trainers::where('id', $id)->first();
        $path = "";
        if($request->hasFile('photo')){
            if($request->photo) {
                $path = $request->file('photo')->store('photos', 'public');
            }
            $trainer->update([
                'jobTitle' => $request->jobTitle,
                'provider' => $request->provider,
                'phone' => $request->phone,
                'photo' => $path,
                'bio' => $request->bio,
            ]);
        }else{
            $trainer->update([
                'jobTitle' => $request->jobTitle,
                'provider' => $request->provider,
                'phone' => $request->phone,
                'bio' => $request->bio,
            ]);
        }
       
        return redirect('trainers');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $trainer = Trainers::with('user')->where('id', $id)->first();
        $deltrainer = Trainers::where('id', $id)->first();
        
        $equires = Enquiries::where('trainer_id', $trainer['user']->id)->delete();
        
        $courses = Courses::where('trainer_id', $trainer['user']->id)->get();

        foreach($courses as $course) {
            $enquires = Enquiries::where('course_id', $course->id)->delete();
        }
        $courses->each->delete();
        $trainer->delete();
        User::where('id', $trainer['user']->id)->delete();
        
        return redirect('trainers');
    }
}
