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

const props = defineProps<{
    errors? : Record<string, string>
    email? : string
    token?  : string
}>()

console.log(props.token)
console.log(props.email)

//list to go through to easily render the inputs using the Input component from the component folder
const inputs = [
    {
        id: 1,
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
    {
        id: 3,
        type: 'hidden',
        name: 'token',
    },
    {
        id: 4,
        type: 'hidden',
        name: 'email',
    },
]

</script>

<template>
    <Form title="Change your password" :inputs="inputs" :errors="errors" action="password.update"/>
</template>
