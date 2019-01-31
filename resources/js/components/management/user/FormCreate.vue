<template>
    <div class="grid-content bg-purple-dark">
        <el-form id="createVideo" ref="form" :model="form" :action="action" :method="method"
                 enctype="multipart/form-data">
            <input type="text" name="_token" :value="csrf_token" hidden/>

            <el-form-item label="Name">
                <el-input v-model="form.name" name="name"></el-input>
                <span class="form-error">{{ errorFields.name }}</span>
            </el-form-item>
            <el-form-item label="Email">
                <el-input v-model="form.email" name="email"></el-input>
                <span class="form-error">{{ errorFields.email }}</span>
            </el-form-item>
            <el-form-item label="Password">
                <el-input v-model="form.password" name="password"></el-input>
                <span class="form-error">{{ errorFields.password }}</span>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSubmit">Create</el-button>
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
            method: {
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
        created() {
            this.errorFields = setterErrorsFromFormFields(this.errorMessage);

            this.form.name = this.oldValue.name;

            this.form.email = this.oldValue.email;

            this.form.password = this.oldValue.password;
        },
        data() {
            return {
                form: {
                    name: '',
                    email: '',
                    password: ''
                },
                oldValue: JSON.parse(this.oldData),
                errorFields: {},
                errorMessage: JSON.parse(this.arrayErrorMessage),
            }
        },
        methods: {
            onSubmit() {
                this.$refs['form'].$el.submit();
            },
            resetForm() {
                this.form.name = '';
                this.form.email = '';
                this.form.password = '';
            },
        }
    }
</script>
