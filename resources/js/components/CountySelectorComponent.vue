<template>
    <div class="row">
        <div class="col-4 d-flex align-items-center border rounded p-2">
            <label for="county-select" class="fw-bold text-uppercase px-2">{{ $t('labels.county') }}</label>
            <select id="county-select"
                    class="form-select"
                    v-model="selectedCounty"
                    @change="emitCountySelected"
            >
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
            selectedCounty: null,
        };
    },
    props: {
        counties: {
            type: Array,
            required: true,
        },
        onCountySelected: {
            type: Function,
            required: true,
        }
    },
    methods: {
        emitCountySelected() {
            this.onCountySelected(this.getSelectedCountyBy());
        },
        getSelectedCountyBy() {
            return this.counties.find(county => county.id === this.selectedCounty);
        },
    },
};
</script>
