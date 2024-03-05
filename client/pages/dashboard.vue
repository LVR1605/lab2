<template>
  <div>
    <nuxt-link to="/">Back</nuxt-link>
    <ViewUsers />
  </div>

  <div class="mt-4">
    <h2 class="flex items-center justify-center mb-2 text-xl font-bold">Users</h2>
    <div class="flex items-center justify-center border-2 border-red-900">
      <div class="w-9/12">
        <table class="w-full">
          <thead class="flex items-center justify-between">
            <tr class="bg-gray-200">
              <th class="px-4 py-2">Name</th>
            </tr>
            <tr class="bg-gray-200">
              <th class="px-4 py-2">Email</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="user in users" :key="user.id" class="border-t">
              <td class="px-4 py-2">{{ user.name }}</td>
              <td class="px-4 py-2">{{ user.email }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount, watch } from 'vue';

const users = ref([]);
let token = null;

// Check if localStorage is available before accessing it
if (typeof localStorage !== 'undefined') {
  token = localStorage.getItem('_token');
}

onMounted(async () => {
  if (token) {
    try {
      const response = await fetch('http://127.0.0.1:8000/api/auth/users', {
        headers: {
          'Authorization': `Bearer ${token}`
        }
      });

      if (response.ok) {
        const data = await response.json();
        users.value = data.data;
      } else {
        console.error('Failed to fetch users:', response.statusText);
      }
    } catch (error) {
      console.error('Error fetching users:', error);
    }
  }
});

onBeforeUnmount(() => {
  // Check if the current URL is not localhost:3000/dashboard before clearing the token
  if (!window.location.href.includes('localhost:3000/dashboard')) {
    logoutUser();
  }
});

async function logoutUser() {
  try {
    const response = await fetch('http://127.0.0.1:8000/api/auth/logout', {
      method: 'GET',
      headers: {
        'Authorization': `Bearer ${token}`
      }
    });

    if (response.ok) {
      console.log('User logged out successfully');
    } else {
      console.error('Failed to log out user:', response.statusText);
    }
  } catch (error) {
    console.error('Error logging out user:', error);
  }

  // Clear token from localStorage
  if (typeof localStorage !== 'undefined') {
    localStorage.removeItem('_token');
  }
}

watch(() => window.location.href, (newValue, oldValue) => {
  if (newValue !== oldValue && newValue.includes('/dashboard')) {
    window.history.pushState({}, '', '/dashboard');
  }
});

</script>
