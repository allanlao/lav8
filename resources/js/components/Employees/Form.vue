<template>
  <v-form ref="form">
    <v-row>
      <v-col cols="12" lg="3">
        <v-text-field
          v-model="form.id"
          :error-messages="$page.errors"
          label="Employee Number"
          outlined
        ></v-text-field>
      </v-col>
      <v-col cols="12" lg="3">
        <v-text-field
          v-model="form.firstname"
          :error-messages="$page.errors"
          label="Firstname"
          outlined
        ></v-text-field>
      </v-col>
      <v-col cols="12" lg="3">
        <v-text-field
          v-model="form.middlename"
          :error-messages="$page.errors"
          label="Middlename"
          outlined
        ></v-text-field>
      </v-col>
      <v-col cols="12" lg="3">
        <v-text-field
          v-model="form.lastname"
          :error-messages="$page.errors"
          label="Lastname"
          outlined
        ></v-text-field>
      </v-col>
      <v-col cols="12" lg="3">
        <v-select
          v-model="form.gender"
          :error-messages="$page.errors"
          :items="gender"
          label="Gender"
          outlined
        ></v-select>
      </v-col>
      <v-col cols="12" lg="3">
        <v-text-field
          v-model="form.birthday"
          :error-messages="$page.errors"
          label="Birthday"
          outlined
        ></v-text-field>
      </v-col>
      <v-col cols="12" lg="3">
        <v-text-field
          v-model="form.tin"
          :error-messages="$page.errors"
          label="TIN"
          outlined
        ></v-text-field>
      </v-col>
      <v-col cols="12" lg="3">
        <v-text-field
          v-model="form.gsis_no"
          :error-messages="$page.errors"
          label="GSIS NO"
          outlined
        ></v-text-field>
      </v-col>

      <v-col cols="12" lg="6">
        <v-select
          v-model="form.school_id"
          :error-messages="$page.errors"
          :items="gender"
          label="School"
          outlined
        ></v-select>
      </v-col>
      <v-col cols="12" lg="3">
        <v-text-field
          v-model="form.entrance_to_duty"
          :error-messages="$page.errors"
          label="Entrance To Duty"
          outlined
        ></v-text-field>
      </v-col>

      <v-col cols="12" lg="3">
        <v-select
          v-model="form.employment_status"
          :error-messages="$page.errors"
          :items="gender"
          label="Employment Status"
          outlined
        ></v-select>
      </v-col>

      <v-col cols="12" lg="3">
        <v-text-field
          v-model="form.position_id"
          :error-messages="$page.errors"
          label="Position"
          outlined
        ></v-text-field>
      </v-col>

      <v-col cols="12" lg="3">
        <v-text-field
          v-model="form.email"
          :error-messages="$page.errors"
          label="Email Address"
          outlined
        ></v-text-field>
      </v-col>
    </v-row>
  </v-form>
</template>

<script>
export default {
  name: "EmployeesForm",

  props: {
    form: Object,
    errors: Object,
  },

  data() {
    return {
      gender: [
        { value: "m", text: "Male" },
        { value: "f", text: "Female" },
      ],
    };
  },
};
</script>