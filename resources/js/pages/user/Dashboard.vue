<script lang="ts">
export default {
    layout: {
        sidebar: [UserSidebar, { active: 'dashboard' }],
        content: [DashboardInfo, { title: 'Dashboard' }],
    }
}
</script>

<script setup lang="ts">
import { User } from '@/types';
import { Task } from '@/types/tasks.js';
import DashboardInfo from '../components/DashboardInfo.vue';
import UserSidebar from '../components/UserSidebar.vue';

import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import { useToastStore } from '@/stores/useToastStore.js';

const toastStore = useToastStore()
toastStore.detectIfFlashMessageWasSentAndDisplayToastForTwoSeconds()
</script>

<template>
    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minima quos perspiciatis incidunt laudantium autem,
    maiores similique ratione commodi, debitis magni porro sequi qui corporis reprehenderit ullam dolores tenetur ab
    pariatur!
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, error. Cupiditate, ipsa. Dignissimos asperiores
    officia tempora placeat fugiat officiis soluta accusamus ex nesciunt ullam odit totam, nisi, velit aspernatur
    doloribus!
</template>
