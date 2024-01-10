<template>
    <h3>Hello, Vuejs with Laravel</h3>
    <h1>Create a new user</h1>

    <div>
        <p>*Please fill in all fields before submitting the form.</p>

        <!-- name, email, phone, and address -->
        <label for="name">Name:</label>
        <input v-model="name" type="text" id="name" />
        <br />

        <label for="email">Email:</label>
        <input v-model="email" type="email" id="email" />
        <br />

        <label for="phone">Phone No.:</label>
        <input v-model="phone" type="text" id="phone" />
        <br />

        <label for="address">Address:</label>
        <input v-model="address" type="text" id="address" />
        <br />

        <!-- make button clickable only when all fields are filled in -->
        <button @click="addUser" :disabled="!allFieldsAreFilledIn">
            Add User
        </button>
    </div>
</template>
<script>
export default {
    setup() {},
    data() {
        return {
            name: "",
            email: "",
            phone: "",
            address: "",
        };
    },
    computed: {
        allFieldsAreFilledIn() {
            return this.name && this.email && this.phone && this.address;
        },
    },
    methods: {
        addUser() {
            // Handle form submission logic here
            console.log(
                "Form submitted",
                this.name,
                this.email,
                this.phone,
                this.address
            );
        },
    },
};
</script>
