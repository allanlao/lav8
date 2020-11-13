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
            :error-messages="errors.vl_credit"
          ></v-text-field>
        </v-col>
        <v-col cols="2">
          <v-text-field
            v-model="form.sl_credit"
            label="Sick Leave"
            outlined
            type="number"
            :error-messages="errors.sl_credit"
          ></v-text-field>
        </v-col>
        <v-col cols="2">
          <v-text-field
            v-model="form.other_credit"
            label="Other Credit"
            outlined
            type="number"
            :error-messages="errors.other_credit"
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
          <v-btn large color="success" @click="submit">Submit</v-btn>
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
      other_credit: null,
      remarks: null,
      balance: 0,
    },

    headers: [
      { text: "Period", value: "period" },

      { text: "VL Credit", value: "vl_credit" },
      { text: "SL Credit", value: "sl_credit" },
      { text: "Other Credit", value: "other_credit" },
      { text: "Remarks", value: "remarks" },
      { text: "Actions", value: "actions", sortable: false },
    ],
  }),

  methods: {
    create(item) {
      this.$inertia.get("/credits/create/" + this.id);
    },

    editItem(item) {
      this.form = item;
    },

    deleteItem(item) {
      if (confirm("Are you sure you want to delete this employee?")) {
        this.$inertia.delete("/credits/" + item.id);
      }
    },

    submit() {
      this.form.employee_id = this.id;
      this.form.encoded_by = this.$page.props.auth.user.name;

      if (this.period != null) {
        this.form.period = this.period + "-01";
      }

      this.$inertia.post("/credits/storeOne", this.form);
    },
  },
};
</script>
