<template>
    <div class="row">
        <div class="col-4 d-flex align-items-center border rounded p-2">
            <label for="county-select" class="fw-bold text-uppercase px-2">{{ $t('labels.county') }}</label>
            <select id="county-select" class="form-select" v-model="selectedCounty">
                <option v-for="county in counties" :value="county.id">{{ county.name }}</option>
            </select>
        </div>
    </div>
</template>

<script>

export default {
    name: "CountySelectorComponent",
    data() {
        return {
            counties: [],
            selectedCounty: null,
        };
    },
    mounted() {
        this.getCounties()
    },
    methods: {
        getCounties() {
            window.axios.get('/api/counties').then(response => {
                if (response.data.success) {
                    this.counties = response.data.data
                }
            })
        },
    },
};
</script>
