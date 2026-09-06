<script setup lang="ts">
defineProps<{
    type: string,
    name: string,
}>()
</script>

<template>
    <div class="flex justify-between *:py-[8px]">
        <label :for="name" class="w-[15%] text-frosted">{{ name }} </label>
        <input :type="type" :id="name" class="bg-surface-100 px-[15px] outline-none w-[85%] rounded-2xl" :name="name">
    </div>
</template>
