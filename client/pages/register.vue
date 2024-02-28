<template>
    <div>
      <nuxt-link to="/">Back</nuxt-link>
      <SignUpForm />
    </div>
  </template>
  
  <script>
  import SignUpForm from '/components/RegisterForm.vue';
  
  export default {
    components: {
      SignUpForm
    }
  };
  </script>
  