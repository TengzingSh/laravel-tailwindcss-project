<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div
                        class="mb-5 w-full"
                    >
                        <div class="flex flex-wrap border-b border-[#E4E4E4] px-4">
                            <a
                                href="trainers"
                                class="bg-primary py-2 px-4 font-medium md:text-base lg:px-6 bg-gray-100 rounded-tr rounded-tl text-zinc-500 border-b-4 border-b-gray-800"
                            >
                                {{ __('All Trainers') }}
                            </a>
                            <a
                                href="courses"
                                class="text-body-color py-2 px-4 font-medium md:text-base lg:px-6"
                            >
                                {{ __('Courses List') }}
                            </a>
                            <a
                                href="enquiries"
                                class="text-body-color py-2 px-4 font-medium md:text-base lg:px-6"
                            >
                                {{ __('Enquiries') }}
                            </a>
                        </div>
                        <div>
                            <div
                                class="text-body-color p-6 text-base leading-relaxed"
                            >
                                <div class="sm:px-6 w-full">
                                    <div class="bg-white py-4 md:py-7 ">
                                        <div class="sm:flex items-center justify-between">
                                            <!-- <button onclick="popuphandler(true)" class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-indigo-700 hover:bg-indigo-600 focus:outline-none rounded">
                                                <p class="text-sm font-medium leading-none text-white">Add Task</p>
                                            </button> -->
                                        </div>
                                        <div class="mt-7 overflow-x-auto">
                                            <table class="w-full whitespace-nowrap">
                                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3">
                                                        Trainer Name
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Trainer Email
                                                    </th>
                                            
                                                    <th scope="col" class="px-6 py-3">
                                                        All Courses
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Provider Name
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Status
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Action
                                                    </th>
                                                </tr>
                                                <tr class="h-2"></tr>
                                            </thead>
                                            <tbody>
                                                @if($trainers && count($trainers) > 0 )
                                                    @php
                                                        $i = 0;
                                                    @endphp
                                                    @foreach($trainers as $trainer)
                                                    @if($i%2 == 0)
                                                    <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                                                        <td class="">
                                                            <div class="flex items-center pl-5">
                                                                <p class="text-base font-medium leading-none text-gray-700 mr-2">{{$trainer['user']['title'] ? $trainer['user']['title']."." : ""}} {{$trainer['user']['firstName']}} {{$trainer['user']['lastName']}}</p>
                                                            </div>
                                                        </td>
                                                        <td class="pl-5">
                                                            <div class="flex items-center pl-5">
                                                                <p class="text-base font-medium leading-none text-gray-700 mr-2">{{$trainer['user']['email']}} </p>
                                                            </div>
                                                        </td>
                                                        
                                                        <td class="pl-5">
                                                            <div class="flex items-center pl-5">
                                                                <p class="text-base font-medium leading-none text-gray-700 mr-2">{{count($trainer['user']['courses'])}} Courses </p>
                                                            </div>
                                                        </td>
                                                        <td class="pl-5">
                                                            <div class="flex items-center pl-5">
                                                                <p class="text-base font-medium leading-none text-gray-700 mr-2">{{$trainer['provider']}} </p>
                                                            </div>
                                                        </td>
                                                        <td class="pl-5">
                                                            <div class="flex items-center pl-5">
                                                                <p class="text-base font-medium leading-none text-gray-700 mr-2">
                                                                @if($trainer->approved)
                                                                <button class="py-3 px-3 text-sm leading-none text-green-700 bg-green-100 rounded focus:outline-none">{{__('Approved')}}</button>
                                                                @else
                                                                <button class="py-3 px-3 text-sm leading-none text-red-700 bg-red-100 rounded focus:outline-none">{{__('Pending')}}</button>
                                                                @endif
                                                                </p>
                                                            </div>
                                                        </td>
                                                        
                                                        <td class="pl-4">
                                                            <div class="flex items-center gap-1.5">
                                                                <a href="trainers/{{$trainer['id']}}" class="focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-gray-600 py-3 px-5 bg-gray-100 rounded hover:bg-gray-200 focus:outline-none">{{__('View')}}</a>
                                                                <a href="trainers/{{$trainer['id']}}/edit" class="focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-white py-3 px-5 bg-sky-400 rounded hover:bg-sky-500 focus:outline-none">{{__('Edit')}}</a>
                                                                <form method="POST" action="{{route('deltrainer', ['id' => $trainer->id])}}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="py-3 px-3 text-sm leading-none text-red-700 bg-red-100 rounded focus:outline-none">{{__('Delete')}}</button>
                                                                </form>
                                                            </div>
                                                        </td>                                                   
                                                    </tr>
                                                    <tr class="h-3"></tr>
                                                    @else
                                                    <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded bg-gray-50 dark:bg-gray-800">
                                                        <td class="">
                                                            <div class="flex items-center pl-5">
                                                                <p class="text-base font-medium leading-none text-gray-700 mr-2">{{$trainer['user']['title'] ? $trainer['user']['title']."." : ""}} {{$trainer['user']['firstName']}} {{$trainer['user']['lastName']}}</p>
                                                            </div>
                                                        </td>
                                                        <td class="pl-5">
                                                            <div class="flex items-center pl-5">
                                                                <p class="text-base font-medium leading-none text-gray-700 mr-2">{{$trainer['user']['email']}} </p>
                                                            </div>
                                                        </td>
                                                        
                                                        <td class="pl-5">
                                                            <div class="flex items-center pl-5">
                                                                <p class="text-base font-medium leading-none text-gray-700 mr-2">{{count($trainer['user']['courses'])}} Courses </p>
                                                            </div>
                                                        </td>
                                                        <td class="pl-5">
                                                            <div class="flex items-center pl-5">
                                                                <p class="text-base font-medium leading-none text-gray-700 mr-2">{{$trainer['provider']}} </p>
                                                            </div>
                                                        </td>
                                                        <td class="pl-5">
                                                            <div class="flex items-center pl-5">
                                                                <p class="text-base font-medium leading-none text-gray-700 mr-2">
                                                                @if($trainer->approved)
                                                                <button class="py-3 px-3 text-sm leading-none text-green-700 bg-green-100 rounded focus:outline-none">{{__('Approved')}}</button>
                                                                @else
                                                                <button class="py-3 px-3 text-sm leading-none text-red-700 bg-red-100 rounded focus:outline-none">{{__('Pending')}}</button>
                                                                @endif
                                                                </p>
                                                            </div>
                                                        </td>
                                                        <td class="pl-4">
                                                            <div class="flex items-center gap-1.5">
                                                                <a href="trainers/{{$trainer['id']}}" class="focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-gray-600 py-3 px-5 bg-gray-100 rounded hover:bg-gray-200 focus:outline-none">{{__('View')}}</a>
                                                                <a href="trainers/{{$trainer['id']}}/edit" class="focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-white py-3 px-5 bg-sky-400 rounded hover:bg-sky-500 focus:outline-none">{{__('Edit')}}</a>
                                                                <form method="POST" action="{{route('deltrainer', ['id' => $trainer->id])}}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="py-3 px-3 text-sm leading-none text-red-700 bg-red-100 rounded focus:outline-none">{{__('Delete')}}</button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="h-3"></tr>
                                                    @endif
                                                    @php
                                                        $i ++;
                                                    @endphp
                                                    @endforeach
                                                @else

                                                    <tr><td class="pt-6 text-center text-base" colspan="7">{{__('No records')}}</td></tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>
</x-app-layout>
