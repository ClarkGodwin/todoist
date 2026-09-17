<script lang="ts">
export default {
    layout: {
        sidebar: [UserSidebar, {active: 'dashboard'}],
        content: [DashboardInfo, {title: 'Email verification notice'}]
    }
}
</script>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import UserSidebar from '../components/UserSidebar.vue';
import DashboardInfo from '../components/DashboardInfo.vue';

</script>

<template>
    <p class=''>
        If you have just registered or changed your email, a verification link has been sent to your email address. <br>
        Check your email (or junk) to verify it . <br>
        If you don't see it, you can just
        <Link :href="route('verification.send')" method="post" class="text-frosted underline hover:no-underline hover:cursor-pointer">click here </Link>
        to send a new one
    </p>
</template>
