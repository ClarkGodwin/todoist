<script lang="ts">
export default {
    layout: {
        sidebar: [UserSidebar, { active: 'dashboard' }],
        content: [DashboardInfo, { title: 'Dashboard' }],
    }
}
</script>

<script setup lang="ts">
import { User } from '@/types/auth.js';
import DashboardInfo from '../components/DashboardInfo.vue';
import UserSidebar from '../components/UserSidebar.vue';

const props = defineProps<{
    auth: {
        user: User
    }
}>()

const user = props.auth.user
</script>

<template>
    <span>{{ user.name }}</span>
    <span>
        , congratulation, you've made it, registering an account, verifying the email and logging into that account. <br> <br>
        Now you can enjoy the features proposed by the app, check the account page in the sidebar to check your user informations, modifying them and even deleting your account if you feel like it. <br> <br>
        The task page is where you'll be able to enjoy the reason why you registered, you can create a task, modify it, mark it as done and even deleting it if you ever change your mind <br>
        This app shows the task for one day, if you'd like to see the planned for another day, just click on the day on which you actually are and then select the day you want to check. <br>
        However, you don't have to go through all that just to create a task for a specific day
    </span>
</template>
