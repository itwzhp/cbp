<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import {Head, Link, usePage} from '@inertiajs/vue3';
import EditUserRoles from '@/Components/Admin/UserEdit/EditUserRoles.vue';
import axios from 'axios';

const user = usePage().props.user;

const destroy = () => {
    axios
        .delete('/admin/users/' + user.id)
        .then(()=> {
            location.href = route('admin.users.index');
        })
};
</script>

<template>
  <Head title="Edycja użytkownika" />

  <AdminLayout>
    <Link
      :href="route('admin.users.index')"
      class="font-medium text-cbp-900 hover:underline ml-3"
      title="Wróć"
    >
      <font-awesome-icon icon="fa-solid fa-chevron-left" />
      Wróć
    </Link>

    <hr class="mb-5">

    <table>
      <tr>
        <td class="font-bold pr-3">
          ID
        </td>
        <td>{{ user.id }}</td>
      </tr>
      <tr>
        <td class="font-bold pr-3">
          Nazwa
        </td>
        <td>{{ user.name }}</td>
      </tr>
      <tr>
        <td class="font-bold pr-3">
          Imię
        </td>
        <td>{{ user.first_name }}</td>
      </tr>
      <tr>
        <td class="font-bold pr-3">
          Nazwisko
        </td>
        <td>{{ user.last_name }}</td>
      </tr>
      <tr>
        <td class="font-bold pr-3">
          Email
        </td>
        <td>{{ user.email }}</td>
      </tr>
    </table>
    <hr class="my-2">
    <h3 class="font-bold mb-3">
      Uprawnienia użytkownika:
    </h3>
    <EditUserRoles
      :roles="usePage().props.roles"
      :user="user"
    />

    <hr class="my-2">

    <div
      class="text-red-600 border-red-600 rounded cursor-pointer"
      @click="destroy"
    >
      <font-awesome-icon icon="fa-solid fa-trash" />
      Usuń użytkownika
    </div>
  </AdminLayout>
</template>
