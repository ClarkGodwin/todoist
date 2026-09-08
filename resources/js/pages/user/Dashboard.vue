<script lang="ts">
export default{
    layout: {
        sidebar: [UserSidebar, {active : 'dashboard'}],
        content: [DashboardInfo, {title: 'Dashboard'}],
    }
}
</script>

<script setup lang="ts">
import { User } from '@/types';
import { UserRound, LayoutDashboard } from '@lucide/vue';
import { Task } from '@/types/tasks.js';
import DashboardInfo from '../components/DashboardInfo.vue';
import UserSidebar from '../components/UserSidebar.vue';
</script>

<template>
    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minima quos perspiciatis incidunt laudantium autem, maiores similique ratione commodi, debitis magni porro sequi qui corporis reprehenderit ullam dolores tenetur ab pariatur!
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, error. Cupiditate, ipsa. Dignissimos asperiores officia tempora placeat fugiat officiis soluta accusamus ex nesciunt ullam odit totam, nisi, velit aspernatur doloribus!
</template>
