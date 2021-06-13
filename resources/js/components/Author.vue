<template>
  <div>
      <Menu/>
        <section id="author" class="container p-3">
        <div class="row">
          <div class="col-lg-3">
            <img class="card-img-top" :src="`images/${author.author_photo_url}`" alt="Card image cap">
          </div>
          <div class="col-lg-9">
            <h1 class="bold">{{author.first_name}} {{author.last_name}}</h1>
            <h4 class="bold">Nacionality 
              <span class="author-link">{{author.nationality}}</span>
            </h4>

            <p class="mt-4">{{author.description}}</p>
          </div>
        </div>
    </section>
    <section class="container books-grid">
        <h1 class="title my-5 text-center">My Books</h1>
        <!-- <div class="sort-filter py-3 d-flex justify-content-end">
            <span class="pr-3">Sort List</span>
            <a href="#" class="btn btn-orange" @click="sortList"><i class="fas fa-sort"></i></a>
        </div> -->
        <div class="section-body">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-12" v-for="book in author.books" :key="book.id">
                    <Book :book="book"/>
                </div>
            </div>
        </div>
    </section>
  </div>
</template>

<script>
import Menu from './Menu'
import Book from './Book'
export default {
    props: ['id'],
    data(){
        return{
            author: []
        }
    },
    methods: {
        async fetchBook(id){
        const res = await fetch(`/api/authors/${id}`);
        const data = await res.json();
        console.log(data)
        return data.data;
        },
    },
    async mounted(){
        this.author = await this.fetchBook(this.id)
    },
    components: {Menu, Book},
}
</script>

<style scoped>
section{
    background: #fff;
}
#author{
    margin-top: 100px;
}
.author-link{
  color: var(--orange-100);
}
</style>