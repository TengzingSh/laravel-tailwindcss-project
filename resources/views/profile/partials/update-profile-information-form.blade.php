<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')
        @if (!$user->type)
        <div>
            <x-input-label for="name" :value="__('Title')" />
            <x-text-input id="title" name="title" type="text" class="mt-1 block w-2/5 mr-1" :value="old('title', $user->title)" autofocus autocomplete="title" />
            <x-input-error class="mt-2" :messages="$errors->get('title')" />
        </div>
        @endif
        <div>
            <x-input-label for="name" :value="__('First & Last Name')" />
            <div class="flex flex-row">
                <x-text-input id="firstName" name="firstName" type="text" class="mt-1 block w-full mr-1" :value="old('firstName', $user->firstName)" required autofocus autocomplete="firstName" />
                <x-input-error class="mt-2" :messages="$errors->get('firstName')" />

                <x-text-input id="lastName" name="lastName" type="text" class="mt-1 block w-full ml-2" :value="old('lastName', $user->lastName)" required autocomplete="lastName" />
                <x-input-error class="mt-2" :messages="$errors->get('lastName')" />
            </div>
        </div>
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
            <!-- @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif -->
        </div>
        <div class="mt-4" x-show="changeEmail">
            <x-input-label for="verify_email" :value="__('Verify Email')" />
            <x-text-input id="verify_email" class="block mt-1 w-full" type="email" name="verify_email" required autocomplete="verify_email" placeholder="Verify Email" value="{{ $user->email }}"/>
            <x-input-error :messages="$errors->get('verify_email')" class="mt-2" />
        </div>
        @if (!$user->type)
        <div class="mt-4">
            <x-input-label for="jobTitle" :value="__('Job Title')" />
            <x-text-input id="jobTitle" class="block mt-1 w-full" type="text" name="jobTitle" :value="old('jobTitle', $user['trainer']->jobTitle)" autocomplete="jobTitle" placeholder="E.g. Trainer"/>
            <x-input-error :messages="$errors->get('jobTitle')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="provider" :value="__('What is your company name?')" />
            <x-text-input id="provider" class="block mt-1 w-full" type="text" name="provider" :value="old('provider', $user['trainer']->provider)" required autocomplete="provider" placeholder="Acme Training Ltd"/>
            <x-input-error :messages="$errors->get('provider')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Telephone Number')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone', $user['trainer']->phone)" required autocomplete="phone" placeholder="123 456 7890"/>
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>
        <div class="mt-4" x-data="{ photoPreview: '{{asset('storage/'.$user['trainer']->photo)}}' }">
            <x-input-label for="photo" :value="__('Company Logo (Max image size: 512kb)')" />
            <x-text-input class="relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary"
                id="photo" type="file" name="photo" accept="image/*" @change="photoPreview = URL.createObjectURL($event.target.files[0])" placeholder="" value="{{$user['trainer']->photo}}"/>
            <div class="mt-2 grid justify-items-center">
                <img :src="photoPreview" alt="Image Preview" width="120px" class="p-1  border-2 border-dashed rounded-md">
            </div>
            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="bio" :value="__('Please write about your journey and expertise as a trainer. Clients will love to hear about your professional background, qualifications, and what makes you exceptional in this field.')" />
            <textarea id="bio" class="block mt-1 w-full rounded-md resize-y border-gray-300 focus:border-blue-500" name="bio" autocomplete="bio" >{{old('bio', $user['trainer']->bio)}}</textarea>
            <x-input-error :messages="$errors->get('bio')" class="mt-2" />
        </div>
        @endif
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
