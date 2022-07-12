<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <a
          class="text-gray-800 hover:text-indigo-500"
          :href="route('rooms.index')"
          >Room</a
        >
        / Edit room
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg">
          <div class="-my-2 py-2 sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6 m">
              <div class="grid lg:grid-cols-1 gap-6">
                  <div
                    class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1"
                  >
                    <div
                      class="-mt-4 absolute tracking-wider px-1 uppercase text-xs"
                    >
                      <p>
                        <label
                          for="description"
                          class="bg-white text-gray-600 px-1"
                          >Room description</label
                        >
                      </p>
                    </div>
                    <p>
                      <textarea
                        id="description"
                        type="text"
                        rows="4"
                        v-model="form.description"
                        placeholder="ex: double"
                        class="px-1 text-gray-900 outline-none block h-full w-full"
                      ></textarea>
                      <jet-input-error
                        :message="errors.description"
                        class="mt-2"
                      />
                    </p>
                  </div>
                  </div>
                  <div
                    class="border mt-5 focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1"
                  >
                    <div
                      class="-mt-4 absolute tracking-wider px-1 uppercase text-xs"
                    >
                      <p>
                        <label
                          for="available_from"
                          class="bg-white text-gray-600 px-1"
                          >Available from:</label
                        >
                      </p>
                    </div>
                    <date-picker
                      v-model="form.available_from"
                      valueType="format"
                    ></date-picker>
                    <jet-input-error
                      :message="errors.available_from"
                      class="mt-2"
                    />
                  </div>
                  <div
                    class="border mt-5 focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1"
                  >
                    <div
                      class="-mt-4 absolute tracking-wider px-1 uppercase text-xs"
                    >
                      <p>
                        <label
                          for="available_till"
                          class="bg-white text-gray-600 px-1"
                          >Available till:</label
                        >
                      </p>
                    </div>
                    <date-picker
                      v-model="form.available_till"
                      valueType="format"
                    ></date-picker>
                    <jet-input-error
                      :message="errors.available_till"
                      class="mt-2"
                    />
                  </div>
                  <div
                    class="border mt-5 focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1"
                  >
                    <div
                      class="-mt-4 absolute tracking-wider px-1 uppercase text-xs"
                    >
                      <p>
                        <label
                          for="room-type"
                          class="bg-white text-gray-600 px-1"
                          >Room type</label
                        >
                      </p>
                    </div>
                    <select v-model="form.room_type_id" style="width: 100%">
                      <option
                        v-for="(option, index) in room_types"
                        :key="index"
                        v-bind:value="option.id"
                      >
                        {{ option.name }}
                      </option>
                    </select>
                    <jet-input-error
                      :message="errors.room_type_id"
                      class="mt-2"
                    />
                  </div>
                  <div
                    class="border mt-5 focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1"
                  >
                    <div
                      class="-mt-4 absolute tracking-wider px-1 uppercase text-xs"
                    >
                      <p>
                        <label
                          for="room-type"
                          class="bg-white text-gray-600 px-1"
                          >Select services</label
                        >
                      </p>
                    </div>
                    <multiselect
                      v-model="form.services"
                      :options="services_options"
                      :multiple="true"
                      :close-on-select="false"
                      :clear-on-select="false"
                      label="name"
                      track-by="id"
                    >
                      <template slot="option" slot-scope="props">
                        <i :class="props.option.icon" />
                        <span>{{ props.option.name }}</span>
                      </template>
                    </multiselect>
                  </div>
              </div>
              </div>

              <div class="border-t mt-6 p-3">
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
import Multiselect from "vue-multiselect";
import DatePicker from "vue2-datepicker";
import "vue2-datepicker/index.css";

export default {
  props: ["errors", "room", "room_types", "services_options"],
  components: {
    AppLayout,
    Button,
    JetInputError,
    Multiselect,
    DatePicker,
  },

  data() {
    return {
      form: {
        description: this.room.description,
        room_type_id: this.room.room_type_id,
        services: this.room.services,
        available_from: this.room.available_from,
        available_till: this.room.available_till,
      },
      loading: false,
    };
  },

  methods: {
    updateRoomType() {
      this.loading = true;
      this.$inertia
        .patch("/dashboard/rooms/" + this.room.id, this.form)
        .then(() => {
          this.loading = false;
        });
    },

    deleteRoomType() {
      if (confirm("Are you sure that you want to delete this room_type?")) {
        this.$inertia.delete("/dashboard/rooms/" + this.room.id).then(() => {
          //   code
        });
      }
    },
  },
};
</script>
