<template>
    <header>
        <div class="header ms_container-fluid">
            <div class="left">
                <a href="/">
                    <img src="images/logo_small.png" alt="">
                </a>
            </div>
            <nav class="right">
                <ul>
                    <li>
                        <a  class="register" href="/register">Diventa host</a>
                    </li>
                    <li>
                        <a class="user" href="/login"><i class="fas fa-user-circle"></i></a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
</template>

<script>
export default {
	name: "HeaderLeo",
}
</script>

<style lang="scss" scoped>
    .header {
        position: fixed;
        width: 100%;
        background: rgb(72,159,181);
        background: linear-gradient(180deg, rgba(72, 159, 181, 0.623) 3%, rgba(22, 105, 122, 0) 100%);
        left: 0px;
        top: 0px;
        z-index: 10;
        padding: 10px 17px;
        display: flex;
        align-items: center;
        .left, .right {
            width: 50%;
        }

        .left {
            img {
                width: 80px;
                margin-left: 20px;
            }
        }
        .right {
            ul {
                display: flex;
                justify-content: right;
                align-items: center;
                list-style: none;
                li {
                    margin-left: 15px;
                    
                    .user {
                        color: #ede7e3;
                        font-size: 27px;
                        margin-right:18px;
                        &:hover {
                            color: #ffa628;
                            transition: 0.2s;
                            
                        }
                    }
                    .register {
                        font-size: 17px;
                        color: #ede7e3;
                        font-weight: 600;
                        &:hover {
                            transition: 0.3s;
                            font-weight: 600;
                            color: #ffa628;
                        }
                    }
                }
            }
        }
    }

</style>