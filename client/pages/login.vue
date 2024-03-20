<template>
    <div>
      <NavigationButtons />
      <nuxt />
    </div>
  <div class="flex flex-col items-center justify-center min-h-screen bg-slate-200">
    <!-- Back button -->
    <div class="mb-4">
      <nuxt-link to="/" class="px-3 py-2 text-white duration-300 bg-blue-500 border rounded-lg hover:border-black hover:bg-white hover:text-black hover:border-1">Back</nuxt-link>
    </div>

    <!-- Login form -->
    <div class="w-full max-w-md">
      <h2 class="mb-4 text-2xl font-semibold">Login</h2>
      <form @submit.prevent="submitForm" class="space-y-4">
        <!-- Email field -->
        <div>
          <label for="email" class="block text-gray-600">Email</label>
          <div>
            <input type="text" name="email" id="email" placeholder="Email Address" v-model="state.user.email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
            <p class="text-red-700">{{ state.errors && state.errors._data && state.errors._data.errors && state.errors._data.errors.email && state.errors._data.errors.email[0]}}</p>
          </div>
        </div>

        <!-- Password field -->
        <div>
          <label for="password" class="block text-gray-600">Password</label>
          <div>
            <input type="password" name="password" id="password" placeholder="Password" v-model="state.user.password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
            <p class="text-red-700">{{ state.errors && state.errors._data && state.errors._data.errors && state.errors._data.errors.password && state.errors._data.errors.password[0]}}</p>
          </div>
        </div>

        <!-- Submit button -->
        <button type="submit" class="w-full py-2 text-white transition-colors duration-300 bg-blue-500 rounded-md shadow-md hover:bg-blue-900">Submit</button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import NavigationButtons from '~/components/default.vue'
import useVuelidate from '@vuelidate/core';
import { required } from '@vuelidate/validators';

  components: {
    NavigationButtons
  }
const state = reactive({
  errors: null,
  user: {
    email: null,
    password: null,
  }
})

const rules = {
    name: { required },
    email: { required },
    password: { required },
}

const validate$ = useVuelidate(rules, state)

async function submitForm() {
  const params = {
    email: state.user.email,
    password: state.user.password,
  };

  try {
    await validate$();
    const response = await $fetch('http://127.0.0.1:8000/api/auth/login', {
      method: 'POST',
      body: JSON.stringify(params),
      headers: {
        'Content-Type': 'application/json'
      }
    });

    if (response.data) {
      localStorage.setItem('_token', response.data.token);
      navigateTo('/dashboard');
    }
  } catch (error) {
    state.errors = error.response;
    console.log('Error:', error.response);
  }
}
</script>
