<template>
<div>
    <Menu/>
    <div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form @submit.prevent="sendForm" id="login-form" class="form">
                            <div class="row">
                                <div class="col">
                                     <label for="firstname">Firstname:</label>
                                     <input type="text" v-model="user.first_name" id="firstname" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="lastname">Lastname:</label>
                                    <input type="text" v-model="user.last_name" id="lastname" class="form-control">
                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="username">Username:</label>
                                <input type="text" v-model="user.user_name" id="username" class="form-control">
                            </div>
                            <div class="mt-3">
                                <label for="email">Email:</label>
                                <input type="text" v-model="user.email" id="email" class="form-control">
                            </div>
                            <div class="mt-3">
                                <label for="password">Password:</label>
                                <input type="password" v-model="user.password" id="password" class="form-control">
                            </div>
                            <div class="mt-3">
                                <label for="c_password">Confirm Password:</label>
                                <input type="password" v-model="user.password_confirm" id="c_password" class="form-control">
                            </div>
                            <div class="form-group">
                                <br>
                                <input type="submit" name="submit" class="btn btn-orange btn-md" value="submit">
                            </div>
                            <div v-if="error">
                                <div class="alert alert-danger">
                                    <div v-for="item in error" :key="item.id">*{{item}}</div>
                                </div>
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
export default {
    name: 'Signup',
    components: {Menu},
    data() {
        return{
            user : {
                first_name: '',
                last_name: '',
                user_name: '',
                email: '',
                password: '',
                password_confirm: '',
            },
            error: null
        }
    },
    methods: {
        async sendForm(){
            let data = {
                first_name: this.user.first_name,
                last_name: this.user.last_name,
                user_name: this.user.user_name,
                email: this.user.email,
                password: this.user.password,
                password_confirmation: this.user.password_confirm
            }
            // this.$store.dispatch('register', data)
            // //.then(() => this.$router.push('/login'))
            // .then(() => console.log(''))
            // .catch(err => this.error = err)
            try{
                const res = await axios.post('/api/signup', data).then(res => res.data);
                if(res.errors){
                    this.error = []
                    for (const key in res.errors) {
                        this.error.push(res.errors[key][0])
                    }
                } else {
                    this.error = null
                    this.user = {
                        first_name: '',
                        last_name: '',
                        user_name: '',
                        email: '',
                        password: '',
                        password_confirm: '',
                    }
                    this.$swal({
                title:'Account created',
                text:'Please login in your account',
                icon:'success'
            }).then(()=>{
                this.$router.push('/login')
            })
                }
            } catch(err){
                this.error = err
            }
        }
    }
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
  background-color: var(--grey-100);
}
#login .container #login-row #login-column #login-box #login-form {
  padding: 20px;
}
#login .container #login-row #login-column #login-box #login-form #register-link {
  margin-top: -85px;
}
</style>