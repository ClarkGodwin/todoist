<script setup lang="ts">
defineProps<{
    type: string,
    label?: string,
    name: string,
    value?: string,
    error?: string,
}>()
</script>

<template>
    <div class="flex justify-between *:py-input-py">
        <label :for="name" class="w-label text-frosted">{{ label }} </label>
        <input v-if="type !== 'textarea'" :type="type" :id="name" class="bg-surface-100 outline-none rounded-2xl px-input-px w-input" :name="name" :value="value">
        <textarea v-else :name="name" :id="name" class="bg-surface-100 outline-none rounded-2xl px-input-px w-input">{{ value }}</textarea>
    </div>
    <div v-if="error" class="mt-2 text-red-500">{{ error }}</div>
</template>
