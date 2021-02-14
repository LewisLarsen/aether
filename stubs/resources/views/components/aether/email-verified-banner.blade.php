@if(session('verified'))
    <div class="bg-green-500">
        <div class="max-w-screen-xl mx-auto py-2 px-3 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between flex-wrap">
                <div class="w-0 flex-1 flex items-center min-w-0">
                <span class="flex p-2 rounded-lg bg-green-600">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd"
                                                                  d="M2.94 6.412A2 2 0 002 8.108V16a2 2 0 002 2h12a2 2 0 002-2V8.108a2 2 0 00-.94-1.696l-6-3.75a2 2 0 00-2.12 0l-6 3.75zm2.615 2.423a1 1 0 10-1.11 1.664l5 3.333a1 1 0 001.11 0l5-3.333a1 1 0 00-1.11-1.664L10 11.798 5.555 8.835z"
                                                                  clip-rule="evenodd"></path></svg>
                </span>

                    <p class="ml-3 font-medium text-sm text-white truncate">{{__("Your email has been verified.")}}</p>
                </div>
            </div>
        </div>
    </div>
@endif