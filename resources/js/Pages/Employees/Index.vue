


<template>
  <v-container class="grey lighten-5">
    <v-row>
     <v-col cols="6" class="py-0">
        <v-text-field
          v-model="search"
          append-icon="mdi-magnify"
          label="Search"
          single-line
          hide-details
        ></v-text-field>
      </v-col>
      <v-col cols="6" class="py-0">
        <v-row justify="end" dense>
          <v-col cols="auto" class="py-0">
            <v-btn @click="create" color="primary">Create Organization</v-btn>
          </v-col>
        </v-row>
      </v-col>
    </v-row>

    <v-spacer></v-spacer>

    <v-data-table
      :headers="headers"
      :items="data"
      :items-per-page="5"
      :search="search"
      class="elevation-1"
    ></v-data-table>
  </v-container>
</template>

<script>
import Layout from "@shared/Layout";

export default {
  metaInfo: { title: "Employees" },

  layout: (h, page) => h(Layout, [page]),

  props: ["data"],

  data: (vm) => ({
    search: "",
    headers: [
      { text: "ID", value: "id" },
      { text: "Name", value: "firstname" },
      { text: "School", value: "school_id" },
      { text: "Name", value: "lastname" },
      { text: "", sortable: false },
    ],
  }),

  methods: {
    create() {
      this.$inertia.visit(route("organizations.create"));
    },
    edit(_organisation) {
      this.$inertia.visit(route("organizations.edit", _organisation));
    },
  },
};
</script>