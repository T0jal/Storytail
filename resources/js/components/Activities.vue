<template>
  <div>
    <Menu />
      <header>
        <h1 class="title text-center mt-5">ACTIVITIES</h1>
        <BookHeaderLinks :isVideo="isVideo" :book="book"/>
      </header>
    <section class="container p-3 mt-5">
<div class="activity-item" v-for="item in activities" :key="item.id">
        <div class="flex-container">
            <div class="flex-items">
                <div class="round">
                    <input @click="completeActivity(item.id)" type="checkbox" :id="item.id" :checked="checkCompleted(item.id)"/>
                    <label :for="item.id"></label>
                </div>
            </div>
            <div class="flex-items">
                <button class="collapsible" @click="openActivity(item.activity.id)">{{item.activity.title}} <i class="chevron fas fa-chevron-down"></i></button>
            </div>
            
        </div>
       <transition
        name="accordion-item"
        @enter="startTransition"
        @after-enter="endTransition"
        @before-leave="startTransition"
        @after-leave="endTransition">
        <div class="accordion-content accordion-item-details" v-show="searchActive(item.activity.id)">
            <p>{{item.activity.description}}</p>
              <!-- {{img.title}}
              {{img.image_url}} -->
<div :id="'carouselExampleControls-'+item.activity.id" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div v-for="(img, index) in item.activity.activity_images" :key="img.id" :class="(index===0)?'carousel-item active':'carousel-item'">
      <img class="d-block w-100" :src="`/images/${img.image_url}`" :alt="img.title">
    </div>
  </div>
  <a class="carousel-control-prev" :href="'#carouselExampleControls-'+item.activity.id" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" :href="'#carouselExampleControls-'+item.activity.id" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
            </div>
       </transition>
        </div>
    </section>

  </div>
</template>

<script>

import BookHeaderLinks from './BookHeaderLinks'
import Menu from './Menu'
export default {
    data(){
        return {
            activities: [],
            activityCompleted: [],
            isActive: []
        }
    },
    props: ['id','isVideo', 'book'],
    components: {BookHeaderLinks, Menu},
    computed: {
      
    },
    methods: {
      completeActivity(id){
          let JWTToken = localStorage.getItem('token');
      axios
      .get(`/api/user/activity/${id}`, { headers: {"Authorization" : `Bearer ${JWTToken}`} })
      .then(res => {
        console.log(res.data)
      })
      .catch(error => console.log(error))
      },
      checkCompleted: function(id){
        let obj = (typeof this.activityCompleted != "undefined" && this.$store.getters.isLoggedIn)?this.activityCompleted.find(o => o.activity_book_id === id):false;
        if (obj) {
          return true
        }
        return false
      },
        openActivity(id){
          let obj = this.isActive.find(o => o.id === id);
          obj.active = (obj.active)?false:true;
          //console.log(this.isActive)
          return obj;
        },
        startTransition(el) {
      el.style.height = el.scrollHeight + 'px'
    },
    addActiveProperty(){
      this.activities.forEach((el)=>{
        this.isActive.push({id:el.activity.id, active: false})
      })
    },
    searchActive(id){
      let obj = this.isActive.find(o => o.id === id);
      return obj.active
    },
    showActive(){
      console.log(this.isActive)
    },
    
    endTransition(el) {
      el.style.height = ''
    },
    async fetchActivities(id){
      const res = await fetch(`/api/books/${id}`)
      const data = await res.json()
      return data.data.activity_books
    },
    fetchUserActivities(){
    let JWTToken = localStorage.getItem('token');
      axios
      .get('/api/user/activity', { headers: {"Authorization" : `Bearer ${JWTToken}`} })
      .then(res => {
        this.activityCompleted = res.data.data;
      })
      .catch(error => console.log(error)) 
      }
    },
    async mounted(){
      this.activities = await this.fetchActivities(this.id)
      this.addActiveProperty()
      this.fetchUserActivities()??{}
      //console.log(this.$store.getters.isLoggedIn)
    }
}
</script>

<style scoped>
.red{
  color: red;
}
.blue{
  color: blue;
}
section{
  background: #fff;
}
header{
  background-color: #fff;
}
header h1{
  padding: 50px 0;
}
.chevron{
  display: inline;
  margin-top: 2px;
  float: right;
}
.accordion-item-details {
  overflow: hidden;
}

.accordion-item-enter-active, .accordion-item-leave-active {
  will-change: height;
  transition: height 0.2s ease;
}
.accordion-item-enter, .accordion-item-leave-to {
  height: 0 !important;
}
.activity-item{
  margin-bottom: 10px;
}
.activity-item:last-child{
  margin-bottom: 0;
}
.flex-container {
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  justify-content: normal;
  align-items: center;
  align-content: center;
}

.flex-items:nth-child(1) {
  display: block;
  flex-grow: 0;
  flex-shrink: 1;
  flex-basis: auto;
  align-self: auto;
  order: 0;
}

.flex-items:nth-child(2) {
  display: block;
  flex-grow: 0;
  flex-shrink: 1;
  flex-basis: auto;
  align-self: auto;
  order: 0;
  margin-left: 30px;
  width: 100%;
}

.collapsible {
  background-color: white;
  color: #000;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: 2px solid #000;
  text-align: left;
  outline: none;
  font-size: 15px;
  font-weight: bold;

}
.active, .collapsible:hover {
  background-color: rgb(250, 250, 250);
}

.accordion-content {
  margin-left: 43px;
  padding: 10px 10px;
  border-top: 0;
  background-color: var(--grey-100);
}
.round {
  position: relative;
}

.round label {
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 50%;
  cursor: pointer;
  height: 28px;
  left: 0;
  position: absolute;
  top: 0;
  width: 28px;
}

.round label:after {
  border: 2px solid #fff;
  border-top: none;
  border-right: none;
  content: "";
  height: 6px;
  left: 7px;
  opacity: 0;
  position: absolute;
  top: 8px;
  transform: rotate(-45deg);
  width: 12px;
}

.round input[type="checkbox"] {
  visibility: hidden;
}

.round input[type="checkbox"]:checked + label {
  background-color: #66bb6a;
  border-color: #66bb6a;
}

.round input[type="checkbox"]:checked + label:after {
  opacity: 1;
}
</style>