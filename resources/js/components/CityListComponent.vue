<template>
    <div class="border rounded">
        <div class="row p-3">
            <div class="col-12">
                <div class="row">
                    <div class="col-4">
                        <label class="fw-bold text-uppercase px-2">{{ $t('labels.county')}}</label>
                    </div>
                    <div class="col-lg-8 col-12">
                        <h5 id="county-name">{{ selectedCounty.name }}</h5>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <label class="fw-bold text-uppercase px-2">{{ $t('labels.cities')}}</label>
                    </div>
                </div>
                <ul class="list-group" v-for="city in cities">
                    <li class="list-group-item m-2">{{ city.name }}</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            cities: []
        }
    },
    props: {
        selectedCounty: {
            type: Object,
            required: true,
        }
    },
    methods: {
        getCities() {
            axios.get('/api/counties/' + this.selectedCounty.id + '/cities').then(response => {
                this.cities = response.data.data;
            });
        }
    },
    watch: {
        selectedCounty() {
            this.getCities()
        }
    }
};
</script>
