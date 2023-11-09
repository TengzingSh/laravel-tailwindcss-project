<x-app-layout>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="border-b p-6 text-gray-900">
                    {{ __('Courses Name') }}
                </div>
                <div class="p-12 text-gray-900">
                    <form method="POST" action="{{ route('coursetemplates.store')}}" class="mb-4">
                        @csrf
                        <div class="w-1/2">
                            <x-input-label for="name" :value="__('New Course Name')" class="mt-4 mb-1"/>
                            <div class="flex flex-row mb-8">
                                <x-text-input id="name" class="block mr-2 w-full" type="text" name="name" required autocomplete="name" />
                                <x-primary-button type="submit" class="ml-2 flex item-center mt-1 mb-1">
                                    {{ __('Add') }}
                                </x-primary-button>
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                    </form>

                    <div class="relative overflow-x-auto sm:rounded-lg mt-4">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Course Name
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
                            @if($coursenames && (count($coursenames) > 0))
                                            
                                @php    
                                    $i = 0;
                                @endphp
                                @foreach ($coursenames as $cname)
                                <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded {{ $i % 2 ? 'bg-gray-50 dark:bg-gray-800' : ''}}" >
                                    <td class="">
                                        <div class="flex items-center pl-5">
                                            <p class="text-base font-medium leading-none text-gray-700 mr-2">{{$cname->name}} </p>
                                        </div>
                                    </td>
                                    <td class="pl-5">
                                        <div class="flex items-center pl-5">
                                            <form method="POST" action="{{route('coursetemplates.approve', ['id' => $cname->id])}}">
                                                @csrf    
                                                <p class="text-base font-medium leading-none text-gray-700 mr-2">
                                                    <button type="submit" class="py-3 px-3 text-sm leading-none {{$cname->approved ? 'text-green-700 bg-green-100' : 'text-red-700 bg-red-100'}} rounded focus:outline-none">{{$cname->approved ? __('Approved') : __('Pending')}}</button>
                                                </p>
                                            </form>
                                            
                                        </div>
                                    </td>
                                    <td class="pl-4 flow flow-row">
                                        <!-- <a href="" class="focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-gray-600 py-3 px-5 bg-gray-100 rounded hover:bg-gray-200 focus:outline-none">Edit</a> -->
                                        <form method="POST" action="{{route('coursetemplates.del', ['id' => $cname->id])}}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-gray-600 py-3 px-5 bg-gray-100 rounded hover:bg-gray-200 focus:outline-none">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <tr class="h-3"></tr>                
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
</x-app-layout>