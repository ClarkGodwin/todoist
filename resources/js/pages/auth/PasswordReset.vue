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

defineProps<{
    errors? : Record<string, string>
}>()

//list to go through to easily render the inputs using the Input component from the component folder
const inputs = [
    {
        id: 3,
        type: 'password',
        name: 'password',
        label: 'Password',
    },
    {
        id: 2,
        type: 'password',
        name: 'password_confirmation',
        label: 'Confirm',
    },
]

</script>

<template>
    <Form title="Login to your account" :inputs="inputs" :errors="errors" action="password.reset"/>
</template>
