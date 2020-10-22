<template>
  <v-row>
    <v-col cols="4" align-self="center">
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        hide-details
        outlined
      ></v-text-field>
    </v-col>
    <v-col cols="4" offset="4" align-self="center">
      <v-btn @click="create" color="primary">Create Organization</v-btn>
    </v-col>

    <v-col cols="12">
      <v-data-table
        :headers="headers"
        :items="data"
        :search="search"
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
    data: Array,
  },

  data: (vm) => ({
    search: "",
    headers: [
      { text: "ID", value: "id" },
      { text: "Name", value: "full_name" },
      { text: "School", value: "school.name" },

      { text: "Postion", value: "position.name" },
      { text: "", sortable: false },
    ],
  }),

  methods: {
    create() {
      this.$inertia.get(
        "/employees/create",
        {
          name: "John Doe",
          email: "john.doe@example.com",
        },
        {
          onSuccess: () => {
            // Handle success event
          },
        }
      );
    },
    edit(_organisation) {
      this.$inertia.visit(route("organizations.edit", _organisation));
    },
  },
};
</script>
