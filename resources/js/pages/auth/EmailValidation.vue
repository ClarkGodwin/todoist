<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
</script>

<template>

    <p class="mt-8 w-welcome-p text-welcome-p">
        It seems like you haven't validated your e-mail yet. <br>
        Check your email (or junk) to verify it or
        <Link :href="route('home')" class="text-frosted underline hover:no-underline hover:cursor-pointer">click here </Link>
        to resend a new one
    </p>
</template>
