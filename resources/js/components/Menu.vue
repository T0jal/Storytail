<template>
   <nav :class="['navbar navbar-expand-lg bg-dark', navclass]">
     <div class="container">
  <router-link :to="{name: 'Home'}" class="navbar-brand logo">StoryTail</router-link>
  <button class="navbar-toggler navbar-dark toogle-border" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon navbar-dark"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
      <li class="nav-item active" v-if="!isLoggedIn">
        <router-link :to="{name: 'Login'}" aria-current="page" class="nav-link active">Sign In</router-link>
      </li>
      <li class="nav-item" v-if="!isLoggedIn">
        <router-link :to="{name: 'Signup'}" class="btn btn-orange ml-2">Register</router-link>
      </li>
      <li class="nav-item dropdown" v-if="isLoggedIn">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user"></i> Hi, <span v-if="userInfo">{{userInfo.user_name}}</span>
        </a>
        <div class="dropdown-menu" v-show="(isLoggedIn)" aria-labelledby="navbarDropdownMenuLink">
          <router-link :to="{name: 'Dashboard'}" class="dropdown-item">Dashboard</router-link>
          <a class="dropdown-item" href="#" @click="logout">Logout</a>
        </div>
      </li>
    </ul>
  </div>
  </div>
</nav>
</template>

<script>
export default {
  props: {
    navclass: {
      type: String,
      default: 'fixed-top'
    }
  },
  data(){
    return {
      userInfo : {},
    }
  },
    name: 'Menu',
    computed: {
      isLoggedIn : function(){ return this.$store.getters.isLoggedIn},
      //userInfo : function(){ return JSON.parse(this.$store.getters.userInfo)}
    },
    methods: {
      logout: function () {
        this.$store.dispatch('logout')
        .then(() => {
          this.$router.push('/')
        })
      },
      getUser(){
        return JSON.parse(localStorage.getItem('userInfo'))
      }
    },
    mounted() {
      this.userInfo = this.getUser();
    }
    
}
</script>

<style scoped>
.nav-link{
  font-weight: bold;
  font-size: 1rem;
}
a.nav-link:hover{
  color: #dfdfdf;
}
.toogle-border{
    border: 1px solid white;
    border-radius: .25rem;
}
</style>