<template>
    <div>
        <div class="container">
            <div class="left">
                <div class="col">
                    <p>BoolBnb</p>
                    <ul>
                        <li v-for="(link,index) in menu1" :key="index"><a :href="link.url">{{link.text}}</a></li>
                    </ul>
                </div>
                <div class="col">
                    <p>Info</p>
                <ul>
                    <li v-for="(link,index) in menu2" :key="index"><a :href="link.url">{{link.text}}</a></li>
                </ul>
                </div>
            </div>
            <div class="right">
                <h3>Seguici sui nostri social</h3>
                <ul>
                    <li :key="index" v-for="(icon,index) in icons">
                        <a :href="icon.url"><img :src="icon.src" :key="index" alt=""></a>
                    </li>
                </ul>
            </div>
        </div>    
    </div>
</template>

<script>
export default{
    name:"FooterTop",
    data(){
        return{
            menu1:[
                {
                    text:"Home",
                    url:"/home"
                },
                {
                    text:"Accedi",
                    url:"/login"
                },
                {
                    text:"Registrati",
                    url:"/register"
                },
            ],
            menu2:[
                {
                    text:"Termini di utilizzo",
                    url:"https://policies.google.com/terms?hl=it"
                },
                {
                    text:"Privacy Policy",
                    url:"https://policies.google.com/privacy?hl=en-US"
                }
            ],
            icons:[
                {
                    text:"Facebook",
                    src:"images/footer-facebook.png",
                    url:"https://facebook.com"
                },
                {
                    text:"Twitter",
                    src:"images/footer-twitter.png",
                    url:"https://twitter.com"
                },
                {
                    text:"Youtube",
                    src:"images/footer-youtube.png",
                    url:"https://youtube.com"
                },
                    {
                    text:"Pinterest",
                    src:"images/footer-pinterest.png",
                    url:"https://pinterest.com"
                },
                {
                    text:"Periscope",
                    src:"images/footer-periscope.png",
                    url:"https://periscope.com"
                },
                   
            ]
        }
    }
}
</script>

<style lang="scss" scoped>
div{
    background-color: #171819;
    .container{
        padding-bottom: 10px;
        width: 70%;
        margin: auto;
        display: flex;
        justify-content: center;
        .left{
            width: 50%;
            display: flex;
            flex-direction: row;
            padding-top: 25px;
            justify-content: space-around;
            .col{
                p{
                color: white;
                font-size: 16px;
                margin: 15px 0 15px 0;
            }
            ul{
                list-style: none;
                padding: 0;
                li{
                    margin-bottom: 10px;
                }
            }
            a{
                text-decoration: none;
                color: #69687a;
            }
            }
        }
        .right{
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            h3{
                margin-bottom: 15px;
                color: #0d6efd;
                font-weight: bold;
            } 
            ul{
                display: flex;
                flex-direction: row;
                list-style: none;
                li{
                    padding: 0 15px;
                    a{
                        text-decoration: none;
                        color: black;  
                    }
                }
            }
        }
    }
}
</style>