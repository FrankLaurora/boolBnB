<template>
    <div class="ms_container">

        <h2>Questa è l'homepage</h2>

        <div class="search_bar">
            <input type="text" v-model="search" @keyup="fetchResults(search)" @keyup.enter.prevent="fetchApartments(query)" placeholder="Cerca una città">
            <button @click="fetchApartments(query)">Cerca</button>
        </div>
        <div>
            <select name="search" id="search" v-model="query">
                <option v-for="(element, index) in searchResults[0]" :key="index" :value="element.position">{{element.address.freeformAddress}}</option>
            </select>
        </div>

        <Card :apartments="apartments"/>
        <!-- <h2>Tutti gli appartamenti</h2>
        <ul>
            <li v-for="(apartment, index) in apartments" :key="index"><strong>{{apartment.title}}</strong> | {{apartment.address}}</li>
        </ul> -->
        <ul>
            <li v-for="index in lastPage" :key="index" @click="getPage(index), changePage()">{{index}}</li>
        </ul>
    </div>
</template>

<script>

import Card from '../components/Card.vue';

export default {
    name: 'Home',

    components: {
        Card
    },

    data() {
        return {
            apartments: [],
            searchResults: [],
            search: "",
            query: {},
            page: 1,
            lastPage: null
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
    
        fetchApartments(query) {
            axios.get(`http://localhost:8000/api/apartments/search/&lat=${query.lat}&lon=${query.lon}&dist=25`)
            .then(response => {
                this.apartments = [];
                this.apartments = response.data.data;
                this.lastPage = response.data.lastPage;
            })
            .catch(error => {
                console.log(error)
            })
        },

        getPage(index) {
            this.page = index;
            console.log(this.page)
        },

        changePage() {
                axios.get(`http://localhost:8000/api/apartments/?page=${this.page}`)
            .then(response => {
                console.log(response);
                this.apartments = response.data.data;
            })
            .catch(error => {
                console.log(error)
            })
        }
    },
        

    mounted () {
        axios.get(`http://localhost:8000/api/apartments/?page=${this.page}`)
        .then(response => {
            console.log(response);
            this.lastPage = response.data.lastPage;
            this.apartments = response.data.data;
        })
        .catch(error => {
            console.log(error)
        })
    }
}
</script>

<style>

</style>