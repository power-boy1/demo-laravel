<template>
    <div class="grid-content bg-purple-dark">
        <el-form ref="form" :model="form" :action="action" method="post"
                 enctype="multipart/form-data">
            <input type="text" name="_token" :value="csrf_token" hidden/>
            <input type="hidden" name="item_id" :value="itemId"/>

            <el-form-item label="Name">
                <el-input v-model="form.name" name="name"></el-input>
                <span class="form-error">{{ errorFields.name }}</span>
            </el-form-item>
            <el-form-item label="Description">
                <el-input v-model="form.description" name="description"></el-input>
                <span class="form-error">{{ errorFields.description }}</span>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSubmit">Update</el-button>
                <el-button @click="resetForm">Reset</el-button>
                <a :href="routeBack" class="el-button el-button--default">Cancel</a>
            </el-form-item>
        </el-form>
    </div>
</template>

<script>
    import {setterErrorsFromFormFields} from './../../../utils/errorSetter.js';

    export default {
        props: {
            routeBack: {
                type: String,
                require: true
            },
            csrf_token: {
                type: String,
                required: true
            },
            action: {
                type: String,
                required: true
            },
            itemData: {
                type: String,
                required: true
            },
            oldData: {
                type: String,
            },
            arrayErrorMessage: {
                type: String,
                required: true
            },
        },
        data() {
            return {
                itemId: '',
                form: {
                    name: '',
                    description: '',
                },
                default: {
                    name: '',
                    description: '',
                },
                oldValue: JSON.parse(this.oldData),
                errorFields: {},
                errorMessage: JSON.parse(this.arrayErrorMessage),
            }
        },
        created() {
            this.errorFields = setterErrorsFromFormFields(this.errorMessage);

            let item = JSON.parse(this.itemData);

            this.itemId = item.id;

            if (this.oldValue.length === undefined) {
                return this.oldValueFields();
            }

            this.default.name = this.form.name = item.name;

            this.default.description = this.form.description = item.description;
        },
        methods: {
            onSubmit() {
                this.$refs['form'].$el.submit();
            },
            resetForm() {
                this.form.name = this.default.name;
                this.form.description = this.default.description;
            },
            oldValueFields() {
                this.form.name = this.oldValue.name;
                this.form.description = this.oldValue.description;
            }
        }
    }
</script>