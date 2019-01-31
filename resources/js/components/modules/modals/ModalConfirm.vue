<template>
    <div>
        <a href="#" @click="showModal">
            <el-button type="danger">
                Delete
            </el-button>
        </a>

        <div class="modal">
            <transition v-if="isVisible" name="modal">
                <div class="modal-mask" @click="outsideModalClose">
                    <div class="modal-wrapper" @click="outsideModalClose">
                        <div class="modal-container">
                            <button class="modal-close" @click="hideModal">
                                Х
                            </button>
                            <div class="modal-body">
                                <div>
                                    {{ text }} <br/>
                                    <form ref="formDelete" name="formDelete" :action="routeDelete" method="post">
                                        <input type="text" name="id" :value="id" hidden>
                                        <input type="text" name="_token" :value="csrf_token" hidden>
                                        <el-button @click="onSubmit" type="primary">
                                            Yes
                                        </el-button>

                                        <el-button type="default" @click="hideModal">
                                            Cancel
                                        </el-button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
    import blockScroll from '../../../utils/blockScroll';

    export default {
        props: {
            routeDelete: {
                type: String,
                required: true
            },
            text: {
                type: String
            },
            id: {
                type: String,
                require: true
            },
            csrf_token: {
                type: String,
                require: true
            }
        },
        data() {
            return {
                isVisible: false
            }
        },
        methods: {
            onSubmit() {
                this.$refs.formDelete.submit();
            },
            showModal() {
                this.isVisible = true;
                blockScroll(this.isVisible);
            },
            hideModal() {
                this.isVisible = false;
                blockScroll(this.isVisible);
            },
            outsideModalClose(e) {
                if (e.target.classList.contains("modal-wrapper")) {
                    this.isVisible = false;
                    blockScroll(this.isVisible);
                }
            }
        }
    }
</script>