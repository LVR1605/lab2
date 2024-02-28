<template>
    <div>
      <div>
        <div>
          <nuxt-link to="/login">
            <button>&times;</button>
          </nuxt-link>
        </div>
  
        <form @submit.prevent="Register">
          <section>
            <h1>Create an Account</h1>
          </section>
  
          <div>
          </div>
  
          <div>
            <section>
              <p>Personal Information</p>
            </section>
  
            <section>
              <section>
                <label>Full Name:</label>
                <section>
                  <div>
                    <h4>First Name</h4>
                    <input type="text" v-model="state.user.first_name" placeholder="*" />
                    <div>{{ state.errors && state.errors._data && state.errors._data.errors && state.errors._data.errors.first_name && state.errors._data.errors.first_name[0] }}</div>
                  </div>

  
              <section>
                <p>Login Credentials <span>(to access our website)</span></p>
              </section>
  
              <section>
                <section>
                  <label>Username:</label>
                  <input type="text" v-model="state.user.username" placeholder="*" />
                  <div>{{ state.errors && state.errors._data && state.errors._data.errors && state.errors._data.errors.username && state.errors._data.errors.username[0] }}</div>
                </section>
                <section>
                  <label>Email:</label>
                  <input v-model="state.user.email" placeholder="*" />
                  <div>{{ state.errors && state.errors._data && state.errors._data.errors && state.errors._data.errors.email && state.errors._data.errors.email[0] }}</div>
                </section>
              </section>
  
              <section>
                <section>
                    <label>Password:</label>
                    <input type="password" v-model="user.password" placeholder="*" />
                    <div>{{ errors.password }}</div>
                </section>
            </section>
        </section>
    </section>
  
            </section>
  
            <section>
              <button type="submit" name="register">Register</button>
            </section>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, reactive } from 'vue';
  
  const state = reactive({
    errors: [],
    user: {
      first_name: null,
      email: null,
      password: null,
    }
  })
  
  async function Register() {
  
    const params = {
      first_name: state.user.first_name,
      email: state.user.email,
      password: state.user.password,
    }
    try {
      const response = await $fetch(`http://127.0.0.1:8000/api/register`, {
        method: 'POST',
        body: params
      })
  
      if (response.data) {
        navigateTo('/login');
      }
    }
    catch (error) {
      state.errors = error.response
      console.log(error.response)
      console.log('error', error)
    }
  }
  
  const isLoading = ref(false);
  const isLoadingTitle = ref('Loading');
  
  </script>
