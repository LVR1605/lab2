<template>
  <div class="flex flex-col items-center justify-center min-h-screen">
    <!-- Back button -->
    <div class="mb-4">
      <nuxt-link to="/" class="text-blue-500 hover:underline">Back</nuxt-link>
    </div>

    <!-- Sign Up form -->
    <div class="w-full max-w-md">
      <h2 class="mb-4 text-2xl font-semibold">Register</h2>
      <form @submit.prevent="submitForm" class="space-y-4">
        <!-- Name field -->
        <div>
          <label for="name" class="block text-gray-600">Name</label>
          <div>
            <input type="text" name="name" id="name" placeholder="Name" v-model="state.user.name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
            <p v-if="state.errors && state.errors.name" class="text-red-700">{{ state.errors.name[0] }}</p>
          </div>
        </div>

        <!-- Email field -->
        <div>
          <label for="email" class="block text-gray-600">Email</label>
          <div>
            <input type="text" name="email" id="email" placeholder="Email Address" v-model="state.user.email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
            <p v-if="state.errors && state.errors.email" class="text-red-700">{{ state.errors.email[0] }}</p>
          </div>
        </div>

        <!-- Password field -->
        <div>
          <label for="password" class="block text-gray-600">Password</label>
          <div>
            <input type="password" name="password" id="password" placeholder="Password" v-model="state.user.password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
            <p v-if="state.errors && state.errors.password" class="text-red-700">{{ state.errors.password[0] }}</p>
          </div>
        </div>

        <!-- Submit button -->
        <button type="submit" class="w-full py-2 text-white transition-colors bg-blue-500 rounded-md shadow-md hover:bg-blue-600">Submit</button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { reactive } from 'vue'

const state = reactive({
  errors: null,
  user: {
    name: null,
    email: null,
    password: null,
  }
})

async function submitForm() {
  const params = {
    name: state.user.name,
    email: state.user.email,
    password: state.user.password,
  };

  try {
    const response = await $fetch('http://127.0.0.1:8000/api/auth/register', {
      method: 'POST',
      body: JSON.stringify(params),
      headers: {
        'Content-Type': 'application/json'
      }
    });

    if (response.data && response.data.token) {
      localStorage.setItem('_token', response.data.token);
      navigateTo('/');
      alert('Successfully created');
    }
  } catch (error) {
    state.errors = error.response.data.errors;
    console.log('Error:', error.response);
  }
}
</script>
