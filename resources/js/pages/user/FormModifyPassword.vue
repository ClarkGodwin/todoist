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
        type: 'password',
        name: 'old_password',
        label: 'Old',
    },
    {
        id: 2,
        type: 'password',
        name: 'password',
        label: 'New',
    },
    {
        id: 3,
        type: 'password',
        name: 'password_confirmation',
        label: 'Confirm',
    },
]

</script>

<template>
    <Form action="modify.password" method="put" title="Modify your password" :inputs="inputs" :errors="errors" submitMessage="Modify">
        <div class="text-red-400">
            Unless you click on 'Modify', whatever you've changed  won't be saved
        </div>
    </Form>
</template>
