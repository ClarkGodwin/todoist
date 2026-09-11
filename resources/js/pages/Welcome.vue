<script lang="ts">
export default{
    layout: GuestNavbar,
}
</script>

<script setup lang="ts">
import { useToastStore } from '@/stores/useToastStore.js';
import GuestNavbar from './components/GuestNavbar.vue';
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

const toastStore = useToastStore()
toastStore.detectIfFlashMessageWasSentAndDisplayToastForTwoSeconds()

</script>

<template>
    <p class="mt-8 w-welcome-p text-welcome-p">
        Welcome in this minimalistic web app to create and track tasks daily and change their status from to do, being
        done and done and move on with your life. <br>
        For those who can easily forget like myself ,
        <Link :href="route('login')" class="text-frosted font-medium underline hover:no-underline hover:cursor-pointer">LOGIN AND USE IT</Link>
        <Link :href="route('test.toast')">Test toast</Link>
    </p>

</template>
