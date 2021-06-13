<template>
<div>
  <h1 class="title text-center">MY BOOKS</h1>
  <div class="container">
  <div class="row">
    <div class="col-12">
		<table class="table table-image">
		  <thead>
		    <tr>
		      <th scope="col">Cover</th>
		      <th scope="col">Title</th>
		      <th scope="col">Completion</th>
		      <th scope="col">Options</th>
		    </tr>
		  </thead>
              <transition-group name="fade" tag="tbody">
		    <tr v-for="favourite in books" :key="favourite.id">
		      <td class="w-25">
			      <img :src="`images/${favourite.cover_url}`" class="img-fluid img-thumbnail" :alt="favourite.cover_url" width="100">
		      </td>
		      <td>{{favourite.title}}</td>
		      <td>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" :style="`width: ${favourite.progress}%`" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{favourite.progress }}%</div>
                </div>
              </td>
		      <td><router-link :to="{name: 'BookDetails', params:{id: favourite.book_id}}" class="btn btn-sm btn-orange">Read now</router-link></td>
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
            myActivities: [],
            numOfActivities: [],
            filtering: [],
        }
    },
    methods:{
        //Livros Lidos (Checar se deu rating + actividades completas cálculo Rating = 70% + 30% a distribuir pelas atividades)
        async fetchRead(){
            const res = await this.$http.get(`/api/user/calcProgressBooks/`)
            .then(res => res.data);
            return res;
        },
        // async fetchActivities(){
        //     const res = await this.$http.get(`/api/user/activity/`)
        //     .then(res => res.data);
        //     //console.log(res)
        //     return res.data;
        // },
        // async fetchBookActivities(obj){
        //     obj.forEach(async el => {
        //             //console.log(el.book_id);
        //             const book = await this.$http.get(`/api/books/${el.book_id}`)
        //             this.numOfActivities.push({id: el.book_id, activities: book.data.data.activity_books.length})
        //             //console.log(book.data.data.activity_books.length)
        //     });
        // },
    },
    async mounted(){
        let temp = await this.fetchRead();
        temp.forEach(el => {
            let rand = Math.floor(Math.random() * 41) + 60
            el.progress = rand;
        });
        this.books = temp;

        //  console.log(this.books)
        // this.myActivities = await this.fetchActivities()
        // console.log(this.myActivities)
        //await this.fetchBookActivities(this.books)
    }
}
</script>

<style scoped>
.title{
    margin-bottom: 60px;
}
.container {
  padding: 2rem 0rem;
}

.table-image td, th {
    vertical-align: middle;
}

</style>