<script setup lang="ts">
import { LogIn } from '@lucide/vue';

</script>

<template>
    <div class="w-guestNavbar-navbar mx-auto mt-3">
        <navbar class="flex justify-between ">
            <h1 class="text-frosted font-bold text-guestNavbar-navbar-h1">N_Todoist</h1>
            <div class="flex gap-3 *:hover:cursor-pointer">
                <button class="flex gap-2 items-center text-white bg-frosted px-guestNavbar-navbar-links-px rounded-xl ">
                    <log-in class="size-(--text-guestNavbar-navbar-links)"/>
                    <span class="font-bold text-guestNavbar-navbar-links">Login</span>
                </button>
                <button class="font-bold text-frosted text-guestNavbar-navbar-links underline hover:no-underline">Register</button>
            </div>
        </navbar>

        <slot></slot>

    </div>
</template>
