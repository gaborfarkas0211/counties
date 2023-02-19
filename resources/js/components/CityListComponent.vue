<template>
    <div class="border rounded">
        <div class="row p-3">
            <div class="col-12">
                <div class="row">
                    <div class="col-4">
                        <label class="fw-bold text-uppercase px-2">{{ $t('labels.county') }}</label>
                    </div>
                    <div class="col-lg-8 col-12">
                        <h5 id="county-name">{{ selectedCounty.name }}</h5>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <label class="fw-bold text-uppercase px-2">{{ $t('labels.cities') }}</label>
                    </div>
                </div>
                <div class="list-group" v-for="(city, index) in cities" :key="city.id" v-if="!isLoading"
                     :id="'city-' + city.id">
                    <div class="list-group-item m-2" v-if="!editableCity || city.id !== editableCity.id"
                         :class="createdCity.id === city.id ? 'border-success' : ''">
                        <span class="cursor-pointer" @click="editCity(city)">{{ city.name }}</span>
                    </div>
                    <div class="list-group-item m-2" v-else>
                        <div class="d-flex justify-content-between align-items-center">
                            <input type="text" v-model="cities[index].name" class="form-control">
                            <div class="d-flex mx-2">
                                <button class="btn btn-danger btn-sm me-2" @click="deleteCity(city.id)">
                                    {{ $t('buttons.delete') }}
                                </button>
                                <button class="btn btn-primary btn-sm me-2" @click="saveCity(city)">
                                    {{ $t('buttons.save') }}
                                </button>
                                <button class="btn btn-outline-secondary btn-sm me-2" @click="cancelEdit()">
                                    {{ $t('buttons.cancel') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center" v-if="isLoading">
                    <div class="spinner-border" role="status"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            cities: [],
            editableCity: null,
            isLoading: false,
        };
    },
    props: {
        selectedCounty: {
            type: Object,
            required: true,
        },
        createdCity: {
            type: Object,
            required: false,
        },
    },
    methods: {
        async getCities() {
            this.isLoading = true
            const response = await axios.get('/counties/' + this.selectedCounty.id + '/cities')
            this.cities = response.data.data;

            this.isLoading = false
            this.cancelEdit()
        },
        editCity(city) {
            if (null !== this.editableCity) {
                this.cancelEdit();
            }
            this.editableCity = city;
        },
        cancelEdit() {
            this.editableCity = null;
        },
        saveCity(city) {
            axios.put('/cities/' + city.id, {name: city.name}).then(() => {
                this.cancelEdit()
            });
        },
        deleteCity(cityId) {
            axios.delete('/cities/' + cityId).then(() => {
                this.getCities()
                this.cancelEdit()
            });
        },
        scrollToCity() {
            const createdCityElement = document.getElementById("city-" + this.createdCity.id);

            if (createdCityElement) {
                createdCityElement.scrollIntoView()
            }
        },
    },
    watch: {
        selectedCounty() {
            this.getCities();
        },
        async createdCity() {
            await this.getCities()
            this.scrollToCity()
        },
    },
    created() {
        this.getCities()
    },
};
</script>
