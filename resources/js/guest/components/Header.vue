<template>
    <nav class="container-header"> 
        <a href="/home"><img src="https://fontmeme.com/permalink/211210/174b446b3d087f6e1ae24dd717a52eb2.png" alt="" id="logo"></a>
        <div class="container-buttons">
            <ul>
                <li>
                    <a class="button" href="/login">Accedi</a>
                    <a  class="button" href="/register">Registrati</a>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
export default {
	name: "Header",
}
</script>

<style lang="scss" scoped>
    .container-header{
        margin-top: 10px;
        display: flex;
        justify-content: space-around;
        #logo{
        width: 70%;
        }
        .container-buttons{
            display: flex;
            align-items: center;
            ul{
                list-style-type: none;
                .button {
                background-color: #343a40;
                border-radius: 10px;
                color: white;
                padding: 10px 22px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                }
            }
        }
    }
</style>