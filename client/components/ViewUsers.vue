<template>
  <div v-if="isLoggedIn">
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
  <div v-else>
    <p>Please log in to view users.</p>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const users = ref([]);
const isLoggedIn = ref(false);

onMounted(async () => {
  try {
    const token = localStorage.getItem('_token');
    if (token) {
      isLoggedIn.value = true;

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
    }
  } catch (error) {
    console.error('Error fetching users:', error);
  }
});
</script>

<style>
/* Add your table styles here if needed */
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

th, td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

th {
  background-color: #f2f2f2;
}
</style>
