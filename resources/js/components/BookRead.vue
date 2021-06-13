<template>
<div>
<Menu />
  <flipbook class="flipbook" :key="forceRendering" :startPage="startingPage" :singlePage="forceRendering" :pages="pages"  v-slot="flipbook">
    <div class="action-bar">
      <button
      class="btn-orange btn left"
      :class="{ disabled: (flipbook.page<=2) }"
      @click="flipBtn(flipbook.flipLeft, flipbook.page-1, flipbook.numPages)"
      ><i class="fas fa-caret-left"></i></button>
      <button
      class="btn-orange btn plus"
      :class="{ disabled: !flipbook.canZoomIn }"
      @click="flipbook.zoomIn"
      ><i class="fas fa-plus"></i></button>
  <!-- <span class="page-num">
  Page {{ flipbook.page }} of {{ flipbook.numPages }}
  </span> -->
      <button
      class="btn-orange btn minus"
      :class="{ disabled: !flipbook.canZoomOut }"
      @click="flipbook.zoomOut"
      ><i class="fas fa-minus"></i></button>
      <button
      class="btn-orange btn right"
      :class="{ disabled: (flipbook.page >= flipbook.numPages) }"
      @click="flipBtn(flipbook.flipRight, flipbook.page+1, flipbook.numPages)"
      ><i class="fas fa-caret-right"></i></button>
      <button v-show="flipbook.page>1"
      class="btn-orange btn audio"
      @click="startAudio(flipbook.page, flipbook.numPages)"
      ><i :class="[(isAudio)?'fas fa-volume-mute':'fas fa-volume-up']"></i></button>
      <!-- <button class="btn-black btn minus" v-show="flipbook.page == flipbook.numPages" @click="finishBook()">Finish Read</button> -->
      <button class="btn-black btn minus" v-show="((flipbook.page+1)>=flipbook.numPages)" @click="finishBook()">Finish Read</button>
    <!-- <span class="page-num">
  Page {{ flipbook.page }} of {{ flipbook.numPages }}
  </span>         -->
    </div>
  </flipbook>
  </div>
</template>

<script>
import StarRating from 'vue-star-rating'
import Flipbook from 'flipbook-vue'
import Menu from './Menu'
export default {
  props: ['id', 'book'],
  data(){
    return{
      pages: [],
      audios: [],
      isAudio: false,
      forceRendering: false,
      startingPage: 1,
      audio: new Audio()
    }
  },
  methods: {
    async finishBook(){
      //if(this.$store.getters.isLoggedIn){
        //let JWTToken = localStorage.getItem('token');
        this.$http
          .get(`/api/user/bookRead/${this.id}`)
          .then(res => {
              console.log('Session user', localStorage.getItem('userInfo'));
              console.log('Already rated? ', res.data.data)
              console.log('Valid Token?' , !(!!res.data.status))
            //axios.defaults.headers.common['Authorization'] = token
          //check if user already rate the book or not and if has a valid token
            if(res.data.data !== true && !(!!res.data.status)){
              this.$swal({
                html: `
                      <h4><span style="color: var(--orange-200)">You’ve finished the book, congratulations</span> <strong>${JSON.parse(localStorage.getItem('userInfo')).user_name}</strong>!</h4>
                      <div>How much did you like this book?</div>
                      <div>Please let us know by leaving a rating below.</div>
                        <div class="d-flex justify-content-center pt-3">
                          <div class="rate" id="myRadios">
                            <input type="radio" id="star5" name="rate" value="5" />
                            <label for="star5" title="text">5 stars</label>
                            <input type="radio" id="star4" name="rate" value="4" />
                            <label for="star4" title="text">4 stars</label>
                            <input type="radio" id="star3" name="rate" value="3" />
                            <label for="star3" title="text">3 stars</label>
                            <input type="radio" id="star2" name="rate" value="2" />
                            <label for="star2" title="text">2 stars</label>
                            <input type="radio" id="star1" name="rate" value="1" />
                            <label for="star1" title="text">1 star</label>
                          </div>
                        </div>`,
                confirmButtonText: 'Thanks!',
                showCancelButton: false,
                preConfirm: function() {
                  return new Promise((resolve, reject) => {
                    // get your inputs using their placeholder or maybe add IDs to them
                    resolve({
                      checked_item: $('input[name=rate]:checked', '#myRadios').val(),
                    });
                      // maybe also reject() on some condition
                  });
                }
              }).then((data) => {
                // your input data object will be usable from here
                if(!!data.value.checked_item){
                  const _data = {
                    book_id: this.id,
                    rating: data.value.checked_item
                  }
                  axios.post('api/user/bookRead', _data)
                  .then((res) => {
                    //axios.defaults.headers.common['Authorization'] = token
                    console.log(res.data)
                  })
                  .catch((error) => {
                    console.error(error)
                  })
                }
              });
            }
            else if(res.data.data === true){
              this.$swal({
                 html: `
                      <h4 style="color: var(--orange-200)">You've already rated this book</h4>`,
                type: 'warning',
                showCancelButton: false,
                confirmButtonText: 'close',
                showCloseButton: true,
                showLoaderOnConfirm: true
              })
            } else {
              this.$swal({
                html: `<h4 style="color: var(--orange-200)">You're not logged in</h4>`,
                type: 'warning',
                showCancelButton: false,
                confirmButtonText: 'Login',
                showCloseButton: true,
                showLoaderOnConfirm: true
              }).then((result) => {
                if(result.value) {
                  this.$router.push('/login')
                } 
                // else {
                //   this.$swal('Cancelled', 'Your file is still intact', 'info')
                // }
              })
            }
          })
          .catch(error => console.log(error))
      //} 
      
    },
    createBook(){
      this.pages.push(null)
      this.pages.push(`images/${this.book.cover_url}`)
      this.book.pages.forEach(el => {
        this.audios.push(`audios/${el.audio_url}`)
        this.pages.push(`images/${el.page_image_url}`)
      });
    },
    playAudio(url){
      return new Promise((resolve,reject)=>{
        let audio = this.audio;
        audio.preload = "auto";                      // intend to play through
        audio.autoplay = true;                       // autoplay when loaded
        audio.onerror = reject;                      // on error, reject
        audio.onended = resolve;                     // when done, resolve
        audio.src = url;
      })
    },
    startAudio(page,pages){
      if(this.forceRendering){
        if(page > 1 && page <= pages){
          this.isAudio = (this.isAudio)?false:true;
          if(this.isAudio){
            this.playAudio(this.audios[page-2]);
          } else{
          this.audio.pause();
          }
        }
      } else{
        this.startingPage = page
        this.forceRendering = true
        this.isAudio = (this.isAudio)?false:true
        if(this.isAudio){
            this.playAudio(this.audios[page-2]);
          } else{
          this.audio.pause();
          }
      }
    },
    flipBtn(flip,page,pages){
      console.log(page)
      if(this.isAudio){
        this.audio.pause();
        this.playAudio(this.audios[page-2]);
      }
      return flip()
    }
  },
  mounted(){
    this.createBook();
  },    
  components: {Flipbook, Menu}
}
</script>

<style scoped>
#b{
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  color: #ccc;
  overflow: hidden;
}

a {
  color: inherit;
}
.btn-black{
  background-color: #000;
  color: #fff;
  font-weight: 600;
}
.action-bar {
  width: 100%;
  height: 30px;
  padding: 100px 0 30px 0;
  display: flex;
  justify-content: center;
  align-items: center;
}
.action-bar .btn {
  font-size: 12px;
}
.action-bar .btn svg {
  bottom: 0;
}
.action-bar .btn:not(:first-child) {
  margin-left: 10px;
}
.has-mouse .action-bar .btn:hover {
  color: #ccc;
  filter: drop-shadow(1px 1px 5px #000);
  cursor: pointer;
}
.action-bar .btn:active {
  filter: none !important;
}
.action-bar .btn.disabled {
  color: #fff;
  pointer-events: none;
}
.action-bar .page-num {
  font-size: 12px;
  margin-left: 10px;
}
.flipbook  {
  width: 90vw;
  height: calc(100vh - 200px);
}
.flipbook .bounding-box {
  box-shadow: 0 0 20px #000;
}
</style>