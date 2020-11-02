<template>
  <v-card>
    <v-card-title>{{ title }}</v-card-title>
    <v-card-text>
      <v-row>
        <v-col cols="4">
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Search"
            hide-details
            outlined
          ></v-text-field>
        </v-col>
      
      </v-row>

      <v-row>
        <v-col>
          <v-data-table :headers="headers" :items="data" :search="search">
            <template v-slot:item.actions="{ item }">
              
              <v-btn  color="primary" @click="leaves(item)">
                <v-icon > event_note </v-icon></v-btn
              >
              <v-btn  color="primary" @click="viewCoc(item)">
                <v-icon > mdi-eye </v-icon>COC</v-btn
              >
            </template>
          </v-data-table>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
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
    title: "Search Employee Here",
    editedIndex: -1,
    search: "",
    headers: [
      { text: "ID", value: "id" },
      { text: "Name", value: "full_name" },
      { text: "School", value: "school.name" },

      { text: "Postion", value: "position.name" },
      { text: "Actions", value: "actions", sortable: false },
    ],
  }),

  methods: {
    create() {
      this.$inertia.get("/employees/create");
    },

    leaves(item) {
      this.$inertia.get("/leaves/create/" + item.id);
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
