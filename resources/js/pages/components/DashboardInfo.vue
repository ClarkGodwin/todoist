<script setup lang="ts">
//this component is simply used as a layout right under UserSidebar.vue for simple information such as the content of the Dashboard.vue and EmailVerify.vue components
defineProps<{
    title: string
}>()
</script>

<template>
    <div class="h-fit bg-surface-300 mt-dashboardInfo-mt w-dashboardInfo mx-auto rounded-xl px-dashboardInfo-px py-dashboardInfo-py text-dashboardInfo">
        <h2 class="font-bold text-frosted text-center text-dashboardInfo-h2 mb-dashboardInfo-h2-mb">{{ title }}</h2>
        <slot></slot>
    </div>
</template>
