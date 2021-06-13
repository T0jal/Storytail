<template>
<div>
    <Menu />
    <div class="search">
        <div class="shadow input-group input-group-lg">
              <input type="text" @keyup.enter="searchFunc" class="form-control" v-model="search" placeholder="Search book" aria-label="Search book" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button @click.prevent="searchFunc" class="shadow btn btn-orange" type="button"><i class="fas fa-search"></i></button>
              </div>
            </div>
        <div class="mt-3">Results for: {{search}}</div>
    </div>
    <BookGrid :books="books" :sortTitle="sortTitle" :loading="loading"/>
</div>
</template>

<script>
import Menu from './Menu'
import BookGrid from './BooksGrid'
export default {
    data(){
        return{
            filterLinks: 'New',
            sortTitle: null,
            scrooling: false,
            loading: false,
            isRunning: false,
            books: []
        }
    },
    props: ['search', 'results'],
    components: {BookGrid, Menu},
    methods: {
        async searchFunc(){
            const res = await fetch(`/api/books/search?s=${this.search}`);
            const data = await res.json();
            this.books = data.data;
        }
    },
    mounted(){
        this.books = this.results;
    }
}
</script>

<style scoped>
.search{
    width: 50%;
    padding: 150px 0 0 0;
    margin: 0 auto;
}
</style>