<template>
  <div>
    <button @click="goTo('/login')">Log In</button>
    <button @click="goTo('/register')">Sign Up</button>
    <button @click="goTo('/dashboard')">Users</button>
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
