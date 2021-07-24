<template>
    <div class="container my-5">
        <h1>Restaurante</h1>
        <div class="row">
            <div
                class="col-md-4 mt-4"
                v-for="restaurante in this.restaurant"
                v-bind:key="restaurante.id"
            >
                <div class="card shadow">
                    <img
                        :src="`/storage/${restaurante.imagen_principal}`"
                        class="card-img-top"
                        alt="..."
                    />
                    <div class="card-body">
                        <h2 class="card-title">{{ restaurante.nombre }}</h2>
                        <p class="card-text">
                            {{ restaurante.direccion }},
                            {{ restaurante.barrio }}
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Horario:</span>
                            {{ restaurante.apertura }},
                            {{ restaurante.cierre }}
                        </p>
                        <router-link
                            :to="{
                                name: 'establecimiento',
                                params: { id: restaurante.id }
                            }"
                        >
                            <a href="#" class="btn btn-primary d-block"
                                >ver lugar</a
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
            .get("/api/categoria/restaurante")
            .then(result => {
                this.$store.commit("ADD_RESTAURANT", result.data);
            })
            .catch(err => {
                console.log(err);
            });
    },
    computed: {
        restaurant() {
            return this.$store.state.restaurant;
        }
    }
};
</script>
