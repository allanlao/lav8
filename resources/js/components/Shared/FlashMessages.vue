<template>
<div>
     <v-snackbar  v-if="$page.props.flash.success && show"
      v-model="show"
       :timeout=3000
      color="success"
    >
      {{ $page.props.flash.success }}

      <template v-slot:action="{ attrs }">
        <v-btn
          color="white"
          text
          v-bind="attrs"
          @click="show = false"
        >
          Close
        </v-btn>
      </template>
    </v-snackbar>



      <v-snackbar  v-if="$page.props.flash.error && show"
      v-model="show"
      :timeout=5000
      color="warning"
    >
      {{ $page.props.flash.error }}

      <template v-slot:action="{ attrs }">
        <v-btn
          color="red"
          text
          v-bind="attrs"
          @click="show = false"
        >
          Close
        </v-btn>
      </template>
    </v-snackbar>
    </div>
</template>

<script>
export default {
  data() {
    return {
      show: true,
    }
  },
  watch: {
    '$page.props.flash': {
      handler() {
        this.show = true
      },
     
    },
  },
}
</script>