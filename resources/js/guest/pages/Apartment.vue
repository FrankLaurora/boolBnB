<template>
    <div class="ms_container">
        <h2>{{apartment.title}}</h2>
        <div class="address"> <span> <strong> {{apartment.city}} </strong></span>   {{apartment.address}} {{apartment.number}}</div> 
        <div class="row_map">
            <div  class="coverimg" >
                <img :src="`http://localhost:8000/storage/${apartment.cover}`" alt="">
            </div>
            <div class="ms_map_container">
                <div id="map" style="width: 100%; height: 100%;"></div>
            </div>
        </div>
        
        <div class="other_img">
            <ul class="pics">
                <li v-for="(element,index) in pics" :key="index">
                    <img :src="`http://localhost:8000/storage/${element.url}`" alt="">
                </li>
            </ul>
        </div>
        <div class="features">
            <h3>Dettagli dell'appartamento</h3>
                <span>  Numero di stanze: {{apartment.rooms}} <i class="fas fa-campground"></i> </span>
                <span>  Ospiti: {{apartment.guests_number}}  <i class="fas fa-user-astronaut"></i> </span>
                <span>  Numero di bagni: {{apartment.bathrooms}} <i class="fas fa-sink"></i> </span>
                <span>  Mq: {{apartment.sqm}}  <i class="fas fa-ruler"></i></span>
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
            <form :action="`http://localhost:8000/messages/store/${apartment.id}`" method="POST">
                <input type="hidden" name="_token" :value="csrf">
                <input type="text" name="name" placeholder="Scrivi il tuo nome">
                <input type="email" name="email" :value="email != null ? email : ''" placeholder="Inserisci la tua mail">
                <textarea name="content" cols="30" rows="10" placeholder="Scrivi il messaggio"></textarea>
                <button type="submit" class="ms_btn">Invia messaggio</button>
            </form>
        </div>
    </div>    
</template> 

<script>
import tt from '@tomtom-international/web-sdk-maps';

export default {
    name: 'Apartment',

    data() {
		return {
			apartment: [],
            services: [],
            pics: [],
            lat: null,
            lon: null,
            map: null,
            marker: null,
            email: null,
            csrf: document.querySelector('meta[name="csrf-token"]').content
		}
    },

    mounted(){
            axios.get(`/api/apartments/${this.$route.params.slug}`)
            .then(response=>{
                this.apartment = response.data.data;
                this.lat = this.apartment.latitude;
                this.lon = this.apartment.longitude;
    
                this.map = tt.map({
                        key: 'lXA4qKasPyxqJxup4ikKlTFOL3Z89cp4',
                        container: 'map',
                        zoom: 15,
                        center: [this.lon, this.lat]
                    });
                this.map.addControl(new tt.NavigationControl);
                this.marker = new tt.Marker({
                    color: '#ffa628',
                    width: '27',
                    height: '35'
                }).setLngLat([this.lon, this.lat]).addTo(this.map);
                console.log(this.marker);
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

                fetch('https://api.ipify.org?format=json')
                    .then(x => x.json())
                    .then(({ ip }) => {
                    console.log(ip);
                    axios.get(`/api/statistics/${this.apartment.id}/${ip}`)
                    .then(function (response) {
                    console.log(response);
                    })
                    .catch(function (error) {
                    console.log(error);
                    });
                });
            
            })

        if(window.Laravel.isLoggedin) {
        this.email = window.Laravel.user.email;
        };

    }
}
</script>

<style lang="scss" scoped>

@import '../../../sass/guest/common';
.ms_container{
    margin-top:30px;    
    margin:0 auto;
    
    h2{
        padding: 15px 0;
        text-transform: capitalize;
        font-size: 30px;
        text-shadow:-2px 2px $darker;
        font-family: 'Poppins', sans-serif; 
        
    }
    h3{
        color:$orange;
        font-size:20px;
    }
    .address{
        text-transform: capitalize;
        color:$lightblue;
        font-size:18px;
        span{
            color:$orange;
            margin-right:10px;
            font-size:19px;
        }
    }
    .row_map{
        display:flex;
        
    }
    .ms_map_container {
        width: 440px;
        height: 450px;
        margin: 1.8rem;
        overflow:hidden;
        #map{
            border-radius: 7px;
        }
    }
    .coverimg{
        width: 70vw;
        height: 45vw;
        max-width: 700px;
        max-height: 450px;
        border-radius: 7px;
        overflow: hidden;
        margin-block: 1.8rem;
            img{
                width:100%;
                height: 100%;
                object-fit: cover;    
            }
    }
    .other_img{
        width:70%;
        min-height: 120px;
        overflow-x: auto;
        .pics{
            display: flex;
            list-style: none;
            img{
                height:120px;
                margin-right: 20px;
                border-radius: 7px;
                // &:hover{
                    
                // }
            }
        }
    }
    .features{
        margin:28px 0 40px 0;
        span{
            padding-right:15px;
            font-size: 17px;
            font-weight:500;
            .fas{
                color:$lightblue;
            }
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
            background-color: $mediumblue;
            color:$beige;
            padding:7px 12px;
            border-radius:15px;
            font-weight:500;
            min-width:80px;
            text-align: center;
        }
    }
    .description{
            margin: 45px 0;
            width:70%;   
        }
    .message{
        width:650px;
        margin:45px 0;
        input{
            width:100%;
            margin: 25px 0;
            display:block;
            padding:12px 15px;
            border-radius: 20px;
            border:none;
            background-color:$beige;
            font-family: 'Raleway', sans-serif;
            font-size:15px;
            &:focus {
                outline: none;
            }
        }
        textarea{
            width:100%;
            padding: 15px;
            border-radius: 15px;
            border:none;
            background-color: $beige;
            resize: none;
            font-family: 'Raleway', sans-serif;
            font-size:15px;
            &:focus {
                outline: none;
            }
        }
    }
    .ms_btn{
        margin: 30px 0 70px 0;
        padding:12px 15px;
        border-radius: 20px;
        border: none;
        background-color: $lightblue;
        font-family: 'Raleway', sans-serif;
        font-size: 15px;
        color: #0d4f75;
        font-weight: 600;
        &:hover{
            box-shadow: 1px 1px 2px #0d424d81;
            cursor : pointer;
            background-color: $mediumblue;
            color:$beige;
        }
    }
   
}
</style>