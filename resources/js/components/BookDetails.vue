<template>
<div>
    <Menu />
      <header>
        <h1 class="book-title bold text-center mt-5">{{book.title}}</h1>
        <BookHeaderLinks :isVideo="isVideo" :book="book"/>
      </header>
  <section class="container p-3 mt-5">
        <div class="row">
          <div class="col-lg-3">
            <img class="card-img-top" :src="`images/${book.cover_url}`" alt="Card image cap">
          </div>
          <div class="col-lg-9">
            <h1 class="bold">{{book.title}}</h1>
            <h4 class="bold">From
              <router-link :to="{name: 'Author', params:{id: author.id}}" class="author-link" v-for="author in book.authors" :key="author.id">{{author.first_name}} {{author.last_name}}</router-link>
            </h4>
            <div class=" row book-info">
              <div class="col-auto">
                <span v-for="(star, index) in ratingStars" :key="index">
                    <span v-if="star===1" class="fa fa-star checked"></span>
                    <span v-if="star===2" class="fa fa-star-half-alt checked"></span>
                    <span v-if="star===0" class="fa fa-star"></span>
                </span>
                <!-- {{rating.ratingInfo}} ({{rating.ratingCount}}) votes -->
              </div>
              <div class="col-auto">
                <i class="fas fa-book"></i> {{pages}} pages
              </div>
              <div class="col-auto">
                <i class="far fa-clock"></i> {{book.read_time}} minutes
              </div>
              <div class="col-auto">
                <i class="fas fa-video"></i> {{(isVideo)?'Yes': 'No'}}
              </div>
            </div>
            <p class="mt-4">{{book.description}}</p>
          </div>
        </div>
        <div class="book-read-btn">
          <router-link :to="{name: 'BookRead', params:{id: book.id, book: book}}" class="btn btn-orange btn-lg">Read Now</router-link>
            </div>
    </section>
  </div>
</template>

<script>
import Menu from './Menu'
import Hero from './Hero'
import BookHeaderLinks from './BookHeaderLinks'
export default {
  components: {Menu, Hero, BookHeaderLinks},
  props: ['id'],
  data(){
    return{
      book: [],
      pages: null,
      video: false,
      readTime: 0,
      rating: {},
      ratingStars: [],
      isVideo: false,
      video_url: null
    }
  },
  methods: {
    async fetchBook(id){
      const res = await fetch(`/api/books/${this.id}`);
      const data = await res.json();
      console.log(data)
      return data.data;
    },
    CalcRating(){
      let sum = 0;
      let count = 0;
      this.book.user_reads.forEach(element => {
        sum += element.book_user_read.rating;
        count++;
        console.log(count, element.book_user_read.rating)
      });
      let intPart = parseInt(sum/count);
      let decPart = ((sum/count)%1);
      if(decPart > 0.5){
        decPart = 1;
      } 
      else if(decPart < 0.5){
        decPart = 0
      } else {
        decPart = 0.5;
      }

      this.rating = {
        ratingInfo: (intPart + decPart),
        ratingCount: count
      }
      let control = 0;
      for (let i = 1; i <= 5; i++) {
        control = (this.rating.ratingInfo - i);
        if(control>=0)
          this.ratingStars.push(1);
        else if(control==-0.5)
          this.ratingStars.push(2);
        else 
          this.ratingStars.push(0);
      }
      console.log(this.ratingStars)

    }
  },
  async mounted(){
    this.book = await this.fetchBook(this.id);
    console.log(this.book.pages, this.book.pages.length)
    this.video_url = (this.book.video != null)? this.book.video.video_url : null;
    this.pages = this.book.pages.length;
    this.CalcRating();
    (this.video_url != null)?this.isVideo = true: this.isVideo = false;
  }
}
</script>

<style scoped>
section{
  background: #fff;
}
header{
  background-color: #fff;
}
header h1{
  padding: 50px 0;
}
.author-link{
  color: var(--orange-100);
  font-size: 0.8em;
}
.author-link:after {
   content: ", ";
}
.author-link:last-child:after {
   content: "";
}
.book-info{
  text-align: left;
}
.book-info div:first-child{
  text-align: left;
}
.book-info .checked {
  color: yellow;
}
.book-read-btn{
  text-align: center;
}
.book-title {
  color: #000;
}

ul {
  background-color: var(--orange-100);
}

.nav-item a.nav-link{
  color: #fff;
}

</style>