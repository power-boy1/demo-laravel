import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        management: {
            route: null,
            deleteRoute: null,
            data: [],
            pagination: {
                perPage: 1,
                currentPage: 1,
                pages: 1,
                count: 0,
                nextPageUrl: null,
                prevPageUrl: null
            },
            modalConfirmDelete: false,
            modalText: null,
        }
    },
    actions: {
        updateList({commit}, {route}) {
            axios.get(route)
                .then((response) => {
                    commit('UPDATE_LIST', response.data.data);
                    commit('UPDATE_PAGINATE', response.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        deleteFromList({commit, dispatch}, {route, notify, routeUpdate}) {
            axios.delete(route)
                .then((response) => {
                    dispatch('updateList', {route: routeUpdate});
                    notify({
                        title: response.data.data.title,
                        message: response.data.data.text,
                        type: response.data.data.type
                    });
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        setCurrentPage({commit}, {pageNumber}) {
            commit('SET_CURRENT_PAGE', pageNumber);
        },
        setRoute({commit}, {route}) {
            commit('SET_ROUTE', route);
        },
        setDeleteRoute({commit}, {route}) {
            commit('SET_DELETE_ROUTE', route);
        },
        showModalConfirmDelete({commit}, {visible}) {
            commit('SHOW_MODAL_CONFIRM_DELETE', visible);
        },
        setConfirmDeleteText({commit}, {text}) {
            commit('SET_CONFIRM_DELETE_TEXT', text);
        }
    },
    mutations: {
        UPDATE_LIST(state, data) {
            state.management.data = data;
        },
        UPDATE_PAGINATE(state, data) {
            state.management.pagination.count = data.total;
            state.management.pagination.pages = Math.ceil(
                state.management.pagination.count / data.perPage
            );
            state.management.pagination.currentPage = data.currentPage;
            state.management.pagination.perPage = data.perPage;
            state.management.pagination.prevPageUrl = data.prevPageUrl;
            state.management.pagination.nextPageUrl = data.nextPageUrl;
        },
        SET_CURRENT_PAGE(state, pageNumber) {
            state.management.pagination.currentPage = pageNumber;
        },
        SET_ROUTE(state, route) {
            state.management.route = route;
        },
        SET_DELETE_ROUTE(state, route) {
            state.management.deleteRoute = route;
        },
        SHOW_MODAL_CONFIRM_DELETE(state, visible) {
            state.management.modalConfirmDelete = visible;
        },
        SET_CONFIRM_DELETE_TEXT(state, text) {
            state.management.modalText = text;
        }
    },
    getters: {
        getList(state) {
            return state.management.data;
        },
        getPagination(state) {
            return state.management.pagination;
        },
        getRoute(state) {
            return state.management.route;
        },
        getDeleteRoute(state) {
            return state.management.deleteRoute;
        },
        showModalConfirmDelete(state) {
            return state.management.modalConfirmDelete;
        },
        getConfirmDeleteText(state) {
            return state.management.modalText;
        }
    },
    modules: {}
});
