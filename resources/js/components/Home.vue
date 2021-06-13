<template>
<div>
    <Header @filter="filterLinks"/>
    <BookGrid :books="books" :sortTitle="sortTitle" :loading="loading"/>

</div>
</template>

<script>
import Header from './Header'
import BookGrid from './BooksGrid'
// import {eventBus} from '../../../../../../../Desktop/Emanuel/resources/eventbus'
export default {
    data() {
        return{
            books: [],
            pages: {
                current_page: 1,
                last_page: 1,
                total: 0
            },
            scrooling: false,
            loading: false,
            sortBy: 'new',
            sortTitleObj: {
                new: 'New Books',
                popular: 'Most Popular',
                picks: 'Our Picks'
            },
            sortTitle: 'New Books',
            isRunning: false
        }
    },

    methods: {
        filterLinks(filterName){
            if(filterName != this.sortBy && !this.isRunning){
                console.log(this.books)
                this.reset();
                this.sortBy = filterName;
                this.sortTitle = this.sortTitleObj[this.sortBy];
                this.fetchBooks(this.sortBy, this.pages.current_page);
            }
        },
        reset(){
            this.pages = {
                current_page: 1,
                last_page: 1,
                total: 0
            }
            this.books = [];
        },
        async fetchBooks(sortBy, current_page){
            try{
                this.isRunning = true;
                this.loading = true;
                console.log(this.loading)
                const res = await fetch(`api/books/sort?
                type=${this.sortBy}
                &page=${this.pages.current_page++}
                `);
                const data = await res.json();
                this.books = [...this.books, ...data.data.data];
                this.pages.last_page = data.data.last_page;
            } catch(err){
                console.log(err);
            } finally {
                this.isRunning = false;
                this.loading = false;
                //console.log(this.loading)
            }

        },
       handleScroll(event){
            (document.documentElement.scrollTop +
            window.innerHeight === document.documentElement.offsetHeight)?
            (
                (this.pages.current_page <= this.pages.last_page)?
                this.fetchBooks(this.sortBy, this.pages.current_page):null
            ):null;
       }
    },
    async beforeMount() {
        this.fetchBooks(this.sortBy, this.pages.current_page);
    },
    updated() {
        this.scrooling = true;
    },
    created(){
        window.addEventListener('scroll', this.handleScroll, 1);
    },
    destroyed(){
        window.removeEventListener('scroll', this.handleScroll);
    },
    mounted(){
        //eventBus.$on('search', (foo)=>{console.log(foo)})
    },
    components: { Header, BookGrid },

}
</script>
