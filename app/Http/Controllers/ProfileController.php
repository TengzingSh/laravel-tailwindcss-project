<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Trainers;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = User::with('trainer')->findOrFail($request->user()['id']);
        return view('profile.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {   
        if ($request->hasFile('photo')){
            
            $request->validate([
                'firstName' => ['required', 'string', 'max:255'],
                'lastName' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($request->user()->id), 'same:verify_email'],
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
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($request->user()->id), 'same:verify_email'],
                'phone' => ['required', 'regex:/^\d{10,12}$/'],
                'jobTitle' => ['required', 'string', 'max:255'],
                'provider' => ['required', 'string', 'max:255'],
                'title' => ['string', 'max:255'],
            ]);
        }
        
        $user = User::findOrFail($request->user()['id']);
        $user->update([
            'title' => $request->title,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
        ]);
        $trainer = Trainers::where('user_id', $request->user()['id'])->first();
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
       
        // $request->user()->fill($request->validated());

        // if ($request->user()->isDirty('email')) {
        //     $request->user()->email_verified_at = null;
        // }

        // $request->user()->save();
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
