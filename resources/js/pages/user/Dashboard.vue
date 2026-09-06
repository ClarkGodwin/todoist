<script setup lang="ts">
import { User } from '@/types';
import { UserRound, LayoutDashboard } from '@lucide/vue';
import UserSidebar from '../components/UserSidebar.vue';
import { Task } from '@/types/tasks.js';

//to get the user's informations sent through the request to this page
defineProps<{
    user: User
    tasks: Task[]
    hasTasks: boolean
}>()


</script>

<template>
    <UserSidebar :user="user" >
        <div v-if="hasTasks">
            {{ tasks }}
        </div>
    </UserSidebar>
</template>
