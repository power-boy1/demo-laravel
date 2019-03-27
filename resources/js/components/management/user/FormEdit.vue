<template>
    <div class="grid-content bg-purple-dark">
        <el-form ref="form" :model="form" :action="action" method="post"
                 enctype="multipart/form-data">
            <input type="hidden" name="_token" :value="csrf_token"/>
            <input type="hidden" name="user_id" :value="userId"/>
            <input type="hidden" name="role" :value="form.role"/>


            <el-form-item label="Name">
                <el-input v-model="form.name" name="name"></el-input>
                <span class="form-error">{{ errorFields.name }}</span>
            </el-form-item>
            <el-form-item label="Email">
                <el-input v-model="form.email" name="email"></el-input>
                <span class="form-error">{{ errorFields.email }}</span>
            </el-form-item>
            <el-form-item label="Select role">
                <el-select
                        v-model="form.role"
                        collapse-tags
                        placeholder="Role">
                    <el-option
                            v-for="role in roles"
                            :key="role.id"
                            :label="role.name"
                            :value="role.id">
                    </el-option>
                </el-select>
                <br>
                <span class="form-error">{{ errorFields.role }}</span>
            </el-form-item>
            <el-form-item label="Password">
                <el-input v-model="form.password" name="password"></el-input>
                <span class="form-error">{{ errorFields.password }}</span>
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
            rolesData: {
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
                userId: '',
                form: {
                    name: '',
                    email: '',
                    role: '',
                    password: ''
                },
                default: {
                    name: '',
                    email: '',
                    role: '',
                    password: ''
                },
                roles: JSON.parse(this.rolesData),
                oldValue: JSON.parse(this.oldData),
                errorFields: {},
                errorMessage: JSON.parse(this.arrayErrorMessage),
            }
        },
        created() {
            this.errorFields = setterErrorsFromFormFields(this.errorMessage);

            let item = JSON.parse(this.itemData);

            this.userId = item.id;

            if (this.oldValue.length === undefined) {
                return this.oldValueFields();
            }

            this.default.name = this.form.name = item.name;

            this.default.email = this.form.email = item.email;

            this.default.role = this.form.role = item.role_id;
        },
        methods: {
            onSubmit() {
                this.$refs['form'].$el.submit();
            },
            resetForm() {
                this.form.name = this.default.name;
                this.form.email = this.default.email;
                this.form.password = this.default.password;
                this.form.role = this.default.role;
            },
            oldValueFields() {
                this.form.name = this.oldValue.name;
                this.form.email = this.oldValue.email;

                if (this.oldValue.role) {
                    this.form.role = parseInt(this.oldValue.role);
                }
            }
        }
    }
</script>