import { defineStore } from "pinia";

export let useClaimStore = defineStore('claim', {
  state: () => ({
    claimTypeId: null,
    referraId: null
  }),
  actions: {
    setClaimTypeId(id) {
      this.claimTypeId = id;
    },
    setReferraId(id) {
      this.referraId = id;
    },
  },
});
