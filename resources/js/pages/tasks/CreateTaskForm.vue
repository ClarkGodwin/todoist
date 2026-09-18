<script lang="ts">
export default {
    layout: [UserSidebar, { active: 'tasks' }]
}
</script>

<script setup lang="ts">
import { User } from '@/types/auth.js';
import UserSidebar from '../components/UserSidebar.vue';
import Form from '../components/Form.vue';

const props = defineProps<{
    auth: {
        user: User
    }
    //to catch the errors sent by the request controller and pass them down to the custom Form component
    errors?: Record<string, string>
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
        type: 'textarea',
        label: 'Description',
        name: 'description',
    },
    {
        id: 3,
        type: 'date',
        label: 'Date',
        name: 'date',
    },
]

</script>

<template>
    <Form title="Create a new task" :inputs="inputs" :errors="errors" action="register">
    </Form>
</template>
