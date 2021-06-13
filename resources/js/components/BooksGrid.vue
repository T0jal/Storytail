<template>
<div>
    <section class="container books-grid">
        <h1 class="title my-5 text-center">{{sortTitle}}</h1>
        <!-- <div class="sort-filter py-3 d-flex justify-content-end">
            <span class="pr-3">Sort List</span>
            <a href="#" class="btn btn-orange" @click="sortList"><i class="fas fa-sort"></i></a>
        </div> -->
        <div class="section-body">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-12" v-for="book in books" :key="book.id">
                    <Book :book="book" :loading="loading"/>
                </div>
                <transition name="fade">
                    <div class="loading" v-show="loading">
                        <span class="fa fa-spinner fa-spin"></span>Loading
                    </div>
                </transition>
            </div>
        </div>
    </section>
    </div>
</template>

<script>
import Book from './Book'
export default {
    components: {Book},
    props: {
        books: null,
        sortTitle: String,
        loading: Boolean
    },
    methods: {
    }
}
</script>

<style>

</style>