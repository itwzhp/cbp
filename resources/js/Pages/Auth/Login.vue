<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
  canResetPassword: Boolean,
  status: String,
  isLocal: Boolean,
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
      @submit.prevent="submit"
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

      <div>
        <a
          :href="route('ms.login')"
          class="btn btn-primary"
        >
          Zaloguj za pomocą konta ZHP
        </a>
      </div>
    </form>
  </GuestLayout>
</template>
