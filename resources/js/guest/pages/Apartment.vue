<template>
    <div class="container">
        <h2>{{apartment.title}}</h2>
        <h4> {{apartment.city}} {{apartment.address}} {{apartment.number}}</h4>
        <div  class="coverimg">
            <div class="big_img">
                <img :src="`./storage/${apartment.cover}`" alt="">
            </div>
            <div class="small_img">
                <img src="" alt="">
                <img src="" alt="">
                <img src="" alt="">
                <img src="" alt="">
            </div>
            
        </div>
        <div class="services" >
            lista dei servizi disponibili: 
        </div>
        <div class="description">
            {{apartment.description}}
            descrizione Lorem ipsum dolor sit, amet consectetur adipisicing elit. Est, similique excepturi nobis neque impedit 
            laboriosam adipisci dolorum quaerat corporis quos deleniti pariatur, temporibus accusamus, culpa velit. Perferendis mollitia amet dolorum!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt aliquam magnam facilis! Esse deserunt architecto illum maxime,
            consectetur provident veniam est magnam repellendus voluptatem molestias sed libero asperiores, impedit animi!
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
			apartment: []
		}
    },
    mounted(){
            // axios.get('/api/apartments')
            // .then(response => {
            //     this.apartment = response.data.data[0];
            // })
            // .catch(error => {
            //     console.log(error)
            // })
            axios.get(`/api/apartments/${this.$route.params.slug}`)
            .then(response=>{
                this.apartment = response.data.data;
                console.log(apartment)
            })
    }
}
</script>

<style lang="scss" scoped>

@import '../../../sass/partials/common';
.container{
    width:80%;
    margin: 0 auto;
    margin-top:40px;
    
    .coverimg{
        height: 450px;
        margin: 30px 0 70px 0;
        display:flex;
        .big_img{
            width:55%;
            background-color: lightseagreen;
            border-radius: 7px;
            margin-right:20px;
            overflow: hidden;
            img{
                max-width:100%;
                height:100%; 
                object-fit: cover;    
            }
        }
        .small_img{
            width:35%;
            background-color: lightslategrey;
            border-radius: 7px;
            overflow: hidden;
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
