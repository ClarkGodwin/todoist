<script lang="ts">
export default {
    layout: GuestNavbar
}
</script>

<script setup lang="ts">
import GuestNavbar from './components/GuestNavbar.vue';
import Input from './components/Input.vue';
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

const inputs = [
    {
        id: 1,
        type: 'text',
        name: 'Name',
    },
    {
        id: 2,
        type: 'email',
        name: 'E-mail',
    },
    {
        id: 3,
        type: 'password',
        name: 'Password',
    },
    {
        id: 4,
        type: 'password',
        name: 'Confirm',
    },
]

</script>

<template>
    <div class="bg-surface-300 rounded-2xl p-[20px] mt-[60px] w-[600px] mx-auto flex flex-col gap-[30px]">
        <h2 class="text-frosted font-bold text-center text-[25px]">Register a new account</h2>
        <div v-for="input in inputs" :key="input.id">
            <Input :type="input.type" :name="input.name" />
        </div>

        <button class="bg-frosted text-white font-bold rounded-xl p-[10px]">Submit</button>

        <div>
            Already have an account ?
            <Link :href="route('login')" class="text-frosted underline hover:no-underline">Login</Link>
        </div>
    </div>
</template>
