<template>
    <div>
        <div class="search_bar">
            <input type="text" v-model="search" @keyup.enter.prevent="fetchApartments(search)" placeholder="Dove vuoi andare?">
            <button @click.prevent="fetchApartments(search)">Cerca</button>
        </div>
        <h2>Tutti gli appartamenti</h2>
        <ul>
            <li v-for="(apartment, index) in apartments" :key="index"><strong>{{apartment.title}}</strong> | {{apartment.address}}</li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'Home',

    data() {
        return {
            apartments: [],
            search: ""
        }
    },

    methods: {
    fetchApartments(search) {
            axios.get('http://localhost:8000/api/apartments')
            .then(response => {
                this.apartments = [];
                response.data.data.forEach(apartment => {
                    if(apartment.city.includes(search)) {
                        this.apartments.push(apartment)
                    }
                });
            })
            .catch(error => {
                console.log(error)
            })
        }   
    },

    mounted () {
        axios.get('http://localhost:8000/api/apartments')
            .then(response => {
                console.log(this.$route.params.slug)
                this.apartments = response.data.data;
                console.log(this.apartments)
            })
            .catch(error => {
                console.log(error)
            })
    }
}

</script>

<style>

</style>