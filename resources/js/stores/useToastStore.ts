import { usePage } from "@inertiajs/vue3";
import { defineStore } from "pinia";
import { computed, ref } from "vue";

export const useToastStore = defineStore('toast', () => {
    const toastVisible = ref(false)

    function detectIfFlashMessageWasSentAndDisplayToastForTwoSeconds() {
        const page = usePage()
        if(page.flash){
            if(page.flash.error || page.flash.success){
                toastVisible.value = true
                setTimeout(() => {
                    toastVisible.value = false
                }, 2000);
            }
        }
        else{
            toastVisible.value = false
        }
    }

    return {
        toastVisible,
        detectIfFlashMessageWasSentAndDisplayToastForTwoSeconds
    }
})
