<template>
    <div>
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
// import Home from './pages/Home.vue';
import Header from './components/Header.vue'
import FooterTop from './components/FooterTop.vue';
import FooterBottom from './components/FooterBottom.vue';
export default {
    components: {
    Header,
    FooterTop,
    FooterBottom
  },
    name: 'App'
}

</script>

<style lang="scss">
// @import "./assets/sass/common.scss";
</style>