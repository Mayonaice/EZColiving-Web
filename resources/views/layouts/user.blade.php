                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <div class="flex space-x-6">
                            <a href="{{ route('userhome') }}" class="text-gray-600 hover:text-gray-800 {{ request()->routeIs('userhome') ? 'text-gray-800' : '' }}">Home</a>
                            <a href="{{ route('user.rooms.index') }}" class="text-gray-600 hover:text-gray-800 {{ request()->routeIs('user.rooms.*') ? 'text-gray-800' : '' }}">Kamar</a>
                            <a href="{{ route('user.bookings.history') }}" class="text-gray-600 hover:text-gray-800 {{ request()->routeIs('user.bookings.*') ? 'text-gray-800' : '' }}">Riwayat Booking</a>
                            <a href="{{ route('user.damages.index') }}" class="text-gray-600 hover:text-gray-800 {{ request()->routeIs('user.damages.*') ? 'text-gray-800' : '' }}">Riwayat Kerusakan</a>
                            <a href="{{ route('user.about') }}" class="text-gray-600 hover:text-gray-800 {{ request()->routeIs('user.about') ? 'text-gray-800' : '' }}">About</a>
                        </div>
                    </div>

                <div class="pt-2 pb-3 space-y-1">
                    <a href="{{ route('userhome') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('userhome') ? 'border-blue-500 text-blue-700 bg-blue-50' : 'border-transparent' }} text-base font-medium hover:text-gray-800 hover:bg-gray-50 transition duration-150 ease-in-out">Home</a>
                    <a href="{{ route('user.rooms.index') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('user.rooms.*') ? 'border-blue-500 text-blue-700 bg-blue-50' : 'border-transparent' }} text-base font-medium hover:text-gray-800 hover:bg-gray-50 transition duration-150 ease-in-out">Kamar</a>
                    <a href="{{ route('user.bookings.history') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('user.bookings.*') ? 'border-blue-500 text-blue-700 bg-blue-50' : 'border-transparent' }} text-base font-medium hover:text-gray-800 hover:bg-gray-50 transition duration-150 ease-in-out">Riwayat Booking</a>
                    <a href="{{ route('user.damages.index') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('user.damages.*') ? 'border-blue-500 text-blue-700 bg-blue-50' : 'border-transparent' }} text-base font-medium hover:text-gray-800 hover:bg-gray-50 transition duration-150 ease-in-out">Riwayat Kerusakan</a>
                    <a href="{{ route('user.about') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('user.about') ? 'border-blue-500 text-blue-700 bg-blue-50' : 'border-transparent' }} text-base font-medium hover:text-gray-800 hover:bg-gray-50 transition duration-150 ease-in-out">About</a>
                </div> 