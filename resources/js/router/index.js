import Vue from "vue";
import VueRouter from "vue-router";
import InicioEstablecimiento from "../components/InicioEstablecimiento";
import EstablecimientoVista from "../components/EstablecimientoVista";
const routes = [
    {
        path: "/",
        component: InicioEstablecimiento
    },
    {
        path: "/establecimiento/:id",
        name: "establecimiento",
        component: EstablecimientoVista
    }
];

const router = new VueRouter({ mode: "history", routes });

Vue.use(VueRouter);

export default router;
