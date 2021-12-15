<template>
    <div>
        <div class="searchbar">
            <label for="rooms">Stanze</label>
            <input type="number" min="1" max="255" placeholder="1" v-model.number="rooms" id="rooms">

            <label for="guests">Posti Letto</label>
            <input type="number" min="1" max="255" placeholder="1" v-model.number="guests" id="guests">

            <label for="distance">Distanza</label>
            <input type="number" min="0" placeholder="20" v-model.number="distance" id="distance">

            <div class="services_container" v-for="(service, index) in services" :key="index">
                <button class="ms_btn_services" @click="addService(service.id)" :class="serviceFilter.includes(service.id) ? 'active' : ''">{{service.name}}</button>
            </div>
            <button @click="advancedSearch()">Filtra</button>
        </div>
        <div class="ms_container">
            <Card :apartments="apartments"/>
        </div>
    </div>
</template>

<script>
import Card from '../components/Card.vue';

export default {
    name: 'AdvancedSearch',

    components: {
        Card
    },


    data() {
        return {
            apartments : [],
            lastPage : null,
            rooms: null,
            guests: null,
            distance: null,
            services: [],
            geo: {
                lat: null,
                lon: null
            },
            serviceFilter : []
        }
    },

    methods: {
        advancedSearch() {
            console.log(this.serviceFilter);
            let servicesId = this.serviceFilter.join('-');
            console.log(servicesId);
            axios.get(`http://localhost:8000/api/apartments/search/&lat=${this.geo.lat}&lon=${this.geo.lon}${this.distance ? '&dist=' + this.distance : ''}${this.rooms ? '&rooms=' + this.rooms : ''}${this.guests ? '&guests=' + this.guests : ''}${servicesId != "" ? '&services=' + servicesId : ''}`)
                .then(response => {
                    this.apartments = [];
                    this.apartments = response.data.data;
                    console.log(this.apartments);
                    this.lastPage = response.data.lastPage;
                    console.log(this.lastPage);
                })
                .catch(error => {
                    console.log(error)
                })
        },

        addService(id) {
            if(this.serviceFilter.includes(id)) {
                let index = this.serviceFilter.indexOf(id);
                this.serviceFilter.splice(index, 1)
            } else {
                this.serviceFilter.push(id)
            }
            console.log(this.serviceFilter)
        },

        serviceToString(array) {
            array.join('-')
        }
    },

    mounted() {
            fetch('https://api.tomtom.com/search/2/geocode/'+ this.$route.params.slug +'.json?key=jXiFCoqvlFBNjmqBX4SuU1ehhUX1JF7t&language=it-IT')
            .then(response => response.json())
            .then(data=>{
                this.geo.lat=data.results[0].position.lat;
                this.geo.lon=data.results[0].position.lon;
                axios.get(`http://localhost:8000/api/apartments/search/&lat=${this.geo.lat}&lon=${this.geo.lon}&dist=25`)
                .then(response => {
                    this.apartments = [];
                    this.apartments = response.data.data;
                    console.log(this.apartments);
                    this.lastPage = response.data.lastPage;
                    console.log(this.lastPage);
                })
                .catch(error => {
                    console.log(error)
                })
            });

            axios.get(`/api/services`)
                .then(response =>{
                console.log(response.data);
                this.services = response.data.data;
            })

            console.log($user.id)

        }
}
</script>

<style lang="scss" scoped>

.searchbar {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 70px;

    input {
        width: 70px;
        padding: 0.5rem;
        border: none;
        border-radius: 0.5rem;
    }
}

.services_container {

    .ms_btn_services {
        min-width: 70px;
        padding: 0.5rem;
        margin: 0.5rem 1rem;
        background-color: cadetblue;
        color: cornsilk;
        border: none;
        border-radius: 0.5rem;
        
        &.active {
            background-color: darkgoldenrod;
            font-weight: bold;
        }
    }
}

</style>