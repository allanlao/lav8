<template>
 
      <v-card class="mx-10">
        <v-app-bar color="primary" flat dark>
          <v-btn icon>
            <v-icon size="40">view_list</v-icon>
          </v-btn>

          <v-toolbar-title>{{card_title}} </v-toolbar-title>
        </v-app-bar>

        <slot />
      </v-card>
  
</template>

<script>
export default {
  name: "CardWrapper",

  props : {card_title: null},
  data() {
    return {
      //   showUserMenu: false,
      // accounts: null,
    };
  },


 
};
</script>
