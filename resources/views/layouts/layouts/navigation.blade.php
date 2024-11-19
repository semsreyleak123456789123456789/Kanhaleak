<?php
    use App\Helpers\Algorithms;
    use Carbon\Carbon;

?>
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard.index') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard.index')" :active="request()->routeIs('dashboard.*')">
                        {{ __("general.dashboard") }}
                    </x-nav-link>

                    @if (Auth::user()->hasRole('admin_tuya'))
                        <x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')">
                            {{ __("general.admin") }}
                        </x-nav-link>
                    @endif

                    @if (Auth::user()->hasAnyRole(array_merge(Algorithms::$lead_ticket, Algorithms::$assist_ticket)))
                        @if (Auth::user()->hasAnyRole(Algorithms::$lead_ticket))
                            <div class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none"
                                :class="@js(request()->routeIs('admin_ticket.*')) ? 'border-indigo-400 text-gray-900 focus:border-indigo-700' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:text-gray-700 focus:border-gray-300'"   >
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button
                                            class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                            <div>{{ __("general.support_ticket") }}</div>

                                            <div class="ms-1">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('admin_ticket.GA.index')">
                                            Assign Ticket
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('admin_ticket.index')">
                                            My Ticket
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('admin_ticket.schedule-ticket.index')">
                                            Scheduled Ticket
                                        </x-dropdown-link>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        @else
                            <x-nav-link :href="route('admin_ticket.index')" :active="request()->routeIs('admin_ticket.index')">
                                {{ __("general.support_ticket") }}
                            </x-nav-link>
                        @endif
                    @endif

                    @if (Auth::user()->hasAnyRole(['admin_shop_controller', 'admin_shop_warehouse']))
                        <x-nav-link :href="route('admin_shop.index')" :active="request()->routeIs('admin_shop.index')">
                            {{ __("general.ym_shop") }}
                        </x-nav-link>
                    @endif

                    @if (Auth::user()->hasRole('admin_bill'))
                        <x-nav-link :href="route('admin_bill.index')" :active="request()->routeIs('admin_bill.index')">
                            {{ __("general.bill_record") }}
                        </x-nav-link>
                    @endif

                    @if (Auth::user()->hasRole('admin_user'))
                        <x-nav-link :href="route('user.index')" :active="request()->routeIs('user.index')">
                            {{ __("general.user") }}
                        </x-nav-link>
                    @endif
                    @if (Auth::user()->hasRole('training'))
                    <x-nav-link :href="route('training.adminindex')" :active="request()->routeIs('trainingindex')">
                        {{ __("Training") }}
                    </x-nav-link>
                @endif
                </div>
            </div>
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <form class="max-w-sm mx-auto" action="{{ route('locale.change') }}" method="POST">
                    @csrf
                    <select name="locale" onchange="this.form.submit()"
                        class=" border border-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                            value="en" {{ app()->getLocale() == 'en' ? ' selected' : '' }}>{{ trans("lang.english") }}
                        </option>
                        <option
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                            value="kh" {{ app()->getLocale() == 'kh' ? ' selected' : '' }}>{{ trans("lang.khmer") }}
                        </option>
                        <option
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                            value="ch" {{ app()->getLocale() == 'ch' ? ' selected' : '' }}>{{ trans("lang.chinese") }}
                        </option>
                    </select>
                </form>
            </div>
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ trans("lang.profile") }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ trans("lang.logout") }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>

                {{-- Notification bell --}}
                @php
                $notifications = Algorithms::listNotification();
                $count = Algorithms::newNotify();
                @endphp
                <div class="relative cursor-pointer" x-data="{ dropdownOpen: false }">
                    <svg @click="dropdownOpen = !dropdownOpen" class="w-6 h-6 text-blue-700 animate-wiggle"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 21">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            d="M15.585 15.5H5.415A1.65 1.65 0 0 1 4 13a10.526 10.526 0 0 0 1.5-5.415V6.5a4 4 0 0 1 4-4h2a4 4 0 0 1 4 4v1.085c0 1.907.518 3.78 1.5 5.415a1.65 1.65 0 0 1-1.415 2.5zm1.915-11c-.267-.934-.6-1.6-1-2s-1.066-.733-2-1m-10.912 3c.209-.934.512-1.6.912-2s1.096-.733 2.088-1M13 17c-.667 1-1.5 1.5-2.5 1.5S8.667 18 8 17" />
                    </svg>
                    @if ($count)
                    <div class="px-1 bg-blue-600 rounded-full text-center text-white text-xs absolute -top-3 -end-2"
                        id="countNoti">
                        {{ $count }}
                        <div class="absolute top-0 start-0 rounded-full -z-10 animate-ping bg-blue-200 w-full h-full">
                        </div>
                    </div>
                    @endif
                    @if (count($notifications) > 0)
                    <div x-show="dropdownOpen" @click.outside="dropdownOpen = false"
                        class="absolute right-0 mt-2 bg-white rounded-md  overflow-hidden z-20 shadow-2xl"
                        style="width:20rem;display: none;">
                        <div
                            class="bg-white py-1 px-2 text-lg text-gray-600 flex items-center border-b border-b-gray-300">
                            Notifications</div>
                        <div class="p-2 max-h-[293px]  overflow-y-scroll custom-scrollbar" id="notifications">
                            @foreach ($notifications as $noti)
                            @php
                            // Parse the timestamp
                            $timeAgo = Carbon::parse($noti->created_at)->diffForHumans();
                            @endphp
                            <a href="{{ route($noti->url) }}"
                                class="flex items-center justify-between py-1 border-b hover:bg-gray-100 clickread"
                                id="{{ $noti->id }}">
                                <div class="text-gray-600 mx-2">
                                    <div class="flex justify-between items-center">
                                        <p class="{{ $noti->read === 0 ? 'font-semibold' : '' }} text-sm">{{
                                            $noti->title }} </p>
                                        <p class="text-xs text-gray-500">{{ $timeAgo }}</p>
                                    </div>
                                    <p class="text-sm">{{ $noti->body }}</p>
                                </div>
                                @if (!$noti->read)
                                <div class="relative ">
                                    <p class="bg-blue-500 h-2 w-2 rounded-full absolute top-0 right-0"></p>
                                </div>
                                @endif
                            </a>
                            @endforeach
                        </div>
                        @if (count($notifications) > 19)
                        <a href="javascript:void(0);" id="seeMore"
                            class="block bg-gray-400 text-white text-center text-sm hover:font-bold py-1">See more</a>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard.index')" :active="request()->routeIs('dashboard.*')">
                {{ trans("lang.dashboard") }}
            </x-responsive-nav-link>

            @if (Auth::user()->hasRole('admin_tuya'))
            <x-responsive-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')">
                {{ trans("lang.admin_tuya") }}
            </x-responsive-nav-link>
            @endif
            @if (Auth::user()->hasAnyRole(array_merge(Algorithms::$lead_ticket, Algorithms::$assist_ticket)))
            <x-responsive-nav-link :href="route('admin_ticket.index')"
                :active="request()->routeIs('admin_ticket.index')">
                {{ trans("lang.admin_support_ticket") }}
            </x-responsive-nav-link>
            @endif
            @if (Auth::user()->hasAnyRole(['admin_shop_controller', 'admin_shop_warehouse']))
            <x-responsive-nav-link :href="route('admin_shop.index')" :active="request()->routeIs('admin_shop.index')">
                {{ trans("lang.admin_ym_shop") }}
            </x-responsive-nav-link>
            @endif
            @if (Auth::user()->hasRole('admin_bill'))
            <x-responsive-nav-link :href="route('admin_bill.index')" :active="request()->routeIs('admin_bill.index')">
                {{ trans("lang.admin_bill_record") }}
            </x-responsive-nav-link>
            @endif
            @if (Auth::user()->hasRole('admin_user'))
            <x-responsive-nav-link :href="route('user.index')" :active="request()->routeIs('user.index')">
                {{ trans("lang.admin_user") }}
            </x-responsive-nav-link>
            @endif
        </div>
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ trans("lang.profile") }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ trans("lang.logout") }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        <div class="py-2 border-t border-gray-200">
            <form class="px-2 mx-auto" action="{{ route('locale.change') }}" method="POST">
                @csrf
                <select name="locale" onchange="this.form.submit()"
                    class=" border border-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                        value="en" {{ app()->getLocale() == 'en' ? ' selected' : '' }}>{{ trans("lang.english") }}
                    </option>
                    <option
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                        value="kh" {{ app()->getLocale() == 'kh' ? ' selected' : '' }}>{{ trans("lang.khmer") }}
                    </option>
                    {{-- <option
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                        value="ch" {{ app()->getLocale() == 'ch' ? ' selected' : '' }}>{{ trans("lang.chinese") }}
                    </option> --}}
                </select>
            </form>
        </div>
    </div>
</nav>
