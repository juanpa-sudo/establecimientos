<template>
    <div class="container">
        <div class="row">
            <div
                class="col-md-4"
                v-for="hotel in this.hotel"
                v-bind:key="hotel.id"
            >
                <div class="card shadow">
                    <img
                        :src="`/storage/${hotel.imagen_principal}`"
                        class="card-img-top"
                        :alt="`imagen del hotel ${hotel.nombre}`"
                    />
                    <div class="card-body">
                        <h2 class="card-title">{{ hotel.nombre }}</h2>
                        <p class="card-text">
                            {{ hotel.direccion }}, {{ hotel.barrio }}
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Horario:</span>
                            {{ hotel.apertura }}, {{ hotel.cierre }}
                        </p>
                        <router-link
                            :to="{
                                name: 'establecimiento',
                                params: { id: hotel.id }
                            }"
                        >
                            <a href="#" class="btn btn-primary d-block"
                                >Ver lugar</a
                            >
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    mounted() {
        axios
            .get("/api/categoria/hotel")
            .then(result => {
                this.$store.commit("ADD_HOTEL", result.data);
            })
            .catch(err => {
                console.error(err);
            });
    },
    computed: {
        hotel() {
            return this.$store.state.hotel;
        }
    }
};
</script>
