import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        cafe: [],
        restaurant: [],
        hotel: []
    },
    mutations: {
        ADD_COFFES(state, cafe) {
            state.cafe = cafe;
        },
        ADD_RESTAURANT(state, restaurant) {
            state.restaurant = restaurant;
        },
        ADD_HOTEL(state, hotel) {
            state.hotel = hotel;
        }
    }
});
