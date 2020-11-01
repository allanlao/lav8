<template>
  <v-row>
    <v-col>
      <v-card>
        <v-card-title>{{ title }} </v-card-title>

        <v-card-text>
          <v-row>
            <v-col cols="12">
              <v-col cols="3">
                <v-text-field
                  v-model="search"
                  append-icon="mdi-magnify"
                  label="Search"
                  hide-details
                  outlined
                ></v-text-field>
              </v-col>
              <v-col cols="3">
                <v-btn @click="create" color="primary">Create Employee</v-btn>
              </v-col>
            </v-col>
          </v-row>

          <v-row>
            <v-col cols="12">
              <v-data-table :headers="headers" :items="data" :search="search">
                <template v-slot:item.actions="{ item }">
                  <v-icon small class="mr-2" @click="editItem(item)">
                    mdi-pencil
                  </v-icon>
                  <v-icon small primary @click="deleteItem(item)">
                    mdi-delete
                  </v-icon>
                  <v-btn x-small color="primary" @click="viewCredit(item)">
                    <v-icon small> mdi-eye </v-icon>Leave Credits</v-btn
                  >
                  <v-btn x-small color="primary" @click="viewCoc(item)">
                    <v-icon small> mdi-eye </v-icon>COC</v-btn
                  >
                </template>
              </v-data-table>
            </v-col>
          </v-row>
        </v-card-text>
      </v-card>
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
    title: "Employee List",
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
