<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import NavElement from '@/Components/NavElement.vue';
import NavButton from '@/Components/NavButton.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import SearchSlideOver from '@/Components/Materials/SearchSlideOver.vue';
import Footer from '@/Layouts/Footer.vue';
import { useSearchStore } from '@/store/search.store';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
const store = useSearchStore();
const displaySearchDialog = (responsiveNavigationAction) => {
  if (responsiveNavigationAction) {
    showingNavigationDropdown.value = false;
    setTimeout(() => {
      store.displayDialog();
    }, 300);
  } else {
    store.displayDialog();
  }
};
const headline = ref(null);
</script>

<template>
  <div>
    <div class="bg-gradient-to-b from-white-300 via-white-200 to-white-100">
      <div ref="headline">
        <nav class="print:hidden absolute sm:static w-full z-10 bg-white">
          <!-- Primary Navigation Menu -->
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Primary Navigation Menu -->
            <div
              class="flex items-center justify-between md:justify-center border-gray-100 py-3 md:space-x-10"
            >
              <div class="hidden md:flex">
                <ApplicationLogo />
              </div>
              <!-- Hamburger -->
              <div class="-mr-2 flex items-center sm:hidden">
                <button
                  class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                  @click="showingNavigationDropdown = !showingNavigationDropdown"
                >
                  <svg
                    class="h-6 w-6"
                    stroke="currentColor"
                    fill="none"
                    viewBox="0 0 24 24"
                  >
                    <path
                      :class="{
                        hidden: showingNavigationDropdown,
                        'inline-flex': !showingNavigationDropdown,
                      }"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"
                    />
                    <path
                      :class="{
                        hidden: !showingNavigationDropdown,
                        'inline-flex': showingNavigationDropdown,
                      }"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"
                    />
                  </svg>
                </button>
              </div>
            </div>
          </div>

          <!-- Responsive Navigation Menu -->
          <div
            :class="{
              block: showingNavigationDropdown,
              hidden: !showingNavigationDropdown,
            }"
            class="sm:hidden"
          >
            <div class="pt-2 pb-3 space-y-1">
              <div class="flex justify-center">
                <ApplicationLogo />
              </div>
              <ResponsiveNavLink
                v-if="!$page.props.auth.user"
                :href="route('login')"
              >
                Zaloguj
              </ResponsiveNavLink>
              <ResponsiveNavLink
                class="bg-cbp-100/10"
                @click="displaySearchDialog(true)"
              >
                <font-awesome-icon icon="fa-solid fa-magnifying-glass" />
                Wyszukaj
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('about')"
                :active="route().current('about')"
              >
                O CBP
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.index')"
                :active="route().current('materials.index')"
              >
                Wszystkie Materiały
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :block="true"
                :active="route().current('materials.tag')"
              >
                Konspekty
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tag', '2-konspekt-ksztalceniowy')"
                :active="
                  route().current('materials.tag', { tag: '2-konspekt-ksztalceniowy' })
                "
              >
                &emsp;Kształceniowe
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tag', '2-program')"
                :active="route().current('materials.tag', { tag: '2-program' })"
              >
                &emsp;Program/plan
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tag', '2-propozycja-programowa')"
                :active="
                  route().current('materials.tag', { tag: '2-propozycja-programowa' })
                "
              >
                &emsp;Propozycje programowe
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tag', '2-poradnik')"
                :active="route().current('materials.tag', { tag: '2-poradnik' })"
              >
                &emsp;Poradniki
              </ResponsiveNavLink>
            </div>

            <!-- Responsive Settings Options -->
            <div
              v-if="$page.props.auth.user"
              class="pt-4 pb-1 border-t border-gray-200"
            >
              <div class="px-4">
                <div class="font-medium text-base text-gray-800">
                  {{ $page.props.auth.user.name }}
                </div>
                <div class="font-medium text-sm text-gray-500">
                  {{ $page.props.auth.user.email }}
                </div>
              </div>

              <div class="mt-3 space-y-1">
                <ResponsiveNavLink
                  :href="route('admin.dashboard')"
                >
                  Panel administracyjny
                </ResponsiveNavLink>
              </div>
              <div class="mt-3 space-y-1">
                <ResponsiveNavLink
                  :href="route('logout')"
                  method="post"
                  as="button"
                >
                  Wyloguj
                </ResponsiveNavLink>
                <hr>
              </div>
            </div>
          </div>
        </nav>
        <nav class="print:hidden border-b border-gray-100 print:hidden">
          <div class="max-w-7xl max-h-10 mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-center h-12">
              <div class="flex">
                <!-- Navigation Links -->
                <div class="max-h-10 hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                  <NavLink
                    :href="route('about')"
                    :active="route().current('about')"
                  >
                    O CBP
                  </NavLink>
                  <NavLink
                    :href="route('materials.index')"
                    :active="route().current('materials.index')"
                  >
                    Wszystkie Materiały
                  </NavLink>
                  <Dropdown width="48">
                    <template #trigger>
                      <NavButton
                        :active="
                          route().current('materials.tag', {
                            tag: '2-konspekt-ksztalceniowy',
                          }) ||
                            route().current('materials.tag', {
                              tag: '2-konspekt-programowy',
                            })
                        "
                      >
                        Konspekty
                      </NavButton>
                    </template>
                    <template #content>
                      <ResponsiveNavLink
                        :href="route('materials.tag', '2-konspekt-ksztalceniowy')"
                        :active="
                          route().current('materials.tag', {
                            tag: '2-konspekt-ksztalceniowy',
                          })
                        "
                      >
                        Kształceniowe
                      </ResponsiveNavLink>
                      <ResponsiveNavLink
                        :href="route('materials.tag', '2-konspekt-programowy')"
                        :active="
                          route().current('materials.tag', {
                            tag: '2-konspekt-programowy',
                          })
                        "
                      >
                        Programowe
                      </ResponsiveNavLink>
                    </template>
                  </Dropdown>
                  <NavLink
                    :href="route('materials.tag', '2-program')"
                    :active="route().current('materials.tag', { tag: '2-program' })"
                  >
                    Program/plan
                  </NavLink>
                  <NavLink
                    :href="route('materials.tag', '2-propozycja-programowa')"
                    :active="
                      route().current('materials.tag', { tag: '2-propozycja-programowa' })
                    "
                  >
                    Propozycje programowe
                  </NavLink>
                  <NavLink
                    :href="route('materials.tag', '2-poradnik')"
                    :active="route().current('materials.tag', { tag: '2-poradnik' })"
                  >
                    Poradniki
                  </NavLink>
                  <NavElement>
                    <span
                      class="cursor-pointer"
                      @click="displaySearchDialog()"
                    >
                      <font-awesome-icon icon="fa-solid fa-magnifying-glass" />
                      Wyszukaj
                    </span>
                  </NavElement>
                  <NavElement>
                    <Dropdown
                      v-if="$page.props.auth.user"
                      align="right"
                      width="48"
                    >
                      <template #trigger>
                        <span class="inline-flex rounded-md">
                          <button
                            type="button"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                          >
                            {{ $page.props.auth.user.name }}
                            <svg
                              class="ml-2 -mr-0.5 h-4 w-4"
                              xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 20 20"
                              fill="currentColor"
                            >
                              <path
                                fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                              />
                            </svg>
                          </button>
                        </span>
                      </template>
                      <template #content>
                        <DropdownLink
                          v-if="$page.props.auth.user"
                          :href="route('admin.dashboard')"
                        >
                          Panel administracyjny
                        </DropdownLink>
                        <DropdownLink
                          :href="route('logout')"
                          method="post"
                          as="button"
                        >
                          Wyloguj
                        </DropdownLink>
                      </template>
                    </Dropdown>
                    <Link
                      v-if="!$page.props.auth.user"
                      :href="route('login')"
                    >
                      Zaloguj się
                    </Link>
                  </NavElement>
                </div>
              </div>
            </div>
          </div>
        </nav>

        <div v-if="$page.props.flash && $page.props.flash.message">
          <div
            class="p-3 my-5 bg-gray-200 max-w-7xl mx-auto"
            :class="$page.props.flash.message.class"
          >
            {{ $page.props.flash.message }}
          </div>
        </div>

        <!-- Page Heading -->
        <header
          v-if="$slots.header"
          class="bg-white shadow"
        >
          <div class="max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8 print:px-1 print:py-1">
            <slot name="header" />
          </div>
        </header>
      </div>

      <!-- Page Content -->
      <main
        id="main-content"
        class="main-content"
        :style="`height: calc(100vh - ${headline?.clientHeight || 0}px); overflow: auto`"
      >
        <slot />
        <Footer />
      </main>
    </div>
  </div>
  <SearchSlideOver />
</template>
<style scoped>
@media print {
  .main-content {
    height: auto !important;
  }
}
</style>
