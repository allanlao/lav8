<template>
  <CardWrapper :card_title="card.title">
    <v-card-text class="pa-10">
      <v-row>
        <v-col cols="4">
          <v-card>
            <v-row>
              <v-avatar color="info" size="100" tile class="pa-0 ma-2">
                <span class="white--text headline">CJ</span>
              </v-avatar>
            </v-row>

            <v-card-title>
              {{ employee.full_name }}
            </v-card-title>
            <v-list-item two-line>
              <v-list-item-content>
                <v-list-item-title>
                  {{ employee.position.name }}</v-list-item-title
                >
                <v-list-item-title> {{ employee.email }}</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-card>
        </v-col>

        <v-col cols="4">
          <v-card>
            <v-card-text>
              <v-row>
                <v-col cols="12" class="h5">General Information</v-col>
                <v-col cols="6" class="ma-0 py-0 font-weight-bold"
                  >School:</v-col
                >
                <v-col cols="6" class="ma-0 py-0">
                  {{ employee.school.name }}</v-col
                >
                <v-col cols="6" class="ma-0 py-0 font-weight-bold"
                  >District:</v-col
                >
                <v-col cols="6" class="ma-0 py-0">{{
                  employee.school.district
                }}</v-col>
                <v-col cols="6" class="ma-0 py-0 font-weight-bold"
                  >Division:</v-col
                >
                <v-col cols="6" class="ma-0 py-0">{{
                  employee.school.division
                }}</v-col>
                <v-col cols="6" class="ma-0 py-0 font-weight-bold"
                  >Status:</v-col
                >
                <v-col cols="6" class="ma-0 py-0">{{
                  employee.employment_status
                }}</v-col>
                <v-col cols="6" class="ma-0 py-0 font-weight-bold"
                  >Civil Status:</v-col
                >
                <v-col cols="6" class="ma-0 py-0">{{
                  employee.civil_status
                }}</v-col>
                <v-col cols="6" class="ma-0 py-0 font-weight-bold"
                  >Entrance to Duty:</v-col
                >
                <v-col cols="6" class="ma-0 py-0">{{
                  employee.entrance_to_duty
                }}</v-col>
                <v-col cols="6" class="ma-0 py-0 font-weight-bold">GSIS:</v-col>
                <v-col cols="6" class="ma-0 py-0">{{ employee.gsis }}</v-col>
                <v-col cols="6" class="ma-0 py-0 font-weight-bold">TIN:</v-col>
                <v-col cols="6" class="ma-0 py-0">{{ employee.tin }}</v-col>
                <v-col cols="6" class="ma-0 py-0 font-weight-bold"
                  >Contact No:</v-col
                >
                <v-col cols="6" class="ma-0 py-0">{{ employee.mobile }}</v-col>
                <v-col cols="6" class="ma-0 py-0 font-weight-bold"
                  >ACTIVE:</v-col
                >
                <v-col cols="6" class="ma-0 py-0"
                  ><v-chip color="green" text-color="white">{{
                    employee.is_active
                  }}</v-chip></v-col
                >
              </v-row>
            </v-card-text>
          </v-card>
        </v-col>

   
      </v-row>
      <v-row>
        <v-col>
          <v-card>
            <v-card-title>Leaves</v-card-title>
            <v-data-table
              :headers="leave_headers"
              :items="leaves"
              :items-per-page="15"
              class="elevation-1"
            ></v-data-table>
          </v-card>
        </v-col>
      </v-row>

      <v-row>
        <v-col>
          <v-card>
            <v-card-title>Leave Credits</v-card-title>
            <v-data-table
              :headers="leave_headers"
              :items="credits"
              :items-per-page="15"
              class="elevation-1"
            ></v-data-table>
          </v-card>
        </v-col>
      </v-row>

      <v-row>
        <v-col>
          <v-card>
            <v-card-title>Compensatory Overtime Credit</v-card-title>
            <v-data-table
              :headers="coc_headers"
              :items="cocs"
              :items-per-page="15"
              class="elevation-1"
            ></v-data-table>
          </v-card>
        </v-col>
      </v-row>
    </v-card-text>
  </CardWrapper>
</template>
<script>
import Layout from "@shared/Layout";

export default {
  layout: (h, page) => h(Layout, [page]),

  props: {
    errors: Object,
    leaves: Array,
    employee: Object,
    cocs: Array,
    credits: Array,
  },
  data() {
    return {
      card: {
        title: "Employee Profile",
        url: "employees.index",
      },

      profile: {
        name: this.employee.full_name,
        position: this.employee.position.name,
        school: this.employee.school.name,
      },

      coc_headers: [
        { text: "Date Issued", value: "date_issued" },
        { text: "Description", value: "description" },
        { text: "Type", value: "type" },
        { text: "Date From", value: "osr_from" },
        { text: "Date To", value: "osr_to" },
        { text: "Hours Earned", value: "hours" },
        { text: "COC Remaining", value: "balance" },
        { text: "Status", value: "coc_status" },
        { text: "Encoded By", value: "encoded_by" },
        { text: "Approved By", value: "approved_by" },
      ],

      leave_headers: [
        { text: "Date Filed", value: "date_filed" },

        { text: "Type", value: "type" },
        { text: "Inclusive Dates", value: "inclusive_dates" },
        { text: "Days", value: "total_days" },
        { text: "Status", value: "leave_status" },
        { text: "Encoded By", value: "encoded_by" },
        { text: "Approved By", value: "approved_by" },
      ],

      credit_headers: [
        { text: "Period", value: "period" },
        { text: "Type", value: "type" },
        { text: "VL Credit", value: "vl_credit" },
        { text: "SL Credit", value: "sl_credit" },
        { text: "Other Credit", value: "other_credit" },
        { text: "Remarks", value: "remarks" },
      ],
    };
  },
};
</script>

<style>
</style>