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
      <v-btn @click="create" color="primary">Create Leave</v-btn>
    </v-col>

    <v-col cols="12">
      <v-data-table :headers="headers" :items="data" :search="search">
        <template v-slot:item.actions="{ item }">
          <v-icon small class="mr-2" @click="editItem(item)">
            mdi-pencil
          </v-icon>
          <v-icon small primary @click="deleteItem(item)"> mdi-delete </v-icon>
        </template>
      </v-data-table>
    </v-col>
  </v-row>
</template>

<script>
import Layout from "@shared/Layout";

export default {
  metaInfo: { title: "Leaves" },

  layout: (h, page) => h(Layout, [page]),

  props: {
    data: Array,
  },

  data: (vm) => ({
    editedIndex: -1,
    search: "",
    headers: [
      { text: "Date Filed", value: "id" },
      { text: "Name", value: "full_name" },
      { text: "School", value: "school.name" },
      { text: "Postion", value: "position.name" },
      { text: "Type", value: "position.name" },
      { text: "Days", value: "position.name" },
      { text: "Actions", value: "actions", sortable: false },
    ],
  }),

  methods: {
    create() {
      this.$inertia.get("/leaves/create");
    },

    editItem(item) {
      this.$inertia.get("/employees/" + item.id);
    },

    viewCoc(item) {
      this.$inertia.get("/cocs/" + item.id);
    },

    viewCredit(item) {
      this.$inertia.get("/credits/" + item.id);
    },

    deleteItem(item) {
      if (confirm("Are you sure you want to delete this employee?")) {
        this.$inertia.get("/employees/delete/" + item.id);
      }
    },
  },
};
</script>
