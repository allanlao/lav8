<template>
  <CardWrapper :card_title="card.title">
    <v-card-text>
      <div class="warning--text caption">* All fields are required</div>
        <div class="warning--text caption">* Editing the Employee ID will create a new record</div>
      <v-form ref="form" lazy-validation>
        <v-row>
          <v-col cols="2">
            <v-text-field
              v-model="form.id"
              :error-messages="errors.id"
              label="Employee Number"
              outlined
            ></v-text-field>
          </v-col>
          <v-col cols="2">
            <v-text-field
              v-model="form.firstname"
              :error-messages="errors.firstname"
              label="Firstname"
              outlined
            ></v-text-field>
          </v-col>
          <v-col cols="2">
            <v-text-field
              v-model="form.middlename"
              :error-messages="errors.middlename"
              label="Middlename"
              outlined
            ></v-text-field>
          </v-col>
          <v-col cols="2">
            <v-text-field
              v-model="form.lastname"
              :error-messages="errors.lastname"
              label="Lastname"
              outlined
            ></v-text-field>
          </v-col>
          <v-col cols="2">
            <v-select
              v-model="form.gender"
              :error-messages="errors.gender"
              :items="gender"
              label="Gender"
              outlined
            ></v-select>
          </v-col>

          <v-col cols="2">
            <v-select
              v-model="form.civil_status"
              :error-messages="errors.civil_status"
              :items="civil_status"
              label="Civil Status"
              outlined
            ></v-select>
          </v-col>

          <v-col cols="2">
            <v-menu
              :close-on-content-click="false"
              transition="scale-transition"
              offset-y
            >
              <template v-slot:activator="{ on, birthday }">
                <v-text-field
                  v-model="form.birthday"
                  label="Birthday"
                  outlined
                  hide-details
                  v-bind="birthday"
                  v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker
                v-model="form.birthday"
                no-title
                @input="menu1 = false"
              ></v-date-picker>
            </v-menu>
          </v-col>

          <v-col cols="2">
            <v-text-field
              v-model="form.email"
              :error-messages="errors.email"
              label="Email Address"
              outlined
            ></v-text-field>
          </v-col>

          <v-col cols="4">
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

          <v-col cols="4">
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

          <v-col cols="2">
            <v-menu
              :close-on-content-click="false"
              transition="scale-transition"
              offset-y
            >
              <template v-slot:activator="{ on, entrance_to_duty }">
                <v-text-field
                  v-model="form.entrance_to_duty"
                  label="Entrance To Duty"
                  outlined
                  hide-details
                  v-bind="entrance_to_duty"
                  v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker
                v-model="form.entrance_to_duty"
                no-title
                @input="menu1 = false"
              ></v-date-picker>
            </v-menu>
          </v-col>

          <v-col cols="2">
            <v-select
              v-model="form.employment_status"
              :error-messages="errors.employment_status"
              :items="emp_status"
              label="Employment Status"
              outlined
            ></v-select>
          </v-col>

          <v-col cols="2">
            <v-text-field
              v-model="form.tin"
              :error-messages="errors.tin"
              label="TIN"
              outlined
            ></v-text-field>
          </v-col>
          <v-col cols="2">
            <v-text-field
              v-model="form.gsis_no"
              :error-messages="errors.gsis_no"
              label="GSIS NO"
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
        <v-col cols="4" align-self="center">
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Search"
            hide-details
            outlined
          ></v-text-field>
        </v-col>
        <v-col cols="12">
          <v-data-table :headers="headers" :items="data" :search="search">
            <template v-slot:item.actions="{ item }">
              <v-icon small primary @click="showItem(item)"> mdi-eye </v-icon>
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
    positions: Array,
    schools: Array,
    data: Array,
  },

  data() {
    return {
      card: {
        title: "Employee Form",
        url: "employees.index",
      },

      search: "",

      form: {
        id: null,
        firstname: null,
        lastname: null,
        middlename: null,
        school_id: null,
        entrance_to_duty: null,
        gsis_no: null,
        tin: null,
        email: null,
        employment_status: null,
        mobile: null,
        gender: null,
        birthday: null,
      },

      headers: [
        { text: "ID", value: "id" },
        { text: "Name", value: "full_name" },

        { text: "School", value: "school.name" },
           { text: "Division", value: "school.division" },

        { text: "Position", value: "position.name" },

        { text: "Gender", value: "gender" },
        { text: "Status", value: "employment_status" },

        { text: "Birthday", value: "birthday", align: " d-none" },

        { text: "Mobile", value: "mobile" , align: " d-none" },

        { text: "tin", value: "tin", align: " d-none" },
        { text: "gsis_no", value: "gsis_no", align: " d-none" },
        {
          text: "entrance_to_duty",
          value: "entrance_to_duty",
          align: " d-none",
        },
        { text: "Email", value: "email"},

        { text: "Middlename", value: "middlename", align: " d-none" },

        { text: "Actions", value: "actions", sortable: false },
      ],
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
      this.form.encoded_by = this.$page.props.auth.user.name;

      this.$inertia.post("/employees", this.form, {
        onSuccess: () => {
          // Handle success event
          //  this.reset();
        },
      });
    },

    reset() {
      this.$refs.form.reset();
    },

    deleteItem(item) {
      this.$inertia.delete("/employees/" + item.id, {
        onBefore: () =>
          confirm("Are you sure you want to delete this employee?"),
      });
    },

    editItem(item) {
      this.form = item;
    },

    showItem(item) {
      this.$inertia.get("/employees/" + item.id);
    },
  },
};
</script>
