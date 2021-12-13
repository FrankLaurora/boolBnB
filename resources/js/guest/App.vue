<template>
<<<<<<< HEAD
    <div class="ms_container">

        <h1>Vue funziona</h1>
=======
    <div>
        <Header/>
>>>>>>> andrea2
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
<<<<<<< HEAD
</script>

<style>

=======

</script>

<style lang="scss">
// @import "./assets/sass/common.scss";
>>>>>>> andrea2
</style>