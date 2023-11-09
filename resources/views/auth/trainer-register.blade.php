<x-guest-layout>
    <div class="border-b pl-1 pb-3 text-lg font-bold text-gray-900">
        {{ __('Register as a trainer') }}
    </div>
    <div class="pt-2 text-sm text-gray-900">
        Boost your training bookings by registering with us below, it's free to register and we'll freely promote your  face-to-face training. After registering you can add the courses you provide and how far you are willing to travel.
    </div>
    <form method="POST" action="{{ route('register-trainer') }}" enctype="multipart/form-data">
        @csrf


        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('First & Last Name')" />
            <div class="flex flex-row">
                <x-text-input id="firstName" class="block mt-1 w-full mr-1" type="text" name="firstName" :value="old('firstName')" required autofocus autocomplete="firstName" placeholder="First Name" />
                <x-input-error :messages="$errors->get('firstName')" class="mt-2" />

                <x-text-input id="lastName" class="block mt-1 w-full ml-1" type="text" name="lastName" :value="old('lastName')" required autocomplete="lastName" placeholder="Last Name"/>
                <x-input-error :messages="$errors->get('lastName')" class="mt-2" />
            </div>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" placeholder="Email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="verify_email" :value="__('Verify Email')" />
            <x-text-input id="verify_email" class="block mt-1 w-full" type="email" name="verify_email" required autocomplete="verify_email" placeholder="Verify Email" />
            <x-input-error :messages="$errors->get('verify_email')" class="mt-2" />
        </div>

        <div class="flex">
            <!-- Password Field -->
            <div class="mt-4 w-1/2">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full"
                              type="password"
                              name="password" required autocomplete="new-password" placeholder="Password"/>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password Field -->
            <div class="mt-4 w-1/2 ml-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                              type="password"
                              name="password_confirmation" required autocomplete="new-password" placeholder="Re-type Password"/>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>


        <div class="mt-4">
            <x-input-label for="jobTitle" :value="__('Job Title')" />
            <x-text-input id="jobTitle" class="block mt-1 w-full" type="text" name="jobTitle" :value="old('jobTitle')" required autocomplete="jobTitle" placeholder="E.g. Trainer"/>
            <x-input-error :messages="$errors->get('jobTitle')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="provider" :value="__('What is your company name?')" />
            <x-text-input id="provider" class="block mt-1 w-full" type="text" name="provider" :value="old('provider')" required autocomplete="provider" placeholder="E.g. Acme Training Ltd"/>
            <x-input-error :messages="$errors->get('provider')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="phone" :value="__('What phone number should people contact you on?')" />
            <x-text-input id="phone" class="block mt-1 w-3/4" type="text" name="phone" :value="old('phone')" required autocomplete="phone" placeholder="0161 123 1234"/>
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div class="mt-4" x-data="{ photoPreview: null }">
            <x-input-label for="photo" :value="__('Company Logo (Max image size: 512kb)')" />
            <x-text-input class="relative mt-1 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary"
                id="photo" type="file" name="photo" accept="image/*" @change="photoPreview = URL.createObjectURL($event.target.files[0])" placeholder=""/>
            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
            <div x-show="photoPreview" class="mt-2 grid justify-items-center">
                <img :src="photoPreview" alt="Image Preview" width="120px" class="p-1  border-2 border-dashed rounded-md">
            </div>
        </div>

        <div class="mt-4">
            <x-input-label for="bio" :value="__('Please write about your journey and expertise as a trainer. Clients will love to hear about your professional background, qualifications, and what makes you exceptional in this field.')" />
            <textarea id="bio" class="block mt-2 w-full rounded-md resize-y border-gray-300 focus:border-blue-500" name="bio" autocomplete="bio">{{ old('bio') }}</textarea>
            <x-input-error :messages="$errors->get('bio')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
