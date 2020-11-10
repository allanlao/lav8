<template>
  <CardWrapper :card_title="card.title">
    <v-card-title>
      <v-row>
        <v-col cols="2" align-self="center">
          <v-menu
            :close-on-content-click="false"
            transition="scale-transition"
            offset-y
            min-width="290px"
          >
            <template v-slot:activator="{ on, period }">
              <v-text-field
                v-model="form.period"
                :error-messages="errors.period"
                label="Period"
                outlined
                readonly
                v-bind="period"
                v-on="on"
              ></v-text-field>
            </template>
            <v-date-picker
              v-model="form.period"
              no-title
              type="month"
              @input="menu1 = false"
            ></v-date-picker>
          </v-menu>
        </v-col>

        <v-col cols="2">
          <v-text-field
            v-model="form.vl_credit"
            label="Vacation Leave"
            outlined
            type="number"
            :rules="[(v) => !!v || 'Item is required']"
          ></v-text-field>
        </v-col>
        <v-col cols="2">
          <v-text-field
            v-model="form.sl_credit"
            label="Sick Leave"
            outlined
            type="number"
            :rules="[(v) => !!v || 'Item is required']"
          ></v-text-field>
        </v-col>
        <v-col cols="2">
          <v-text-field
            v-model="form.other_credit"
            label="Other Leave"
            outlined
            type="number"
            :rules="[(v) => !!v || 'Item is required']"
          ></v-text-field>
        </v-col>

        <v-col cols="3" align-self="center">
          <v-text-field
            v-model="form.remarks"
            :error-messages="errors.remarks"
            label="Remarks"
            outlined
          ></v-text-field>
        </v-col>

        <v-col cols="2">
          <v-btn large color="primary" @click="submit">Add Leave Credit</v-btn>
        </v-col>
      </v-row>

     
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
    </v-card-title>
  </CardWrapper>
</template>

<script>
import Layout from "@shared/Layout";

export default {
  metaInfo: { title: "Leave Credits" },

  layout: (h, page) => h(Layout, [page]),

  props: {
    data: Array,
    id: null,
    errors: Object,
    flash: Object,
  },

  data: (vm) => ({
    card: {
      title: "Leave Credit Form",
      url: "employees.index",
    },

    editedIndex: -1,
    search: "",

    form: {
      period: null,
      employee_id: null,
      vl_credit: 1.25,
      sl_credit: 1.25,
      other_credit: 0.0,
      remarks: null,
      leave_type: null,
    },

    headers: [
      { text: "Period", value: "period" },
      { text: "Type", value: "type" },
      { text: "VL Credit", value: "vl_credit" },
      { text: "SL Credit", value: "sl_credit" },
      { text: "Other Credit", value: "other_credit" },
      { text: "Remarks", value: "remarks" },
    ],

   
  }),

  methods: {
    create(item) {
      this.$inertia.get("/credits/create/" + this.id);
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

    submit() {
      this.form.employee_id = this.id;
      this.form.encoded_by = this.$page.props.auth.user.name;
      this.$inertia.post("/credits/storeOne", this.form);
    },
  },
};
</script>
