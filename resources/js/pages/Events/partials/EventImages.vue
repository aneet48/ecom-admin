<template>
  <div class="text-center">


  </div>
</template>

<script>
export default {
  props: ["images", "pmModal"],
  methods:{
      modelToggle(){
          this.$emit('modalToggle')
      }
  }
};
</script>

<style>
</style>
