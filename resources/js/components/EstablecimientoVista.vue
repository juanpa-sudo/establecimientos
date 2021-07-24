<template>
    <h1>Mi segunda ruta con los componentes de Vue</h1>
</template>
<script>
export default {
    mounted() {
        const { id } = this.$route.params;
        console.log(id);
    }
};
</script>
