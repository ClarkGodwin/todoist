<script lang="ts">
export default{
    layout: [UserSidebar, {active: 'tasks'}]
}
</script>

<script setup lang="ts">
import { User } from '@/types/auth.js';
import UserSidebar from '../components/UserSidebar.vue';
import { Task } from '@/types/tasks.js';

const props = defineProps<{
    auth : {
        user : User
    }
    tasks : Task[]
}>()

</script>

<template>
    <div
    v-if="props.tasks.length === 0"
    class="flex flex-col justify-center items-center gap-4 text-dark-surface-400 w-fit mx-auto text-tasks-noTasks"
    >
        <span>It looks like you don't have any tasks yet</span>
        <button class="bg-frosted text-white font-bold rounded-lg sm:rounded-xl p-tasks-p w-fit">Create a task</button>
    </div>
</template>
