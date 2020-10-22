<template>
  <v-row>
    <v-col cols="12">
      <employees-form v-bind:form.sync="form"></employees-form>
    </v-col>

    <v-col cols="12">
      <v-btn :loading="sending" color="primary" @click="submit">Save Organization</v-btn>
    </v-col>
  </v-row>
</template>

<script>
import Layout from '@shared/Layout'

export default {
  metaInfo: {
    title: 'Create Employee',
    goBack: {
      title: 'Employees',
      url: 'employees.index',
    }
  },

  layout: (h, page) => h(Layout, [page]),

  remember: 'form',

  data: vm => ({
    sending: false,
    form: {
      id:null,
      firstname: null,
      lastname: null,
      middlename: null,
      school_id: null,
      entrance_to_duty: null,
      gsis_no: null,
      tin: null,
      email: null,
      employment_status:null,
      mobile :null,
      gender :null,
      birthday:null,

    },
  }),
  methods: {
    submit() {
      this.sending = true
   

        this.$inertia.post('/employees/store',  
              this.form
              , {
              onSuccess: () => {
                // Handle success event
              },
            }).then(() => this.sending = false)
    },
  },
}
</script>
