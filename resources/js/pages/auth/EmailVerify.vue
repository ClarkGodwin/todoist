<script lang="ts">
export default {
    layout: [UserSidebar, DashboardInfo]
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
        If you have just registered, a verification link has been sent to your email address. <br>
        Check your email (or junk) to verify it or if you don't see it, you can just
        <Link :href="route('home')" class="text-frosted underline hover:no-underline hover:cursor-pointer">click here </Link>
        to send a new one
    </p>
</template>
