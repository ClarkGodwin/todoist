<script lang="ts">
export default{
    layout: [UserSidebar, {active: 'tasks'}]
}
</script>

<script setup lang="ts">
import { Task } from '@/types/tasks';
import UserSidebar from '../components/UserSidebar.vue';
import { User } from '@/types/auth.js';
import { useSidebar } from '@/components/ui/sidebar/utils.js';

</script>

<template>
    tasks
</template>
