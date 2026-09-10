<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { CircleCheck } from '@lucide/vue';
import { ref } from 'vue';

const page = usePage()

const visible = ref(true)

function displayToastForTwoSeconds(){
    setTimeout(() => {
        visible.value = false

    }, 2000);
}

displayToastForTwoSeconds()

</script>

<template>
    <div v-if="visible" class="relative left-toast-left-position ">
        <div
            class="font-bold text-white text-toast bg-frosted h-fit flex items-center justify-center gap-toast-gap  p-toast-p rounded-xl fixed top-toast-top-position">
            <CircleCheck class="size-(--text-toast)" />
            <span>{{ page.flash.success }}</span>
        </div>
    </div>
</template>
