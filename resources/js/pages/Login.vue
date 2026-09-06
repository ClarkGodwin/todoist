<script lang="ts">
export default {
    layout: GuestNavbar
}
</script>

<script setup lang="ts">
import GuestNavbar from './components/GuestNavbar.vue';
import Input from './components/Input.vue';
import Form from './components/Form.vue';
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

//list to go through to easily render the inputs using the Input component from the component folder
const inputs = [
    {
        id: 1,
        type: 'text',
        name: 'Name',
    },
    {
        id: 2,
        type: 'email',
        name: 'E-mail',
    },
    {
        id: 3,
        type: 'password',
        name: 'Password',
    },
]

</script>

<template>
    <Form title="Login to your account" :inputs="inputs">
        No account yet ?
        <Link :href="route('register')" class="text-frosted underline hover:no-underline">Register</Link>
    </Form>
</template>
