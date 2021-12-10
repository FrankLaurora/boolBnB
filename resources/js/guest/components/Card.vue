<template> 
     
     <div class="container">

         <div class="col">
            <div class="card">
                <div class="card-head">
                    <img src="../images/prova.jpg" alt="">
                </div>
                <div class="card-body">
                    <h3>Happy Days Garden</h3>
                    <div>Procida, 80079</div>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eos aliquam magnam tenetur, explicabo ipsa officia sed aliquid quia nihil qui provident dicta cupiditate inventore aspernatur, corrupti alias eligendi obcaecati id?</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-head">
                    <img src="../images/prova.jpg" alt="">
                </div>
                <div class="card-body">
                    <h3>Happy Days Garden</h3>
                    <div>Procida, 80079</div>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eos aliquam magnam tenetur, explicabo ipsa officia sed aliquid quia nihil qui provident dicta cupiditate inventore aspernatur, corrupti alias eligendi obcaecati id?</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-head">
                    <img src="../images/prova.jpg" alt="">
                </div>
                <div class="card-body">
                    <h3>Happy Days Garden</h3>
                    <div>Procida, 80079</div>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eos aliquam magnam tenetur, explicabo ipsa officia sed aliquid quia nihil qui provident dicta cupiditate inventore aspernatur, corrupti alias eligendi obcaecati id?</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-head">
                    <img src="../images/prova.jpg" alt="">
                </div>
                <div class="card-body">
                    <h3>Happy Days Garden</h3>
                    <div>Procida, 80079</div>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eos aliquam magnam tenetur, explicabo ipsa officia sed aliquid quia nihil qui provident dicta cupiditate inventore aspernatur, corrupti alias eligendi obcaecati id?</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-head">
                    <img src="../images/prova.jpg" alt="">
                </div>
                <div class="card-body">
                    <h3>Happy Days Garden</h3>
                    <div>Procida, 80079</div>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eos aliquam magnam tenetur, explicabo ipsa officia sed aliquid quia nihil qui provident dicta cupiditate inventore aspernatur, corrupti alias eligendi obcaecati id?</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-head">
                    <img src="../images/prova.jpg" alt="">
                </div>
                <div class="card-body">
                    <h3>Happy Days Garden</h3>
                    <div>Procida, 80079</div>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eos aliquam magnam tenetur, explicabo ipsa officia sed aliquid quia nihil qui provident dicta cupiditate inventore aspernatur, corrupti alias eligendi obcaecati id?</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-head">
                    <img src="../images/prova.jpg" alt="">
                </div>
                <div class="card-body">
                    <h3>Happy Days Garden</h3>
                    <div>Procida, 80079</div>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eos aliquam magnam tenetur, explicabo ipsa officia sed aliquid quia nihil qui provident dicta cupiditate inventore aspernatur, corrupti alias eligendi obcaecati id?</p>
                </div>
            </div>
        </div>
        

     
     </div>

     
    
</template>

<script>

export default {
  name: 'Card'
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
   
   * {
       padding: 0px;
       margin: 0px;
       box-sizing: border-card;
   }

    .container {
        max-width: 992px;
        margin: 0 auto;
        display: flex;  
        flex-wrap: wrap;
    }

   .col {
       width: 33%;
   }

   .card {
       border: 1px solid black;
       margin: 10px;
   }

   .card-body {
       padding: 10px;
   }

   img {
       display: block;
       width: 100%;
       height: 250px;
       object-fit: cover;
       object-position: center;
   }
   

</style>
