<x-app-layout>
    @section('title', 'Change Password -')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Change Password') }}
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

                            <form method="POST" action="{{ route('account.password') }}">
                            @csrf

                            <!-- Password -->
                                <div>
                                    <x-label for="password" :value="__('Current Password')"/>

                                    <x-input id="password" class="block mt-1 w-full" type="password"
                                             name="password" required autofocus/>
                                </div>

                                <!-- New Password -->
                                <div class="mt-4">
                                    <x-label for="new_password" :value="__('New Password')"/>

                                    <x-input id="new_password" class="block mt-1 w-full"
                                             type="password"
                                             name="new_password"
                                             required />
                                </div>

                                <!-- Confirm New Password -->
                                <div class="mt-4">
                                    <x-label for="new_password_confirmation" :value="__('Confirm New Password')"/>

                                    <x-input id="new_password_confirmation" class="block mt-1 w-full"
                                             type="password"
                                             name="new_password_confirmation"
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
