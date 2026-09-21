<script lang="ts">
export default {
    layout: [UserSidebar, { active: 'tasks' }]
}
</script>

<script setup lang="ts">
import { User } from '@/types/auth.js';
import UserSidebar from '../components/UserSidebar.vue';
import Form from '../components/Form.vue';
import { Task } from '@/types/tasks.js';

const props = defineProps<{
    //to catch the errors sent by the request controller and pass them down to the custom Form component
    errors?: Record<string, string>
    task: Task
}>()

//list to go through to easily render the inputs using the Input component from the component folder
const inputs = [
    {
        id: 1,
        type: 'hidden',
        name: 'id',
        value: props.task.id
    },
    {
        id: 2,
        type: 'date',
        label: 'Date',
        name: 'day',
        value: props.task.day
    },
]

</script>

<template>
    <Form title="Move your task to another day" :inputs="inputs" :errors="errors" action="move.to.date" method="post">
        If you don't specify a  date, the default pic will be today
    </Form>
</template>
