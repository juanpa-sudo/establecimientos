<template lang="pug">
<div>
        <categori-cafe></categori-cafe>
        <categoria-restaurant></categoria-restaurant>
        <categoria-hotel></categoria-hotel>
</div>
</template>
<script>
import CategoriCafe from "./CategoriCafe.vue";
import CategoriaRestaurant from "./CategoriaRestaurant.vue";
import CategoriaHotel from "./CategoriaHotel.vue";
export default {
    components: {
        CategoriCafe,
        CategoriaRestaurant,
        CategoriaHotel
    },
    setup() {}
};
</script>
