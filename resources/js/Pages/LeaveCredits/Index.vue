<template>
  <v-row>
    <v-col cols="3" align-self="center">
      <v-select
        v-model="filter.school"
        :items="any_schools"
        item-text="name"
        item-value="id"
        label="School"
        hide-details
        outlined
      ></v-select>
    </v-col>
    <v-col cols="3" align-self="center">
      <v-text-field
        v-model="filter.lastname"
        label="Lastname"
        hide-details
        outlined
      ></v-text-field>
    </v-col>
    <v-col cols="3" align-self="center">
      <v-btn large color="primary" @click="search">Search</v-btn>
    </v-col>

    <v-col cols="12" align-self="center">
      <v-card tile outlined>
        <v-card-title>
          <v-col cols="2" align-self="center">
            <v-select
              v-model="form.year"
              :items="years"
              label="Year"
              hide-details
              outlined
            ></v-select>
          </v-col>
          <v-col cols="2" align-self="center">
            <v-select
              v-model="form.month"
              :items="months"
               label="Month"
              hide-details
              outlined
            ></v-select>
          </v-col>
          <v-col cols="2" align-self="center">
            <v-text-field
              v-model="form.credit"
              label="Credit Amount"
              hide-details
              outlined
              type="number"
            ></v-text-field>
          </v-col>
            <v-col cols="3" align-self="center">
            <v-text-field
              v-model="form.remarks"
              label="Remarks"
              hide-details
              outlined
              
            ></v-text-field>
          </v-col>

          <v-col cols="3" align-self="center">
            <v-btn large color="primary" @click="submit"
              >Add Leave Credit</v-btn
            >
          </v-col>
        </v-card-title>

        <v-data-table
          v-model="selected"
          :headers="headers"
          :items="employees"
          item-key="id"
          sort-by="name"
          group-by="school.name"
          class="elevation-1"
          show-group-by
          show-select
        >
        </v-data-table>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import Layout from "@shared/Layout";
export default {
  metaInfo: { title: "Employees" },

  layout: (h, page) => h(Layout, [page]),

  props: {
    schools: Array,
    divisions: Array,
    employees: Array,
  },

  data() {
    return {
      selected: [],
      years: [new Date().getFullYear(), new Date().getFullYear() + 1],
      months: [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
      ],

      filter: { school: "Any", lastname: "" },

      form: {
        year: new Date().getFullYear(),
        month: null,
        credit: 1.5,
        remarks:null,
      },
      headers: [
        { text: "ID", value: "id" },
        { text: "Name", value: "full_name" },
        { text: "School", value: "school.name" },
        { text: "Division", value: "school.division" },
      ],
    };
  },

  computed: {
    any_divisions: function () {
      this.divisions.unshift("Any");
      return this.divisions;
    },

    any_schools: function () {
      this.schools.unshift("Any");
      return this.schools;
    },

     currentMonth: function(){
         const d = new Date();
         console.log(this.months[d.getMonth()]);
         return "April"
     },
    // years: function(){

    //   return new Date().getFullYear();

    //  },
  },

  methods: {
    search() {
      this.$inertia.post("/credit", this.filter);
    },

    submit() {
      this.$inertia.post("/credit/store", {
        selected: this.selected,
        form: this.form,
      });
    },
  },
};
</script>
