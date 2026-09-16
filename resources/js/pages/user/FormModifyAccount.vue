<script lang="ts">
export default {
    layout: {
        sidebar: [UserSidebar, { active: 'account' }],
    }
}
</script>

<script setup lang="ts">
import UserSidebar from '../components/UserSidebar.vue';
import Form from '../components/Form.vue';
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import { User } from '@/types/auth.js';

//to catch the errors sent by the request controller and pass them down to the custom Form component
const props = defineProps<{
    //to get the authenticated user
    auth: {
        user: User
    }
    errors? : Record<string, string>
}>()

const user = props.auth.user

//list to go through to easily render the inputs using the Input component from the component folder
const inputs = [
    {
        id: 1,
        type: 'text',
        name: 'name',
        label: 'Username',
        value: user.name
    },
    {
        id: 2,
        type: 'email',
        name: 'email',
        label: 'E-mail',
        value: user.email
    },
]

</script>

<template>
    <Form action="login" title="Account's informations" :inputs="inputs" :errors="errors" submitMessage="Modify">
        <div class="text-red-400">
            Unless you click on 'Modify', whatever you've changed  won't be saved
        </div>
    </Form>
</template>
