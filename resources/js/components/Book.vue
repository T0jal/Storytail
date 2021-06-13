<template>

<div class="card m-3">   
    <i :class="[(isActive)?'fas fa-heart':'far fa-heart notactive']" v-if="isLoggedIn" @click="addFavourite(book.id)"></i>
            <div class="card-title">
                <h3>{{book.title}}</h3>
            </div>
            <img class="card-img-top" :src="'/images/'+book.cover_url" @error="imageError" alt="Loading..">
            <div class="card-body d-flex justify-content-center">
                <router-link :to="{name: 'BookDetails', params:{id: book.id}}" class="btn btn-orange btn-sm">Read</router-link>
            </div>
</div>  
</template>

<script>
export default {
    name: 'Book',
    props: {
        book: null,
    },
    data(){
        return{
            isActive: null
        }
    },
    methods:{
        imageError(event){
            event.target.src = 'images/baseImages/loading.gif'
        },
        async fetchFavourite(){
            const res = await this.$http.get(`/api/user/bookFavourite/${this.book.id}`)
            .then(res => res.data);
            return res.data;
        },
        addFavourite(id){
            if(!this.isActive){
                let res = this.$http.post(`/api/user/saveFavourite/`, {book_id:id})
                .then((res)=>{
                    console.log('book added to fav ' + id)
                    console.log(res)
                })
            } else{
                const res = this.$http.delete(`/api/user/deleteFavourite/${id}`)
                .then(res => {
                    console.log('book removed from fav ' + id)
                    console.log(res)
                });
            }
            this.$swal({
                heightAuto: false,
                html: (!this.isActive)?'<i class="fas fa-heart" style="color:red"></i> Added to favourites':'<i class="far fa-heart" style="color:red"></i> Removed favourites',
                showConfirmButton: false,
                timer: 850
            }).then(()=>{
                this.isActive = (this.isActive)?false:true; 
            })
        }
    },
    computed: {
    isLoggedIn : function(){ return this.$store.getters.isLoggedIn},
    },
    async created(){
        this.isActive = await this.fetchFavourite();
    }
}
</script>

<style scoped>
.card-title h3{
    display: inline-block;
}
.card >i{
    position: absolute;
    right: 0;
    margin: 6px;
    padding: 6px;
    background-color: var(--orange-100);
    border-radius: 5px;
}
.fas.fa-heart,.far.fa-heart{
    font-size: 24px;
    color: white;
    cursor: pointer;
}
.notactive{
    display: none;
}

.card:hover i{
    display: block;
}
</style>