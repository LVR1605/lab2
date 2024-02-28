<template>
  <div>
    <NavigationButtons />
    <nuxt />
  </div>
</template>

<script>
import NavigationButtons from '~/components/NavigationButtons.vue'

export default {
  components: {
    NavigationButtons
  }
}
</script>
