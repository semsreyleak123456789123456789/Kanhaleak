<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" href="{{ url('IMG/logo.jpg') }}">
        <title>@yield('title') - Admin</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="flex-col w-full md:flex md:flex-row md:min-h-screen">
            <div @click.away="open = false" class="flex flex-col flex-shrink-0 w-full md:w-64 text-gray-200 bg-gray-800" x-data="{ open: false }">
                <div class="flex flex-row items-center justify-between flex-shrink-0 px-8 py-4">

                    <a href="{{ route('dashboard.index') }}" class="block mt-1 m-auto">
                        <x-application-logo class=" h-20 w-auto fill-current" />
                    </a>
                    <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
                        <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                            <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                            <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
            </div>
            <nav :class="{'block': open, 'hidden': !open}" class="flex-grow px-4 pb-4 md:block md:pb-0 md:overflow-y-auto">
                @php
                    $pcActive=request()->routeIs('admin.energy.meter.*')==true?"true":"false";
                    $aqdActive=request()->routeIs('admin.air.*')==true?"true":"false";
                    $waterActive=request()->routeIs('admin.water.*')==true?"true":"false";
                @endphp
                <div @click.away="open = {{ $pcActive }}" class="relative" x-data="{ open: {{ $pcActive }} }">
                    <button @click="open = !open" class="flex flex-row items-center  w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg rounded-lg bg-transparent focus:text-white hover:text-white focus:bg-gray-600 hover:bg-gray-600 md:block focus:outline-none focus:shadow-outline" >
                        <span>{{ trans("lang.energy") }}</span>
                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                    <ul x-show="open"  class="mt-2  px-1  rounded-md shadow  " >
                        <li>
                            <x-admin-nav-link :href="route('admin.energy.meter.index')" :active="request()->routeIs('admin.energy.meter.*')">
                                {{ trans("lang.power_clamp") }}
                            </x-admin-nav-link>
                        </li>
                    </ul>
                </div>
                <div @click.away="open = {{ $aqdActive }}" class="relative " x-data="{ open: {{ $aqdActive }} }">
                    <button @click="open = !open" class="flex flex-row  items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg rounded-lg bg-transparent focus:text-white hover:text-white focus:bg-gray-600 hover:bg-gray-600 md:block focus:outline-none focus:shadow-outline" >
                        <span> {{ trans("lang.air") }}</span>
                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                    <ul x-show="open" class="mt-2  px-1   rounded-md shadow ">
                            <li>
                                 <x-admin-nav-link {{--:href="route('admin.air.aqd.index')" :active="request()->routeIs('admin.air.aqd.index')" --}}>
                                    {{ trans("lang.tempertature_and_humidity") }}
                                </x-admin-nav-link>
                            </li>
                            <li>
                                <x-admin-nav-link :href="route('admin.air.ths.index')" :active="request()->routeIs('admin.air.ths.*')">
                                    {{ trans("lang.switch_fan_pump") }}
                                </x-admin-nav-link>
                            </li>
                            <li>
                                <x-admin-nav-link :href="route('admin.air.aqd.index')" :active="request()->routeIs('admin.air.aqd.*')">
                                    {{ trans("lang.air_quality_detector") }}
                                </x-admin-nav-link>
                            </li>
                    </ul>
                </div>
                <div @click.away="open = {{ $waterActive }}" class="relative " x-data="{ open: {{ $waterActive }} }">
                    <button @click="open = !open" class="flex flex-row  items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg rounded-lg bg-transparent focus:text-white hover:text-white focus:bg-gray-600 hover:bg-gray-600 md:block focus:outline-none focus:shadow-outline" >
                        <span> {{ trans("Water") }}</span>
                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                    <ul x-show="open" class="mt-2  px-1   rounded-md shadow ">
                            <li>
                                 <x-admin-nav-link :href="route('admin.water.water_meter.index')" :active="request()->routeIs('admin.water.water_meter.index')">
                                    {{ trans("Water Meter") }}
                                </x-admin-nav-link>
                            </li>
                          
                    </ul>
                </div>
                <div @click.away="open = false" class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg rounded-lg bg-transparent focus:text-white hover:text-white focus:bg-gray-600 hover:bg-gray-600 md:block focus:outline-none focus:shadow-outline">
                        <span>{{ Auth::user()->name }}</span>
                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
                        <div class="px-1 py-2 rounded-md shadow bg-gray-700">
                            <x-dropdown-admin-link :href="route('profile.edit')">
                                {{ trans("lang.profile") }}
                            </x-dropdown-admin-link>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-admin-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ trans("lang.logout") }}
                                </x-dropdown-admin-link>
                            </form>

                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <main class="m-2 p-8">
            <div class="z-30 fixed bottom-0 right-3 max-w-3xl justify-center">
                @php
                    $alertTypes = ['danger', 'success', 'warning'];
                @endphp

                @foreach ($alertTypes as $type)
                    @if (Session()->has($type))
                        <x-alert :type="$type" :message="Session()->get($type)" />
                    @endif
                @endforeach
            </div>

            {{ $slot }}
        </main>
    </body>
</html>
