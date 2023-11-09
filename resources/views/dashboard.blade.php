<x-app-layout>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div
                        x-data="
                            {
                            openTab: 1,
                            activeClasses: 'bg-gray-100 rounded-tr rounded-tl text-zinc-500 border-b-4 border-b-gray-800',
                            inactiveClasses: 'text-body-color hover:text-zinc-500',
                            }
                        "
                        class="mb-5 w-full"
                    >
                        <div class="flex flex-wrap border-b border-[#E4E4E4] px-4">
                            <a
                                href="javascript:void(0)"
                                @click="openTab = 1"
                                :class="openTab === 1 ? activeClasses : inactiveClasses"
                                class="bg-primary py-2 px-4 font-medium md:text-base lg:px-6"
                            >
                                {{ __('All Trainers') }}
                            </a>
                            <a
                                href="javascript:void(0)"
                                @click="openTab = 2"
                                :class="openTab === 2 ? activeClasses : inactiveClasses"
                                class="text-body-color py-2 px-4 font-medium md:text-base lg:px-6"
                            >
                                {{ __('Courses List') }}
                            </a>
                            <a
                                href="javascript:void(0)"
                                @click="openTab = 3"
                                :class="openTab === 3 ? activeClasses : inactiveClasses"
                                class="text-body-color py-2 px-4 font-medium md:text-base lg:px-6"
                            >
                                {{ __('Enquiries') }}
                            </a>
                        </div>
                        <div>
                            <div
                                x-show="openTab === 1"
                                class="text-body-color p-6 text-base leading-relaxed"
                            >
                                
                            </div>
                            <div
                                x-show="openTab === 2"
                                class="text-body-color p-6 text-base leading-relaxed"
                                style="display: none"
                            >
                                <div class="flex items-center justify-end mt-4">
                                    <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-4 " href="{{ route('createcourse') }}">
                                        {{ __('Add New') }}
                                    </a>
                                   
                                </div>
                            </div>
                            <div
                                x-show="openTab === 3"
                                class="text-body-color p-6 text-base leading-relaxed"
                                style="display: none"
                            >
                                
                            </div>
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>

        
    </div>
</x-app-layout>
