<template>
    <div>
        <div class="searchbar">
            <div class="input_bar">
                <input list="addresses" id="addressInput" style="width:500px" name="search" v-model="search" @keyup="fetchResults(search)" @keyup.enter.prevent="$emit('advancedSearch', search)" placeholder="Dove vuoi andare?">
                <datalist style="width:500px" id="addresses">
                    <option style="width:500px" v-for="(element, index) in searchResults[0]" :key="index" :value="element.address.freeformAddress"></option>
                </datalist>
                <label for="rooms">Stanze</label>
                <input type="number" min="1" max="255" placeholder="2" v-model.number="rooms" id="rooms">

                <label for="guests">Ospiti</label>
                <input type="number" min="1" max="255" placeholder="2" v-model.number="guests" id="guests">

                <label for="distance">Distanza</label>
                <input type="number" min="0" placeholder="20 km" v-model.number="distance" id="distance">
            </div>
            
            <div class="service_row">
                <div class="services_container" v-for="(service, index) in services" :key="index">
                    <button class="ms_btn_services" @click="addService(service.id)" :class="serviceFilter.includes(service.id) ? 'active' : ''">{{service.name}}</button>
                </div>
                <router-link :to="{ name: 'search', params: { slug:search} }">
                    <button @click="advancedSearch()" class="ms_btn_advance">Mostra appartamenti </button>
                </router-link>
            </div>
            
        </div>
        <div class="container-cards ms_container">
            <h1 v-if="apartments < 1">Non ci sono appartamenti che corrispondono alle tue richieste</h1>
            <div v-else class="ms_row ms_align-items-center">
                <Card v-for="(apartment, index) in apartments" :key="index" :apartment="apartment"/>
            </div>
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
            searchResults: [],
            rooms: null,
            guests: null,
            distance: null,
            lat: null,
            lon: null,
            search: "",
            lastSearch: "",
            services: [],
            geo: {
                lat: null,
                lon: null
            },
            serviceFilter : []
        }
    },

    methods: {
        fetchResults(search) {
            if(search != '') {
                fetch('https://api.tomtom.com/search/2/geocode/'+ search +'.json?key=jXiFCoqvlFBNjmqBX4SuU1ehhUX1JF7t&language=it-IT')
                .then(response => response.json())
                .then(data =>{
                    this.searchResults = [];
                    this.searchResults.push(data.results);
                })
            }
        },

        advancedSearch() {
            if(this.search!=this.lastSearch&&this.search!=""){
                setTimeout(() => {
                    this.lastSearch=this.search;
                    fetch('https://api.tomtom.com/search/2/geocode/'+ this.$route.params.slug +'.json?key=jXiFCoqvlFBNjmqBX4SuU1ehhUX1JF7t&language=it-IT')
                    .then(response => response.json())
                    .then(data=>{
                        this.geo.lat=data.results[0].position.lat;
                        this.geo.lon=data.results[0].position.lon;
                        axios.get(`http://localhost:8000/api/apartments/search/&lat=${this.geo.lat}&lon=${this.geo.lon}&dist=25`)
                        .then(response => {
                            this.apartments = [];
                            this.apartments = response.data.data.data;
                            this.lastPage = response.data.lastPage;
                        })
                        .catch(error => {
                            console.log(error)
                        })
                    });
                }, 100);
            }
            let servicesId = this.serviceFilter.join('-');
            axios.get(`http://localhost:8000/api/apartments/search/&lat=${this.geo.lat}&lon=${this.geo.lon}${this.distance ? '&dist=' + this.distance : ''}${this.rooms ? '&rooms=' + this.rooms : ''}${this.guests ? '&guests=' + this.guests : ''}${servicesId != "" ? '&services=' + servicesId : ''}`)
                .then(response => {
                    this.apartments = [];
                    this.apartments = response.data.data.data;
                    this.lastPage = response.data.lastPage;
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
                    this.apartments = response.data.data.data;
                    this.lastPage = response.data.lastPage;
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
        }
}
</script>

<style lang="scss" scoped>

.searchbar {
    // display: flex;
    justify-content: center;
    align-items: center;
    height: 130px;
    font-size: 15px;
    font-weight: 500;
    border-bottom: 1px solid #0a333b9a;
    width: 90%;
    margin:0 auto;
    .input_bar{
        display:flex;
        width:100%;
        justify-content: center;
        flex-wrap: nowrap;
        margin-bottom: 0.9rem;
        line-height:50px;
        font-size:17px;
    }

    input {
        width: 125px;
        padding: 0.5rem ;
        text-align: center;
        border: none;
        border-radius: 1rem;
        font-family: 'Raleway', sans-serif;
        margin: 0.5rem 0.8rem 0.5rem 0.3rem;
        font-size: 16px;
        background-color: #ede7e3;
        &:focus{
                outline:none;
            }
    }
}
.service_row{
    display: flex;
    width:80%;
    margin:0 auto;
    justify-content: center;
    align-items: center;
}
.services_container {
    width:100%;
    .ms_btn_services {
        min-width: 120px;
        padding: 0.6rem 0.3rem;
        margin: 0.5rem 0.2rem;
        background-color: #82c0cc;
        color: white;
        border: none;
        border-radius: 1rem;
        font-family: 'Raleway', sans-serif;
        &:hover{
            cursor:pointer;
            background-color: #489fb5;
            color:white;
            
        }
        &.active {
            background-color: #ffa628;
            font-weight: bold;
            color:white;
            box-shadow: 1px 1px 2px rgba(150, 147, 147, 0.603);
        }
    }
}

.container-cards {
        margin-top:30px;
        padding: 25px 0px 0px 0px;
    }

.ms_btn_advance{
        min-width: 190px;
        padding: 0.6rem 1.2rem;
        border-radius: 1rem;
        background-color: rgb(26, 21, 21);
        color: white;
        font-family: 'Raleway', sans-serif;
        border: none;
        margin-left:1.5rem;
        justify-content: center;
        align-items: center;
        font-size: 15px;
        &:hover{
            cursor:pointer;
            background-color: white;
            color:black;
            box-shadow: 1px 1px 2px rgba(150, 147, 147, 0.603);
            transform:scale(1.02);
        }
    }

</style>