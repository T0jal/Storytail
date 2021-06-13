<template>
      <div class="hero">
      <div class="content container">
        <div class="row">
          <div class="col-md-6 offset-md-3 col-sm-12">
            <h1 class="bold text-center">Find a Book</h1>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-md-6 offset-md-3 col-sm-12">
              <Search/>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
import Search from './Search'
export default {
    components: {Search}
}
</script>

<style>

</style>