<template>
  <v-row>
     <v-col cols="12">
        <v-alert
      border="top"
      colored-border
      type="info"
      elevation="2"
    >
    When creating a CTO, the Hours Earned should be negative to reflect a deduction in the number of COC credits.
    Also a mistake in COC entry should be countered with a debit entry for COC.
    </v-alert>
     </v-col>
    <v-col cols="12">
      <v-form ref="form">
        <v-row >
          <v-col cols="12" lg="3">
            <v-text-field
              v-model="form.employee_id"
              :error-messages="errors.employee_id"
              label="Employee ID"
              outlined
              readonly
              dense
            ></v-text-field>
          </v-col>

          <v-col cols="12" lg="6">
            <v-text-field
              v-model="form.description"
              :error-messages="errors.description"
              label="Description / Event"
              outlined
              dense
            ></v-text-field>
          </v-col>
          <v-col cols="12" lg="3">
            <v-select
              v-model="form.osr_type"
              :error-messages="errors.osr_type"
              :items="osr_type"
              label="Type"
              outlined
              dense
            ></v-select>
          </v-col>

          <v-col cols="12" lg="3">
            <v-menu
              :close-on-content-click="false"
              transition="scale-transition"
              offset-y
              min-width="290px"
            >
              <template v-slot:activator="{ on, date_issued }">
                <v-text-field
                  v-model="form.date_issued"
                  :error-messages="errors.date_issued"
                  label="Date Issued / Approved"
                  outlined
                  dense
                  readonly
                  hint="Date Issued for COC, Date Approved for CTO"
                  prepend-icon="mdi-calendar"
                  v-bind="date_issued"
                
                  v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker
                v-model="form.date_issued"
                no-title
                @input="menu1 = false"
              ></v-date-picker>
            </v-menu>
          </v-col>

          <v-col cols="12" lg="3">
            <v-menu
              :close-on-content-click="false"
              transition="scale-transition"
              offset-y
              min-width="290px"
            >
              <template v-slot:activator="{ on, from_date }">
                <v-text-field
                  v-model="form.osr_from"
                  :error-messages="errors.osr_from"
                  label="Start Date"
                  outlined
                  dense
                  readonly
                  prepend-icon="mdi-calendar"
                  v-bind="from_date"
                
                  v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker
                v-model="form.osr_from"
                no-title
                @input="menu1 = false"
              ></v-date-picker>
            </v-menu>
          </v-col>

          <v-col cols="12" lg="3">
            <v-menu
              :close-on-content-click="false"
              transition="scale-transition"
              offset-y
              min-width="290px"
            >
              <template v-slot:activator="{ on, end_date }">
                <v-text-field
                  v-model="form.osr_to"
                  :error-messages="errors.osr_to"
                  label="End Date"
                  outlined
                  dense
                  readonly
                  prepend-icon="mdi-calendar"
                  v-bind="end_date"
               
                  v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker
                v-model="form.osr_to"
                no-title
                @input="menu1 = false"
              ></v-date-picker>
            </v-menu>
          </v-col>
          <v-col cols="12" lg="3">
            <v-text-field
              v-model="form.hours"
              :error-messages="errors.hours"
              label="Hours Earned/ Hours Used"
              outlined
              dense
              hint="If COC then enter hours earned, if CTO then Hours Used"
            ></v-text-field>
          </v-col>

        </v-row>
      </v-form>
    </v-col>

    <v-col cols="12">
      <v-btn :loading="sending" color="primary" @click="submit"
        >Save COC/CTO</v-btn
      >
    </v-col>


        <v-col cols="12">
      <v-data-table :headers="headers" :items="data" >
        <template v-slot:item.actions="{ item }">
          <v-icon small class="mr-2" @click="editItem(item)">
            mdi-pencil
          </v-icon>
          <v-icon small primary @click="deleteItem(item)"> mdi-delete </v-icon>
          
        </template>
      </v-data-table>
    </v-col>
  </v-row>
  </v-row>
</template>


<script>
import Layout from "@shared/Layout";

export default {
  metaInfo: {
    title: "Create COC",
    goBack: {
      title: "Employees",
      url: "employees.index",
    },
  },

  layout: (h, page) => h(Layout, [page]),

  props: {
    id: null,
    errors: Object,
    data: Array,
  },

  data() {
    return {
      sending: false,
      form: {
        employee_id: this.id,
        date_issued: null,
        description: null,
        type: "COC",
        osr_from: null,
        osr_to: null,
        hours: null,
        balance: null,
      },
      osr_type: [
        { value: "coc", text: "COC" },
        { value: "cto", text: "CTO" },
      ],

      headers: [
        { text: "Date Issued", value: "date_issued" },
        { text: "Description", value: "description" },
        { text: "type", value: "type" },

        { text: "Start Date", value: "osr_from" },
        { text: "End Date", value: "osr_to", sortable: false },
        { text: "Hours", value: "hours", sortable: false },
        { text: "Balance", value: "balance", sortable: false },
        { text: "Created", value: "created_at", sortable: false },
      ],
    };
  },

  methods: {
    submit() {
      this.$inertia.post("/cocs/store", this.form);
    },
  },
};
</script>
