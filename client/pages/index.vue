<template>
  <div>
    <button @click="goTo('/login')">Log In</button>
    <button @click="goTo('/signup')">Sign Up</button>
    <button @click="goTo('/users')">Users</button>
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
