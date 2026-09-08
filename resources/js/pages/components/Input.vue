<script setup lang="ts">
defineProps<{
    type: string,
    label: string,
    name: string,
    error?: string,
}>()
</script>

<template>
    <div class="flex justify-between *:py-input-py">
        <label :for="name" class="w-label text-frosted">{{ label }} </label>
        <input :type="type" :id="name" class="bg-surface-100 px-input-px outline-none w-input rounded-2xl" :name="name">
    </div>
    <div v-if="error" class="mt-2 text-red-500">{{ error }}</div>
</template>
