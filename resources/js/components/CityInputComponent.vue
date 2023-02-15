<template>
    <div class="border rounded p-2">
        <div class="mb-3 d-flex align-items-center p-2">
            <label for="city-input" class="fw-bold text-uppercase px-2">
                {{ $t('labels.new_city') }} <span class="text-danger">*</span>
            </label>
            <input id="city-input"
                   class="form-control"
                   :class="error ? 'is-invalid' : ''"
                   v-model="name"
                   required
                   @input="error = false"
            >
        </div>
        <div class="row">
            <div class="col">
                <button class="btn btn-primary float-end" @click="addNewCity" :disabled="null === name">
                    {{ $t('buttons.new_city') }}
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "CityInputComponent",
    props: {
        selectedCounty: {
            type: Object,
            default: null,
        },
        onCityCreated: {
            type: Function,
            required: true,
        }
    },
    data() {
        return {
            name: null,
            error: false,
        };
    },
    methods: {
        addNewCity() {
            window.axios.post('/api/counties/' + this.selectedCounty.id + '/city', {
                name: this.name
            }).then(response => {
                if (response.data.success) {
                    const newCity = response.data.data
                    this.onCityCreated(newCity)
                    this.name = null
                }
            }).catch(error => {
                if (error.response) {
                    this.error = true
                }
            })
        },
    },
};
</script>
