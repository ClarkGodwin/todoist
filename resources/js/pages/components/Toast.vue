<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { CircleCheck } from '@lucide/vue';

const page = usePage()

console.log(page.flash.success)

</script>

<template>
    <div class="relative left-toast-left-position ">
        <div
            class="font-bold text-white text-toast bg-frosted h-fit flex items-center justify-center gap-toast-gap  p-toast-p rounded-xl fixed top-toast-top-position">
            <CircleCheck class="size-(--text-toast)" />
            <span>
                The credentials do not match
            </span>
        </div>
    </div>
</template>
