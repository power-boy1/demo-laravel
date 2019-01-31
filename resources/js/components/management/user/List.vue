<template>
    <div>
        <el-row>
            <table class="table">
                <tr class="table-heading">
                    <th class="table-heading-col"
                        :class="{
                         'orderByDesc': sort.sort && sort.column === 'id' && sort.desc,
                         'orderByAsc': sort.sort && sort.column === 'id' && !sort.desc
                         }"
                        @click="byFilter('id')">ID</th>
                    <th class="table-heading-col"
                        :class="{
                         'orderByDesc': sort.sort && sort.column === 'name' && sort.desc,
                         'orderByAsc': sort.sort && sort.column === 'name' && !sort.desc
                         }"
                        @click="byFilter('name')">Name</th>
                    <th class="table-heading-col"
                        :class="{
                         'orderByDesc': sort.sort && sort.column === 'email' && sort.desc,
                         'orderByAsc': sort.sort && sort.column === 'email' && !sort.desc
                         }"
                        @click="byFilter('email')">Email</th>
                    <th class="table-heading-col"
                        :class="{
                         'orderByDesc': sort.sort && sort.column === 'created_at' && sort.desc,
                         'orderByAsc': sort.sort && sort.column === 'created_at' && !sort.desc
                         }"
                        @click="byFilter('created_at')">Created at</th>
                    <th class="table-heading-col"
                        :class="{
                         'orderByDesc': sort.sort && sort.column === 'updated_at' && sort.desc,
                         'orderByAsc': sort.sort && sort.column === 'updated_at' && !sort.desc
                         }"
                        @click="byFilter('updated_at')">Updated at</th>
                    <th class="table-heading-col disabled">Actions</th>
                </tr>
                <tr v-for="item in list" class="table-row">
                    <td class="table-col">{{ item.id }}</td>
                    <td class="table-col dotted"><a class="link" :href="item.linkDetails">{{ item.name }}</a></td>
                    <td class="table-col">{{ item.email }}</td>
                    <td class="table-col" v-if="item.createdAt">{{ item.createdAt }}</td>
                    <td class="table-col" v-else>Not set</td>
                    <td class="table-col" v-if="item.updatedAt">{{ item.updatedAt }}</td>
                    <td class="table-col" v-else>Not set</td>
                    <td class="table-col table-controls">
                        <div class="table-actions">
                            <a :href="item.linkEdit">
                                <el-button type="primary" icon="el-icon-edit" circle></el-button>
                            </a>
                            <el-button @click="deleteItem(item.linkDelete)" type="danger" icon="el-icon-delete"
                                       circle></el-button>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="management_paginator" v-if="paginate.count > paginate.perPage">
                <span v-if="paginate.prevPageUrl" @click="prev">< Prev</span>
                <span v-else>-</span>
                <template v-for="page in paginate.pages">
                <span :class="{current_page: paginate.currentPage === page}"
                      @click="onPage" :data-page="page">{{ page }}</span>
                </template>
                <span v-if="paginate.nextPageUrl" @click="next">Next ></span>
                <span v-else>-</span>
            </div>
        </el-row>
    </div>
</template>

<script>
    export default {
        props: {
            route: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                sort: {
                    sort: false,
                    column: '',
                    desc: false
                },
                pagination: {
                    param: 'page=1'
                },
                filter: {
                    items: [],
                    loading: false,
                    param: ''
                },
                selectName: [],
                query: this.route,
            }
        },
        created() {
            this.$store.dispatch('setRoute', {route: this.route});

            this.$store.dispatch('updateList', {route: this.route});
        },
        computed: {
            list() {
                return this.$store.getters.getList;
            },
            paginate() {
                return this.$store.getters.getPagination;
            }
        },
        methods: {
            prev() {
                let param = this.paginate.prevPageUrl.split('?');
                this.pagination.param = param[1];
                this.$store.dispatch('setRoute', {route: this.queryBuild()});
                this.$store.dispatch('updateList', {route: this.queryBuild()});
            },
            next() {
                let param = this.paginate.nextPageUrl.split('?');
                this.pagination.param = param[1];
                this.$store.dispatch('setRoute', {route: this.queryBuild()});
                this.$store.dispatch('updateList', {route: this.queryBuild()});
            },
            onPage(e) {
                let pageNumber = e.target.getAttribute('data-page');
                this.pagination.param = 'page=' + pageNumber;
                this.$store.dispatch('setCurrentPage', {pageNumber: pageNumber});
                this.$store.dispatch('setRoute', {route: this.queryBuild()});
                this.$store.dispatch('updateList', {route: this.queryBuild()});
            },
            queryBuild() {
                this.query = this.route;
                this.query = this.query + '?' + this.pagination.param;
                if (this.sort.sort) {
                    this.query = this.query + '&orderBy=' + this.sort.column;
                    if (this.sort.desc) {
                        this.query = this.query + '&desc=true'
                    }
                }
                return this.query;
            },
            byFilter(column) {
                if (this.sort.sort && this.sort.column === column) {
                    if (this.sort.desc) {
                        this.sort.sort = false;
                        this.sort.desc = false;
                    } else {
                        this.sort.desc = true;
                    }
                } else {
                    this.sort.sort = true;
                    this.sort.desc = false;
                }
                this.sort.column = column;

                this.$store.dispatch('setRoute', {route: this.queryBuild()});
                this.$store.dispatch('updateList', {route: this.queryBuild()});
            },
            deleteItem(route) {
                this.$store.dispatch('setConfirmDeleteText', {text: 'Are you sure you want to delete the item?'});
                this.$store.dispatch('setDeleteRoute', {route: route});
                this.$store.dispatch('showModalConfirmDelete', {visible: true});
            }
        }
    }
</script>
