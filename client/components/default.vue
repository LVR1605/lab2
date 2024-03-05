<template>
  <div>
    <!-- Navigation bar -->
    <div class="fixed top-0 left-0 z-50 w-full p-5">
      <nav class="flex items-center justify-between p-5 bg-white shadow-md rounded-2xl">
        <div class="text-4xl">
          <p class="">Welcome!</p>
        </div>
        <div>
          <button @click="goTo('/login')" class="px-4 py-2 mr-4 text-xl text-white transition-colors duration-300 bg-blue-500 rounded-md shadow-md hover:bg-blue-900">Log In</button>
          <button @click="goTo('/register')" class="px-4 py-2 text-xl text-black transition-colors duration-300 bg-transparent rounded-md shadow-md hover:bg-blue-900 hover:text-white">Sign Up</button>
        </div>
      </nav>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    goTo(path) {
      this.$router.push(path);
    }
  }
}
</script>

<style>
  /* Add any additional styles here */
</style>
