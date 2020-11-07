<template>
  <v-app-bar app flat color="primary">
    
    <v-toolbar-title>
      <template v-if="$root.goBack">
        <inertia-link class="light-blue--text lighten-5--text" :href="route($root.goBack.url)">
          {{$root.goBack.title}}
        </inertia-link>
        /
      </template>
      {{$root.appTitle}}
    </v-toolbar-title>

 <v-spacer></v-spacer>

   <v-btn icon>
        <v-icon>mdi-heart</v-icon>
      </v-btn>

           <v-menu
        left
        bottom
      >
        <template v-slot:activator="{ on, attrs }">
          <v-btn
            icon
            v-bind="attrs"
            v-on="on"
          >
            <v-icon>mdi-dots-vertical</v-icon>
          </v-btn>
        </template>

        <v-list>
          <v-list-item
            v-for="n in 5"
            :key="n"
            @click="() => {}"
          >
            <v-list-item-title>Option {{ n }}</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>

  </v-app-bar>
</template>

<script>
  export default {
    name: 'AppBar'
  }
</script>
