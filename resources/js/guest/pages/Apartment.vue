<template>
    <div class="ms_container">
        <h2>{{apartment.title}}</h2>
        <div class="address"><strong> {{apartment.city}}</strong> {{apartment.address}} {{apartment.number}}</div> 
        <div  class="coverimg">
            <img :src="`http://localhost:8000/storage/${apartment.cover}`" alt="">
        </div>
        <div class="other_img">
            <ul class="pics">
                <li v-for="(element,index) in pics" :key="index">
                    <img :src="`http://localhost:8000/storage/${element.url}`" alt="">
                </li>
            </ul>
        </div>
        <div class="features">
            <h3>Dettagli appartamento</h3>
                <span> {{apartment.rooms}} Stanze <i class="fas fa-campground"></i> </span>
                <span> {{apartment.guests_number}} Ospiti <i class="fas fa-user-astronaut"></i> </span>
                <span> {{apartment.bathrooms}} Bagni <i class="fas fa-sink"></i> </span>
                <span> {{apartment.sqm}} Mq <i class="fas fa-ruler"></i></span>
        </div>
        <div class="services" >
            <h3>Servizi disponibili</h3>
            <ul class="service_list">
                <li v-for="(element,index) in services" :key="index">{{element}}</li>
            </ul>
        </div>
        <div class="description">
            {{apartment.description}}
        </div>
        <div class="message">
            <h3>Scrivi a questo host</h3>
            <form action="">
                <input type="text" placeholder="Scrivi il tuo nome">
                <input type="text" placeholder="Inserisci la tua mail">
                <textarea name="" id="" cols="30" rows="10" placeholder="Scrivi il messaggio"></textarea>
                <button type="submit" class="ms_btn"> <a href=""> Invia messaggio</a></button>
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
            services: [],
            pics:[]
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
                    axios.get(`/api/pics/${this.$route.params.slug}`)
                    .then(response =>{
                        console.log(response.data.data);
                        this.pics = response.data.data;
                    })
            
            })
    }
}
</script>

<style lang="scss" scoped>

@import '../../../sass/partials/common';
.ms_container{
    margin-top:20px;
    
    h2{
        padding: 15px 0;
        text-transform: capitalize;
        font-size: 28px;
    }
    .address{
        text-transform: capitalize;
    }
    .coverimg{
        width: 55vw;
        height: 35vw;
        max-width: 550px;
        max-height: 350px;
        border-radius: 7px;
        overflow: hidden;
        margin-block: 1.9rem;
            img{
                width:100%;
                height: 100%;
                object-fit: cover;    
            }
    }
    .other_img{
        width:100%;
        height: 120px;
        .pics{
            display: flex;
            list-style: none;
            img{
                height:120px;
                margin-right: 20px;
                border-radius: 7px;
                &:hover{
                    transform: scale(1.8);
                }
            }
        }
    }
    .features{
        margin:28px 0 40px 0;
        span{
            padding-right:15px;
            font-size: 17px;
        }
        h3{
            margin-bottom: 20px;
        }
    }
    .service_list{
        display: flex;
        list-style: none;
        margin:20px 0;
        li{
            margin-right: 10px;
            background-color: white;
            padding:7px 10px;
            border-radius:15px;
        }
    }
    .description{
            margin: 30px 0;
            width:70%;   
        }
    .message{
        width:600px;
        margin:40px 0;
        input{
            width:100%;
            margin: 25px 0;
            display:block;
            padding:10px 15px;
            border-radius: 15px;
            border:none;
            background-color:white;
            font-family: 'Raleway', sans-serif;
        }
        textarea{
            width:100%;
            padding: 15px;
            border-radius: 15px;
            border:none;
            background-color: white;
            resize: none;
            font-family: 'Raleway', sans-serif;
        }
    }
    .ms_btn{
        margin: 15px 0;
        padding:13px 20px;
        border-radius: 20px;
        border: none;
        background-color: white;
        font-family: 'Raleway', sans-serif;
        &:hover{
            box-shadow: 1px 1px 2px rgba(150, 147, 147, 0.603);
            cursor: pointer;
        }
    }
}
</style>