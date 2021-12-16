<template>
    <nav>
        <div class="container-header">
            <a href="/"><img src="images/logo_small.png" alt="" id="logo"></a>
            <div>
                <ul>
                    <li>
                        <a  class="register" href="/register">Diventa host</a>
                    </li>
                    <li>
                        <a class="user" href="/login"><i class="fas fa-user-circle"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
	name: "Header",
}
</script>

<style lang="scss" scoped>
    nav{
        display: flex;
        align-items: center;
        flex-grow: 1;
    }

    .container-header{
        display: flex;
        justify-content: space-between;
        padding-inline: 2rem;
        align-items: center;
        flex-grow: 1;
        
        #logo{
            width: 17%;
        }
        ul{
            list-style-type: none;
            display:flex;
            line-height:80px;
            li{
               margin-left:18px; 
            }
            .fas{
                color: white;
                font-size: 30px;
                margin-top: 25px;


                &:hover{
                    transform:scale(1.07);
                    cursor: pointer;
                    color: rgba(255, 255, 255, 0.836);
                    transition: 0.3s;
                }
            }
            .register{
                color:white;
                font-weight: 600;
                text-shadow: 1px 1px 2px rgba(150, 147, 147, 0.603);
                &:hover{
                    font-weight: 600;
                    cursor: pointer;
                    color: rgba(255, 255, 255, 0.836);
                    transition: 0.3s;
                    
                }
            }
        }
    }
</style>