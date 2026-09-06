<script lang="ts">
export default {
    layout: GuestNavbar
}
</script>

<script setup lang="ts">
import GuestNavbar from './components/GuestNavbar.vue';
import Input from './components/Input.vue';

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
]

</script>

<template>
    <div class="bg-surface-300 rounded-2xl p-4 mt-[100px] w-[600px] mx-auto flex flex-col gap-4">
        <div v-for="input in inputs" :key="input.id">
            <Input :type="input.type" :name="input.name" />
        </div>
    </div>
</template>
