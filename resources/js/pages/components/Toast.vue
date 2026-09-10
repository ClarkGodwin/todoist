<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { CircleCheck, CircleX } from '@lucide/vue';
import { ref } from 'vue';

const page = usePage()

const background = ref('') //the background of the toast
const toastText = ref('') //the text displayed on the toast
const successVisible = ref(false) //to show the circlecheck icon if we have a success flash message
const errorVisible = ref(false) //to show the circlex icon if we have a error flash message

if(page.flash.success){
    background.value = 'bg-frosted'
    toastText.value = page.flash.success
    successVisible.value = true
}
else if(page.flash.error){
    background.value = 'bg-red-500'
    toastText.value = page.flash.error
    errorVisible.value = true
}

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
            class="font-bold text-white text-toast h-fit flex items-center justify-center gap-toast-gap  p-toast-p rounded-xl fixed top-toast-top-position"
            :class="background"
        >
            <CircleCheck v-if="successVisible" class="size-(--text-toast)" />
            <CircleX v-if="errorVisible" class="size-(--text-toast)" />
            <span>{{ toastText }}</span>
        </div>
    </div>
</template>
