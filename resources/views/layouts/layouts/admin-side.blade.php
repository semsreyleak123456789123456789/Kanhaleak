<nav :class="{ 'block': open, 'hidden': !open }" class="flex-grow px-4 pb-4 md:block md:pb-0 md:overflow-y-auto">
    @if (isset($ticket_list))
        @if ($type === 'ticket')
            <x-admin-nav-link :href="route('admin_ticket.schedule-ticket.index')" :active="false">
                {{ __('Scheduled Request Ticket') }}
            </x-admin-nav-link>
            <hr class="mx-2 my-1">
        @endif

        @foreach ($ticket_list as $key => $item)
            @if (is_array($item))
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-6 py-2 text-sm font-bold text-left">
                        <span class="truncate">{{ __(formatSegment(basename(url()->current()))) }}</span>
                        <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" class="pl-4 " style="display: none;">
                        @foreach ($item as $it)
                            <x-admin-nav-link :href="route('admin_'.$type.'.'.$it.'.index')" :active="request()->routeIs('admin_' . $type . '.' . $it . '.index')" style="color:rgb(196, 196, 196);">
                                {{ __(str_replace('_', ' ', $it)) }}
                            </x-admin-nav-link>
                        @endforeach
                    </div>
                </div>
            @else
                @php
                    $item_name = $type === 'ticket' ? $item : strtolower($item);
                @endphp
                <x-admin-nav-link :href="route('admin_' . $type . '.' . $item_name . '.index')" :active="request()->routeIs('admin_' . $type . '.' . $item_name . '.index')">
                    {{ __(str_replace('_', ' ', $item)) }}
                </x-admin-nav-link>
            @endif
        @endforeach
    
    @elseif (isset($org_list) && $type === 'chart')
        <x-admin-nav-link :href="route('dashboard.chart.index')" :active="false">
            {{ __('Org Chart') }}
        </x-admin-nav-link>

        @foreach ($org_list as $org_name)
            <x-admin-nav-link :href="route('org_chart.' . strtolower($org_name) . '.index')" :active="request()->routeIs('org_chart.' . strtolower($org_name) . '.index')">
                {{ __(str_replace('_', ' ', $org_name)) }}
            </x-admin-nav-link>
        @endforeach
    @else
        @php
            $pcActive = request()->routeIs('admin.energy.meter.*') == true ? 'true' : 'false';
            $aqdActive = request()->routeIs('admin.air.*') == true ? 'true' : 'false';
        @endphp
        <x-collapsible :open="$pcActive" label="{{ trans('lang.energy') }}">
            <x-admin-nav-link :href="route('admin.energy.meter.index')" :active="request()->routeIs('admin.energy.meter.*')">
                {{ __('Power Clamp') }}
            </x-admin-nav-link>
        </x-collapsible>

        <x-collapsible :open="$aqdActive" label="{{ __('Air') }}">
            <x-admin-nav-link :href="route('admin.air.aqd.index')" :active="request()->routeIs('admin.air.aqd.index')">
                {{ __('Temperature & Humidity') }}
            </x-admin-nav-link>
            <x-admin-nav-link :href="route('admin.air.ths.index')" :active="request()->routeIs('admin.air.ths.*')">
                {{ __('Switch (Fan & Pump)') }}
            </x-admin-nav-link>
            <x-admin-nav-link :href="route('admin.air.aqd.index')" :active="request()->routeIs('admin.air.aqd.*')">
                {{ __('Air Quality Detector') }}
            </x-admin-nav-link>
        </x-collapsible>
    @endif
    <div @click.away="open = false" class="relative" x-data="{ open: false }">
        <button @click="open = !open"
            class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg rounded-lg bg-transparent focus:text-white hover:text-white focus:bg-gray-600 hover:bg-gray-600 md:block focus:outline-none focus:shadow-outline">
            <span>{{ Auth::user()->name }}</span>
            <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}"
                class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>

        <div x-show="open" x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
            <div class="px-1 py-2 rounded-md shadow bg-gray-700">
                <x-dropdown-admin-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-dropdown-admin-link>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-admin-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-admin-link>
                </form>

            </div>
        </div>
    </div>
</nav>
