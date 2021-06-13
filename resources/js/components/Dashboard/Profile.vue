<template>
<div>
  <h1 class="title text-center">MY PROFILE</h1>
<div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form @submit.prevent="sendForm" id="login-form" class="form">
                            <div class="picture-profile">
                                <img :src="pic" class="img-profile rounded-circle" width="100">
                                     <input id="file" type='file' name="image" accept=".png, .jpg, .jpeg" style="display: none;" @change="changePicture">
                                     <label for="file" style="cursor: pointer;"><span class="btn btn-sm btn-orange"><i class="fas fa-plus-circle"></i> new picture</span></label>
                            </div>
                            <br>    
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
                                <input type="text" v-model="user.user_name" id="username" class="form-control" readonly>
                            </div>
                            <div class="mt-3">
                                <label for="email">Email:</label>
                                <input type="text" v-model="user.email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <br>
                                <input type="submit" name="submit" class="btn btn-orange btn-md" value="update">
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
            user : {
                first_name: '',
                last_name: '',
                user_name: '',
                email: '',
                password: '',
                password_confirm: '',
                image: ''
            },
            pic: null,
            error: null
        }
    },
    methods:{
        changePicture(a){
            	// let image = document.getElementById('output');
	            // image.src = URL.createObjectURL(event.target.files[0]);
                this.pic = URL.createObjectURL(a.target.files[0])
                 this.user.image = a.target.files[0];
        },
        async sendForm(){
            let data = new FormData();
            data.append('first_name', this.user.first_name)
            data.append('last_name', this.user.last_name)
            data.append('email', this.user.email)
            data.append('image', this.user.image)
            await axios
            .post(`/api/user/update/${this.user.id}`, data, {headers:{'Content-Type': 'multipart/form-data'}})
            .then(res => {
                const {id, user_name, first_name, last_name, email, user_photo_url} = res.data.data
                // console.log({id, user_name, first_name, last_name, email, user_photo_url})
                localStorage.removeItem('userInfo');
                localStorage.setItem('userInfo', JSON.stringify({id: id, first_name:first_name, last_name:last_name,user_name: user_name, email:email, user_photo_url:user_photo_url}))
                this.$store.dispatch('picture')
            })
      .catch(error => console.log(error))
        }
    },
    mounted(){
        let user = JSON.parse(localStorage.getItem('userInfo'))
        this.pic = 'images/'+user.user_photo_url
        this.user = user
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