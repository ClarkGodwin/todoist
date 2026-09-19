<script lang="ts">
export default {
    layout: [UserSidebar, { active: 'tasks' }]
}
</script>

<script setup lang="ts">
import { User } from '@/types/auth.js';
import UserSidebar from '../components/UserSidebar.vue';
import Form from '../components/Form.vue';
import { usePage } from '@inertiajs/vue3';
import { Task } from '@/types/tasks.js';

const props = defineProps<{
    auth: {
        user: User
    }
    //to catch the errors sent by the request controller and pass them down to the custom Form component
    errors?: Record<string, string>
    task: Task
}>()

//list to go through to easily render the inputs using the Input component from the component folder
const inputs = [
    {
        id: 1,
        type: 'text',
        label: 'Title',
        name: 'title',
        value: props.task.title
    },
    {
        id: 2,
        type: 'textarea',
        label: 'Description',
        name: 'description',
        value: props.task.description
    },
    {
        id: 3,
        type: 'date',
        label: 'Day',
        name: 'day',
        value: props.task.description
    },
    {
        id: 4,
        type: 'hidden',
        name: 'id',
        value: props.task.id
    }
]

</script>

<template>
    <Form title="Create a new task" :inputs="inputs" :errors="errors" action="create.task" method="post">
        If you don't specify a  date, the default pic will be today
    </Form>
</template>

