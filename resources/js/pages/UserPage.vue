<script setup lang="ts">
import { User } from '@/types';

defineProps<{user : User}>()
</script>

<template>
    {{ user.status }}
</template>
