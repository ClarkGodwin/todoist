<script lang="ts">
export default {
    layout: GuestNavbar
}
</script>

<script setup lang="ts">
import GuestNavbar from '../components/GuestNavbar.vue';
import Form from '../components/Form.vue';
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

//list to go through to easily render the inputs using the Input component from the component folder
const inputs = [
    {
        id: 1,
        type: 'email',
        name: 'E-mail',
    },
]

</script>

<template>
    <Form title="Password forgotten ?" :inputs="inputs">
        Enter your e-mail and if it's the one registered, an email will be sent to you containing a link to a page to change your  password.
    </Form>
</template>
