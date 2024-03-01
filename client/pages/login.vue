<template>
    <div>
      <nuxt-link to="/">Back</nuxt-link>
    </div>
  <div>
    <h2>Login</h2>
    <form @submit.prevent="submitForm" action="">
     <div>
      <label for="'email'">Email Address</label>
      <div>
        <input type="text" name="email" placeholder="Email Address" v-model="state.user.email"/>
        <p class="text-red-700" >
          {{ state.errors && state.errors._data && state.errors._data.errors.email && state.errors._data.errors.email[0] }}
        </p>
      </div>
     </div>
     <div>
      <label for="'password'">Password</label>
      <div>
        <input type="password" name="password" placeholder="Password" v-model="state.user.password"/>
        <p class="text-red-700" >
          {{ state.errors && state.errors._data && state.errors._data.errors.password && state.errors._data.errors.password[0] }}
        </p>
      </div>
     </div>
     <button type="submit">Submit</button>
    </form>
  </div>
</template>
  

<script setup>
const state = reactive({
  isPageLoading: false,
  error: null,
  user: {
    email: null,
    password: null,
  }
})

async function submitForm() {
  const params = {
    email: state.user.email,
    password: state.user.password,
  };
  try {
    const response = await $fetch('http://127.0.0.1:8000/api/auth/login', {
      method: 'POST',
      body: params, // Stringify the params object
    });

    if (response.data) { // Corrected response.data from response.date
      localStorage.setItem('_token', response.data.token);
      navigateTo('/dashboard')
    }
  } catch (error) {
    state.errors = error.response
    console.log(error.response)
    console.log('error', error);
  }
}
</script>
  