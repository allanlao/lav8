<template>
  <v-card flat>
    <v-row no-gutters>

      <v-col cols="1"
        ><v-avatar color="info" size="100" tile class="pa-0 ma-2">
           <span class="white--text headline">CJ</span>
        </v-avatar>
      </v-col>
      <v-col class="pa-0 ma-0">
        <v-list-item three-line>
          <v-list-item-content>
            <v-list-item-title>{{data.name}}</v-list-item-title>
            <v-list-item-subtitle>
              {{data.position}}
            </v-list-item-subtitle>
            <v-list-item-subtitle>
              {{data.school}}
            </v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
      </v-col>
    </v-row>
  </v-card>
</template>

<script>
export default {
  name: "Profile",

   props : {data: null},
};
</script>
