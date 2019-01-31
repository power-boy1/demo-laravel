<template>
    <div class="modal">
        <transition v-if="showModal" name="modal">
            <div class="modal-mask" @click="outsideModalClose">
                <div class="modal-wrapper" @click="outsideModalClose">
                    <div class="modal-container">
                        <button class="modal-close" @click="closeModal">
                            Х
                        </button>
                        <div class="modal-body">
                            <div>
                                {{ modalText }} <br/>
                                <a href="#" @click="confirmDelete">
                                    <el-button type="primary">
                                        Yes
                                    </el-button>
                                </a>

                                <el-button type="default" @click="closeModal">
                                    Cancel
                                </el-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        computed: {
            showModal() {
                return this.$store.getters.showModalConfirmDelete;
            },
            modalText() {
                return this.$store.getters.getConfirmDeleteText;
            }
        },
        methods: {
            outsideModalClose(e) {
                if (e.target.classList.contains("modal-wrapper")) {
                    this.$store.dispatch('showModalConfirmDelete', {visible: false});
                }
            },
            closeModal() {
                this.$store.dispatch('showModalConfirmDelete', {visible: false});
            },
            confirmDelete() {
                let routeDelete = this.$store.getters.getDeleteRoute;
                let route = this.$store.getters.getRoute;
                this.$store.dispatch('deleteFromList', {route: routeDelete, notify: this.$notify, routeUpdate: route});
                this.closeModal();
            }
        }
    }
</script>