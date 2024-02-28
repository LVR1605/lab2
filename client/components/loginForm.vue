<template>
    <div>
      <h2>Login</h2>
      <form @submit.prevent="login">
        <div>
          <label for="email">Email:</label>
          <input type="email" id="email" v-model="email" required>
        </div>
        <div>
          <label for="password">Password:</label>
          <input type="password" id="password" v-model="password" required>
        </div>
        <button type="submit">Login</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        email: '',
        password: ''
      };
    },
    methods: {
      login() {
        // Here you would typically send the login request to your backend
        // For simplicity, let's just log the email and password
        console.log('Email:', this.email);
        console.log('Password:', this.password);
  
        // After successful login, you can redirect the user to another page
        // For example:
        // this.$router.push('/dashboard');
      }
    }
  };
  </script>
  