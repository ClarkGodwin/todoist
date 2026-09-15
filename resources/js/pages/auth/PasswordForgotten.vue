<script lang="ts">
export default {
    layout: GuestNavbar
}
</script>

<script setup lang="ts">
import GuestNavbar from '../components/GuestNavbar.vue';
import Form from '../components/Form.vue';
import {usePage } from '@inertiajs/vue3';

const props = defineProps<{
    errors? : Record<string, string>
}>()

//list to go through to easily render the inputs using the Input component from the component folder
const inputs = [
    {
        id: 1,
        type: 'email',
        label: 'E-mail',
        name: 'email',
    },
]

console.log(usePage().flash.status)

</script>

<template>
    <Form title="Password forgotten ?" :inputs="inputs" :errors="errors" action="password.email">
        Enter your e-mail and if it's the one registered, an email will be sent to you containing a link to a page to change your  password.
    </Form>
</template>
