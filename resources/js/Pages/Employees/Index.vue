<template>
  <v-row>
    <v-col cols="12" class="py-0">
      <v-row justify="end" dense>
        <v-col cols="auto" class="py-0">
          <v-btn @click="create" color="primary">Create Organization</v-btn>
        </v-col>
      </v-row>
    </v-col>

    <v-col cols="12">
      <data-table-wrapper
        :items="data"
        :headers="headers"
        with-search
        sort-by="lastname"
      >
        <template #item="{ item }">
          <tr>
            <td>
              {{ item.id }}
            </td>
            <td>
              {{ item.firstname }}
            </td>
            <td>{{ item.city }}</td>
            <td>{{ item.phone }}</td>

            <td class="text-right">

              <template v-if="item.deleted_at">
                <v-chip color="warning" outlined>Deleted</v-chip>
              </template>

              <v-btn text icon @click="edit(item.id)">
                <v-icon>edit</v-icon>
              </v-btn>
            </td>
          </tr>
        </template>

      </data-table-wrapper>
    </v-col>
  </v-row>
</template>

<script>
import Layout from "@shared/Layout";

export default {
  metaInfo: { title: "Employees" },

  layout: (h, page) => h(Layout, [page]),

  props: ["data"],

  data: (vm) => ({
    search: "",
    headers: [
      { text: "ID", value: "id" },
      { text: "Name", value: "firstname" },
      { text: "School", value: "school_id" },
      { text: "Name", value: "lastname" },
      { text: "", sortable: false },
    ],
  }),

  methods: {
    create() {
      this.$inertia.get('/employees/create',  {
                name: 'John Doe',
                email: 'john.doe@example.com',
              }, {
              onSuccess: () => {
                // Handle success event
              },
            });
    },
    edit(_organisation) {
      this.$inertia.visit(route("organizations.edit", _organisation));
    },
  },
};
</script>
