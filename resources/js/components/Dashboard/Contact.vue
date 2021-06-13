<template>
<div>
  <h1 class="title text-center">CONTACT US</h1>
<div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form @submit.prevent="sendForm" id="login-form" class="form">
                              
                            <div class="row">
                                <div class="col">
                                     <label for="message">Leave us a message:</label>
                                     <textarea v-model="message" id="message" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <br>
                                <input type="submit" name="submit" class="btn btn-orange btn-md" value="Send">
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
export default {
    data() {
        return{
            message: '',
            error: null
        }
    },
    methods:{
        async sendForm(){
            await axios
            .post(`/api/user/message`, message)
            .then(res => {
                console.log(res)
            })
      .catch(error => console.log(error))
        }
    }
}
</script>

<style scoped>
.picture-profile{
    text-align: center;
}
.picture-profile label{
    margin-top: 10px;
    display: block;
}
.picture-profile img{
    border: 2px solid white;
}
.text-logo{
    font-family: babyeliot;
    color: white;
}
#login{
    padding: 20px 0 0 0;
}
#login .container #login-row #login-column #login-box {
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