<template>
    <div class="ms_container">
        <Header/>

        <!-- <Home/> -->

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
// @import "./assets/sass/common.scss";

</style>
