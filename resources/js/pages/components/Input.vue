<script setup lang="ts">
defineProps<{
    type: string,
    label?: string,
    name: string,
    error?: string,
}>()
</script>

<template>
    <div class="flex justify-between *:py-input-py">
        <label v-if="label" :for="name" class="w-label text-frosted">{{ label }} </label>
        <input :type="type" :id="name" :class="{'px-input-px w-input': typeof(label) != undefined}" class="bg-surface-100outline-none rounded-2xl" :name="name">
    </div>
    <div v-if="error" class="mt-2 text-red-500">{{ error }}</div>
</template>
