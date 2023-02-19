<template>
    <div class="row">
        <div class="col-lg-4 offset-1">
            <county-selector-component :counties="counties"
                                       @county-selected="onCountySelected">
            </county-selector-component>
            <add-city-component :selectedCounty="selectedCounty"
                                  @city-created="onCityCreated"
                                  v-if="selectedCounty"
            >
            </add-city-component>
        </div>
        <div class="col-lg-6 overflow-auto offset-1 offset-md-0">
            <city-list-component v-if="selectedCounty"
                                 :selected-county="selectedCounty"
                                 :createdCity="createdCity"
            >
            </city-list-component>
        </div>
    </div>
</template>

<script>
import CountySelectorComponent from "./CountySelectorComponent.vue";
import AddCityComponent from "./AddCityComponent.vue";
import CityListComponent from "./CityListComponent.vue";

export default {
    data() {
        return {
            counties: [],
            selectedCounty: null,
            createdCity: {},
        }
    },
    components: {
        CountySelectorComponent,
        AddCityComponent,
        CityListComponent,
    },
    mounted() {
        this.getCounties()
    },
    methods: {
        onCountySelected(county) {
            this.selectedCounty = county;
        },
        getCounties() {
            window.axios.get('/counties').then(response => {
                if (response.data.success) {
                    this.counties = response.data.data
                }
            })
        },
        onCityCreated(city) {
            this.createdCity = city;
        }
    },
}
</script>
