<script setup lang="ts">
import { User } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { LogIn } from '@lucide/vue';
import { route } from 'ziggy-js';

defineProps<{ users: User[] }>()

</script>

<template>
    <div class="w-welcome-navbar mx-auto mt-3">
        <navbar class="flex justify-between ">
            <h1 class="text-frosted font-bold text-welcome-navbar-h1">N_Todoist</h1>
            <div class="flex gap-3 *:hover:cursor-pointer">
                <button class="flex gap-2 items-center text-white bg-frosted px-welcome-navbar-links-px rounded-xl ">
                    <log-in class="size-(--text-welcome-navbar-links)"/>
                    <span class="font-bold text-welcome-navbar-links">Login</span>
                </button>
                <button class="font-bold text-frosted text-welcome-navbar-links underline hover:no-underline">Register</button>
            </div>
        </navbar>

        <p class="mt-8 w-welcome-p text-welcome-p">
            Welcome in this minimalistic web app to create and track tasks daily and change their status from to do, being done and done and move on with your life. <br>
            For those who can easily forget like myself ,
            <span class="text-frosted font-medium">LOGIN AND USE IT</span>
        </p>

    </div>
</template>
