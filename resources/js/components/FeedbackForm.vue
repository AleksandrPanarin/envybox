<template>
    <div class="container">
        <div class="mt-4">
            <div class="alert" v-show="(response && alertClass && alertMessage)"
                 :class="alertClass"
            >
                {{ alertMessage }}
            </div>
            <form @submit.prevent="submitForm">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Name"
                           :class="(response)? (errors.name)?'is-invalid' : 'is-valid': ''"
                           v-model="form.name">
                    <div class="invalid-feedback">{{ errors.name }}</div>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" placeholder="+7 999 999-99-99"
                           v-bind:class="(response) ? (errors.phone) ? 'is-invalid' : 'is-valid': ''"
                           v-model="form.phone"
                    >
                    <div class="invalid-feedback">{{ errors.phone }}</div>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message"
                              v-bind:class="(response)? (errors.message) ?'is-invalid' : 'is-valid': ''"
                              v-model="form.message"></textarea>
                    <div class="invalid-feedback">{{ errors.message }}</div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Form',
    data() {
        return {
            response: false,
            alertMessage: '',
            alertClass: '',
            errors: {
                name: '',
                phone: '',
                message: '',
            },
            form: {
                name: '',
                phone: '',
                message: '',
            }
        }
    },
    methods: {
        submitForm(e) {
            this.errors = {
                name: '',
                phone: '',
                message: '',
            };
            this.alertClass = '';
            this.alertMessage = '';

            axios.post(
                '/api/v1/feedback',
                this.form,
            ).then((res) => {
                this.alertClass = 'alert-success';
                this.alertMessage = 'Success';
                window.location.reload()
            }).catch((error) => {
                if (error.response.status === 400) {
                    this.errors = error.response.data.errors;
                } else {
                    this.alertClass = 'alert-danger';
                    this.alertMessage = 'Error system';
                }
            }).finally(() => {
                this.response = true;
            });
            e.preventDefault();
        },
    },
}

</script>
