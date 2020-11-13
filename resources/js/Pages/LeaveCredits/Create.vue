<template>
  <CardWrapper :card_title="card.title">
    <v-card-title>
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
              label="Period"
              outlined
              readonly
              prepend-icon="mdi-calendar"
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

      <v-col cols="2" align-self="center">
        <v-text-field
          v-model="form.vl_credit"
          label="VL Credit Amount"
          hide-details
          outlined
          type="number"
        ></v-text-field>
      </v-col>
            <v-col cols="2" align-self="center">
        <v-text-field
          v-model="form.sl_credit"
          label="SL Credit Amount"
          hide-details
          outlined
          type="number"
        ></v-text-field>
      </v-col>
            <v-col cols="2" align-self="center">
        <v-text-field
          v-model="form.other_credit"
          label="VL Credit Amount"
          hide-details
          outlined
          type="number"
        ></v-text-field>
      </v-col>
      <v-col cols="2" align-self="center">
        <v-text-field
          v-model="form.remarks"
          label="Remarks"
          hide-details
          outlined
        ></v-text-field>
      </v-col>

      <v-col cols="3" >
        <v-btn large color="primary" @click="submit">Add Leave Credit</v-btn>
      </v-col>
    </v-card-title>
    
  </CardWrapper>
</template>

<script>
import Layout from "@shared/Layout";
export default {
  metaInfo: { title: "Employees" },

  layout: (h, page) => h(Layout, [page]),

  props: {
    employee: null,
    id: null,
  },

  data() {
    return {
      card: {
        title: "Leave Credit Form",
        url: "employees.index",
      },

      profile: {
        name: this.employee.full_name,
        position: this.employee.position.name,
        school: this.employee.school.name,
      },

      form: {
        period: null,
        month: null,
        credit: 1.25,
        remarks: null,
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

    currentMonth: function () {
      const d = new Date();
      console.log(this.months[d.getMonth()]);
      return "April";
    },
    // years: function(){

    //   return new Date().getFullYear();

    //  },
  },

  methods: {
    search() {
      this.$inertia.post("/credit/create", this.filter);
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
