<x-app-layout>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" style="height:300px;">
                    <div class="text-center text-xl font-medium py-28">
                        @if(isset($provider))
                        Thank you for your enquiry, {{$provider}} will get back to you shortly.
                        @else
                        Thank you for registering, We will get back to you shortly.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
