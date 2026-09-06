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
        id: 3,
        type: 'password',
        name: 'Password',
    },
    {
        id: 2,
        type: 'password',
        name: 'Confirm',
    },
]

</script>

<template>
    <Form title="Login to your account" :inputs="inputs"/>
</template>
