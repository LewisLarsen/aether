<x-app-layout>
    @section('title', 'Change Name -')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Change Name') }}
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

                            <form method="POST" action="{{ route('account.name') }}">
                            @csrf

                            <!-- Current Name -->
                                <div>
                                    <x-label for="name" :value="__('Current Name')"/>

                                    <x-input id="name" class="block mt-1 w-full cursor-not-allowed bg-gray-50" type="text"
                                             name="name" value="{{ Auth::user()->name }}" required disabled autofocus/>
                                </div>

                                <!-- Password -->
                                <div class="mt-4">
                                    <x-label for="password" :value="__('Password')"/>

                                    <x-input id="password" class="block mt-1 w-full" type="password"
                                             name="password" required autofocus/>
                                </div>

                                <!-- New Name -->
                                <div class="mt-4">
                                    <x-label for="name" :value="__('New Name')"/>

                                    <x-input id="name" class="block mt-1 w-full"
                                             type="text"
                                             name="name"
                                             required />
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
