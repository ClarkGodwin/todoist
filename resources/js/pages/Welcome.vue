<script setup lang="ts">
import { User } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

defineProps<{ users: User[] }>()

</script>

<template>
    <div v-for="user in users" :key="user.id">
        <Link :href="route('user.dashboard', {id: user.id})" class="ml-20 text-blue-400">{{ user.name }}</Link>
    </div>
</template>
