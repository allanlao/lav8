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
      <v-form ref="form" v-model="valid" lazy-validation>
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
                  readonly
                  append-icon="mdi-calendar"
                  v-bind="period"
                  v-on="on"
                  :rules="[(v) => !!v || 'Item is required']"
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

          <v-col cols="1">
            <v-text-field
              v-model="form.vl_credit"
              label="Vacation Leave"
              outlined
              type="number"
              :rules="[(v) => !!v || 'Item is required']"
            ></v-text-field>
          </v-col>
          <v-col cols="1">
            <v-text-field
              v-model="form.sl_credit"
              label="Sick Leave"
              outlined
              type="number"
              :rules="[(v) => !!v || 'Item is required']"
            ></v-text-field>
          </v-col>
          <v-col cols="1">
            <v-text-field
              v-model="form.other_credit"
              label="Other Leave"
              outlined
              type="number"
            
            ></v-text-field>
          </v-col>
          <v-col cols="2">
            <v-text-field
              v-model="form.remarks"
              label="Remarks"
              outlined
          
            ></v-text-field>
          </v-col>

          <v-col cols="2">
            <v-btn
              large
              color="primary"
              @click="submit"
              :disabled="this.form.selected.length == 0"
              >Add
            </v-btn>
          </v-col>
        </v-row>
      </v-form>
      <v-divider></v-divider>
      <div class="warning--text caption">
        * Select employees whom to apply the leave credit
      </div>
      <v-row>
        <v-col>
          <v-data-table
            v-model="form.selected"
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
    errors: Object,
    flash: Object,
  },

  data() {
    return {
      valid: true,
      card: {
        title: "Leave Credit Form",
        url: "employees.index",
      },

      filter: { school: "Any", lastname: "" },

      form: {
        period: null,
        leave_type: null,
        vl_credit: 1.25,
        sl_credit: 1.25,
        other_credit: 0.0,
        remarks: null,
        selected: [],
      },
      headers: [
        { text: "ID", value: "id" },
        { text: "Name", value: "full_name" },
        { text: "School", value: "school.name" },
        { text: "Division", value: "school.division" },
        { text: "VL Credit", value: "credits.vl_credit" },
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
      this.$inertia.post("/credits_grp", this.filter);
    },
    validate() {
      this.$refs.form.validate();
    },
    submit() {
      if (this.$refs.form.validate()) {
        if (
          confirm(
            "Are you sure you want to add leave credits for " +
              this.form.selected.length +
              " employees?"
          )
        ) {
          this.form.encoded_by = this.$page.props.auth.user.name;
          this.$inertia.post("/credits/storeMany", this.form);
        }
      }
    },
  },
};
</script>
