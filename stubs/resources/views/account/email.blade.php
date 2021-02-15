<x-app-layout>
    @section('title', 'Change Email -')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Change Email') }}
        </h2>
    </x-slot>


    <div class="py-6">
        <div class="max-w-6xl mx-auto px-6 lg:px-8 py-3 md:py-12">
            <div class="grid md:grid-cols-12 md:gap-12">

                <div class="md:col-span-3 col-span-9 mb-4 md:py-0">
                    @include('account.sidebar')
                </div>

                <div class="col-span-9">
                        <x-account.flash />
                    <div class="w-full bg-white shadow overflow-hidden rounded sm:rounded-lg">
                        <div class="px-6 py-4">

                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4" :errors="$errors"/>

                            <form method="POST" action="{{ route('account.email') }}">
                            @csrf

                            <!-- Current Email -->
                                <div>
                                    <x-label for="current_email" :value="__('Current Email')"/>

                                    <x-input id="current_email" class="block mt-1 w-full cursor-not-allowed bg-gray-50" type="email"
                                             name="current_email" value="{{ Auth::user()->email }}" disabled/>
                                </div>

                                <!-- Password -->
                                <div class="mt-4">
                                    <x-label for="password" :value="__('Password')"/>

                                    <x-input id="password" class="block mt-1 w-full" type="password"
                                             name="password" required autofocus/>
                                </div>

                                <!-- New Email -->
                                <div class="mt-4">
                                    <x-label for="email" :value="__('New Email')"/>

                                    <x-input id="email" class="block mt-1 w-full"
                                             type="email"
                                             name="email"
                                             required autofocus />
                                </div>

                                <!-- Confirm New Email -->
                                <div class="mt-4">
                                    <x-label for="email_confirmation" :value="__('Confirm New Email')"/>

                                    <x-input id="email_confirmation" class="block mt-1 w-full"
                                             type="email"
                                             name="email_confirmation"
                                             required autofocus />
                                </div>
                                <x-button class="mt-3">
                                    {{ __('Update') }}
                                </x-button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
