<template>
    <h3>Darkside Developments Tech Test</h3>
    <h1>Insert customer data:</h1>

    <div>
        <p>*Please fill in all fields before submitting the form.</p>
        <div v-if="dataSubmitted" style="color: green">
            Data has been submitted successfully!
        </div>

        <!-- name, email, phone, and address -->
        <label for="name">Name:</label>
        <input v-model="name" type="text" id="name" />
        <div v-if="v$.name.$error && !dataSubmitted" style="color: red">
            Name field has an error: {{ v$.name.$errors[0].$message }}
        </div>
        <br />

        <label for="email">Email:</label>
        <input v-model="email" type="email" id="email" />
        <div v-if="v$.email.$error && !dataSubmitted" style="color: red">
            Email field has an error: {{ v$.email.$errors[0].$message }}
        </div>
        <br />

        <label for="phone">Phone No.:</label>
        <input v-model="phone" type="text" id="phone" />
        <div v-if="v$.phone.$error && !dataSubmitted" style="color: red">
            Phone no. field has an error: {{ v$.phone.$errors[0].$message }}
        </div>
        <br />

        <label for="address">Address:</label>
        <input v-model="address" type="text" id="address" />
        <div v-if="v$.address.$error && !dataSubmitted" style="color: red">
            Address field has an error: {{ v$.address.$errors[0].$message }}
        </div>
        <br />

        <!-- make button clickable only when all fields are filled in -->
        <button @click="saveCustomerDataToDisk">
            Save Customer Data to Disk
        </button>
    </div>
</template>
<script>
import { useVuelidate } from "@vuelidate/core";
import { required, email, numeric } from "@vuelidate/validators";
import { ErrorCodes } from "vue";

export default {
    setup() {
        return { v$: useVuelidate() };
    },
    data() {
        return {
            name: "",
            email: "",
            phone: "",
            address: "",
            dataSubmitted: false,
        };
    },
    computed: {
        allFieldsAreFilledIn() {
            return this.name && this.email && this.phone && this.address;
        },
    },
    methods: {
        saveCustomerDataToDisk() {
            // initialise prompt
            this.dataSubmitted = false;

            // validates fields
            this.v$.$validate();

            // if there are no validation errors send call to API
            if (this.v$.$errors.length == 0) {
                axios
                    .post("/api/add_customer", {
                        name: this.name,
                        email: this.email,
                        phone: this.phone,
                        address: this.address,
                    })
                    .then((response) => {
                        // handle successful response
                        console.log(response.data);

                        // display success message and clear form, etc.
                        // ...
                        this.clearForm();
                        this.dataSubmitted = true;
                    })
                    .catch((error) => {
                        // log error
                        console.error(error);
                        // display error message to UI
                        // ...
                    });
            }
        },
        clearForm() {
            this.name = "";
            this.email = "";
            this.phone = "";
            this.address = "";
        },
    },
    validations() {
        return {
            name: { required },
            email: { required, email },
            phone: { required, numeric },
            address: { required },
        };
    },
};
</script>
