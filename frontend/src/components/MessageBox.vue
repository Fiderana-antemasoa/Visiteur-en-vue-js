<template>
  <p v-if="message" :class="isSuccess ? 'text-green-600' : 'text-red-600'">
    {{ message }}
  </p>
</template>

<script>
export default {
  props: {
    message: String,
    isSuccess: { type: Boolean, default: true }
  }
}
</script>
