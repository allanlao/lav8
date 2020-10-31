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
      <v-btn @click="create(id)" color="primary">Create New COC</v-btn>
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
  metaInfo: { title: "Compensatory Overtime Credit" },

  layout: (h, page) => h(Layout, [page]),

  props: {
    data: Array,
    id:null,
  },

  data: (vm) => ({
    editedIndex: -1,
    search: "",
     headers: [
        { text: "Date Issued", value: "date_issued" },
        { text: "Description", value: "description" },
        { text: "Type", value: "type" },
        { text: "Date From", value: "osr_from" },
        { text: "Date To", value: "osr_to" },
        { text: "Hours Earned", value: "hours" },
        { text: "COC Remaining", value: "balance" },
      ],
  }),

  methods: {
    create(item) {
      this.$inertia.get("/cocs/create/" + this.id);
    },

    editItem(item) {
      this.$inertia.get("/employees/" + item.id);
    },

      viewCoc(item) {
      this.$inertia.get("/cocs/" + item.id);
    },

     deleteItem(item) {
     

      if (confirm("Are you sure you want to delete this employee?")) {
       this.$inertia.get("/employees/delete/" + item.id);
      }
    },
  },
};
</script>
