<template>
<div>
  <h1 class="title text-center">FAVOURITE BOOKS</h1>
  <div class="container">
  <div class="row">
    <div class="col-12">
		<table class="table table-image">
		  <thead>
		    <tr>
		      <th scope="col">Cover</th>
		      <th scope="col">Title</th>
		      <th scope="col">Read Time</th>
		      <th scope="col">Options</th>
		    </tr>
		  </thead>
              <transition-group name="fade" tag="tbody">
		    <tr v-for="favourite in books" :key="favourite.id">
		      <td class="w-25">
			      <img :src="`images/${favourite.cover_url}`" class="img-fluid img-thumbnail" :alt="favourite.cover_url" width="100">
		      </td>
		      <td>{{favourite.title}}</td>
		      <td><strong>{{favourite.read_time}}</strong> min.</td>
		      <td><router-link :to="{name: 'BookDetails', params:{id: favourite.book_id}}" class="btn btn-sm btn-orange">Read now</router-link> <button class="btn btn-sm btn-danger" @click="remove(favourite.book_id)"><i class="fas fa-times"></i></button></td>
		    </tr>
              </transition-group>
		</table>   
    </div>
  </div>
</div>
</div>
</template>

<script>
export default {
    data() {
        return{
            books: [],
            error: null
        }
    },
    methods:{
        async fetchFavourites(){
            const res = await this.$http.get(`/api/user/getFavourites/`)
            .then(res => res.data);
            return res.data;
        },
        async remove(book_id){
            const res = await this.$http.delete(`/api/user/deleteFavourite/${book_id}`)
            .then(res => {
                this.books = this.books.filter(function( obj ) {
                return obj.book_id !== book_id;
            });
            });
        }
    },
    async mounted(){
        this.books = await this.fetchFavourites()
    }
}
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
.title{
    margin-bottom: 60px;
}
.container {
  padding: 2rem 0rem;
}

h4 {
  margin: 2rem 0rem 1rem;
}

.table-image td, th {
    vertical-align: middle;
}

</style>