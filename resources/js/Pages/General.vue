<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">General</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-1 md:gap-6">
              <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="shadow overflow-hidden sm:rounded-md">
                  <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                      <div class="col-span-6 sm:col-span-3">
                        <label
                          for="email"
                          class="block text-sm font-medium text-gray-700"
                          >Email</label
                        >
                        <input
                          type="text"
                          name="email"
                          v-model="form.email"
                          class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        />
                      </div>

                      <div class="col-span-6 sm:col-span-3">
                        <label
                          for="faceook_url"
                          class="block text-sm font-medium text-gray-700"
                          >Facebook</label
                        >
                        <input
                          type="text"
                          name="faceook_url"
                          v-model="form.facebook_url"
                          class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        />
                      </div>

                      <div class="col-span-6 sm:col-span-3">
                        <label
                          for="map_url"
                          class="block text-sm font-medium text-gray-700"
                          >Map URL</label
                        >
                        <input
                          type="text"
                          name="map_url"
                          v-model="form.map_url"
                          class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        />
                      </div>

                      <div class="col-span-6 sm:col-span-3">
                        <label
                          for="tel"
                          class="block text-sm font-medium text-gray-700"
                          >Tel</label
                        >
                        <input
                          type="tel"
                          name="tel"
                          v-model="form.tel"
                          class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        />
                      </div>

                      <div class="col-span-6">
                        <label
                          for="address"
                          class="block text-sm font-medium text-gray-700"
                          >Address</label
                        >
                        <input
                          type="text"
                          name="address"
                          v-model="form.address"
                          class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button
                      @click="updateGeneralInfo"
                      :disabled="loading"
                      class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                      Save
                    </button>
                  </div>
                </div>
                <div v-if="successMessage" class="text-green-500 p-5">
                  {{ successMessage }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
  props: ["general", "successMessage"],
  components: {
    AppLayout,
  },

  data() {
    return {
      form: {
        email: this.general.email,
        facebook_url: this.general.facebook_url,
        map_url: this.general.map_url,
        tel: this.general.tel,
        address: this.general.address,
      },
      loading: false,
    };
  },

  methods: {
    updateGeneralInfo() {
      this.loading = true;
      if (this.general && this.general.id) {
        this.$inertia
          .patch("/dashboard/general/" + this.general.id, this.form)
          .then(() => {
            this.loading = false;
            setTimeout(() => {
              this.successMessage = null;
            }, 4000);
          });
      } else {
        this.$inertia.post("/dashboard/general", this.form).then(() => {
          this.loading = false;
          setTimeout(() => {
            this.successMessage = null;
          }, 4000);
        });
      }
    },
  },
};
</script>
