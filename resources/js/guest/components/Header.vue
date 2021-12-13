<template>
    <nav>
        <div class="container-header">
            <a href="/home"><img src="https://fontmeme.com/permalink/211210/174b446b3d087f6e1ae24dd717a52eb2.png" alt="" id="logo"></a>
            <div>
                <ul>
                    <li>
                        <a class="button" href="/login">Accedi</a>
                        <a  class="button" href="/register">Registrati</a>
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
    .container-header{
        display: flex;
        justify-content: space-between;
        padding-inline: 2rem;
        align-items: center;
        flex-grow: 1;
        #logo{
            width: 70%;
        }
        ul{
            list-style-type: none;
            .button {
            background-color: #0d6efd;
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
</style>