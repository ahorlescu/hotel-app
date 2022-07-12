<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Rooms</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div
            class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8"
          >
            <div
              class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg"
            >
              <a :href="route('rooms.create')">
                <button
                  type="submit"
                  class="inline-flex justify-center my-4 py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                  Add room
                </button>
              </a>
              <table class="min-w-full">
                <thead>
                  <tr>
                    <th
                      class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider"
                    >
                      ID
                    </th>
                    <th
                      class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider"
                    >
                      Description
                    </th>
                    <th
                      class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider"
                    >
                      Room type
                    </th>
                    <th
                      class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider"
                    >
                      Services
                    </th>
                    <th
                      class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider"
                    >
                      Available from
                    </th>
                    <th
                      class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider"
                    >
                      Available till
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-300"></th>
                  </tr>
                </thead>
                <tbody class="bg-white">
                  <tr v-for="(room, index) in rooms" :key="index">
                    <td
                      class="px-6 py-4 whitespace-no-wrap border-b border-gray-500"
                    >
                      <div class="flex items-center">
                        <div>
                          <div class="text-sm leading-5 text-gray-800">
                            {{ room.id }}
                          </div>
                        </div>
                      </div>
                    </td>
                    <td
                      class="px-6 py-4 whitespace-no-wrap border-b border-gray-500"
                    >
                      <div class="text-sm leading-5 text-blue-900">
                        {{ room.description.slice(0, 50) }}
                        <span v-if="room.description.length > 50">...</span>
                      </div>
                    </td>
                    <td
                      class="px-6 py-4 whitespace-no-wrap border-b border-gray-500"
                    >
                      <div class="text-sm leading-5 text-blue-900">
                        {{ room.room_types.name }}
                      </div>
                    </td>
                    <td
                      class="px-6 py-4 whitespace-no-wrap border-b border-gray-500"
                    >
                      <div class="text-sm leading-5 text-blue-900">
                        <span v-if="room.services.length == 0">no service</span>
                        <span v-if="room.services.length == 1"
                          >{{ room.services.length }} service</span
                        >
                        <span v-if="room.services.length > 1"
                          >{{ room.services.length }} services</span
                        >
                      </div>
                    </td>
                    <td
                      class="px-6 py-4 whitespace-no-wrap border-b border-gray-500"
                    >
                      <div class="text-sm leading-5 text-blue-900">
                        {{ room.available_from }}
                      </div>
                    </td>
                    <td
                      class="px-6 py-4 whitespace-no-wrap border-b border-gray-500"
                    >
                      <div class="text-sm leading-5 text-blue-900">
                        {{ room.available_till }}
                      </div>
                    </td>
                    <td
                      class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5"
                    >
                      <a :href="'/dashboard/rooms/' + room.id + '/edit'">
                        <button
                          class="px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none"
                        >
                          Edit
                        </button>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div v-if="successMessage" class="text-green-500 py-5">
                {{ successMessage }}
              </div>
              <div
                class="sm:flex-1 sm:flex sm:items-center sm:justify-between mt-4 work-sans"
              ></div>
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

export default {
  props: ["rooms", "successMessage"],

  components: {
    AppLayout,
    Button,
  },
  mounted() {
    // Hide successMessage after 3sec
    if (this.successMessage) {
      setTimeout(() => {
        this.successMessage = null;
      }, 4000);
    }
  },
};
</script>
