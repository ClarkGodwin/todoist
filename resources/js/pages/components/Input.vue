<script setup lang="ts">
defineProps({
    type: String,
    name: String,
})
</script>

<template>
    <div class="flex justify-between *:py-[8px]">
        <label :for="name" class="w-[15%] text-frosted">{{ name }} : </label>
        <input :type="type" class="bg-surface-100 px-[15px] outline-none w-[85%] rounded-2xl" :name="name">
    </div>
</template>
