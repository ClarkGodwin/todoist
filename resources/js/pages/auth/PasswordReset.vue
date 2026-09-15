<script lang="ts">
export default {
    layout: GuestNavbar
}
</script>

<script setup lang="ts">
import GuestNavbar from '../components/GuestNavbar.vue';
import Form from '../components/Form.vue';

const props = defineProps<{
    errors? : Record<string, string>
    email? : string
    token?  : string
}>()

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
        value: props.token,
    },
    {
        id: 4,
        type: 'hidden',
        name: 'email',
        value: props.email,
    },
]

</script>

<template>
    <Form title="Change your password" :inputs="inputs" :errors="errors" action="password.update"/>
</template>
