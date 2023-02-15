<template>
    <div>
        <div class="pb-2">
            <county-selector-component :counties="counties" @county-selected="onCountySelected"></county-selector-component>
        </div>
        <city-input-component v-if="selectedCounty"
                              :selectedCounty="selectedCounty"
                              @city-created="onCityCreated"
        >
        </city-input-component>
    </div>
</template>

<script>
import CountySelectorComponent from "./CountySelectorComponent.vue";
import CityInputComponent from "./CityInputComponent.vue";

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
        CityInputComponent,
    },
    mounted() {
        this.getCounties()
    },
    methods: {
        onCountySelected(county) {
            this.selectedCounty = county;
        },
        getCounties() {
            window.axios.get('/api/counties').then(response => {
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
