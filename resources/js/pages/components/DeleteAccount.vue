<script setup lang="ts">
import { Trash2 } from '@lucide/vue';

</script>

<template>
    <button
        class="bg-red-500 px-3 py-1.5 rounded-lg sm:rounded-xl text-account text-white font-bold flex items-center gap-1">
        <Trash2 class="size-(--text-account)" />
        <span>Delete the account</span>
    </button>
</template>
