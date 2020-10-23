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
      <v-btn @click="create" color="primary">Create Organization</v-btn>
    </v-col>

    <v-col cols="12">
      <v-data-table
        :headers="headers"
        :items="data"
        :search="search"
      >
         <template v-slot:item.actions="{ item }">
      <v-icon
        small
        class="mr-2"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
        small
        @click="deleteItem(item)"
      >
        mdi-delete
      </v-icon>
    </template>
    <template v-slot:no-data>
      <v-btn
        color="primary"
        @click="initialize"
      >
        Reset
      </v-btn>
    </template>
      
      </v-data-table>


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
    editedIndex: -1,
    search: "",
    headers: [
      { text: "ID", value: "id" },
      { text: "Name", value: "full_name" },
      { text: "School", value: "school.name" },

      { text: "Postion", value: "position.name" },
      { text: 'Actions', value: 'actions', sortable: false },
    ],
  }),

  methods: {
    create() {
      this.$inertia.get(
        "/employees/create",
        {
          name: "John Doe",
          email: "john.doe@example.com",
        },
        {
          onSuccess: () => {
            // Handle success event
          },
        }
      );
    },
  

     editItem (item) {
      //  this.editedIndex = this.data.indexOf(item)
        console.log("edited item" + item.id); 
      //   this.$inertia.visit();
          this.$inertia.put("/employees/" + item.id);
     
      },
  },
};
</script>
