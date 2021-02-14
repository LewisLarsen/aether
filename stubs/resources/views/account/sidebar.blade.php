<div class="w-full bg-white shadow overflow-hidden rounded sm:rounded-lg">

    <x-account.sidebar-nav :href="route('account')" :active="request()->routeIs('account')">
        <svg class="w-5 h-5 -mt-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"
             xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
        </svg>
        {{__("My Account")}}
    </x-account.sidebar-nav>

    @if(config('aether.can_change_avatar'))
        <x-account.sidebar-nav :href="route('account.avatar')" :active="request()->routeIs('account.avatar')">
            <svg class="w-5 h-5 -mt-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            {{__("Change Avatar")}}
        </x-account.sidebar-nav>
    @endif

    @if(config('aether.can_change_name'))
        <x-account.sidebar-nav :href="route('account.name')" :active="request()->routeIs('account.name')">
            <svg class="w-5 h-5 -mt-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            {{__("Change Name")}}
        </x-account.sidebar-nav>
    @endif

    @if(config('aether.can_change_password'))
        <x-account.sidebar-nav :href="route('account.password')" :active="request()->routeIs('account.password')">
            <svg class="w-5 h-5 -mt-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
            </svg>
            {{__("Change Password")}}
        </x-account.sidebar-nav>
    @endif

    @if(config('aether.can_change_email'))
        <x-account.sidebar-nav :href="route('account.email')" :active="request()->routeIs('account.email')">
            <svg class="w-5 h-5 -mt-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg> {{__("Change Email")}}
        </x-account.sidebar-nav>
    @endif
</div>