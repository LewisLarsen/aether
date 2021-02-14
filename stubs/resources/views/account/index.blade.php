<x-app-layout>
    @section('title', 'My Account -')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Account') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto px-6 lg:px-8 py-3 md:py-12">
            <div class="grid md:grid-cols-12 md:gap-12">
                <div class="md:col-span-3 col-span-9 mb-4 md:py-0">
                    @include('account.sidebar')
                </div>
                <div class="col-span-9">
                    <x-account.flash/>

                    @if(!Auth::user()->hasVerifiedEmail())
                        <div class="mb-3">
                            <div class="bg-yellow-100 text-yellow-800 font-semibold px-4 py-3 rounded-lg shadow-sm">
                                <svg class="w-5 h-5 inline text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                {{__("Your email address is still awaiting verification.")}}

                                <form class="inline" method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <a title="Resend Verification Email" onclick="event.preventDefault();
                                                this.closest('form').submit();"><span
                                                class="inline underline font-bold hover:text-yellow-700 cursor-pointer">{{__("Resend your verification email now")}}</span>.</a>
                                </form>
                            </div>
                        </div>
                    @endif


                    <div class="w-full bg-white shadow overflow-hidden rounded sm:rounded-lg">
                        <div class="px-6 py-4">
                            <div class="md:grid md:grid-cols-12">
                                <div class="col-span-6 md:flex items-center text-center md:text-left">
                                    @if(config('aether.show_avatar_on_account_index'))
                                        <img src="{{ Auth::user()->avatar('l') }}" alt="{{ Auth::user()->name }}"
                                             title="{{ Auth::user()->name }}"
                                             class="h-32 w-32 object-cover rounded-full items-baseline inline text-center"/>
                                    @endif
                                    <div class="md:ml-8 text-center md:text-left">
                                        <h1 class="text-2xl font-bold text-gray-800">
                                            {{ Auth::user()->name }}
                                        </h1>
                                        <p class="text-base md:text-lg font-semibold text-gray-500">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                                <div class="col-span-6 md:text-left text-sm md:flex items-center md:ml-12 mt-2 text-center">
                                    <ul>
                                        <li class="list-none text-gray-600 font-semibold">
                                            <svg class="w-5 h-5 inline" fill="none" stroke="currentColor"
                                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                            {{__("Email Verified:")}} @if(Auth::user()->hasVerifiedEmail())<span
                                                    class="font-bold text-green-500">{{__("Yes")}}</span>@else <span
                                                    class="font-bold text-red-500">{{__("No")}}</span>@endif</li>
                                        <li class="list-none text-gray-600 font-semibold mt-2">
                                            <svg class="w-5 h-5 inline -mt-1" fill="none" stroke="currentColor"
                                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{__("Registered:")}} <span
                                                    class="font-bold text-gray-600">{{ Auth::user()->created_at->format('D j M Y H:i') }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>