<template>
<div>
<Menu/>
      <div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" @submit.prevent="loginForm">
                            <div class="form-group">
                                <label for="username">Username:</label><br>
                                <input type="text" v-model="user.user_name" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label><br>
                                <input type="password" v-model="user.password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <br>
                                <input type="submit" name="submit" class="btn btn-orange btn-md" value="submit">
                            </div>
                            <div id="register-link" class="text-right">
                                <router-link :to="{name: 'Signup'}">Register here</router-link>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import Menu from './Menu'
import axios from 'axios'
export default {
    name: 'Login',
    data(){
        return{
            user:{
                user_name: '',
                password: ''
            }
        }
    },
    methods: {
        loginForm(){
            this.$store.dispatch('login', this.user)
            .then(()=>this.$router.push('/dashboard'))
            .catch(err=>console.log(err))
        }
    },
    components: {Menu}

}
</script>

<style scoped>
.text-logo{
    font-family: babyeliot;
    color: white;
}
#login{
    background: white;
    padding: 100px 0 0 0;
    height: 100vh;
}
#login .container #login-row #login-column #login-box {
  margin-top: 120px;
  max-width: 600px;
  height: 320px;
  background-color: var(--grey-100);
}
#login .container #login-row #login-column #login-box #login-form {
  padding: 20px;
}
#login .container #login-row #login-column #login-box #login-form #register-link {
  margin-top: -85px;
}
</style>