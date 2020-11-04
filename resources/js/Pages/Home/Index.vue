<template>
  <CardWrapper :card_title="card.title">
    <v-card-text class="pa-10">
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
              <v-btn color="primary" outlined @click="leaves(item)">
                <v-icon> event_note </v-icon>Leave</v-btn
              >
              <v-btn color="primary" outlined @click="cocs(item)">
                <v-icon> more_time </v-icon>COC</v-btn
              >

              <v-btn color="primary" outlined @click="credits(item)">
                <v-icon> more_time </v-icon>Credits</v-btn
              >
            </template>
          </v-data-table>
        </v-col>
      </v-row>
    </v-card-text>
  </CardWrapper>
</template>
<script>
import Layout from "@shared/Layout";
import CardWrapper from "@shared/CardWrapper";

export default {
  metaInfo: { title: "Employees" },
  

  layout: (h, page) => h(Layout, [page]),

  props: {
    data: Array,
    
  },

  data: (vm) => ({
  

    card: {
      title: "Employee Directory",
      url: "employees.index",
    },
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

    cocs(item) {
      this.$inertia.get("/cocs/create/" + item.id);
    },

    credits(item) {
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
