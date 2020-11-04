<template>
  <CardWrapper :card_title="card.title">
    <v-card-text>
      <v-row>
        <v-col cols="3">
          <v-select
            v-model="filter.school"
            :items="any_schools"
            item-text="name"
            item-value="id"
            label="School"
            outlined
            hide-details
          ></v-select>
        </v-col>
        <v-col cols="3">
          <v-text-field
            v-model="filter.lastname"
            label="Lastname"
            outlined
            hide-details
          ></v-text-field>
        </v-col>
        <v-col cols="3">
          <v-btn large color="primary" @click="search">Search</v-btn>
        </v-col>
      </v-row>
      <v-divider></v-divider>
      <div class="warning--text caption">* Monthly leave credit</div>
      <v-row>
        <v-col cols="2">
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
                hide-details
                readonly
                append-icon="mdi-calendar"
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
            v-model="form.credit"
            label="Credit Amount"
            outlined
            hide-details
            type="number"
          ></v-text-field>
        </v-col>
        <v-col cols="3">
          <v-text-field
            v-model="form.remarks"
            label="Remarks"
            outlined
            hide-details
          ></v-text-field>
        </v-col>

        <v-col cols="3">
          <v-btn large color="primary" @click="submit">Add </v-btn>
        </v-col>
      </v-row>
      <v-divider></v-divider>
            <div class="warning--text caption">* Select employees whom to apply the leave credit</div>
      <v-row>
        <v-col>
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
        </v-col>
      </v-row>
    </v-card-text>
  </CardWrapper>
</template>

<script>
import Layout from "@shared/Layout";
export default {
  metaInfo: { title: "Leave Credits" },

  layout: (h, page) => h(Layout, [page]),

  props: {
    schools: Array,
    divisions: Array,
    employees: Array,
  },

  data() {
    return {
      selected: [],
      card: {
        title: "Leave Credit Form",
        url: "employees.index",
      },

      filter: { school: "Any", lastname: "" },

      form: {
        period: null,

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
  },

  methods: {
    search() {
      this.$inertia.post("/credits/grp", this.filter);
    },

    submit() {
      this.$inertia.post("/credits/grp", [this.selected, this.form]);
    },
  },
};
</script>
