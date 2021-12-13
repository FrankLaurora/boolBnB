<template>
    <div class="ms_+container">
        <h2>{{apartment.title}}</h2>
        <div><strong> {{apartment.city}}</strong> {{apartment.address}} {{apartment.number}}</div> 
        <div  class="coverimg">
            <div class="big_img">
                <img :src="`./storage/${apartment.cover}`" alt="">
            </div>
        </div>
        <div class="services" >
            <h3> lista dei servizi disponibili:</h3>
            <ul>
                <li v-for="(element,index) in services" :key="index">{{element}}</li>
            </ul>
        </div>
        <div class="description">
            {{apartment.description}}
        </div>
        <div class="message">
            <h3>Scrivi a questo host</h3>
            <form action="">
                <input type="text" placeholder="scrivi il tuo nome">
                <input type="text" placeholder="inserisci la tua mail">
                <textarea name="" id="" cols="30" rows="10" placeholder="Scrivi il messaggio"></textarea>
                <button type="submit" class="">Invia messaggio</button>
            </form>
        </div>
    </div>    
</template> 

<script>
export default {
    name: 'Apartment',
    data() {
		return {
			apartment: [],
            services: []
		}
    },

    mounted(){
            axios.get(`/api/apartments/${this.$route.params.slug}`)
            .then(response=>{
                this.apartment = response.data.data;
                console.log(this.apartment);
                this.apartment.services.forEach(id => {
                    axios.get(`/api/services/${id}`)
                    .then(response =>{
                    console.log(response.data);
                    this.services.push(response.data.data.name);
                    })
                });
            })
    }
}
</script>

<style lang="scss" scoped>

@import '../../../sass/partials/common';
.container{
    width:80%;
    margin: 0 auto;
    margin-top:50px;
    h2{
        padding: 15px 0;
    }
    .coverimg{
        height: 450px;
        margin: 30px 0 70px 0;
        display:flex;
        .big_img{
            width:65%;
            // background-color: lightseagreen;
            border-radius: 7px;
            overflow: hidden;
            img{
                width:100%;
                height:100%;
                object-fit: contain;    
            }
        }
        
    }
    .description{
            margin: 60px 0;
            width:70%;   
        }
    .message{
        width:600px;
        margin:40px 0;
        input{
            width:100%;
            margin: 25px 0;
            display:block;
            padding: 15px;
            border-radius: 15px;
            border:none;
            background-color: rgb(243, 236, 236);
        }
        textarea{
            width:100%;
            padding: 15px;
            border-radius: 15px;
            border:none;
            background-color: rgb(243, 236, 236);
            resize: none;
        }
    }
    button{
        margin: 10px 0;
        padding:12px 20px;
        border-radius: 20px;
        border: none;
        background-color: rgb(243, 236, 236);
    }
}
</style>