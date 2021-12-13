<template>
    <div>
        <div class="flex_container">
            <div class="prev_photo">
                <i class="fas fa-chevron-left" @click="prevPhoto()"></i>
            </div>

            <div class="image_box">
                
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
.flex_container {
    display: flex;
    justify-content: space-between;
    align-items: center;

    .image_box {
        width: 500px;
        height: 250px;

        img {
            display: block;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
        .bullet_box {
            position: absolute;
            display: flex;
            bottom: 20px;
            left: 50%;
            transform: translate(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: rgb(105, 224, 224);
            padding: 15px;
            border-radius: 15px;
            box-shadow: 0px 0px 20px rgb(105, 224, 224) inset;
            border: 2px solid rgb(219, 255, 255);
            }

        .bullet {
            margin: 0px 10px;
        }
    }
}

</style>