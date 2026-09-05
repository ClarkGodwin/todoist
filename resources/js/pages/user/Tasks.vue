<script setup lang="ts">
import { Task } from '@/types/tasks';
import UserSidebar from '../components/UserSidebar.vue';
import { User } from '@/types/auth.js';

defineProps<{
    user : User,
}>()

</script>

<template>
    <UserSidebar :user="user"/>
</template>
