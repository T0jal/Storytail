<template>
  <header>
      <Menu />
      <Hero />
      <NavFilter @filter="filter"/>

  </header>
</template>

<script>
import Menu from './Menu'
import Hero from './Hero'
import NavFilter from './NavFilter'
export default {
methods: { 
    filter(d){
      //console.log(d)
      this.$emit('filter', d);
    }
},
components: { Menu, Hero, NavFilter },
}
</script>

<style>

</style>