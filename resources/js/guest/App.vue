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
    }
}
</script>


<style lang="scss">
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
div{
    overflow: hidden;
    header{
    background-color: #292c30;
    height: 10vh;
    }
    main{
        height: 70vh;
        overflow: auto;
    }
    footer{
        height: 20vh;
        width: 100%;
    }
}
</style>
