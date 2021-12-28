<template>
    <div>
        <div class="ms_container">
            <div class="search_bar">
                <input list="addresses" name="search" v-model="search" @keyup="fetchResults(search)" @keyup.enter.prevent="$emit('advancedSearch', search)" placeholder="Dove vuoi andare?">
                <router-link :to="{ name: 'search', params: { slug: search } }">
                    <button class="ms_btn">Cerca <i class="far fa-paper-plane"></i></button>
                </router-link>
                <datalist id="addresses">
                    <option v-for="(element, index) in searchResults[0]" :key="index" :value="element.address.freeformAddress"></option>
                </datalist>
            </div>
        </div>  
        <div class="ms_container-fluid" > 
            <Hero :sponsored="sponsored" />
            <div class="ms_container container-cards">
                <div class="ms_row ms_align-items-center">
                    <Card v-for="(apartment, index) in apartments" :key="index" :apartment="apartment"/>
                </div>
            </div>
            <ul>
                <!-- creo i numeri delle pagine in base alla ricerca effettuata -->
                <li v-for="index in lastPage" :key="index" @click="getPage(index), changePage()">{{index}}</li>
            </ul>
        </div>
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
            apartments: [],//salvo gli appartamenti
            searchResults: [],//risultati che ritornano dalla chiamata api di tomtom
            search: "",//stringa in cui salvo i valori contenuti nella input della località
            //query: {},non usata
            page: 1,//la pagina, come standard 1 prima che l'utente la modifichi
            lastPage: null,//viene assegnata alla richiesta axios degli appartamenti
            sponsored: []//appartamenti sponsorizzati? a cosa serve? dovrebbe essere una feature implementata nella card
        }
    },

    methods: {

        //ogni volta che scrivo un carattere nella barra di ricerca chiamo l'api di tomtom per chiedere eventuali risultati
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

        //non utilizzata
        // fetchApartments(search) {
        //     fetch('https://api.tomtom.com/search/2/geocode/'+ search +'.json?key=jXiFCoqvlFBNjmqBX4SuU1ehhUX1JF7t&language=it-IT')
        //     .then(response => response.json())
        //     .then(data=>{
        //         let lat=data.results[0].position.lat;
        //         let lon=data.results[0].position.lon;
        //         axios.get(`http://localhost:8000/api/apartments/search/&lat=${lat}&lon=${lon}&dist=25`)
        //         .then(response => {
        //             this.apartments = [];
        //             this.apartments = response.data.data;
        //             this.lastPage = response.data.lastPage;
        //         })
        //         .catch(error => {
        //             console.log(error)
        //         })
        //     });
        // },

        getPage(index) {
            this.page = index;
        },

        //al cambio pagina richiamo l'api impaginata
        changePage() {
                axios.get(`http://localhost:8000/api/apartments/?page=${this.page}`)
            .then(response => {
                this.apartments = response.data.data.data;
            })
            .catch(error => {
                console.log(error)
            })
        }
    },
        
    //apppena monta la pagina chiamo i dati degli appartamenti e salvo 3 appartamenti sponsorizzati?
    mounted () {
        window.scrollTo(0, 0);
   
        axios.get(`http://localhost:8000/api/apartments/?page=${this.page}`)
        .then(response => {
            console.log(response);
            this.lastPage = response.data.data.last_page;
            this.apartments = response.data.data.data;
//?????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????
            // for (let index = 6; index < 9; index++) {
            //     this.sponsored.push(this.apartments[index])
            // }
        })
        .catch(error => {
            console.log(error)
        });
        
    }
}
</script>

<style lang="scss" scoped>
.search_bar{
    display: flex;
    margin: 3rem 0 2rem 0;
    justify-content: center;
    input{
        width: 100%;
        max-width: 25rem;
        border: none;
        border-radius:20px;
        padding: 10px 20px;
        margin-right:10px;
        font-family: 'Raleway', sans-serif;
        font-size: 17px;
        text-align: center;
        background-color: #ede7e3;
        &:focus{
            outline:none;
        }
    }
    .ms_btn{
        font-family: 'Raleway', sans-serif;
        font-size: 17px;
        background-color: #ede7e3;
        .far{
            margin-left:5px;
        }
    }

    .container-cards {
    padding: 25px 0px 0px 0px;
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