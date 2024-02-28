<template>
    <div>
      <nuxt-link to="/">Back</nuxt-link>
      <LoginForm />
      <SignUpForm />
    </div>
  </template>
  
  <script>
  import LoginForm from '/components/loginForm.vue';
  import SignUpForm from '/components/signUpForm.vue';
  
  export default {
    components: {
      LoginForm,
      SignUpForm
    }
  };
  </script>
  