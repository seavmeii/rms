<nav x-data="{ open: false }" class="bg-white border-b shadow-sm">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">

            <!-- LEFT SIDE -->
            <div class="flex items-center space-x-6">

                <!-- Logo -->
                <a href="/" class="flex items-center space-x-2">
                    <x-application-logo class="h-9 w-auto text-pink-500" />
                    <span class="font-bold text-lg text-gray-800">
                        Flower Restaurant
                    </span>
                </a>


                <!-- Desktop Navigation -->
                <div class="hidden sm:flex space-x-4">


                    @if(Auth::user()->role === 'admin')

                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        Dashboard
                    </x-nav-link>

                    <x-nav-link :href="route('admin.foods.index')" :active="request()->routeIs('admin.foods.*')">
                        Menu
                    </x-nav-link>

                    <x-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')">
                        Categories
                    </x-nav-link>

                    <x-nav-link :href="route('admin.orders.index')" :active="request()->routeIs('admin.orders.*')">
                        Orders
                    </x-nav-link>

                    @else

                    <x-nav-link :href="route('customer.foods.index')" :active="request()->routeIs('customer.foods.*')">
                        Menu
                    </x-nav-link>

                    <x-nav-link :href="route('customer.orders.index')" :active="request()->routeIs('customer.orders.*')">
                        My Orders
                    </x-nav-link>

                    @endif

                </div>

            </div>



            <!-- RIGHT SIDE -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button class="flex items-center text-sm font-medium text-gray-600 hover:text-gray-800">

                            <span class="mr-2">{{ Auth::user()->name }}</span>

                            <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>

                        </button>

                    </x-slot>



                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>


                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>



            <!-- MOBILE BUTTON -->
            <div class="flex items-center sm:hidden">

                <button @click="open = !open"
                    class="p-2 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100">

                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">

                        <path :class="{'hidden': open, 'inline-flex': ! open }"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />

                        <path :class="{'hidden': ! open, 'inline-flex': open }"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />

                    </svg>

                </button>

            </div>

        </div>

    </div>



    <!-- MOBILE MENU -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        <div class="pt-2 pb-3 space-y-1">


            @if(Auth::user()->role === 'admin')

            <x-responsive-nav-link :href="route('admin.dashboard')">
                Dashboard
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.foods.index')">
                Menu
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.categories.index')">
                Categories
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.orders.index')">
                Orders
            </x-responsive-nav-link>

            @else

            <x-responsive-nav-link :href="route('customer.foods.index')">
                Menu
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('customer.orders.index')">
                My Orders
            </x-responsive-nav-link>

            @endif

        </div>

    </div>

    

</nav>