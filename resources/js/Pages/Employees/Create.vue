<template>
  <v-row>
    <v-col cols="12">
      <organization-form v-bind:form.sync="form"></organization-form>
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
    title: 'Create Emplotee',
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
      name: null,
      email: null,
      phone: null,
      address: null,
      city: null,
      region: null,
      country: null,
      postal_code: null,
    },
  }),
  methods: {
    submit() {
      this.sending = true
      this.$inertia.post(this.route('employees.store'), this.form)
        .then(() => this.sending = false)
    },
  },
}
</script>
