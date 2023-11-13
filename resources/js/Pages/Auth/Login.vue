<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import ZHPLogo from '@/Components/ZHPLogo.vue';

defineProps({
  canResetPassword: Boolean,
  status: String,
  isLocal: Boolean,
  token: String,
});

const form = useForm({
  userid: '',
});

const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('password'),
  });
};
</script>

<template>
  <GuestLayout>
    <Head title="Log in" />

    <div
      v-if="status"
      class="mb-4 font-medium text-sm text-green-600"
    >
      {{ status }}
    </div>

    <form
      v-if="isLocal"
      class="mb-5"
      @submit.prevent="submit"
    >
      <input
        type="hidden"
        name="_token"
        :value="token"
      >
      <div>
        <InputLabel
          for="userid"
          value="User ID"
        />
        <TextInput
          id="userid"
          v-model="form.userid"
          type="numeric"
          class="mt-1 block w-full"
          required
          autofocus
          autocomplete="userid"
        />
        <InputError
          class="mt-2"
          :message="form.errors.userid"
        />
      </div>

      <div class="flex items-center justify-end mt-4">
        <Link
          v-if="canResetPassword"
          :href="route('password.request')"
          class="underline text-sm text-gray-600 hover:text-gray-900"
        >
          Nie pamiętasz hasła?
        </Link>

        <PrimaryButton
          class="ml-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Zaloguj
        </PrimaryButton>
      </div>
    </form>

    <div class="text-center">
      <a
        :href="route('ms.login')"
        class="inline-flex items-center px-4 py-2 bg-gray-100 border border-zhp-500 rounded-md font-semibold text-xs text-zhp-500 uppercase tracking-widest hover:bg-gray-200 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
      >
        <ZHPLogo class="mr-5" />
        Zaloguj za pomocą <br>konta ZHP
      </a>
    </div>
  </GuestLayout>
</template>
