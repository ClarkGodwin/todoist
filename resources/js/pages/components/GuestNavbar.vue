<script setup lang="ts">
import { LogIn } from '@lucide/vue';
import { route } from 'ziggy-js';
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <div class="w-guestNavbar-navbar mx-auto my-3">
        <div id="navbar" class="flex justify-between ">
            <!-- the big title on the left -->
            <Link :href="route('home')">
                <h1 class="text-frosted font-bold text-guestNavbar-navbar-h1">N_Todoist</h1>
            </Link>

            <!-- login and register links on the right -->
            <div class="flex gap-3 *:hover:cursor-pointer">
                <Link :href="route('login')"
                    class="flex gap-2 items-center text-white bg-frosted px-guestNavbar-navbar-links-px rounded-xl ">
                    <log-in class="size-(--text-guestNavbar-navbar-links)" />
                    <span class="font-bold text-guestNavbar-navbar-links">Login</span>
                </Link>
                <button>
                    <Link :href="route('register')"
                        class="font-bold text-frosted text-guestNavbar-navbar-links underline hover:no-underline">
                        Register</Link>
                </button>
            </div>
        </div>

        <slot></slot>

    </div>
</template>
