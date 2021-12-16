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
         background: rgba(97, 92, 82, 0.808);
        background: linear-gradient(180deg, rgba(95, 89, 78, 0.301) 45%, rgba(222,138,11,0) 99%);
        left: 0px;
        top: 0px;
        z-index: 10;
        padding: 10px 20px;
        display: flex;
        align-items: center;
        .left, .right {
            width: 50%;
        }

        .left {
            img {
                width: 150px;
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
                        color: white;
                        transition: 0.3s;
                        font-size: 24px;
                        &:hover {
                            font-size: 25px;
                            color: rgba(255, 255, 255, 0.836);
                        }
                    }
                    .register {
                        transition: 0.3s;
                        color: white;
                        &:hover {
                            font-weight: 600;
                            color: rgba(255, 255, 255, 0.836);
                        }
                    }
                }
            }
        }
    }

</style>