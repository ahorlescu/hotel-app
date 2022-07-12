<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <a
          class="text-gray-800 hover:text-indigo-500"
          :href="route('services.index')"
          >Services</a
        >
        / Create service
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div
            class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8"
          >
            <div class="bg-white shadow rounded-lg p-6 m">
              <form
                action="/services"
                method="POST"
                @submit.prevent="createService"
              >
                <div class="grid lg:grid-cols-2 gap-6">
                  <div
                    class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1"
                  >
                    <div
                      class="-mt-4 absolute tracking-wider px-1 uppercase text-xs"
                    >
                      <p>
                        <label for="name" class="bg-white text-gray-600 px-1"
                          >Service name</label
                        >
                      </p>
                    </div>
                    <p>
                      <input
                        id="name"
                        type="text"
                        v-model="form.name"
                        placeholder="TV"
                        class="py-1 px-1 text-gray-900 outline-none block h-full w-full"
                      />
                      <jet-input-error :message="errors.name" class="mt-2" />
                    </p>
                  </div>
                  <div
                    class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1"
                  >
                    <div
                      class="-mt-4 absolute tracking-wider px-1 uppercase text-xs"
                    >
                      <p>
                        <label for="icon" class="bg-white text-gray-600 px-1"
                          >Icon</label
                        >
                      </p>
                    </div>
                    <p>
                      <input
                        id="icon"
                        v-model="form.icon"
                        placeholder="ex: fa fas-tv"
                        type="text"
                        class="py-1 px-1 outline-none block h-full w-full"
                      />
                      <jet-input-error :message="errors.icon" class="mt-2" />
                    </p>
                    <span
                      ><a
                        href="https://fontawesome.com/icons/"
                        style="color: green"
                        target="_blank"
                        >More icons</a
                      ></span
                    >
                  </div>
                </div>
                <div class="border-t mt-6 pt-3">
                  <button
                    type="submit"
                    class="inline-flex justify-center my-4 py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                  >
                    Save
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Button from "@/Jetstream/Button";
import JetInputError from "@/Jetstream/InputError";

export default {
  props: ["errors"],
  components: {
    AppLayout,
    Button,
    JetInputError,
  },

  data() {
    return {
      form: {
        name: "",
        icon: "",
      },
    };
  },

  methods: {
    createService() {
      this.$inertia.post("/dashboard/services", this.form).then(() => {
        //   code
      });
    },
  },
};
</script>
