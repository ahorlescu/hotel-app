<template>
  <div>
    <nav class="bg-gray-800">
      <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
          <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
            <!-- Mobile menu button-->
            <button
              class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
              aria-expanded="false"
            >
              <span class="sr-only">Open main menu</span>

              <svg
                class="block h-6 w-6"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                aria-hidden="true"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"
                />
              </svg>

              <svg
                class="hidden h-6 w-6"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                aria-hidden="true"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"
                />
              </svg>
            </button>
          </div>
          <div
            class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start"
          >
            <div class="hidden sm:block sm:ml-6">
              <div class="flex space-x-4">
                <inertia-link
                  :href="route('home')"
                  :class="
                    $page.component == 'Home'
                      ? 'bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium'
                      : ' text-white px-3 py-2 rounded-md text-sm font-medium'
                  "
                >
                  {{ $page.props.appName }}
                </inertia-link>

                <inertia-link
                  :href="route('rooms.public')"
                  :class="
                    $page.component == 'Rooms'
                      ? 'bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium'
                      : ' text-white px-3 py-2 rounded-md text-sm font-medium'
                  "
                >
                  Camere
                </inertia-link>

                <inertia-link
                  :href="route('media')"
                  :class="
                    $page.component == 'Media'
                      ? 'bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium'
                      : ' text-white px-3 py-2 rounded-md text-sm font-medium'
                  "
                >
                  Galerie
                </inertia-link>

                <inertia-link
                  :href="route('contact')"
                  :class="
                    $page.component == 'Contact'
                      ? 'bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium'
                      : ' text-white px-3 py-2 rounded-md text-sm font-medium'
                  "
                >
                  Contact
                </inertia-link>
              </div>
            </div>
          </div>
          <div
            class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0"
          >
            <div class="hidden top-0 right-0 px-6 py-4 sm:block">
              <inertia-link
                v-if="$page.props.user"
                :href="route('general')"
                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
              >
                Dashboard
              </inertia-link>

              <template v-else>
                <inertia-link
                  :href="route('login')"
                  class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                >
                  Login
                </inertia-link>
              </template>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </div>
</template>