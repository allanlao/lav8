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
          <v-btn @click="create" color="primary">Create COC/CTO</v-btn>
        </v-col>

        <v-col cols="12">
          <v-data-table :headers="headers" :items="data" :search="search">
            <template v-slot:item.actions="{ item }">
              <v-btn
                class="ma-2"
                color="primary"
                dark
                @click="approveItem(item)"
              >
                Accept
                <v-icon dark right> mdi-checkbox-marked-circle </v-icon>
              </v-btn>

              <v-btn
                class="ma-2"
                color="red"
                dark
                @click="disapproveItem(item)"
              >
                Disapprove
                <v-icon dark right> mdi-cancel </v-icon>
              </v-btn>
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
  metaInfo: { title: "Leaves" },

  layout: (h, page) => h(Layout, [page]),

  props: {
    data: Array,
  },

  data() {
    return {
      card: {
        title: "COC/CTO Approval Form",
        url: "employees.index",
      },
      editedIndex: -1,
      search: "",
      headers: [
        { text: "Date Issued", value: "date_issued" },
        { text: "Name", value: "employee.full_name" },
        { text: "School", value: "employee.school.name" },
        { text: "Description", value: "description" },
        { text: "Type", value: "type" },

        { text: "Hours Earned", value: "hours" },

        { text: "Status", value: "coc_status" },
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
      if (
        confirm(
          "Are you sure you want to Approve this " +
            item.type.toUpperCase() +
            "?"
        )
      ) {
        this.$inertia.get(
          "/cocs_approval/" + item.id + "/" + "allan" + "/approved"
        );
      }
    },

    disapproveItem(item) {
      if (
        confirm(
          "Are you sure you want to Disapprove this " +
            item.type.toUpperCase() +
            "?"
        )
      ) {
        this.$inertia.get(
          "/cocs_approval/" + item.id + "/" + "allan" + "/disapproved"
        );
      }
    },
  },
};
</script>
