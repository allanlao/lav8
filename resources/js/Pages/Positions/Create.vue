<template>
  <CardWrapper :card_title="card.title">
    <v-card-text>
      <v-row>
        <v-col cols="4">
          <v-text-field
            v-model="form.name"
            :error-messages="errors.name"
            label="Position Name"
            outlined
          ></v-text-field>
        </v-col>
      </v-row>

      <v-row>
        <v-col cols="1">
          <v-btn color="primary" @click="submit">Save Position</v-btn>
        </v-col>
      </v-row>
    </v-card-text>
    <v-divider></v-divider>
  </CardWrapper>
</template>

<script>
import Layout from "@shared/Layout";

export default {
  metaInfo: {
    title: "Create Position",
    goBack: {
      title: "Positions",
      url: "positions.index",
    },
  },

  layout: (h, page) => h(Layout, [page]),

  props: {
    errors: Object,
  },

  data() {
    return {
      card: {
        title: "Position Form",
        url: "positions.index",
      },

      form: {
        name: null,
      },
    };
  },

  methods: {
    submit() {
      this.$inertia.post("/positions", this.form);
    },
  },
};
</script>
