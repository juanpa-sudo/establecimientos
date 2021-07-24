<template>
    <div class="container my-5">
        <h1>Cafe</h1>
        <div class="row">
            <div
                class="col-md-4 mt-4"
                v-for="cafe in this.cafe"
                v-bind:key="cafe.id"
            >
                <div class="card shadow">
                    <img
                        :src="`/storage/${cafe.imagen_principal}`"
                        class="card-img-top"
                        alt="Imagen del establecimiento del cafe"
                    />
                    <div class="card-body">
                        <h2 class="card-title">{{ cafe.nombre }}</h2>
                        <p class="card-text">
                            {{ cafe.direccion }}, {{ cafe.barrio }}
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Horario:</span>
                            {{ cafe.apertura }} - {{ cafe.cierre }}
                        </p>
                        <router-link
                            :to="{
                                name: 'establecimiento',
                                params: { id: cafe.id }
                            }"
                        >
                            <a href="#" class="btn btn-primary d-block"
                                >VER LUGAR</a
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
            .get("/api/categoria/cafe")
            .then(result => {
                this.$store.commit("ADD_COFFES", result.data);
            })
            .catch(err => console.log);
    },
    computed: {
        cafe() {
            return this.$store.state.cafe;
        }
    }
};
</script>
