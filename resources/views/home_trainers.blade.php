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
                                href="/"
                                class="bg-primary py-2 px-4 font-medium md:text-base lg:px-6"
                            >
                                Search for courses
                            </a>
                            <a  
                                href="/home-trainers"
                                class="text-body-color py-2 px-4 font-medium md:text-base lg:px-6 bg-gray-100 rounded-tr rounded-tl text-zinc-500 border-b-4 border-b-gray-800"
                            >
                                All trainers
                            </a>
                        </div>
                        <div>
                            <form action="/search" method="GET" class="text-body-color p-6 text-base leading-relaxed flex justify-center" id="myForm">
                                @csrf
                                <input type="hidden" name="cat" value="trainer">
                                <label class="block">
                                    <span class="text-gray-700">Filter by regions covered</span>
                                    <select name="region" id="region" class="block w-full mt-1" x-on:change="document.getElementById('myForm').submit()">
                                        <option value="" {{isset($query) && ($query[0] == '') ? 'selected': '' }}>Select region</option>
                                        @foreach($sharedRegions as $region)
                                        <option value="{{$region}}" {{isset($query) && ($query[0] == $region) ? 'selected': '' }}>{{$region}}</option>
                                        @endforeach
                                    </select>
                                </label>
                                <label class="block ml-4">
                                    <span class="text-gray-700">Filter by course</span>
                                    <select name="course" id="course" class="block w-full mt-1" x-on:change="document.getElementById('myForm').submit()">
                                        <option value="" {{isset($query) && ($query[1] == '') ? 'selected': '' }}>Select course</option>
                                        @foreach($courseslist as $list)
                                        <option value="{{$list}}" {{isset($query) && ($query[1] == $list) ? 'selected': '' }}>{{$list}}</option>
                                        @endforeach
                                    </select>
                                </label>
                            </form>
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    @if($trainers && count($trainers)>0)
    @foreach($trainers as $trainer)
        @php 
        $offerdCourses = "";
        $offeredFormats = "";
        $courseslist = [];
        $formatlist = [];
        if($trainer['user']['courses'] && count($trainer['user']['courses']) > 0){
            foreach($trainer['user']['courses'] as $course){
                if(!in_array($course['name'], $courseslist, false)){
                    array_push($courseslist, $course['name']);
                }
                
                $formatVal = explode(",", $course['format']);
                foreach($formatVal as $format) {
                    if(!in_array($sharedFormat[$format], $formatlist, false)){
                        array_push($formatlist, $sharedFormat[$format]);
                    } 
                }
            }
            $offerdCourses = implode(", ", $courseslist);
            $offeredFormats = implode(", ", $formatlist);
        }
        @endphp
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-12 text-gray-900">
                    
                    <div class="flex justify-end">
                        <img class="w-24 h-24" src="{{asset('storage/'.$trainer['photo'])}}" alt="">
                    </div>
                    <div class="flex justify-start">
                        <h3 class="font-bold">{{$trainer['user']['title'] ? $trainer['user']['title']."." : ""}} {{$trainer['user']['firstName']}} {{$trainer['user']['lastName']}}</h3>
                    </div>
                    <div class="flex ">
                        <p class="font-bold mr-2">Coures Offered: </p>
                        <p>{{$offerdCourses}}</p>
                    </div>
                    <div class="flex ">
                        <p class="font-bold mr-2">Format: </p>
                        <p>{{$offeredFormats}}</p>
                    </div>
                    <div class="flex justify-end">
                        <a class="px-2 sm:px-2 py-1 sm:py-1 bg-gray-800 hover:bg-gray-700 text-white" href="{{route('viewtrainer', ['id' => $trainer['id']]) }}">View detail</a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @else
    <div class="font-medium flex justify-center mt-8 text-gray-500 text-base">No Records</div>
    @endif
    
</x-app-layout>
