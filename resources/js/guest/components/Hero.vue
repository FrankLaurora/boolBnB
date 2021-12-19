<template>
    <div>
        <h2 class="suggestion"><span>Oppure lasciati ispirare...</span></h2>
        <div class="flex_container">
            <div class="prev_photo">
                <i class="fas fa-chevron-left" @click="prevPhoto()"></i>
            </div>

            <div class="image_box">
                <div class="text_box">
                    <h2>{{sponsored[photoIndex].title}}</h2>
                    <h3>{{sponsored[photoIndex].city}}</h3>
                </div>

                
                <img :src="`./storage/${sponsored[photoIndex].cover}`" alt="">
                
                <div class="bullet_box">
                    <span class="bullet" v-for="(apartment, index) in sponsored" :key="index" @click="toSelectedPhoto(index)"><i class="fas fa-circle"></i></span>
                </div>

            </div>

            <div class="next_photo">
                <i class="fas fa-chevron-right" @click="nextPhoto()"></i>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Hero',

    data() {
        return {
            photoIndex: 0,
            autoplay: ""
        }
    },

    props: {
        sponsored: Array
    },

    methods: {
        nextPhoto: function() {
            clearInterval(this.autoplay);

            if(this.photoIndex == this.sponsored.length - 1) {
                return this.photoIndex = 0;
            } else {
                return this.photoIndex++;
            }
        },

        prevPhoto: function() {
            clearInterval(this.autoplay);

            if(this.photoIndex == 0) {
                return this.photoIndex = this.sponsored.length - 1;
            } else {
                return this.photoIndex--;
            }
        },

        toSelectedPhoto: function(index) {
            clearInterval(this.autoplay);

            return this.photoIndex = index;
        }
    },

    mounted: function() {
        this.autoplay = setInterval(() => {
            if(this.photoIndex == this.sponsored.length - 1) {
                return this.photoIndex = 0;
            } else {
                return this.photoIndex++;
            }
        }, 3000);

        return this.autoplay;
    }
}
</script>

<style lang="scss" scoped>
.suggestion{
    text-align: center;
    margin:18px 0;
    font-size:37px;
    color: #ede7e3;
    text-shadow:-4px 4px #113950;
    font-family: 'Space Mono', monospace;
    position:relative;  
    display:flex;
    justify-content: center; 
}
.suggestion::before, .suggestion::after{
    content:'';
    top:0;
    left:0;
    right:0;
    bottom:0;
    position:absolute;
}
.suggestion::before{
    background-color:#16697a;
    animation:typing 3s steps(33) forwards ;
}
@keyframes typing{
    to{
        left:100%;
    }
}
.flex_container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 40px;

    .prev_photo, .next_photo {
        margin-inline: 2rem;
    }
    .fa-chevron-left, .fa-chevron-right{
        font-size:20px;
        color:#82c0cc;
        }
    .fas:hover{
        cursor: pointer;
        transform: scale(1.1);
    }    

    .image_box {
        position: relative;
        width: 820px;
        height: 450px;
        border-radius:10px;
        overflow:hidden;

        img {
            display: block;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }

        .text_box {
            position: absolute;
            top: 1.2rem;
            left: 2rem;
            text-shadow: 0 0 4px #ede7e3 ;
            text-transform: capitalize;
            color:#0d4f75;
        }

        .bullet_box {
            position: absolute;
            display: flex;
            bottom: 20px;
            left: 50%;
            transform: translate(-50%);
            background-color: #11689a3b;
            color: #0d4f75;
            text-shadow: 0px 0px 4px #fff;
            padding: 0.4rem;
            border-radius: 15px;
            border: 2px solid #0d4f75;
            }

        .bullet {
            margin: 0px 8px;
            font-size: 0.7rem;
        }
    }
}

</style>