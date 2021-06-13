<template>
  <ul class="nav justify-content-center nav-filter">
        <li class="nav-item">
          <a :class="[this.activeIndex === 0? 'active':'', 'nav-link ']" href="#" @click="filter('new'), activeItem(0)">New Books</a>
        </li>
        <!-- <li class="nav-item">
          <a :class="[this.activeIndex === 1? 'active':'', 'nav-link ']" href="#" @click="filter('picks'), activeItem(1)">Our Picks</a>
        </li> -->
        <li class="nav-item">
          <a :class="[this.activeIndex === 2? 'active':'', 'nav-link ']" href="#" @click="filter('popular'), activeItem(2)">Most Popular</a>
        </li>
    </ul>
</template>

<script>
export default {
    name: 'NavFilter',
    data() {
      return {
        activeIndex: 0
      }
      
    },
    methods: {
      filter(d){
        this.$emit('filter', d);
      },
      activeItem(n){
        this.activeIndex = n;
      }
    },
}
</script>

<style>

</style>