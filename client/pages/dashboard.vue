<template>
      <div class="min-h-32 bg-slate-200">
        <NavigationButtons />
        <nuxt />
      </div>


  <div class="min-h-screen bg-slate-200">
    <div class="flex items-center justify-center pb-10 ">
    <nuxt-link class="px-3 py-2 text-white duration-300 bg-blue-500 rounded-md hover:bg-red-500" to="/login">Logout</nuxt-link>
    <ViewUsers />
  </div>
    <h2 class="flex items-center justify-center pt-10 text-6xl">Users</h2>
    <div>
      <div class="flex items-center justify-center">
        <table class="m-10 border-2 border-black">
          <thead class="text-3xl">
            <tr class="bg-blue-300">
              <th class="py-3 font-semibold border-2 border-black px-60">Name</th>
              <th class="py-3 font-semibold border-2 border-black px-60">Email</th>
            </tr>
          </thead>
          <tbody class="text-xl bg-slate-50 ">
            <tr v-for="user in users" :key="user.id">
              <td class="py-3 border-black border-x-2 px-60 hover:bg-gray-200">{{ user.name }}</td>
              <td class="py-3 border-black border-x-2 px-60 hover:bg-gray-200">{{ user.email }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script setup>
import NavigationButtons from '~/components/default.vue'

components: {
  NavigationButtons
}
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
        alert('Successfully logged in');
      } else {
        console.error('Failed to fetch users:', response.statusText);
        alert('Error fetching users');
      }
    } catch (error) {
      console.error('Error fetching users:', error);
      alert('Error fetching users');
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
    // Show confirmation alert
    const confirmLogout = confirm('Are you sure you want to log out?');
    if (!confirmLogout) return;

    const response = await fetch('http://127.0.0.1:8000/api/auth/logout', {
      method: 'GET',
      headers: {
        'Authorization': `Bearer ${token}`
      }
    });

    if (response.ok) {
      console.log('User logged out successfully');
      alert('User logged out successfully');
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
