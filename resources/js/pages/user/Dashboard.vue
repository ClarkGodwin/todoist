<script setup lang="ts">
import { User } from '@/types';
import {UserRound, LayoutDashboard} from '@lucide/vue';
import UserSidebar from '../components/UserSidebar.vue';

//to get the user's informations sent through the request to this page
defineProps<{user : User}>()
</script>

<template>
    <UserSidebar>
        <template #header>
            <div class="flex gap-3 text-frosted text-bold">
                <UserRound/>
                <span>{{ user.name }}</span>
            </div>
        </template>
    </UserSidebar>
</template>
