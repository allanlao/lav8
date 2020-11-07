<template>
  <v-navigation-drawer permanent v-model="$root.sideDrawer" app>

    
    <v-app-bar flat color="primary">
      <v-row align="center" justify="center">
        <v-col cols="12" class="text-center pt-6">
          <logo></logo>
        </v-col>
      </v-row>
    </v-app-bar>
 <v-list>
      

        <v-list-item link>
             <v-list-item-avatar>
          <v-img src="https://randomuser.me/api/portraits/men/85.jpg"></v-img>
        </v-list-item-avatar>
          <v-list-item-content>
            <v-list-item-title class="title">
            {{ $page.props.auth.user.name }}
            </v-list-item-title>
            <v-list-item-subtitle>     {{ $page.props.auth.user.name }}</v-list-item-subtitle>
          </v-list-item-content>

          <v-list-item-action>
            <v-icon>mdi-menu-down</v-icon>
          </v-list-item-action>
        </v-list-item>
      </v-list>
      <v-divider></v-divider>

    <v-list  shaped>

      <v-list-item-group
        :value="currentController"
        active-class="light-blue lighten-5 blue--text text--darken-4"
      >
        <v-list-item link @click="$inertia.get('/home')">
          <v-list-item-icon>
            <v-icon>house</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title> Home </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item link @click="$inertia.get('/employees')">
          <v-list-item-icon>
            <v-icon>person</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title> Employees </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-divider></v-divider>

        <v-list-item link @click="$inertia.get('/home')">
          <v-list-item-icon>
            <v-icon>event_note</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>New Leave Application </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item link @click="$inertia.get('/leaves')">
          <v-list-item-icon>
            <v-icon>event_note</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Approved Leaves </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item link @click="$inertia.get('/leaves_approval')">
          <v-list-item-icon>
            <v-icon>event_note</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Pending Leaves </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-divider></v-divider>

      

        <v-list-item link @click="$inertia.get('/home')">
          <v-list-item-icon>
            <v-icon>more_time</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>New COC/CTO Application </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item link @click="$inertia.get('/cocs')">
          <v-list-item-icon>
            <v-icon>event_note</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Approved COC/CTO </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item link @click="$inertia.get('/cocs_approval')">
          <v-list-item-icon>
            <v-icon>event_note</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Pending COC/CTO </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-divider></v-divider>


      

        <v-list-item link @click="$inertia.get('/home/')">
          <v-list-item-icon>
            <v-icon>monetization_on</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title> Leave Credits </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item link @click="$inertia.post('/credits_grp', { filter: 1 })">
          <v-list-item-icon>
            <v-icon>business</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title> Leave Credits by Group </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

    

        <v-list-item link @click="$inertia.get('/')">
          <v-list-item-icon>
            <v-icon>people</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title> Positions </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item link @click="$inertia.get('/')">
          <v-list-item-icon>
            <v-icon>school</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title> Schools </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item link @click="$inertia.post('/logout')">
          <v-list-item-icon>
            <v-icon>exit_to_app</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title> Logout </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list-item-group>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
export default {
  name: "NavigationDrawer",
  data: (vm) => ({}),
  computed: {
    currentController() {
      const controller = location.pathname.substr(1).split("/").shift();
      return `/${controller}`;
    },
  },
};
</script>