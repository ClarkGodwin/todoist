<script setup lang="ts">
import { User } from '@/types';
import { UserRound, LayoutDashboard } from '@lucide/vue';
import UserSidebar from '../components/UserSidebar.vue';
import { Task } from '@/types/tasks.js';

defineProps<{
    auth: {
        user: User
    }
 }>()
</script>

<template>
    <UserSidebar :auth="auth">
        Welcome
    </UserSidebar>
</template>
