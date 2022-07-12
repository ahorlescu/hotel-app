<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <a
          class="text-gray-800 hover:text-indigo-500"
          :href="route('room_type.index')"
          >Room Type</a
        >
        / Edit room
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div
            class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8"
          >
            <div class="bg-white shadow rounded-lg p-6 m">
              <div class="grid lg:grid-cols-2 gap-6">
                <div
                  class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1"
                >
                  <div
                    class="-mt-4 absolute tracking-wider px-1 uppercase text-xs"
                  >
                    <p>
                      <label for="name" class="bg-white text-gray-600 px-1"
                        >Room name</label
                      >
                    </p>
                  </div>
                  <p>
                    <input
                      id="name"
                      type="text"
                      v-model="form.name"
                      placeholder="ex: double"
                      class="py-1 px-1 text-gray-900 outline-none block h-full w-full"
                    />
                    <jet-input-error :message="errors.name" class="mt-2" />
                  </p>
                </div>
              </div>
              <div class="border-t mt-6 pt-3">
                <button
                  @click="updateRoomType"
                  class="inline-flex justify-center my-4 py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                  Save
                </button>
                <button
                  @click="deleteRoomType"
                  class="inline-flex justify-center my-4 py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                  Delete
                </button>
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
import Button from "@/Jetstream/Button";
import JetInputError from "@/Jetstream/InputError";

export default {
  props: ["errors", "room_type"],
  components: {
    AppLayout,
    Button,
    JetInputError,
  },

  data() {
    return {
      form: {
        name: this.room_type.name,
        id: this.room_type.id,
      },
      loading: false,
    };
  },

  methods: {
    updateRoomType() {
      this.loading = true;
      this.$inertia
        .patch("/dashboard/room-type/" + this.room_type.id, this.form)
        .then(() => {
          this.loading = false;
        });
    },

    deleteRoomType() {
      if (confirm("Are you sure that you want to delete this room_type?")) {
        this.$inertia
          .delete("/dashboard/room-type/" + this.room_type.id)
          .then(() => {
            //   code
          });
      }
    },
  },
};
</script>
