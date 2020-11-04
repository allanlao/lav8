<template>
  <CardWrapper :card_title="card.title">
    <v-card-text>
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
          <v-btn @click="create(id)" color="primary" large
            >Create New COC</v-btn
          >
        </v-col>
      </v-row>
      <v-divider> </v-divider>
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
            </template>
          </v-data-table>
        </v-col>
      </v-row>
    </v-card-text>
  </CardWrapper>
</template>

<script>
import Layout from "@shared/Layout";

export default {
  metaInfo: { title: "Compensatory Overtime Credit" },
  title: "Create COC",
  layout: (h, page) => h(Layout, [page]),

  props: {
    data: Array,
  },

  data: (vm) => ({
    card: {
      title: "List of Approved COC/CTO",
      url: "employees.index",
    },

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
      { text: "Status", value: "coc_status" },
      { text: "Encoded By", value: "encoded_by" },
      { text: "Approved By", value: "approved_by" },
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
