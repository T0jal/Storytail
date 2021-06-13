<template>
              <div class="shadow input-group input-group-lg">
              <input type="text" @keyup.enter="searchFunc" class="form-control" v-model="search" placeholder="Search book" aria-label="Search book" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button @click.prevent="searchFunc" class="shadow btn btn-orange" type="button"><i class="fas fa-search"></i></button>
              </div>
            </div>
</template>

<script>
//import {eventBus} from '../../eventbus'
export default {
    name: 'Search',
    data(){
      return{
        search: '',
        results: []
      }
      
    },
    methods: {
      async searchFunc(){
        const res = await fetch(`/api/books/search?s=${this.search}`);
        const data = await res.json();
        this.$router.push({
          name: 'Search',
          params: {search: this.search, results: data.data}
        })
        //eventBus.$emit('search', this.search)
      }
    }
}
</script>

<style>

</style>