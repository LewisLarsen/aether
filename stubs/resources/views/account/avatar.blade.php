<x-app-layout>
    @section('title', 'Change Avatar -')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Change Avatar') }}
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
                    <div class="w-full bg-white shadow overflow-hidden rounded sm:rounded-lg">
                        <div class="px-6 py-4">

                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4" :errors="$errors"/>

                            <form method="POST" action="{{ route('account.avatar') }}" enctype="multipart/form-data">
                            @csrf

                            <!-- Current Avatar -->
                                <div>
                                    <x-label for="avatar" :value="__('Current Avatar')"/>

                                    <img src="{{ Auth::user()->avatar('m') }}" alt="{{ Auth::user()->name }}" title="{{ Auth::user()->name }}"
                                         class="h-24 w-24 inline rounded-full object-cover">
                                </div>

                                <!-- Select New Avatar -->
                                <div class="mt-4">
                                    <x-label for="avatar" :value="__('Choose New Avatar')"/>

                                    <input type="file" id="avatar" name="avatar" class="block mt-1 w-full" required/>
                                </div>

                                <x-button class="mt-3">
                                    {{ __('Update') }}
                                </x-button>

                                @if(Auth::user()->avatar_path)
                                    <a href="{{ route('account.remove-avatar') }}">
                                        <x-button type="button" class="bg-white">
                                            {{__("Remove Avatar")}}
                                        </x-button>
                                    </a>
                                @endif
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
