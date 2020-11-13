<template>
  <CardWrapper :card_title="card.title">
    <v-card-text>
      <v-row>
        <v-col cols="12">
          <Profile :data="profile"></Profile>
        </v-col>
      </v-row>
      <v-divider></v-divider>
      <div class="warning--text caption">* All fields are required</div>
      <v-row>
        <v-col cols="6">
          <v-text-field
            v-model="form.title"
            :error-messages="errors.title"
            label="Training Title"
            outlined
          ></v-text-field>
        </v-col>

        <v-col cols="2">
          <v-select
            v-model="form.type"
            :items="type"
            :error-messages="errors.type"
            label="Type"
            outlined
          ></v-select>
        </v-col>

        <v-col cols="2">
          <v-select
            v-model="form.level"
            :items="level"
            :error-messages="errors.level"
            label="Level"
            outlined
          ></v-select>
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
                :error-messages="errors.date_from"
                label="Date From"
                outlined
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
                :error-messages="errors.date_to"
                label="Date To"
                outlined
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

        <v-col cols="2">
          <v-text-field
            v-model="form.hours"
            :error-messages="errors.hours"
            label="No of Hours"
            outlined
          ></v-text-field>
        </v-col>
        <v-col cols="4">
          <v-text-field
            v-model="form.sponsor"
            :error-messages="errors.sponsor"
            label="Conducted By/Sponsored By"
            outlined
          ></v-text-field>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12">
          <v-btn @click="submit" color="success">Submit</v-btn>
        </v-col>
      </v-row>

      <v-divider></v-divider>

      <v-row>
        <v-col>
          <v-data-table :headers="headers" :items="trainings" :search="search">
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
</template>

<script>
import Layout from "@shared/Layout";
import Profile from "@shared/Profile";

export default {
  metaInfo: {
    title: "Create Training",
    goBack: {
      title: "Employee Trainings",
      url: "trainings.index",
    },
  },

  layout: (h, page) => h(Layout, [page]),

  props: {
    errors: Object,
    trainings: Array,
    employee: Object,
  },

  data() {
    return {
      profile: {
        name: this.employee.full_name,
        position: this.employee.position.name,
        school: this.employee.school.name,
      },
      card: {
        title: "New Training Form",
      },

      form: {
        id: null,
        employee_id: this.employee.id,
        type: null,
        level: null,
        title: null,
        date_from: new Date().toISOString().substr(0, 10),
        date_to: new Date().toISOString().substr(0, 10),
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

      search: "",

      headers: [
        { text: "Title", value: "title" },
        { text: "Type", value: "type" },
        { text: "Level", value: "level" },
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
    submit() {
      this.form.encoded_by = this.$page.props.auth.user.name;

      this.$inertia.post("/trainings/store", this.form);
    },

    deleteItem(item) {
      if (confirm("Are you sure you want to delete this training?")) {
        this.$inertia.get("/trainings/delete/" + item.id);
      }
    },

    editItem(item) {
      this.form = item;
    },
  },
};
</script>
