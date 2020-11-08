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
        <v-col cols="4" offset="4" align-self="center">
          <v-btn @click="create" color="primary" large>Create Position</v-btn>
        </v-col>
      </v-row>

      <v-row>
        <v-col>
          <v-data-table
            :headers="headers"
            :items="data"
            :search="search"
            @click:row="show"
          >
            <template v-slot:item.actions="{ item }">
              <v-icon small class="mr-2" @click="editItem(item)">
                mdi-pencil
              </v-icon>
              <v-icon small primary @click="destroy(item)">
                mdi-delete
              </v-icon>

              <v-icon small primary @click="show(item)"> mdi-eye </v-icon>
            </template>
          </v-data-table>
        </v-col>
      </v-row>
    </v-card-text>
  </CardWrapper>
</template>
</template>



<script>
import Layout from "@shared/Layout";

export default {
  metaInfo: { title: "Positions" },

  layout: (h, page) => h(Layout, [page]),

  props: {
    data: Array,
  },

  data: (vm) => ({
    card: {
      title: "Positions",
      url: "position.index",
    },
    title: "Positions List",
    editedIndex: -1,
    search: "",
    headers: [
      { text: "ID", value: "id" },
      { text: "Position Name", value: "name" },
      { text: "Created At", value: "created_at" },
      { text: "Updated At", value: "updated_at" },
          { text: "Actions", value: "actions" },
    ],
  }),

  methods: {
    create() {
      this.$inertia.get("/positions/create");
    },

    editItem(item) {
      this.$inertia.get("/destroy/" + item.id);
    },

    destroy(item) {
      if (confirm("Are you sure you want to delete this position?")) {
        this.$inertia.delete("/positions/" + item.id);
      }
    },

    show(item) {
      this.$inertia.get("/employees/show/" + item.id);
    },
  },
};
</script>
