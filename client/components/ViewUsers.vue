<template>
  <div>
    <div v-if="token">
      <h3>Token: {{ token }}</h3>
    </div>
    <div v-else>
      <h3>No token available</h3>
    </div>
    <h2>Users</h2>
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" :key="user.id">
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';

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

</script>
