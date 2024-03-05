<template>
  <div class="flex flex-col items-center justify-center min-h-screen">
    <!-- Navigation buttons -->
    <div class="mb-8">
      <button @click="goTo('/login')" class="px-4 py-2 mr-4 text-white transition-colors duration-300 bg-blue-500 rounded-md shadow-md hover:bg-blue-600">Log In</button>
      <button @click="goTo('/register')" class="px-4 py-2 text-white transition-colors duration-300 bg-green-500 rounded-md shadow-md hover:bg-green-600">Sign Up</button>
    </div>
    
    <!-- Back button and login form -->
    <div class="w-full max-w-md">
      <LoginForm />
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

