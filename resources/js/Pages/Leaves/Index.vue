<template>
  <v-row>
    <v-col cols="12">
      <v-card>
        <v-app-bar color="primary" flat dark>
          <v-btn icon>
            <v-icon size="40">view_list</v-icon>
          </v-btn>

          <v-toolbar-title>List of Approved Leaves </v-toolbar-title>
        </v-app-bar>

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
              <v-btn @click="create" color="primary">Create Leave</v-btn>
            </v-col>

            <v-col cols="12">
              <v-data-table :headers="headers" :items="data" :search="search">
                <template v-slot:item.actions="{ item }">
                  <v-icon small class="mr-2" @click="showItem(item)">
                    mdi-eye
                  </v-icon>
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
        { text: "Date Filed", value: "date_filed" },
        { text: "Name", value: "employee.full_name" },
        { text: "School", value: "employee.school.name" },
        { text: "Postion", value: "employee.position.name" },
        { text: "Type", value: "type" },
        { text: "Inclusive Dates", value: "inclusive_dates" },
        { text: "Days", value: "total_days" },
        { text: "Status", value: "leave_status" },
        { text: "Encoded By", value: "encoded_by" },
        { text: "Approved By", value: "approved_by" },

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
  },
};
</script>
