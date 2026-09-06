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
        <div>
            No account yet ?
            <Link :href="route('register')" class="text-frosted underline hover:no-underline">Register</Link>
        </div>

        <div class="mt-3">
            Forgot your password ?
            <Link :href="route('password.forgotten')" class="text-frosted underline hover:no-underline">Click here</Link>
        </div>
    </Form>
</template>
