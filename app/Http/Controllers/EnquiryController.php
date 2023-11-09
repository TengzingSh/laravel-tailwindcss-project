<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enquiries;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $trainer_id;
        $isAdmin = false;
        if (Auth::check()) {
            $trainer_id = Auth::user()->id;
            $isAdmin = Auth::user()->type;
        }
        $enquiries;

        if($isAdmin){
            $enquiries = Enquiries::with('course', 'trainer')->get();
        }else{
            $enquiries = Enquiries::with('course', 'trainer')->where('trainer_id', $trainer_id)->get();
        }

        return view('enquirieslist', ['enquiries' => $enquiries]);
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
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255','same:verify_email'],
            'phone' => ['required', 'regex:/^[0-9\s]{1,20}$/'],
            'organName' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:512'],
            'title' => ['string', 'max:255'],
        ]);

        if($request->trainer_id){
            Enquiries::create([
                'trainer_id' => $request->trainer_id,
                'title' => $request->title,
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email,
                'organName' => $request->organName,
                'phone' => $request->phone,
                'message' => $request->message,
            ]);
            
            // $data = [
            //     'title' => 'Thank you for registering with book-a-trainer',
            //     'content' => 'Thank you for registering with book-a-trainer, now be sure to add the courses that you offer.',
            // ];
    
            // $response = Mail::send('emails.enquiry_to_admin', $data, function($message){
            //     $message->to("geniuspromarcus@gmail.com")->subject('Notifications');
            // });
            return view('backsoon', ['provider' => $request->provider]);

        }else if($request->course_id){
            Enquiries::create([
                'course_id' => $request->course_id,
                'title' => $request->title,
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email,
                'organName' => $request->organName,
                'phone' => $request->phone,
                'message' => $request->message,
            ]);

            return view('backsoon', ['provider' => $request->provider]);

        }else{
            abort(404);
        }

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
