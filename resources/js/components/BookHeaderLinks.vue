<template>
<div>
      <ul class="nav justify-content-center nav-filter">
        <li class="nav-item">
          <router-link :to="{name: 'BookDetails', params:{id: book.id}}" class="nav-link">About this Book</router-link>
        </li>
        <li class="nav-item">
          <router-link :to="{name: 'BookRead', params:{id: book.id, book: book}}" class="nav-link">Read Now</router-link>
        </li>
        <li class="nav-item" v-show="isVideo">
          <router-link :to="{name: 'BookVideo', params:{book: book, isVideo:isVideo}}" class="nav-link">Watch Video</router-link>
        </li>
        <li class="nav-item">
          <router-link :to="{name: 'Activities', params:{book: book, id: book.id, isVideo:isVideo}}" class="nav-link">Tail it Yourself</router-link>
        </li>
    </ul>
</div>
</template>

<script>
export default {
    props: ['book', 'isVideo']
}
</script>

<style scoped>
.nav {
    background-color: var(--orange-200);
}
.nav a{
    color: #fff;
    text-decoration: none;
}
.nav a:hover{
    color: #fff;
    text-decoration: none;
}

</style>