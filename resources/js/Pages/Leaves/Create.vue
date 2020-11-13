<template>
  <CardWrapper :card_title="card.title">
    <v-card-text>
      <v-row>
        <v-col cols="12">
          <Profile :data="profile"></Profile>
        </v-col>
      </v-row>
      <v-divider></v-divider>
         <div class="warning--text caption">* All fields are required except Disapproved Reason</div>
      <v-row>
        <v-col cols="2">
          <v-menu
            :close-on-content-click="false"
            transition="scale-transition"
            offset-y
          >
            <template v-slot:activator="{ on, date_filed }">
              <v-text-field
                v-model="form.date_filed"
                :error-messages="errors.date_filed"
                label="Date Filed"
                outlined
                v-bind="date_filed"
                v-on="on"
              ></v-text-field>
            </template>
            <v-date-picker
              v-model="form.date_filed"
              no-title
              @input="menu1 = false"
            ></v-date-picker>
          </v-menu>
        </v-col>

        <v-col cols="2">
          <v-select
            v-model="form.type"
            :items="leave_type"
            :error-messages="errors.type"
            label="Leave Type"
            outlined
          ></v-select>
        </v-col>

        <v-col cols="2">
          <v-select
            v-model="form.location_type"
            :items="location_type"
            :error-messages="errors.location_type"
            label="Location Type"
            outlined
          ></v-select>
        </v-col>

        <v-col cols="2">
          <v-select
            v-model="form.commutation"
            :items="commutation"
            :error-messages="errors.commutation"
            label="Commutation"
            outlined
          ></v-select>
        </v-col>

        <v-col cols="4">
          <v-text-field
            v-model="form.location"
            :error-messages="errors.location"
            label="Location"
            outlined
          ></v-text-field>
        </v-col>
      </v-row>

      <v-row>
        <v-col cols="2">
          <v-text-field
            v-model="form.total_days"
            :error-messages="errors.total_days"
            label="Working Days Applied"
            outlined
          ></v-text-field>
        </v-col>

        <v-col cols="4">
          <v-text-field
            v-model="form.inclusive_dates"
            :error-messages="errors.inclusive_dates"
            label="Inclusive Dates"
            outlined
          ></v-text-field>
        </v-col>

        <v-col cols="2">
          <v-text-field
            v-model="form.vl_balance"
            :error-messages="errors.vl_balance"
            label="Vacation Balance"
            outlined
          ></v-text-field>
        </v-col>

        <v-col cols="2">
          <v-text-field
            v-model="form.sl_balance"
            :error-messages="errors.sl_balance"
            label="Sick Balance"
            outlined
          ></v-text-field>
        </v-col>
      </v-row>

      <v-row>
        <v-col cols="2">
          <v-text-field
            v-model="form.total_approved_with_pay"
            :error-messages="errors.total_approved_with_pay"
            label="Approved with Pay"
            outlined
          ></v-text-field>
        </v-col>

        <v-col cols="2">
          <v-text-field
            v-model="form.total_approved_without_pay"
            :error-messages="errors.total_approved_without_pay"
            label="Approved without Pay"
            outlined
          ></v-text-field>
        </v-col>

        <v-col cols="2">
          <v-text-field
            v-model="form.total_approved_others"
            :error-messages="errors.total_approved_others"
            label="Approved Others"
            outlined
          ></v-text-field>
        </v-col>

        <v-col cols="3">
          <v-text-field
            v-model="form.disapproved_reason"
            :error-messages="errors.disapproved_reason"
            label="Disapproved Reason"
            outlined
          ></v-text-field>
        </v-col>
      </v-row>

     
      <v-row>
        <v-col cols="12">
          <v-btn @click="submit" color="success" >Submit</v-btn>

        </v-col>
      </v-row>

       <v-divider ></v-divider>

      <v-row>
        <v-col>
        <v-data-table
        
          :headers="headers"
          :items="employee_leaves"
          :search="search"
        >
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
    title: "Create Leave",
    goBack: {
      title: "Leaves",
      url: "leaves.index",
    },
  },

  layout: (h, page) => h(Layout, [page]),

  props: {
    errors: Object,
    employee_leaves: Array,
    employee: Object,
  
  },

  data() {
    return {


      profile:{
        name:this.employee.full_name,
        position:this.employee.position.name,
        school:this.employee.school.name,
      },
      card: {
        title: "Leave Application Form",
        url: "employees.index",
      },

      form: {
        id: null,
        date_filed: new Date().toISOString().substr(0, 10),
        employee_id: this.employee.id,
        type: null,
        location: null,
        location_type: "local",
        total_days: null,
        inclusive_dates: null,
        commutation: "none",

        vl_balance: null,
        sl_balance: null,
        total_approved_with_pay: 0,
        total_approved_without_pay: 0,
        total_approved_others: 0,
        disapproved_reason: null,
      },
      leave_type: [
        { value: "sick", text: "Sick Leave" },
        { value: "vacation", text: "Vacation Leave" },
        { value: "maternity", text: "Maternity Leave" },
        { value: "paternity", text: "Paternity Leave" },
      ],
      location_type: [
        { value: "local", text: "Local" },
        { value: "abroad", text: "Abroad" },
        { value: "hospital", text: "Hospital" },
      ],

      leave_pay: [
        { value: "yes", text: "With Pay" },
        { value: "no", text: "Without Pay" },
        { value: "others", text: "Others" },
      ],

      commutation: [
        { value: "requested", text: "Requested" },
        { value: "none", text: "Not Requested" },
      ],
      search: "",

      headers: [
        { text: "Date Filed", value: "date_filed" },
        { text: "Type", value: "type" },
        { text: "Location", value: "location" },
        { text: "Inclusive Date", value: "inclusive_dates" },
        { text: "Days", value: "total_days" },
        { text: "With Pay", value: "total_approved_with_pay" },
        { text: "Encoded By", value: "encoded_by" },
        { text: "Actions", value: "actions", sortable: false },
      ],
    };
  },

  methods: {
    submit() {
      this.form.encoded_by = this.$page.props.auth.user.name;
      this.form.leave_status = "pending";
      this.$inertia.post("/leaves", this.form);
    },
   editItem(item) {
      this.form = item;
    },

    deleteItem(item) {
      if (confirm("Are you sure you want to delete this leave?")) {
        this.$inertia.get("/leaves/delete/" + item.id);
      }
    },
  },
};
</script>
