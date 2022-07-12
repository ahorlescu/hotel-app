<template>
  <div class="full-page">
    <header-menu :canLogin="canLogin" />
    <div class="title-public">
      <h2>Camere</h2>
    </div>
    <div class="container mx-auto rooms-container">
      <div class="rooms-sidebar">
        <h1 class="text-2xl font-bold text-gray-800 uppercase">Filtre</h1>
        <div class="mt-6 tracking-wider px-1 uppercase text-xs">
          <p>
            <label for="available_from" class="bg-white text-gray-600 px-1"
              >Selecteaza tipul camerei:</label
            >
          </p>
          <select
            v-model="form.room_type_id"
            class="rounded-md"
            style="width: 210px"
          >
            <option
              v-for="(option, index) in room_types"
              :key="index"
              v-bind:value="option.id"
            >
              {{ option.name }}
            </option>
          </select>
        </div>

        <div class="mt-6 tracking-wider px-1 uppercase text-xs">
          <p>
            <label for="room-type" class="bg-white text-gray-600 px-1"
              >Alege servicii</label
            >
          </p>
          <multiselect
            style="width: 210px"
            v-model="form.services"
            class="rounded-md"
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

        <div class="mt-6 tracking-wider px-1 uppercase text-xs">
          <p>
            <label for="available_from" class="bg-white text-gray-600 px-1"
              >Disponibil de pe:</label
            >
          </p>
          <date-picker
            v-model="form.available_from"
            valueType="format"
          ></date-picker>
        </div>

        <div class="mt-6 tracking-wider px-1 uppercase text-xs">
          <p>
            <label for="available_from" class="bg-white text-gray-600 px-1"
              >Disponibil pana pe:</label
            >
          </p>
          <date-picker
            v-model="form.available_till"
            valueType="format"
          ></date-picker>
        </div>

        <div class="mt-8 cursor-pointer">
          <a
            @click="filterRooms"
            class="bg-gray-900 text-gray-100 px-3 py-2 font-semibold rounded"
            >Filtreaza</a
          >
        </div>
      </div>

      <div class="rooms-content">
        <div v-if="!loading">
          <div v-for="(room, index) in rooms" :key="index">
            <div
              class="bg-white my-8 lg:mx-8 lg:flex room-card lg:shadow-lg lg:rounded-lg"
            >
              <div class="lg:w-1/3">
                <div
                  class="h-64 bg-cover lg:rounded-lg lg:h-full"
                  style="
                    background-position: top;
                    background-image: url('../storage/10.jpg');
                  "
                ></div>
              </div>
              <div class="py-6 px-6 max-w-xl lg:max-w-5xl lg:w-2/3">
                <h2 class="text-3xl text-gray-800 font-bold">
                  <span class="text-yellow-600" v-if="room.room_types_name">{{
                    room.room_types_name
                  }}</span>
                  <span class="text-yellow-600" v-else>Camera</span>
                  <span class="text-xs right-0 flex text-gray-600"
                    >Disponibilitate: {{ room.available_from }} -
                    {{ room.available_till }}</span
                  >
                </h2>
                <p class="mt-3 text-gray-600">
                  {{ room.description }}
                </p>
                <p class="mt-3"><b>Servicii:</b></p>
                <p
                  v-for="(service, index) in room.services"
                  :key="index"
                  class="mt-1 text-gray-600"
                >
                  <i :class="service.icon"></i>
                  {{ service.name }}
                </p>
                <div class="flex">
                  <div class="mt-6 tracking-wider px-1 uppercase text-xs">
                    <p>
                      <label
                        for="available_from"
                        class="bg-white text-gray-600 px-1"
                        >Alege data</label
                      >
                    </p>
                    <HotelDatePicker
                      :startDate="room.available_from"
                      :endDate="room.available_till"
                      :disabledDates="disabledDates(index)"
                      :halfDay="false"
                      @starting-date-changed="getStartDate"
                      @ending-date-changed="getEndDate"
                    ></HotelDatePicker>
                  </div>
                </div>
                <div class="mt-8">
                  <a
                    @click="reserveRoom(index)"
                    class="bg-gray-900 text-gray-100 px-5 py-3 font-semibold rounded cursor-pointer"
                    >Rezerva</a
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="loading-spinner" v-else>
          <div
            class="loader ease-linear rounded-full border-8 border-t-8 border-gray-200 h-64 w-64"
          ></div>
        </div>
      </div>
      <notifications group="not" position="bottom right" />
    </div>
    <footer-component />
  </div>
</template>

<script>
import HeaderMenu from "@/Jetstream/HeaderMenu";
import FooterComponent from "@/Jetstream/FooterComponent";
import Multiselect from "vue-multiselect";
import DatePicker from "vue2-datepicker";
import "vue2-datepicker/index.css";
import HotelDatePicker from "vue-hotel-datepicker";
import "vue-hotel-datepicker/dist/vueHotelDatepicker.css";
import moment from "moment";

export default {
  components: {
    HeaderMenu,
    FooterComponent,
    Multiselect,
    DatePicker,
    HotelDatePicker,
  },

  props: {
    services_options: Array,
    rooms: Array,
    form: Object,
    room_types: Array,
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    successMessage: String,
    errors: Object,
  },
  data() {
    return {
      loading: false,
      reserved: {
        start: "",
        end: "",
      },
    };
  },
  watch: {
    reserved(value) {
      console.log(value);
    },
  },

  created: function () {
    this.moment = moment;
  },

  methods: {
    getStartDate(value) {
      this.reserved.start = moment(value).format("YYYY-MM-DD");
    },

    getEndDate(value) {
      this.reserved.end = moment(value).format("YYYY-MM-DD");
    },

    reserveRoom(index) {
      let reservedRoom = {
        reserved_from: this.reserved.start,
        reserved_till: this.reserved.end,
        room_id: this.rooms[index].id,
      };

      let hasError = false;
      // Validation
      this.disabledDates(index).forEach((date) => {
        if (
          date >= reservedRoom.reserved_from &&
          date <= reservedRoom.reserved_till
        ) {
          hasError = true;
        }
      });
      if (hasError) {
        this.$notify({
          group: "not",
          type: "error ",
          title: "Perioada aleasa nu este disponibila",
        });
      } else {
        this.loading = true;
        this.$inertia.post("reserved-rooms", reservedRoom).then(() => {
          if (this.successMessage) {
            this.$notify({
              group: "not",
              type: "success ",
              title: this.successMessage,
            });
          }
          if (this.errors) {
            for (var property in this.errors) {
              if (this.errors.hasOwnProperty(property)) {
                this.$notify({
                  group: "not",
                  type: "error ",
                  title: this.errors[property],
                });
              }
            }
          }

          this.loading = false;
        });
      }
    },

    filterRooms() {
      this.loading = true;

      if (this.form.services) {
        let new_services = [];
        this.form.services.forEach((service) => {
          new_services.push(service.id);
        });
        this.form.services = [];
        new_services.forEach((serv) => {
          this.form.services.push(serv);
        });
      }

      this.$inertia.get("/rooms", this.form).then(() => {
        this.loading = false;
      });
    },

    disabledDates(index) {
      let reservedDays = [];
      if (this.rooms[index] && this.rooms[index].reserved_rooms) {
        this.rooms[index].reserved_rooms.forEach((data) => {
          let values = this.dateRange(data.reserved_from, data.reserved_till);
          values.forEach((value) => {
            reservedDays.push(value);
          });
        });
      }
      return reservedDays;
    },

    dateRange(startDate, endDate) {
      startDate = moment(startDate);
      endDate = moment(endDate);
      var now = startDate.clone(),
        dates = [];

      while (now.isSameOrBefore(endDate)) {
        dates.push(now.format("YYYY-MM-DD"));
        now.add(1, "days");
      }
      return dates;
    },
  },
};
</script>

<style>
.loading-spinner {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 70vh;
}

.multiselect {
  border: 1px solid #6b7280;
}
.loader {
  border-top-color: #3498db;
  -webkit-animation: spinner 1.5s linear infinite;
  animation: spinner 1.5s linear infinite;
}

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
  }
}

@keyframes spinner {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>

<style>
.vhd__datepicker {
  right: 0 !important;
}
.vhd__datepicker__wrapper {
  width: 300px !important;
  height: 4em !important;
}
</style>