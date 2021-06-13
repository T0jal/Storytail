<template>

<div>
<Menu />
      <header>
        <h1 class="book-title bold text-center mt-5">{{book.title}}</h1>
        <BookHeaderLinks :isVideo="isVideo" :book="book"/>
      </header>
  <section class="container p-3 mt-5">
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item"
:src="book.video.video_url">
</iframe>
        </div></section>
</div>
</template>
<script>
    import Menu from './Menu'
    import BookHeaderLinks from './BookHeaderLinks'
export default { 
    props: ['book','isVideo'],
    components: {Menu, BookHeaderLinks}
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
</style>