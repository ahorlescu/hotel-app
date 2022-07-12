<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Reserved rooms
      </h2>
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
                      Room ID
                    </th>
                    <th
                      class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider"
                    >
                      From
                    </th>
                    <th
                      class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider"
                    >
                      Untill
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-300"></th>
                  </tr>
                </thead>
                <tbody class="bg-white">
                  <tr
                    v-for="(reserved_room, index) in reserved_rooms"
                    :key="index"
                  >
                    <td
                      class="px-6 py-4 whitespace-no-wrap border-b border-gray-500"
                    >
                      <div class="flex items-center">
                        <div>
                          <div class="text-sm leading-5 text-gray-800">
                            {{ reserved_room.id }}
                          </div>
                        </div>
                      </div>
                    </td>
                    <td
                      class="px-6 py-4 whitespace-no-wrap border-b border-gray-500"
                    >
                      <div class="text-sm leading-5 text-blue-900">
                        {{ reserved_room.room_id }}
                      </div>
                    </td>
                    <td
                      class="px-6 py-4 whitespace-no-wrap border-b border-gray-500"
                    >
                      <div class="text-sm leading-5 text-blue-900">
                        {{ reserved_room.reserved_from }}
                      </div>
                    </td>
                    <td
                      class="px-6 py-4 whitespace-no-wrap border-b border-gray-500"
                    >
                      <div class="text-sm leading-5 text-blue-900">
                        {{ reserved_room.reserved_till }}
                      </div>
                    </td>
                    <td
                      class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5"
                    >
                      <a @click="deleteRoomReservation(index)">
                        <button
                          class="px-5 py-2 border-red-500 border text-red-500 rounded transition duration-300 hover:bg-red-700 hover:text-white focus:outline-none"
                        >
                          Delete
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
  props: ["reserved_rooms", "successMessage"],

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
  methods: {
    deleteRoomReservation(index) {
      if (confirm("Are you sure that you want to delete this reservation?")) {
        this.$inertia
          .delete("/dashboard/reserved-rooms/" + this.reserved_rooms[index].id)
          .then(() => {
            //   code
          });
      }
    },
  },
};
</script>
