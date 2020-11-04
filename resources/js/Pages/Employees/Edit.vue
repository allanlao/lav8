<template>
  <CardWrapper :card_title="card.title">
    <v-card-text>
      <v-row>
        <v-col cols="12" lg="3">
          <v-text-field
            v-model="form.id"
            :error-messages="errors.id"
            label="Employee Number"
            outlined
            readonly
          ></v-text-field>
        </v-col>
        <v-col cols="12" lg="3">
          <v-text-field
            v-model="form.firstname"
            :error-messages="errors.firstname"
            label="Firstname"
            outlined
          ></v-text-field>
        </v-col>
        <v-col cols="12" lg="3">
          <v-text-field
            v-model="form.middlename"
            :error-messages="errors.middlename"
            label="Middlename"
            outlined
          ></v-text-field>
        </v-col>
        <v-col cols="12" lg="3">
          <v-text-field
            v-model="form.lastname"
            :error-messages="errors.lastname"
            label="Lastname"
            outlined
          ></v-text-field>
        </v-col>
        <v-col cols="12" lg="3">
          <v-select
            v-model="form.gender"
            :error-messages="errors.gender"
            :items="gender"
            label="Gender"
            outlined
          ></v-select>
        </v-col>

        <v-col cols="12" lg="3">
          <v-select
            v-model="form.civil_status"
            :error-messages="errors.civil_status"
            :items="civil_status"
            label="Civil Status"
            outlined
          ></v-select>
        </v-col>

        <v-col cols="12" lg="3">
          <v-text-field
            v-model="form.birthday"
            :error-messages="errors.birthday"
            label="Birthday"
            outlined
          ></v-text-field>
        </v-col>

        <v-col cols="12" lg="3">
          <v-text-field
            v-model="form.email"
            :error-messages="errors.email"
            label="Email Address"
            outlined
          ></v-text-field>
        </v-col>

        <v-col cols="12" lg="6">
          <v-select
            v-model="form.school_id"
            :error-messages="errors.school_id"
            :items="schools"
            item-text="name"
            item-value="id"
            label="School"
            outlined
          ></v-select>
        </v-col>
        <v-col cols="12" lg="3">
          <v-text-field
            v-model="form.entrance_to_duty"
            :error-messages="errors.entrance_to_duty"
            label="Entrance To Duty"
            outlined
          ></v-text-field>
        </v-col>

        <v-col cols="12" lg="3">
          <v-select
            v-model="form.employment_status"
            :error-messages="errors.employment_status"
            :items="emp_status"
            label="Employment Status"
            outlined
          ></v-select>
        </v-col>

        <v-col cols="12" lg="6">
          <v-select
            v-model="form.position_id"
            :items="positions"
            item-text="name"
            item-value="id"
            :error-messages="errors.position_id"
            label="Position"
            outlined
          ></v-select>
        </v-col>

        <v-col cols="12" lg="3">
          <v-text-field
            v-model="form.tin"
            :error-messages="errors.tin"
            label="TIN"
            outlined
          ></v-text-field>
        </v-col>
        <v-col cols="12" lg="3">
          <v-text-field
            v-model="form.gsis_no"
            :error-messages="errors.gsis_no"
            label="GSIS NO"
            outlined
          ></v-text-field>
        </v-col>

        <v-col cols="12">
          <v-btn :loading="sending" color="primary" @click="submit"
            >Update Employee</v-btn
          >
        </v-col>
      </v-row>
    </v-card-text>
  </CardWrapper>
</template>

<script>
import Layout from "@shared/Layout";

export default {
  metaInfo: {
    title: "Create Employee",
    goBack: {
      title: "Employees",
      url: "employees.index",
    },
  },

  layout: (h, page) => h(Layout, [page]),

  props: {
    errors: Object,
    positions: Array,
    schools: Array,
    employee: Object,
  },

  data() {
    return {
      card: {
        title: "Employee Form",
        url: "employees.index",
      },
      form: this.employee,
      gender: [
        { value: "male", text: "Male" },
        { value: "female", text: "Female" },
      ],
      emp_status: [
        { value: "regular", text: "Regular" },
        { value: "probationary", text: "Probationary" },
      ],

      civil_status: [
        { value: "married", text: "Married" },
        { value: "single", text: "Single" },
        { value: "widowed", text: "Widowed" },
      ],
    };
  },

  methods: {
    submit() {
      this.$inertia.post("/employees/store", this.form);
    },
  },
};
</script>
