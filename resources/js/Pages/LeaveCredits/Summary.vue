<template>
  <CardWrapper :card_title="card.title">
    <v-card-text>
      <v-row>
        <v-col cols="4">
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Search"
            hide-details
            outlined
          ></v-text-field>
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <v-data-table
            :headers="headers"
            :items="data"
            item-key="id"
            sort-by="name"
            group-by="name"
            class="elevation-1"
            :search="search"
          >
            <template #item.fullname="{ item }"
              >{{ item.lastname }}, {{ item.firstname }}</template
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
    data: Array,
    errors: Object,
    flash: Object,
  },

  data() {
    return {
      search: null,
      valid: true,
      card: {
        title: "Leave Usage Summary",
        url: "employees.index",
      },

      headers: [
        { text: "ID", value: "id" },
        { text: "Employee Name", value: "fullname" },
        { text: "School", value: "name" },
        { text: "Division", value: "division" },
        { text: "VL Credit", value: "vl_credit" },
        { text: "SL Credit", value: "sl_credit" },
        { text: "Other Credit", value: "other_credit" },
        { text: "VL used", value: "tvlwp" },
        { text: "SL used", value: "tslwp" },
      ],
    };
  },

  methods: {
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
