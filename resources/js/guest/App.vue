<template>
    <div>
        <header><Header/></header>
        
        <main>
            <router-view></router-view>
        </main>

        <footer>
            <FooterTop/>
            <Footer-Bottom/>
        </footer>
        
    </div>
</template>

<script>
import Header from './components/Header.vue'
import FooterTop from './components/FooterTop.vue';
import FooterBottom from './components/FooterBottom.vue';
export default {
    name: 'App',

    components: {
        Header,
        FooterTop,
        FooterBottom
    },

    data() {
        return {
            search: null,
            user: null
        }
    },

    methods: {
        advancedSearch(search) {
            this.search = search;
        }
    },

    created() {
        if (window.Laravel.isLoggedin) {
            this.user = window.Laravel.user
        }
    },
}
</script>


<style lang="scss">
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
div{
    
    header{
    background: rgba(99, 93, 81, 0.753);
    background: linear-gradient(180deg, rgba(95, 89, 78, 0.301) 40%, rgba(222,138,11,0) 99%);
    height: 75px;
    display: flex;
    align-items: center;
    position:fixed;
    width: 100%;
    top:0;
    left:0;
    z-index: 2;
    }

    main{
        // height: 70vh;
        // overflow: auto;
        margin-top: 80px;
        min-height: 800px;
    }
    footer{
        width: 100%;
    }
}

</style>