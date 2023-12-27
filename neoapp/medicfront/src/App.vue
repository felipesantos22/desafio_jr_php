<template>
  <FirstComponent />
  <SecondComponent/>
</template>









<script lang="ts">
import FirstComponent from './components/FirstComponent.vue';
import SecondComponent from './components/SecondComponent.vue'
export default {
  name: 'App',
  components: {
    FirstComponent,
    SecondComponent
  }
}
</script>