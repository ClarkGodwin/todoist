<script lang="ts">
export default {
    layout: {
        sidebar: [UserSidebar, { active: 'account' }],
        content: [DashboardInfo, { title: "Account's informations" }],
    }
}
</script>

<script setup lang="ts">
import { User } from '@/types/auth.js';
import DashboardInfo from '../components/DashboardInfo.vue';
import UserSidebar from '../components/UserSidebar.vue';
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import DeleteAccount from '../components/DeleteAccount.vue';

//to catch the errors sent by the request controller and pass them down to the custom Form component
const props = defineProps<{
    //to get the authenticated user
    auth: {
        user: User
    }
    errors?: Record<string, string>
}>()

const user = props.auth.user

const infos = [
    {
        id: 1,
        title: 'Username',
        value: user.name,
    },
    {
        id: 2,
        title: 'E-mail',
        value: user.email,
    },
    {
        id: 3,
        title: 'Created at',
        value: user.created_at.slice(0, 10),
    },
    {
        id: 4,
        title: 'Updated at',
        value: user.updated_at.slice(0, 10),
    },
]

</script>

<template>
    <!-- informations -->
    <div v-for="info in infos" :key="info.id" class="flex items-center gap-account-info-gap my-account-info-my">
        <div class="font-bold text-frosted text-account-title">{{ info.title }} : </div>
        <div class="text-dark-surface-400 text-account">{{ info.value }}</div>
    </div>

    <!-- update links -->
    <div class="text-account text-dark-surface-400 my-account-modify-my flex flex-col gap-3">
        <div>
            <span>To modify your personal informations, </span>
            <Link :href="route('modify.account-info')" class="text-frosted underline hover:no-underline">click here
            </Link>
        </div>

        <div>
            <span>To modify your password, </span>
            <Link :href="route('modify.password')" class="text-frosted underline hover:no-underline">click here</Link>
        </div>
    </div>

    <!-- user deletion link -->
    <DeleteAccount />
</template>
