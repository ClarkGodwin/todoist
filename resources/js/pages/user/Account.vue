<script lang="ts">
export default {
    layout: {
        sidebar: [UserSidebar, { active: 'account' }],
    }
}
</script>

<script setup lang="ts">
import UserSidebar from '../components/UserSidebar.vue';
</script>

<template>
    account
</template>
