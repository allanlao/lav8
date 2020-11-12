<template>
  <v-navigation-drawer v-model="toggle" fixed app>
    <v-toolbar flat dark :color="$root.themeColor" class="toolbar">
      <img src="/../storage/logo/deped-logo-round.png" width="36px" />

         &nbsp; DEPED HR SYSTEM
    </v-toolbar>

    <v-list>
       <v-list-item @click="changeRoute('/home', 1)">
        <v-list-item-action>
          <v-icon>house</v-icon>
        </v-list-item-action>
        <v-list-item-title
          :class="[{ active: selectedIndex === 1 }, 'item-title']"
          >Home</v-list-item-title
        >
      </v-list-item>

        <v-list-item @click="changeRoute('/employees', 2)">
        <v-list-item-action>
          <v-icon>person</v-icon>
        </v-list-item-action>
        <v-list-item-title
          :class="[{ active: selectedIndex === 2 }, 'item-title']"
          >Employee</v-list-item-title
        >
      </v-list-item>

      <v-list-group prepend-icon="event_note">
        <v-list-item slot="activator" class="item-title">
          <v-list-item-title class="item-title">Leaves</v-list-item-title>
        </v-list-item>

        <v-list-item @click="changeRoute('/home', 3)">
          <v-list-item-action>
              <v-icon>event_note</v-icon>
          </v-list-item-action>
          <v-list-item-title
            :class="[{ active: selectedIndex === 3 }, 'item-title']"
            >New</v-list-item-title
          >
        </v-list-item>

           <v-list-item @click="changeRoute('/leaves', 4)">
          <v-list-item-action>
            <v-icon>group</v-icon>
          </v-list-item-action>
          <v-list-item-title
            :class="[{ active: selectedIndex === 4}, 'item-title']"
            >Approved</v-list-item-title
          >
        </v-list-item>

           <v-list-item @click="changeRoute('/leaves_approval', 5)">
          <v-list-item-action>
            <v-icon>group</v-icon>
          </v-list-item-action>
          <v-list-item-title
            :class="[{ active: selectedIndex === 5 }, 'item-title']"
            >Pending</v-list-item-title
          >
        </v-list-item>
      </v-list-group>


         <v-list-group prepend-icon="more_time">
        <v-list-item slot="activator" class="item-title">
          <v-list-item-title class="item-title">COC / CTO</v-list-item-title>
        </v-list-item>

        <v-list-item @click="changeRoute('/home', 6)">
          <v-list-item-action>
             <v-icon>more_time</v-icon>
          </v-list-item-action>
          <v-list-item-title
            :class="[{ active: selectedIndex === 6 }, 'item-title']"
            >New</v-list-item-title
          >
        </v-list-item>

           <v-list-item @click="changeRoute('/cocs', 7)">
          <v-list-item-action>
            <v-icon>group</v-icon>
          </v-list-item-action>
          <v-list-item-title
            :class="[{ active: selectedIndex === 7}, 'item-title']"
            >Approved</v-list-item-title
          >
        </v-list-item>

           <v-list-item @click="changeRoute('/cocs_approval', 8)">
          <v-list-item-action>
            <v-icon>group</v-icon>
          </v-list-item-action>
          <v-list-item-title
            :class="[{ active: selectedIndex ===8 }, 'item-title']"
            >Pending</v-list-item-title
          >
        </v-list-item>
      </v-list-group>



            <v-list-group prepend-icon="monetization_on">
        <v-list-item slot="activator" class="item-title">
          <v-list-item-title class="item-title">Credits</v-list-item-title>
        </v-list-item>

        <v-list-item @click="changeRoute('/home', 9)">
          <v-list-item-action>
             <v-icon>monetization_on</v-icon>
          </v-list-item-action>
          <v-list-item-title
            :class="[{ active: selectedIndex === 9 }, 'item-title']"
            >New</v-list-item-title
          >
        </v-list-item>

           <v-list-item @click="changeRoute('/credits_grp', 10)">
          <v-list-item-action>
            <v-icon>group</v-icon>
          </v-list-item-action>
          <v-list-item-title
            :class="[{ active: selectedIndex === 10}, 'item-title']"
            >Credits by Group</v-list-item-title
          >
        </v-list-item>

           <v-list-item @click="changeRoute('/credits/summary', 11)">
          <v-list-item-action>
            <v-icon>group</v-icon>
          </v-list-item-action>
          <v-list-item-title
            :class="[{ active: selectedIndex === 11 }, 'item-title']"
            >Summary</v-list-item-title
          >
        </v-list-item>
      </v-list-group>


      
            <v-list-group prepend-icon="pageview">
        <v-list-item slot="activator" class="item-title">
          <v-list-item-title class="item-title">Admin</v-list-item-title>
        </v-list-item>

        <v-list-item @click="changeRoute('/positions/create', 12)">
          <v-list-item-action>
            <v-icon>group</v-icon>
          </v-list-item-action>
          <v-list-item-title
            :class="[{ active: selectedIndex === 12 }, 'item-title']"
            >Positions</v-list-item-title
          >
        </v-list-item>

           <v-list-item @click="changeRoute('/credits_grp', 13)">
          <v-list-item-action>
            <v-icon>group</v-icon>
          </v-list-item-action>
          <v-list-item-title
            :class="[{ active: selectedIndex === 13}, 'item-title']"
            >School</v-list-item-title
          >
        </v-list-item>

        
      </v-list-group>



    </v-list>
  </v-navigation-drawer>
</template>

<script>
export default {
  props: {
    toggle: {
      type: Boolean,
      required: false,
      default: true,
    },
  },

  data() {
    return {
      selectedIndex: 1,
    };
  },

  methods: {
    changeRoute(routeName, selectedIndex) {
      const vm = this;

      vm.selectedIndex = selectedIndex;
      vm.$inertia.get(routeName);
      // return vm.$router.push({ name: routeName });
    },
  },
};
</script>

<style>
.toolbar {
  font-weight: bold;
  font-size: 18px;
}

.toolbar .text {
  padding-left: 15px;
  color: white;
  text-decoration: none;
}

.item-title {
  font-size: 17px;
  font-weight: 500;
  padding: 0px;
}
.item-sub-title {
  font-size: 15px;
  font-weight: 500;
}

.group-item-title {
  padding: 0px;
}

.active {
  font-weight: bold;
 
}
</style>
