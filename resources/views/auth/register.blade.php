<x-guest-layout>
    <div class="border-b p-6 text-gray-900">
        {{ __('Register as Admin') }}
    </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('First & Last Name')"/>
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

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="Password"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password"  placeholder="Re-type Password"/>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
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
