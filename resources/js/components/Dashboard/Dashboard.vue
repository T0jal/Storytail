<template>
  <div>
    <Menu :navclass="null"/>
    <div class="btn-sidebar">
      <a class="openclosebtn" @click="openNav()">
          <i class="fas fa-times" v-show="!navBar"></i>
          <i class="fas fa-bars" v-show="navBar"></i>
      </a>
    </div>
    <div id="mySidebar" class="sidebar">
      
      <span v-show="!(navBar)">
        <div class="profile">
          <img :src="`images/${userInfo}`" class="img-profile rounded-circle" width="100">
          <router-link :to="{name: 'Profile'}" class="link-profile">My Profile</router-link>
        </div>
        <router-link :to="{name: 'Mybooks'}"><i class="fas fa-book"></i> My books</router-link>
        <router-link :to="{name: 'Favourites'}"><i class="fas fa-heart"></i> Favourites</router-link>
        <router-link :to="{name: 'Premium'}"><i class="fas fa-arrow-alt-circle-up"></i> Upgrade Account</router-link>
        <router-link :to="{name: 'Contact'}"><i class="fas fa-envelope"></i> Contact</router-link>
      </span>
    </div>

<div id="main">
<router-view></router-view>

</div>
    </div>
</template>

<script>
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
import Menu from '../Menu'
export default {
  data(){
    return{
      navBar: false,
      user : {
                first_name: '',
                last_name: '',
                user_name: '',
                email: '',
                password: '',
                password_confirm: '',
                user_photo_url: ''
            }
    }
  },
  methods: {
    openNav(){
      let width = 0;
      let marginLeft = 0;
      if(this.navBar){
        width = '250px';
        marginLeft = '300px';
      } else{
        width = '0';
        marginLeft = '50px';
      }
      document.getElementById("mySidebar").style.width = width;
      document.getElementById("main").style.marginLeft = marginLeft;
      this.navBar = (this.navBar)? false: true;
    }
  },
  computed: {
    isLoggedIn : function(){ return this.$store.getters.isLoggedIn},
    userInfo : function(){
      if(this.$store.getters.userInfo){
        return this.$store.getters.userInfo.user_photo_url
      }
      return this.user.user_photo_url
      }
    },
  created(){
    //console.log(this.$store.state.user)
    // axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token')
    // this.$store.dispatch('currentUser/getUser')
  },
  components: {Menu},
  mounted(){
        this.user = JSON.parse(localStorage.getItem('userInfo'))
    }
}
</script>
<style scoped>
.profile{
  width: 250px;
  text-align: center;
  margin-bottom: 20px;
}
.sidebar a.link-profile{
  padding: 0;
  padding-top: 5px;
  color: var(--orange-100);
  font-weight: 500;
  font-size: 16px;
}
.img-profile{
  border: 2px solid white;
}
.sidebar  a .fas{
  transition: 0.3s;
  margin-right: 5px;
}
.sidebar  a:hover .fas{
  color: var(--orange-100);
}
/* The sidebar menu */
.sidebar {
  height: 100%; /* 100% Full-height */
  width: 250px; /* 0 width - change this with JavaScript */
  position: fixed; /* Stay in place */
  z-index: 99999; /* Stay on top */
  top: 56px;
  left: 0;
  background-color: white;
  overflow-x: hidden; /* Disable horizontal scroll */
  padding-top: 15px; /* Place content 60px from the top */
  transition: 0.5s; /* 0.5 second transition effect to slide in the sidebar */
  box-shadow: 10px 0 30px -32px #888;
}

/* The sidebar links */
.sidebar a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 14px;
  font-weight: 400;
  color: black;
  display: block;
  transition: 0.3s;
}


/* When you mouse over the navigation links, change their color */
.sidebar a:hover {
  color: #333;
}


/* Position and style the close button (top right corner) */
.btn-sidebar {
  position: absolute;
  top: 0;
  left: 0;
  width: 56px;
  height: 56px;
  font-size: 24px;
  background-color: var(--orange-100);
  padding-top: 10px;
  text-align: center;
  }
.openclosebtn{
  color: white;
  cursor: pointer;
}

/* The button used to open the sidebar */
.openbtn {
  font-size: 20px;
  cursor: pointer;
  background-color: var(--orange-100);
  color: white;
  padding: 10px 15px;
  border: none;
}

.openbtn:hover {
  background-color: #444;
}

/* Style page content - use this if you want to push the page content to the right when you open the side navigation */
#main {
  transition: margin-left .5s; /* If you want a transition effect */
  padding: 20px;
  margin-left: 300px;
  margin-right: 50px;
  margin-top: 50px;
  margin-bottom: 50px;
  background-color: white;
}

/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
  .sidebar {padding-top: 15px;}
  .sidebar a {font-size: 18px;}
}
</style>