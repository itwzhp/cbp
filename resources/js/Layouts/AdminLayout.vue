<script setup>
import {ref, onMounted} from 'vue';
import {Link} from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import AdminNavLink from '@/Components/Admin/AdminNavLink.vue';
import Avatar from '@/Components/Avatar.vue';
import ContentAccess from '@/Components/Admin/ContentAccess.vue';
import {permissions} from '@/Components/Admin/permissions.js';
import {Dropdown} from 'flowbite';

const pages = ref(new Map([
    ['admin.dashboard', 'Dashboard'],
    ['admin.materials.index', 'Materiały'],
    ['admin.materials.create', 'Dodaj materiał'],
    ['admin.materials.edit', 'Edytuj materiał'],
    ['admin.settings', 'Ustawienia'],
    ['admin.taxonomies.index', 'Tagi'],
    ['admin.users.index', 'Użytkownicy'],
]));

const initDropdownMenu = () => {
    const $targetEl = document.getElementById('dropdownMenu');
    const $triggerEl = document.getElementById('dropdownButton');
    const options = {
        placement: 'bottom',
        offsetSkidding: 0,
        offsetDistance: 25,
    };
    if ($targetEl) {
        const dropdown = new Dropdown($targetEl, $triggerEl, options);
        dropdown.hide();
    }
};

onMounted(() => {
    initDropdownMenu();
});

const mobileSidebarHidden = ref(true);
const toggleMobileSidebar = () => {
    mobileSidebarHidden.value = !mobileSidebarHidden.value;
};
</script>

<template>
  <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
      <div class="flex items-center justify-between">
        <div class="flex items-center justify-start">
          <button
            data-drawer-target="logo-sidebar"
            data-drawer-toggle="logo-sidebar"
            aria-controls="logo-sidebar"
            type="button"
            class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
            @click="toggleMobileSidebar()"
          >
            <span class="sr-only">Open sidebar</span>
            <svg
              class="w-6 h-6"
              aria-hidden="true"
              fill="currentColor"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                clip-rule="evenodd"
                fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"
              />
            </svg>
          </button>
          <Link
            :href="route('welcome')"
            class="flex ml-2 md:mr-24"
          >
            <ApplicationLogo />
          </Link>
        </div>
        <div class="flex items-center">
          <div class="flex items-center ml-3">
            <div class="hidden sm:flex items-center space-x-4 cursor-pointer">
              <div class="font-medium text-right mr-3">
                <div>{{ $page.props.auth.user.name }}</div>
                <div class="text-sm text-gray-500">
                  {{ $page.props.auth.user.email }}
                </div>
              </div>
            </div>
            <div>
              <button
                id="dropdownButton"
                type="button"
                class="flex text-sm rounded-full focus:ring-4 focus:ring-gray-300"
                aria-expanded="true"
                data-dropdown-toggle="dropdown-user"
              >
                <span class="sr-only">Open user menu</span>
                <Avatar
                  :width="10"
                  :height="10"
                  class="rounded-full"
                  :img-src="$page.props.auth.photo? 'data:image/jpeg;base64,'+$page.props.auth.photo : ''"
                />
              </button>
            </div>
            <div
              id="dropdownMenu"
              style="width: 190px"
              class="z-50 text-base list-none bg-white divide-y divide-gray-100 rounded shadow"
            >
              <ul
                class="py-1"
                role="none"
              >
                <li>
                  <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="w-full text-left"
                  >
                    <span
                      class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                      role="menuitem"
                    >
                      Wyloguj
                    </span>
                  </Link>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <aside
    id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0"
    :class="{ 'translate-x-0': !mobileSidebarHidden }"
    aria-label="Sidebar"
  >
    <div class="h-full px-3 py-4 overflow-y-auto bg-white">
      <ul class="space-y-2">
        <li>
          <AdminNavLink
            href="admin.dashboard"
            icon="fa-solid fa-chart-pie"
          >
            {{ pages.get('admin.dashboard') }}
          </AdminNavLink>
        </li>
        <li>
          <AdminNavLink
            href="admin.materials.index"
            child-href="admin.materials.edit"
            icon="fa-solid fa-file"
          >
            {{ pages.get('admin.materials.index') }}
          </AdminNavLink>
        </li>
        <ContentAccess :permissions="[permissions.CREATE_MATERIALS]">
          <li>
            <AdminNavLink
              href="admin.materials.create"
              icon="fa-solid fa-plus"
            >
              {{ pages.get('admin.materials.create') }}
            </AdminNavLink>
          </li>
        </ContentAccess>

        <ContentAccess :permissions="[permissions.MANAGE_MATERIALS]">
          <li>
            <AdminNavLink
              href="admin.taxonomies.index"
              icon="fa-solid fa-tag"
            >
              {{ pages.get('admin.taxonomies.index') }}
            </AdminNavLink>
          </li>
        </ContentAccess>

        <ContentAccess :permissions="[permissions.MANAGE_USERS]">
          <li>
            <AdminNavLink
              href="admin.settings"
              icon="fa-solid fa-gear"
            >
              {{ pages.get('admin.settings') }}
            </AdminNavLink>
          </li>
        </ContentAccess>

        <ContentAccess :permissions="[permissions.MANAGE_USERS]">
          <li>
            <AdminNavLink
              href="admin.users.index"
              icon="fa-solid fa-users"
            >
              {{ pages.get('admin.users.index') }}
            </AdminNavLink>
          </li>
        </ContentAccess>
      </ul>
    </div>
  </aside>
  <div class="p-4 sm:ml-64">
    <div class="p-4 mt-14">
      <p class="my-4 text-base font-semibold text-gray-900 md:text-xl">
        {{ pages.get(route().current()) }}
      </p>
      <slot />
    </div>
  </div>
</template>
<style scoped></style>
