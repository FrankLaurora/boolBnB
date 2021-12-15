<template> 
     <div class="container-cards ms_container">
         <div class="ms_row ms_align-items-center">
             <div v-for="(apartment, index) in apartments" :key="index" class="ms_col-12 ms_col-md-6 ms_col-lg-3">
                <router-link class="card-href" :to="{ name: 'apartment', params: { slug: apartment.slug } }">
                    <div class="card">
                        <div v-if="apartment.cover" class="header">
                            <img :src="`./storage/${apartment.cover}`" alt="">
                        </div>
                        <div v-else class="header">
                            <img src="../images/image_not_found.jpg" alt="">
                        </div>
                        <div class="body">
                            <div class="title">
                                {{apartment.title}}
                            </div>
                            <div class="city">
                                {{apartment.city}}
                            </div>
                        </div>
                        <div class="footer">
                            <div class="guests_number">
                                <i class="fas fa-bed"></i>
                                <span>{{apartment.guests_number}}</span> 
                                Bedrooms
                            </div>
                            <div class="bathrooms">
                                <i class="fas fa-bath"></i>
                                <span>{{apartment.bathrooms}}</span> 
                                Bathrooms
                            </div>
                        </div>
                    </div>
                </router-link>
             </div>
         </div>
     </div>    
</template>

<script>

export default {
  name: 'Card',

  props: {
      apartments: Array
  }
//   data() {
//       return {
//           apartments: [],
//       }
//   },
//   created(){
//       axios.get('http://localhost:8000/api/apartments')
//       .then((response)=> {
//         this.apartments = response.data.data;
//       });
//   }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">
    
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');

    .container-cards {
        padding: 25px 0px 0px 0px;
    }

    .card-href {
        text-decoration: none;
    }

    .card {
        background-color: white;
        transition: 0.5s;
        font-family: Arial, Helvetica, sans-serif;
        overflow: hidden;
        border: 2px solid darkgrey;
        border-radius: 5px;
        margin: 5px;
        &:hover {
            transform: scale(1.025);
            // border: 2px solid orange;
            // .footer {
            //     border-top: 2px solid orange;
            // }
        }
        .header {
            img {
                display: block;
                width: 100%;
                height: 150px;
                object-fit: cover;
                object-fit: center;
            }
        }
        .body {
            padding: 10px;
            .title {
                margin-bottom: 2px;
                color: black;
                font-size: 14px;
                text-transform: uppercase;
                font-weight: bold;
            }
            .city {
                font-size: 14px;
                color:  darkgrey;
            }
        }
        .footer {
            display: flex;
            border-top: 2px solid darkgrey;
            transition: 1s;
            .bathrooms, .guests_number {
                color: darkgrey;
                width: 50%;
                font-size: 12px;
                text-align: center;
                padding: 10px;
                span {
                    color: black;
                    font-weight: bold;
                }
            }
        }
    }


    

  
</style>
