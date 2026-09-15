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
        type: 'email',
        name: 'email',
        label: 'E-mail',
    },
    {
        id: 2,
        type: 'password',
        name: 'password',
        label: 'Password',
        value: '2'
    },
]

</script>

<template>
    <Form action="login" title="Login to your account" :inputs="inputs" :errors="errors">
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
