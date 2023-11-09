<x-app-layout>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="mb-5 w-full">
                        <div class="flex flex-wrap border-b border-[#E4E4E4] px-4">
                            @auth
                            @if(Auth::user()->type)
                            <a
                                href="trainers"
                                class="bg-primary py-2 px-4 font-medium md:text-base lg:px-6"
                            >
                                {{ __('All Trainers') }}
                            </a>
                            @else
                            @endif
                            @endauth
                            <a
                                href="courses"
                                class="text-body-color py-2 px-4 font-medium md:text-base lg:px-6"
                            >
                                {{ __('Courses List') }}
                            </a>
                            <a  
                                href="enquiries"
                                class="bg-gray-100 rounded-tr rounded-tl text-zinc-500 border-b-4 border-b-gray-800 text-body-color py-2 px-4 font-medium md:text-base lg:px-6"
                            >
                                {{ __('Enquiries') }}
                            </a>
                        </div>
                        <div>
                            <div class="text-body-color p-6 text-base leading-relaxed">
                                <div class="relative overflow-x-auto sm:rounded-lg mt-4">
                                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>
                                                <th scope="col" class="px-6 py-3">
                                                    Enquiry Time
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Name
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Organisation
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Action
                                                </th>
                                            </tr>
                                            <tr class="h-2"></tr>
                                        </thead>
                                        <tbody>
                                        @if($enquiries && (count($enquiries) > 0))
                                            @php    
                                                $i = 0;
                                            @endphp
                                            @foreach ($enquiries as $enquiry)
                                            @if($i%2 == 0)
                                            <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                                                <td class="">
                                                    <div class="flex items-center pl-5">
                                                        <p class="text-base font-medium leading-none text-gray-700 mr-2">{{$enquiry->created_at}}</p>
                                                    </div>
                                                </td>
                                                <td class="pl-5">
                                                    <div class="flex items-center pl-5">
                                                        <p class="text-base font-medium leading-none text-gray-700 mr-2">{{$enquiry['title'] ? $enquiry['title']."." : ""}} {{$enquiry['firstName']}} {{$enquiry['lastName']}}</p>
                                                    </div>
                                                </td>
                                                <td class="pl-5">
                                                    <div class="flex items-center pl-5">
                                                        <p class="text-base font-medium leading-none text-gray-700 mr-2">
                                                        {{$enquiry['organName']}}
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="pl-4">
                                                    <a href="enquiries/{{$enquiry->id}}" class="focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-gray-600 py-3 px-5 bg-gray-100 rounded hover:bg-gray-200 focus:outline-none">View</a>
                                                </td>
                                            </tr>
                                            <tr class="h-3"></tr>                
                                            
                                            @else
                                            <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded bg-gray-50 dark:bg-gray-800">
                                                <td class="">
                                                    <div class="flex items-center pl-5">
                                                        <p class="text-base font-medium leading-none text-gray-700 mr-2">{{$enquiry->created_at}}</p>
                                                    </div>
                                                </td>
                                                <td class="pl-5">
                                                    <div class="flex items-center pl-5">
                                                        <p class="text-base font-medium leading-none text-gray-700 mr-2">{{$enquiry['title'] ? $enquiry['title']."." : ""}} {{$enquiry['firstName']}} {{$enquiry['lastName']}}</p>
                                                    </div>
                                                </td>
                                                <td class="pl-5">
                                                    <div class="flex items-center pl-5">
                                                        <p class="text-base font-medium leading-none text-gray-700 mr-2">
                                                        {{$enquiry['organName']}}
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="pl-4">
                                                    <a href="enquiries/{{$enquiry->id}}" class="focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-gray-600 py-3 px-5 bg-gray-100 rounded hover:bg-gray-200 focus:outline-none">View</a>
                                                </td>
                                            </tr>
                                            <tr class="h-3"></tr>
                                            @endif
                                            @php    
                                                $i ++;
                                            @endphp
                                            @endforeach
                                        @else
                                            <tr><td class="pt-6 text-center text-base" colspan="4">{{__('No records')}}</td></tr>
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
</x-app-layout>
