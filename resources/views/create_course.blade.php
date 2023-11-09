<x-app-layout>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="border-b p-6 text-gray-900">
                    {{ __('Add New Course') }}
                </div>
                <div class="p-12 text-gray-900">
                    <form method="POST" action="{{ route('createstore') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Name -->
                        <div x-data="{ selectedOption: '' }">
                            <x-input-label for="select_course" :value="__('Which course do you offer')" />
                            <select id="select_course" class="block w-3/5 mt-1 rounded-md border-gray-300 " name="select_course" x-model="selectedOption" autofocus>
                                <option value="">Other please specify</option>
                                @foreach ($courses as $course)
                                <option value="{{$course['name']}}">{{$course['name']}}</option>
                                @endforeach
                            </select>
                            <x-input-label for="name" :value="__('Course Name')" class="mt-4"/>
                            <x-text-input id="name" class="block mt-1 w-3/5 mr-1" type="text" name="name" x-bind:value="selectedOption" required autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="mt-4 flex flex-row">
                            <div class="w-full mr-3">
                                <x-input-label for="duration" :value="__('Duration')" />
                                <div class="flex flex-row">
                                    <x-text-input id="duration" class="block mt-1 w-2/3 mr-1" type="number" name="duration" :value="old('duration')" required  autocomplete="duration" /> 
                                    <!-- <span class="flex items-center ml-2">Hours</span> -->
                                    <select name="dur_mode" id="dur_mode" class="block w-1/3 mt-1 rounded-md border-gray-300" required autocomplete="dur_mode">
                                        @foreach($sharedDurModes as $key => $durMode)
                                        <option value="{{$key}}">{{$durMode}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                            </div>    
                            <div class="w-full ml-3">
                                <x-input-label for="price" :value="__('Price')" />
                                <div class="flex flex-row">
                                    <span class="flex items-center bg-gray-300 rounded rounded-r-none px-4 mt-1">£</span>
                                    <x-text-input type="number" id="price" name="price" class="block mt-1 w-full rounded-l-none" :value="old('price')" required autocomplete="price"/>
                                </div>
                                <x-input-error :messages="$errors->get('price')" class="mt-2" />
                            </div>
                        </div>
                        <div class="mt-4 flex flex-row">
                            <div class="w-full mr-3">
                                <x-input-label for="min_parts" :value="__('Min Participants')" />
                                <x-text-input id="min_parts" class="block mt-1 w-full " type="number" name="min_parts" :value="old('min_parts')" required  autocomplete="min_parts" /> 
                                <x-input-error :messages="$errors->get('min_parts')" class="mt-2" />
                            </div>    
                            <div class="w-full ml-3">
                                <x-input-label for="max_parts" :value="__('Max Participants')" />
                                <x-text-input id="max_parts" class="block mt-1 w-full " type="number" name="max_parts" :value="old('max_parts')" required  autocomplete="max_parts" /> 
                                <x-input-error :messages="$errors->get('max_parts')" class="mt-2" />
                            </div> 
                        </div>
                        <div class="mt-4 flex flex-row">
                            <div class="w-full mr-3">
                                <x-input-label for="level" :value="__('Level')" />
                                <x-text-input id="level" class="block mt-1 w-3/5 mr-1" type="text" name="level" :value="old('level')" required autocomplete="level" />
                                <x-input-error :messages="$errors->get('level')" class="mt-2" />
                            </div>    
                        </div>
                        <div class="mt-4 flex flex-col">
                            <x-input-label for="Region" :value="__('What regions do you offer')" class="mb-3"/>
                            <div class="border rounded-md border-gray-300 flex flex-col p-6">
                                <label class="mt-2">
                                    <span class="mr-7">{{__('London - England')}}</span> <input type="checkbox" name="region[]" value="London - England"> 
                                </label>
                                <label class="mt-2">
                                    <span class="mr-7">{{__('East Midlands - England')}}</span> <input type="checkbox" name="region[]" value="East Midlands - England"> 
                                </label>
                                <label class="mt-2">
                                    <span class="mr-7">{{__('West Midlands - England')}}</span> <input type="checkbox" name="region[]" value="West Midlands - England"> 
                                </label>
                                <label class="mt-2">
                                    <span class="mr-7">{{__('North East - England')}}</span> <input type="checkbox" name="region[]" value="North East - England"> 
                                </label>
                                <label class="mt-2">
                                    <span class="mr-7">{{__('North West - England')}}</span> <input type="checkbox" name="region[]" value="North West - England"> 
                                </label>
                                <label class="mt-2">
                                    <span class="mr-7">{{__('South West - England')}}</span> <input type="checkbox" name="region[]" value="South West - England"> 
                                </label>
                                <label class="mt-2">
                                    <span class="mr-7">{{__('South East - England')}}</span> <input type="checkbox" name="region[]" value="South East - England"> 
                                </label>
                                <label class="mt-2">
                                    <span class="mr-7">{{__('Yorkshire & The Humber - England')}}</span> <input type="checkbox" name="region[]" value="Yorkshire & The Humber - England"> 
                                </label>
                                <label class="mt-2">
                                    <span class="mr-7">{{__('Scotland')}}</span> <input type="checkbox" name="region[]" value="Scotland"> 
                                </label>
                                <label class="mt-2">
                                    <span class="mr-7">{{__('Wales')}}</span> <input type="checkbox" name="region[]" value="Wales"> 
                                </label>
                                <label class="mt-2">
                                    <span class="mr-7">{{__('Northern Ireland')}}</span> <input type="checkbox" name="region[]" value="Northern Ireland"> 
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('region')" class="mt-2" />
                        </div>
                        <div class="mt-4 flex flex-row">
                            <div class="w-full mr-3">
                                <x-input-label for="format" :value="__('What trainig format do you offer')" />
                               
                                <select x-cloak id="select" style="display: none;">
                                @foreach ($sharedFormat as $key => $format)
                                    <option value="{{$key}}">{{$format}}</option>
                                @endforeach    
                                </select>

                                <div x-data="() => {
                                        return {
                                            options: [],
                                            selected: [],
                                            show: false,
                                            open() { this.show = true },
                                            close() { this.show = false },
                                            isOpen() { return this.show === true },
                                            select(index, event) {

                                                if (!this.options[index].selected) {

                                                    this.options[index].selected = true;
                                                    this.options[index].element = event.target;
                                                    this.selected.push(index);

                                                } else {
                                                    this.selected.splice(this.selected.lastIndexOf(index), 1);
                                                    this.options[index].selected = false
                                                }
                                            },
                                            remove(index, option) {
                                                this.options[option].selected = false;
                                                this.selected.splice(index, 1);


                                            },
                                            loadOptions() {
                                                const options = document.getElementById('select').options;
                                                for (let i = 0; i < options.length; i++) {
                                                    this.options.push({
                                                        value: options[i].value,
                                                        text: options[i].innerText,
                                                        selected: options[i].getAttribute('selected') != null ? options[i].getAttribute('selected') : false
                                                    });
                                                }


                                            },
                                            selectedValues(){
                                                return this.selected.map((option)=>{
                                                    return this.options[option].value;
                                                })
                                            }
                                        }
                                    }" x-init="loadOptions()" class="w-full flex flex-col mt-1">
                                    <input name="format" id="format" required autocomplete="format" type="hidden" x-bind:value="selectedValues()">
                                    <div class="inline-block relative">
                                        <div class="flex flex-col items-center relative">
                                            <div x-on:click="open" class="w-full">
                                                <div class="p-1 flex border border-gray-200 bg-white rounded">
                                                    <div class="flex flex-auto flex-wrap">
                                                        <template x-for="(option,index) in selected" :key="options[option].value">
                                                            <div class="flex justify-center items-center m-1 font-medium py-1 px-1 bg-white rounded bg-gray-100 border">
                                                                <div class="text-xs font-normal leading-none max-w-full flex-initial x-model=" options[option] x-text="options[option].text"></div>
                                                                <div class="flex flex-auto flex-row-reverse">
                                                                    <div x-on:click.stop="remove(index,option)">
                                                                        <svg class="fill-current h-4 w-4 " role="button" viewBox="0 0 20 20">
                                                                            <path d="M14.348,14.849c-0.469,0.469-1.229,0.469-1.697,0L10,11.819l-2.651,3.029c-0.469,0.469-1.229,0.469-1.697,0
                                                                                c-0.469-0.469-0.469-1.229,0-1.697l2.758-3.15L5.651,6.849c-0.469-0.469-0.469-1.228,0-1.697s1.228-0.469,1.697,0L10,8.183
                                                                                l2.651-3.031c0.469-0.469,1.228-0.469,1.697,0s0.469,1.229,0,1.697l-2.758,3.152l2.758,3.15
                                                                                C14.817,13.62,14.817,14.38,14.348,14.849z" />
                                                                        </svg>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </template>
                                                        <div x-show="selected.length == 0" class="flex-1">
                                                            <input placeholder="Select a option" class="bg-transparent appearance-none outline-none h-full w-full text-gray-800 border-none" x-bind:value="selectedValues()">
                                                        </div>
                                                    </div>
                                                    <div class="text-gray-300 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200 svelte-1l8159u">
                                                        <button type="button" x-show="isOpen() === true" x-on:click="open" class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                                            <svg version="1.1" class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                                                <path d="M17.418,6.109c0.272-0.268,0.709-0.268,0.979,0s0.271,0.701,0,0.969l-7.908,7.83
                                                                    c-0.27,0.268-0.707,0.268-0.979,0l-7.908-7.83c-0.27-0.268-0.27-0.701,0-0.969c0.271-0.268,0.709-0.268,0.979,0L10,13.25
                                                                    L17.418,6.109z" />
                                                            </svg>
                                                        </button>
                                                        <button type="button" x-show="isOpen() === false" @click="close" class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                                            <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                                                <path d="M2.582,13.891c-0.272,0.268-0.709,0.268-0.979,0s-0.271-0.701,0-0.969l7.908-7.83
                                                                    c0.27-0.268,0.707-0.268,0.979,0l7.908,7.83c0.27,0.268,0.27,0.701,0,0.969c-0.271,0.268-0.709,0.268-0.978,0L10,6.75L2.582,13.891z
                                                                    " />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full px-4">
                                                <div x-show.transition.origin.top="isOpen()" class="absolute shadow top-100 bg-white z-40 w-full left-0 rounded max-h-select" x-on:click.away="close">
                                                    <div class="flex flex-col w-full overflow-y-auto">
                                                        <template x-for="(option,index) in options" :key="option" class="overflow-auto">
                                                            <div class="cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-gray-100" @click="select(index,$event)">
                                                                <div class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative">
                                                                    <div class="w-full items-center flex flex-row">
                                                                        <div x-show="option.selected">
                                                                            <svg style="width: 1em; height: 1em;" viewBox="0 0 20 20">
                                                                                <path fill="#333" d="M7.197,16.963H7.195c-0.204,0-0.399-0.083-0.544-0.227l-6.039-6.082c-0.3-0.302-0.297-0.788,0.003-1.087
                                                                                    C0.919,9.266,1.404,9.269,1.702,9.57l5.495,5.536L18.221,4.083c0.301-0.301,0.787-0.301,1.087,0c0.301,0.3,0.301,0.787,0,1.087
                                                                                    L7.741,16.738C7.596,16.882,7.401,16.963,7.197,16.963z"></path>
                                                                            </svg>
                                                                        </div>
                                                                        <div class="mx-2 leading-6" x-model="option" x-text="option.text"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </template>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <x-input-error :messages="$errors->get('format')" class="mt-2" />
                            </div>    
                            <div class="w-full ml-3">
                                <x-input-label for="certificate" :value="__('Certificate')" />
                                <select name="certificate" id="certificate" class="block w-full mt-1 rounded-md border-gray-300" required autocomplete="certificate">
                                    <option value="">Select certificate</option>
                                    <option value="cert_tra">Certificate of Achievement (assessed by trainer)</option>
                                    <option value="cert_ext">Certificate of Achievement (assessed externally)</option>
                                    <option value="other">Other</option>
                                </select>  
                                <x-input-error :messages="$errors->get('certificate')" class="mt-2" />
                            </div> 
                        </div>
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" class="block mt-1 w-full rounded-md resize-y border-gray-300 focus:border-blue-500" name="description" :value="old('description')" autocomplete="description" ></textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Add') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>