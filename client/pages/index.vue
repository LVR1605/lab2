<template>
  <div>
    <button @click="goTo('/login')">Log In</button>
    <button @click="goTo('/register')">Sign Up</button>
  </div>
  <div>
      <nuxt-link to="/">Back</nuxt-link>
      <LoginForm />
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
