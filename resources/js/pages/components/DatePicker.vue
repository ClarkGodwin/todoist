<script setup lang="ts">
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger,
} from '@/components/ui/alert-dialog'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Form } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

defineProps<{
    errors?: Record<string, string>
}>()

</script>

<template>
    <AlertDialog>
        <AlertDialogTrigger class="text-dark-surface-400 font-bold text-[20px]">
            <slot></slot>
        </AlertDialogTrigger>
        <AlertDialogContent>
            <AlertDialogHeader>
                <AlertDialogTitle>Pick a date to see the tasks planned for that day</AlertDialogTitle>
                <AlertDialogDescription>
                    <Form :action="route('date.picker')" method="post"
                        class="flex w-full max-w-sm items-center space-x-2">
                        <Input type="date" placeholder="Day" name="day" />
                        <div v-if="errors!['day'] != undefined" class="mt-2 text-red-500">{{ errors!['day'] }}</div>
                        <Button type="submit">
                            Submit
                        </Button>
                    </Form>
                </AlertDialogDescription>
            </AlertDialogHeader>
            <AlertDialogFooter>
                <AlertDialogCancel class="bg-dark-surface-400 text-surface-400 font-bold">Cancel</AlertDialogCancel>
            </AlertDialogFooter>
        </AlertDialogContent>
    </AlertDialog>
</template>
