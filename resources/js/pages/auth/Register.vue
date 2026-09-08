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

//to catch the errors sent by the request controller and pass them down to the custom Form component
defineProps<{
    errors? : Record<string, string>
}>()

//list to go through to easily render the inputs using the Input component from the component folder
const inputs = [
    {
        id: 1,
        type: 'text',
        label: 'Name',
        name: 'name',
    },
    {
        id: 2,
        type: 'email',
        label: 'E-mail',
        name: 'email',
    },
    {
        id: 3,
        type: 'password',
        label: 'Password',
        name: 'password',
    },
    {
        id: 4,
        type: 'password',
        label: 'Confirm',
        name: 'password_confirmation'
    },
]

</script>

<template>
    <Form title="Register a new account" :inputs="inputs" :errors="errors" action="register">
        Already have an account ?
        <Link :href="route('login')" class="text-frosted underline hover:no-underline">Login</Link>
    </Form>
</template>
