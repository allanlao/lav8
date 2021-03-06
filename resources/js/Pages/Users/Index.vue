<template>
  <div>
    <v-row>
      <v-col cols="6">
        <CardWrapper :card_title="card.title">
          <v-card-text>
            <div class="warning--text caption">* All fields are required</div>
            <v-form ref="form" lazy-validation>
              <v-row>
                <v-col cols="6" sm="12">
                  <v-text-field
                    v-model="form.name"
                    :error-messages="errors.name"
                    label="Position Name"
                    outlined
                  ></v-text-field>
                </v-col>
              </v-row>

              <v-row>
                <v-col cols="12">
                  <v-btn @click="submit" color="success">Submit</v-btn>
                </v-col>
              </v-row>
            </v-form>
            <v-divider></v-divider>

            <v-row>
              <v-col>
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
      </v-col>
    </v-row>

    <ConfirmDlg ref="confirm" />
  </div>
</template>

<script>
import Layout from "@shared/Layout";

export default {
  metaInfo: {
    title: "Create Position",
    goBack: {
      title: "Employee Trainings",
      url: "trainings.index",
    },
  },

  layout: (h, page) => h(Layout, [page]),

  props: {
    errors: Object,
    data: Array,
  },

  data() {
    return {
      card: {
        title: "New Position Form",
      },

      form: {
        id: null,
        name: null,
      },

      search: "",

      headers: [
        { text: "Id", value: "id" },
        { text: "Name", value: "name" },
        { text: "Actions", value: "actions", sortable: false },
      ],
    };
  },

  methods: {
    submit() {
      this.form.encoded_by = this.$page.props.auth.user.name;

      this.$inertia.post("/positions", this.form, {
        onSuccess: () => {
          // Handle success event
          this.reset();
        },
      });
    },

    reset() {
      this.$refs.form.reset();
    },

    deleteItem(item) {
      var a = this;
      this.$refs.confirm
        .open("Confirm Deletion", "Are you sure you want to delete this record?")
        .then(function (val) {
          if (val) {
            a.$inertia.delete("/positions/" + item.id);
          }
        });
    },

    editItem(item) {
      this.form = item;
    },
  },
};
</script>
