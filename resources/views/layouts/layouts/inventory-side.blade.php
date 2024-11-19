<nav :class="{'block': open, 'hidden': !open}" class="flex-grow px-4 pb-4 md:block md:pb-0 md:overflow-y-auto">
    <x-admin-nav-link :href="route('admin_'.$type.'.inventory')" :active="request()->routeIs('admin_'.$type.'.inventory')">
        {{ __("All") }}
    </x-admin-nav-link>
    @foreach ($ticket_list as $item)
        <x-admin-nav-link :href="route('admin_'.$type.'.inventory_'.strtolower($item))" :active="request()->routeIs('admin_'.$type.'.'.strtolower($item).'.index')">
            {{ __($item) }}
        </x-admin-nav-link>
    @endforeach
    <div @click.away="open = false" class="relative" x-data="{ open: false }">
        <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg rounded-lg bg-transparent focus:text-white hover:text-white focus:bg-gray-600 hover:bg-gray-600 md:block focus:outline-none focus:shadow-outline">
            <span>{{ Auth::user()->name }}</span>
            <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
        <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
            <div class="px-1 py-2 rounded-md shadow bg-gray-700">
                <x-dropdown-admin-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-dropdown-admin-link>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-admin-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-admin-link>
                </form>

            </div>
        </div>
    </div>
</nav>