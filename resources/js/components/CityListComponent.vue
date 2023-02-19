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
                <div class="list-group" v-for="(city) in cities" :key="city.id" v-if="!isLoading"
                     :id="'city-' + city.id">
                    <div class="list-group-item m-2" v-if="!editableCity || city.id !== editableCity.id"
                         :class="createdCity.id === city.id ? 'border-success' : ''">
                        <span class="cursor-pointer" @click="editCity(city)">{{ city.name }}</span>
                    </div>
                    <div class="list-group-item m-2" v-else>
                        <div class="d-flex justify-content-between align-items-center">
                            <input type="text" v-model="editableCity.name" class="form-control"
                                   :class="error ? 'is-invalid' : ''">
                            <div class="d-flex mx-2">
                                <button class="btn btn-danger btn-sm me-2" @click="deleteCity()">
                                    {{ $t('buttons.delete') }}
                                </button>
                                <button class="btn btn-primary btn-sm me-2" @click="saveCity()">
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
            error: false,
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
        },
        editCity(city) {
            if (null !== this.editableCity) {
                this.cancelEdit();
            }
            this.editableCity = {...city};
        },
        cancelEdit() {
            this.editableCity = null
            this.error = false
        },
        saveCity() {
            let defaultCity = this.getCityBy(editingCity)

            if (defaultCity.name === this.editableCity.name) {
                this.cancelEdit()
                return
            }

            if (0 === this.editableCity.name.length) {
                this.error = true;
                return
            }
            axios.put('/cities/' + this.editableCity.id, {name: this.editableCity.name}).then(() => {
                this.reset()
            }).catch((error) => {
                if (error.response) {
                    this.error = true
                }
            });
        },
        deleteCity() {
            axios.delete('/cities/' + this.editableCity.id).then(() => {
                this.reset()
            });
        },
        scrollToCity() {
            const createdCityElement = document.getElementById("city-" + this.createdCity.id);

            if (createdCityElement) {
                createdCityElement.scrollIntoView()
            }
        },
        getCityBy(requiredCity) {
            return this.cities.find((city) => city.id === requiredCity.id)
        },
        reset() {
            this.getCities()
            this.cancelEdit()
        },
    },
    watch: {
        selectedCounty() {
            this.reset()
        },
        async createdCity() {
            await this.getCities()
            this.cancelEdit()
            this.scrollToCity()
        },
    },
    created() {
        this.getCities()
    },
};
</script>
