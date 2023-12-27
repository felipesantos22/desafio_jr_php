<template>
    <div>
        <h1>Desenvolvedor</h1>
        <h1>{{ nome }}</h1>
    </div>
</template>

<script lang="ts">
export default {
    name: 'SecondComponent',
    data() {
        return {
            nome: "PHP"
        }
    }
}
</script>