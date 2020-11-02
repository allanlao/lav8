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
          <v-btn class="ma-2" color="primary" dark @click="approveItem(item)">
            Accept
            <v-icon dark right> mdi-checkbox-marked-circle </v-icon>
          </v-btn>

          <v-btn class="ma-2" color="red" dark @click="deleteItem(item)">
            Delete
            <v-icon dark right> mdi-cancel </v-icon>
          </v-btn>
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

  data() {
    return {
      editedIndex: -1,
      search: "",
      headers: [
        { text: "Leave ID ", value: "id" },
        { text: "Date Filed", value: "date_filed" },
        { text: "Name", value: "employee.full_name" },
        { text: "School", value: "employee.school.name" },

        { text: "Type", value: "type" },
        { text: "Inclusive Date", value: "inclusive_dates" },
        { text: "Days", value: "total_days" },
        { text: "Encoded By", value: "encoded_by" },

        { text: "Actions", value: "actions", sortable: false },
      ],
    };
  },

  methods: {
    create() {
      this.$inertia.get("/home");
    },

    showItem(item) {
      this.$inertia.get("/leaves/show/" + item.id);
    },

    approveItem(item) {
      if (confirm("Are you sure you want to Approve this leave?")) {
        this.$inertia.get("/leaves_approval/" + item.id + "/" + "allan");
      }
    },

    deleteItem(item) {
      if (confirm("Are you sure you want to delete this leave?")) {
        this.$inertia.get("/leaves/delete/" + item.id);
      }
    },
  },
};
</script>
