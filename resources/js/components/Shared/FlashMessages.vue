<template>
  <v-snackbar
    v-model="snackbar"
    color="success"
    :timeout="6000"
    top
    @input="close"
    vertical
  >
    {{  $page.props.flash.success }}
    <v-btn
      dark
      text
      @click="close"
    >
      Close
    </v-btn>
  </v-snackbar>
</template>

<script>
  export default {
    name: 'FlashMessages',

      data: () => ({
      snackbar: true,
    
    }),
  }
</script>