<template>
    <header>
        <div class="header ms_container-fluid">
            <div class="left">
                <a href="/">
                    <img src="https://fontmeme.com/permalink/211210/174b446b3d087f6e1ae24dd717a52eb2.png" alt="">
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
        background-color: white;
        left: 0px;
        top: 0px;
        z-index: 10;
        border-bottom: 1px solid black;
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
                        color: gray;
                        transition: 0.3s;
                        font-size: 24px;
                        &:hover {
                            color: black;
                        }
                    }
                    .register {
                        transition: 0.3s;
                        color: gray;
                        font-weight: bold;
                        &:hover {
                            color: black;
                        }
                    }
                }
            }
        }
    }

</style>