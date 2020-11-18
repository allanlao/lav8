<template>
  <v-app id="inspire">
    <navigation-drawer></navigation-drawer>
    <app-bar></app-bar>

    <v-main>
      <v-container fluid scroll-region>
             <flash-messages />
        <slot/>
      </v-container>
    </v-main>

  </v-app>
</template>

<script>
import FlashMessages from "./FlashMessages.vue";
export default {
  name: "Layout",
  data() {
    return {
   //   showUserMenu: false,
     // accounts: null,
    }
  },
 
  methods: {
    url() {
      return location.pathname.substr(1)
    },
    hideDropdownMenus() {
      this.showUserMenu = false
    },
  },
}
</script>
