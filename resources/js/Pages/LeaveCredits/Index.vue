<template>
  <v-row>
    <v-col cols="3" align-self="center">
      <v-select
        v-model="division"
        :items="any_divisions"
        label="Division"
        hide-details
        outlined
      ></v-select>
    </v-col>
    <v-col cols="3" align-self="center">
      <v-select
        v-model="school"
        :items="any_schools"
        item-text="name"
        item-value="id"
        label="School"
        hide-details
        outlined
      ></v-select>
    </v-col>
    <v-col cols="3" align-self="center">
      <v-text-field
        v-model="lastname"
        label="Lastname"
        hide-details
        outlined
      ></v-text-field>
    </v-col>
    <v-col cols="3" align-self="center">
      <v-btn color="primary" @click="search">Search</v-btn>
    </v-col>
    <v-col cols="12" align-self="center">
      <v-data-table
        :headers="headers"
        :items="employees"
        item-key="name"
        sort-by="name"
        group-by="school_id"
        class="elevation-1"
        show-group-by
      ></v-data-table>
    </v-col>
  </v-row>
</template>

<script>
import Layout from "@shared/Layout";
export default {
  metaInfo: { title: "Employees" },

  layout: (h, page) => h(Layout, [page]),

  props: {
    schools: Array,
    divisions: Array,
    employees:Array,
  },

  data() {
    return {
      division: "Any",
      school: "Any",
      lastname: "",



    headers: [
      { text: "ID", value: "id" },
      { text: "Name", value: "full_name" },
      { text: "School", value: "school.name" },
     
      { text: "Actions", value: "actions", sortable: false },
    ],

    };
  },

  computed: {
    any_divisions: function () {
      this.divisions.unshift("Any");
      return this.divisions;
    },

    any_schools: function () {
      this.schools.unshift("Any");
      return this.schools;
    },
  },

  methods: {
    search() {
      this.$inertia.get("/credit", this.form);
    },
  },
};
</script>
