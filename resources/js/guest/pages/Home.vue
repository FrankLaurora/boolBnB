<template>
    <div class="ms_container">
        <div class="search_bar">
            <!-- <input list="addresses" name="search" v-model="search" @keyup="fetchResults(search)" @keyup.enter.prevent="fetchApartments(search)" placeholder="Cerca una città"> -->
            <input list="addresses" name="search" v-model="search" @keyup="fetchResults(search)" @keyup.enter.prevent="$emit('advancedSearch', search)" placeholder="Cerca una città">
            <!-- <button @click="fetchApartments(search)">Cerca</button> -->
            <router-link :to="{ name: 'search', params: { slug: search } }">
                <button>Cerca</button>
            </router-link>
            <datalist id="addresses">
                <option v-for="(element, index) in searchResults[0]" :key="index" :value="element.address.freeformAddress"></option>
            </datalist>
        </div>
        
        <Hero :sponsored="sponsored" />
        <Card :apartments="apartments"/>

        <ul>
            <li v-for="index in lastPage" :key="index" @click="getPage(index), changePage()">{{index}}</li>
        </ul>
    </div>
</template>

<script>

import Card from '../components/Card.vue';
import Hero from '../components/Hero.vue';

export default {
    name: 'Home',

    components: {
        Card,
        Hero
    },

    data() {
        return {
            apartments: [],
            searchResults: [],
            search: "",
            query: {},
            page: 1,
            lastPage: null,
            sponsored: []
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
    
        fetchApartments(search) {
            fetch('https://api.tomtom.com/search/2/geocode/'+ search +'.json?key=jXiFCoqvlFBNjmqBX4SuU1ehhUX1JF7t&language=it-IT')
            .then(response => response.json())
            .then(data=>{
                let lat=data.results[0].position.lat;
                let lon=data.results[0].position.lon;
                axios.get(`http://localhost:8000/api/apartments/search/&lat=${lat}&lon=${lon}&dist=25`)
                .then(response => {
                    this.apartments = [];
                    this.apartments = response.data.data;
                    this.lastPage = response.data.lastPage;
                })
                .catch(error => {
                    console.log(error)
                })
            });
        },

        getPage(index) {
            this.page = index;
        },

        changePage() {
                axios.get(`http://localhost:8000/api/apartments/?page=${this.page}`)
            .then(response => {
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
            this.lastPage = response.data.lastPage;
            this.apartments = response.data.data;
            for (let index = 6; index < 9; index++) {
                this.sponsored.push(this.apartments[index])
            }
        })
        .catch(error => {
            console.log(error)
        })
    }
}
</script>

<style lang="scss" scoped>
    .search_bar{
        display: flex;
        margin: 1.25rem 0;
        input{
            width: 100%;
            max-width: 25rem;
        }
        button{
            background-color: #343a40;
            border-radius: 10px;
            color: white;
            text-align: center;
            text-decoration: none;
            font-size: 12px;
            width: 70px;
            height: 30px;
        }
    }

    ul {
        display: flex;
        list-style: none;
        width: 25%;
        margin: 1.5rem auto;
        justify-content: center;

        li {
            font-size: 1rem;
            padding: 0.8rem;
            &:hover {
                cursor: pointer;
                transform: scale(1.2);
            }
        }
    }
</style>