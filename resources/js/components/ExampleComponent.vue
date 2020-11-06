<template>
    <ValidationObserver v-slot="{ handleSubmit, reset }"> 
        <form @submit.prevent="handleSubmit(onSubmit)" @reset.prevent="reset"> 
        <div>
            <div class="row justify-content-center">
                <p style ="color:blue">Register a person:</p>
            </div>
            <br>
            <div class="row justify-content-center">
                <label style="color:blue">First Name:&nbsp;&nbsp;</label>
                <ValidationProvider rules="alpha_spaces|required" v-slot="{errors}">
                    <input v-model="firstName" placeholder="First Name">
                    <span>{{ errors[0] }}</span>
                </ValidationProvider>
            </div>
            <br>
            <div class="row justify-content-center">
                <label style="color:blue">Last Name:&nbsp;&nbsp;</label>
                <ValidationProvider rules="alpha_spaces|required" v-slot="{errors}">
                    <input v-model="lastName" placeholder="Last Name">
                    <span>{{ errors[0] }}</span>
                </ValidationProvider>
            </div>
            <br>
            <div class="row justify-content-center">
                <label style="color:blue">Gender:&nbsp;&nbsp;</label>
                <ValidationProvider rules="required" v-slot="{errors}">
                    <select v-model="gender">
                        <option disabled value="">Please select type</option>
                        <option>Female</option>
                        <option>Male</option>
                        <option>Other</option>
                    </select> 
                    <span>{{ errors[0] }}</span>
                </ValidationProvider>
            </div>
            <br>
            <div class="row justify-content-center"> 
                <label style="color:blue">Age:&nbsp;&nbsp;</label>
                <ValidationProvider rules="between:0,110|required" v-slot="{errors}">
                    <input v-model="age" placeholder="Age">
                    <span>{{ errors[0] }}</span>
                </ValidationProvider>
            </div>
            <br>
            <div class="row justify-content-center">
                <label style="color:blue">Street Address:&nbsp;&nbsp;</label>
                <ValidationProvider rules="alpha_dash|required" v-slot="{errors}">
                    <input v-model="streetAddress" placeholder="Street Address">
                    <span>{{ errors[0] }}</span>
                </ValidationProvider>
            </div>
            <br>
            <div class="row justify-content-center">
                <label style="color:blue">City:&nbsp;&nbsp;</label>
                <ValidationProvider rules="alpha_spaces|required" v-slot="{errors}">
                    <input v-model="city" placeholder="City">
                    <span>{{ errors[0] }}</span>
                </ValidationProvider>
            </div>
            <br>
            <div class="row justify-content-center">
                <label style="color:blue">State:&nbsp;&nbsp;</label>
                <ValidationProvider rules="alpha_spaces|required" v-slot="{errors}">
                    <input v-model="state" placeholder="State">
                    <span>{{ errors[0] }}</span>
                </ValidationProvider>
            </div>
            <br>
            <div class="row justify-content-center">
            <label style="color:blue">Postal Code:&nbsp;&nbsp;</label>
                <ValidationProvider rules="alpha_dash|required" v-slot="{errors}">
                    <input v-model="postalCode" placeholder="Postal Code">
                    <span>{{ errors[0] }}</span>
                </ValidationProvider>
            </div>
            <br>
            <div class="row justify-content-center">
                <label style="color:blue">Phone Number:&nbsp;&nbsp;</label>
                <ValidationProvider rules="numeric|required" v-slot="{errors}">
                    <input v-model="phoneNumber" placeholder="Phone Number">
                    <span>{{ errors[0] }}</span>
                </ValidationProvider>
            </div>
            <br>
            <div class="row justify-content-center">
                <label style="color:blue">Phone Number Type:&nbsp;&nbsp;</label>
                <ValidationProvider rules="required" v-slot="{errors}">
                    <select v-model="type">
                        <option disabled value="">Please select type</option>
                        <option>Mobile</option>
                        <option>Work</option>
                        <option>Home</option>
                    </select>
                    <span>{{ errors[0] }}</span>
                </ValidationProvider>
            </div>
            <br>
            <div class="row justify-content-center">
                <button type="submit">Submit</button>
                <button type="reset">Reset</button>
            </div>
            <br>
        </div>
        </form>
    </ValidationObserver>
</template>

<script>
import { ValidationProvider } from 'vee-validate';
import { ValidationObserver } from 'vee-validate';
import validation from '../validation';
    export default {
        name: "ExampleComponent",
        components: {
            ValidationProvider,
            ValidationObserver
        },
        data(){
            return {
                firstName: '',
                lastName: '',
                gender: '',
                age: '',
                streetAddress: '',
                city: '',
                state: '',
                postalCode: '',
                phoneNumber: '',
                type: '',
            };
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            onSubmit () {
                alert('Form has been submitted!'); 
                this.sendJson(); 
            },
            sendJson() { 
                const requestOptions = {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(this.getInputBody())
                };
                fetch('https://penne.test/api/persons', requestOptions)
                    .then(response => {
                        if (response.status === 200) {
                        return response.json();
                        } else {
                            throw new Error('Something went wrong on api server!');
                        }
                    })
                    .then(response => {
                        console.debug(response);
                        // ...
                    }).catch(error => {
                    console.error(error);
                    }); 
            },
            getInputBody(){
                return {
                    firstName: this.firstName, 
                    lastName:  this.lastName, 
                    gender:  this.gender,
                    age:  this.age,
                    address: {
                        streetAddress: this.streetAddress,
                        city: this.city,
                        state: this.state,
                        postalCode: this.postalCode
                    },
                    phoneNumbers: [{type: this.type, number:this.phoneNumber}]
                };
            }
        } 
    };
</script>
