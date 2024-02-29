<template>
  <form @submit.prevent="registerUser">
    <div>
      <label for="name">Name:</label>
      <input type="text" id="name" v-model="name" required />
    </div>
    <div>
      <label for="email">Email:</label>
      <input type="email" id="email" v-model="email" required />
    </div>
    <div>
      <label for="password">Password:</label>
      <input type="password" id="password" v-model="password" required />
    </div>
    <div>
      <label for="password_confirmation">Confirm Password:</label>
      <input type="password" id="password_confirmation" v-model="passwordConfirmation" required />
    </div>
    <button type="submit">Register</button>
  </form>
</template>

<script>
export default {
  data() {
    return {
      name: '',
      email: '',
      password: '',
      passwordConfirmation: ''
    };
  },
  methods: {
    async registerUser() {
      try {
        const response = await fetch('api/auth/register', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            name: this.name,
            email: this.email,
            password: this.password,
            password_confirmation: this.passwordConfirmation
          })
        });

        if (!response.ok) {
          const errorData = await response.json();
          throw new Error(errorData.message || 'Failed to register user');
        }

        const responseData = await response.json();
        console.log(responseData); // handle success response
      } catch (error) {
        console.error(error);
        // Handle error
      }
    }
  }
};
</script>
