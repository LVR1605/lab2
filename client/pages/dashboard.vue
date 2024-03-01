<template>
    <div>
      <nuxt-link to="/">Back</nuxt-link>
      <ViewUsers />
    </div>
  </template>
  
  <script>
  import ViewUsers from '/components/ViewUsers.vue';
  
  export default {
    components: {
      ViewUsers,
    }
  };
  </script>
  