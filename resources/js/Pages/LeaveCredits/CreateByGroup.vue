<template>
  <v-row>
    <v-col cols="3" align-self="center">
      <v-select
        v-model="filter.school"
        :items="any_schools"
        item-text="name"
        item-value="id"
        label="School"
       
        outlined
      ></v-select>
    </v-col>
    <v-col cols="3" align-self="center">
      <v-text-field
        v-model="filter.lastname"
        label="Lastname"
       
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
              v-model="form.credit"
              label="Credit Amount"
           
              outlined
              type="number"
            ></v-text-field>
          </v-col>
          <v-col cols="3" align-self="center">
            <v-text-field
              v-model="form.remarks"
              label="Remarks"
             
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
      this.$inertia.post("/credits/grp", [
       this.selected,
        this.form,
      ]);
    },
  },
};
</script>
