<template>
  <CardWrapper :card_title="card.title">
    <v-card-text>
      <div class="primary--text h4">Search Form</div>
      <div class="warning--text caption">*Leave field blank to select all</div>

      <v-form
    ref="form"
    v-model="valid"
    lazy-validation
  >
      <v-row>

        <v-col cols="4">
          <v-select
            v-model="form.employee_id"
            :items="employees"
            item-text="full_name"
            item-value="id"
            label="Employee"
            outlined
            hide-details
          ></v-select>
        </v-col>

        <v-col cols="2">
          <v-select
            v-model="form.level"
            :items="level"
            label="Level"
            outlined
            hide-details
          ></v-select>
        </v-col>

        <v-col cols="2">
          <v-select
            v-model="form.type"
            :items="type"
            label="Type"
            outlined
            hide-details
          ></v-select>
        </v-col>

        <v-col cols="4">
          <v-text-field
            v-model="form.title"
            label="Title"
            outlined
            hide-details
          ></v-text-field>
        </v-col>

        <v-col cols="2">
          <v-menu
            :close-on-content-click="false"
            transition="scale-transition"
            offset-y
          >
            <template v-slot:activator="{ on, date_from }">
              <v-text-field
                v-model="form.date_from"
                label="Date From"
                outlined
                hide-details
                v-bind="date_from"
                v-on="on"
              ></v-text-field>
            </template>
            <v-date-picker
              v-model="form.date_from"
              no-title
              @input="menu1 = false"
            ></v-date-picker>
          </v-menu>
        </v-col>

        <v-col cols="2">
          <v-menu
            :close-on-content-click="false"
            transition="scale-transition"
            offset-y
          >
            <template v-slot:activator="{ on, date_to }">
              <v-text-field
                v-model="form.date_to"
                label="Date To"
                outlined
                hide-details
                v-bind="date_to"
                v-on="on"
              ></v-text-field>
            </template>
            <v-date-picker
              v-model="form.date_to"
              no-title
              @input="menu1 = false"
            ></v-date-picker>
          </v-menu>
        </v-col>

        <v-col cols="3">
          <v-text-field
            v-model="form.sponsor"
            label="Conducted By/Sponsored By"
            outlined
            hide-details
          ></v-text-field>
        </v-col>
        <v-col cols="3">
          <v-btn @click="search" color="success">Search</v-btn>
       
          <v-btn @click="reset" color="warning">Reset</v-btn>
        </v-col>
      </v-row>
      </v-form>
      <v-divider></v-divider>
      <v-row>
        <v-col cols="2" offset="10">
          <v-btn @click="create" color="primary">Create Training</v-btn>
        </v-col>
        <v-col cols="12">
          <v-data-table :headers="headers" :items="data">
            <template v-slot:item.actions="{ item }">
              <v-icon small class="mr-2" @click="showItem(item)">
                mdi-eye
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
  metaInfo: { title: "Trainings" },

  layout: (h, page) => h(Layout, [page]),

  props: {
    data: Array,
    employees:Array,
  },

  data() {
    return {
      card: {
        title: "Trainings",
        url: "employees.index",
      },

      form: {
        id: null,
        employee_id: null,
        type: null,
        level: null,
        title: null,
        date_from: null,
        date_to: null,
        hours: null,
        sponsor: null,
        encoded_by: null,
      },

      type: [
        { value: "managerial", text: "Managerial" },
        { value: "supervisory", text: "Supervisory" },
        { value: "technical", text: "Technical" },
        { value: "others", text: "Others" },
      ],

      level: [
        { value: "national", text: "National" },
        { value: "regional", text: "Regional" },
        { value: "division", text: "Division" },
      ],

      headers: [
        { text: "No", value: "props.index" },
        { text: "Name", value: "employee.full_name" },
        { text: "School", value: "employee.school.name" },
        { text: "Title", value: "title" },
        { text: "Level", value: "level" },
        { text: "Type", value: "type" },
        { text: "Date From", value: "date_from" },
        { text: "Date To", value: "date_to" },
        { text: "No of Hours", value: "hours" },
        { text: "Sponsor", value: "sponsor" },
        { text: "Encoded By", value: "encoded_by" },
        { text: "Actions", value: "actions", sortable: false },
      ],
    };
  },

  methods: {
    create() {
      this.$inertia.get("/home");
    },

    search() {
      this.$inertia.post("/trainings", this.form);
    },

      reset () {
        this.$refs.form.reset()
      },

    showItem(item) {
      this.$inertia.get("/trainings/show/" + item.id);
    },
  },
};
</script>
