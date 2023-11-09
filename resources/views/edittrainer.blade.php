<x-app-layout>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
                <section class="p-12 max-w-xl">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Profile Information') }}
                        </h2>
                        
                    </header>

                    <form method="post" action="{{ route('updatetrainer', ['id' => $trainer[0]->id]) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div>
                            <x-input-label for="name" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-2/5 mr-1" :value="old('title', $trainer[0]['user']->title)" required autofocus autocomplete="title" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>
                        <div>
                            <x-input-label for="name" :value="__('First & Last Name')" />
                            <div class="flex flex-row">
                                <x-text-input id="firstName" name="firstName" type="text" class="mt-1 block w-full mr-1" :value="old('firstName', $trainer[0]['user']->firstName)" required autofocus autocomplete="firstName" />
                                <x-input-error class="mt-2" :messages="$errors->get('firstName')" />
                        
                                <x-text-input id="lastName" name="lastName" type="text" class="mt-1 block w-full ml-2" :value="old('lastName', $trainer[0]['user']->lastName)" required autocomplete="lastName" />
                                <x-input-error class="mt-2" :messages="$errors->get('lastName')" />
                            </div>
                        </div>
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $trainer[0]['user']->email)" required autocomplete="email" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            
                        </div>
                        <div class="mt-4" x-show="changeEmail">
                            <x-input-label for="verify_email" :value="__('Verify Email')" />
                            <x-text-input id="verify_email" class="block mt-1 w-full" type="email" name="verify_email" required autocomplete="verify_email" placeholder="Verify Email" value="{{ $trainer[0]['user']->email }}"/>
                            <x-input-error :messages="$errors->get('verify_email')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="jobTitle" :value="__('Job Title')" />
                            <x-text-input id="jobTitle" class="block mt-1 w-full" type="text" name="jobTitle" :value="old('jobTitle', $trainer[0]->jobTitle)" required autocomplete="jobTitle" placeholder="Job Title"/>
                            <x-input-error :messages="$errors->get('jobTitle')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="provider" :value="__('Provider Name')" />
                            <x-text-input id="provider" class="block mt-1 w-full" type="text" name="provider" :value="old('provider', $trainer[0]->provider)" required autocomplete="provider" placeholder="Provider Name"/>
                            <x-input-error :messages="$errors->get('provider')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="phone" :value="__('Telephone Number')" />
                            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone', $trainer[0]->phone)" required autocomplete="phone" placeholder="123 456 7890"/>
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>
                        <div class="mt-4" x-data="{ photoPreview: '{{asset('storage/'.$trainer[0]->photo)}}' }">
                            <x-input-label for="photo" :value="__('Photo (Max size: 2MB)')" />
                            <x-text-input class="relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary"
                                id="photo" type="file" name="photo" accept="image/*" @change="photoPreview = URL.createObjectURL($event.target.files[0])" placeholder=""/>
                            <div class="mt-2 grid justify-items-center">
                                <img :src="photoPreview" alt="Image Preview" width="120px" class="p-1  border-2 border-dashed rounded-md">
                            </div>
                            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="bio" :value="__('Please write a bio of yourself.')" />
                            <textarea id="bio" class="block mt-1 w-full rounded-md resize-y border-gray-300 focus:border-blue-500" name="bio" autocomplete="bio" >{{old('bio', $trainer[0]->bio)}}</textarea>
                            <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                        </div>
                        <div class="flex items-center gap-4">
                            
                            <a href="/trainers" class="focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-white py-2 px-4 bg-sky-400 rounded-md hover:bg-sky-500 focus:outline-none">{{__('Cancel')}}</a>
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                            
                        </div>
                    </form>
                </section>


            </div>
        </div>


    </div>

</x-app-layout>
