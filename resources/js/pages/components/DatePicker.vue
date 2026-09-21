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
        <AlertDialogTrigger>
            <slot></slot>
        </AlertDialogTrigger>
        <AlertDialogContent>
            <AlertDialogHeader>
                <AlertDialogTitle>Pick a date to see the tasks planned for that day</AlertDialogTitle>
                <AlertDialogDescription>
                    <Form :action="route('date.picker')" method="get" #default="{ errors: formErrors }"
                        class="flex flex-col w-full max-w-sm space-x-2">
                        <Input type="date" placeholder="Day" name="day" />
                        <div v-if="formErrors['day']" class="text-red-500">{{ formErrors['day'] }}</div>
                        <Button type="submit" class="mt-3 font-black"> Submit </Button>
                    </Form>
                </AlertDialogDescription>
            </AlertDialogHeader>
            <AlertDialogFooter>
                <AlertDialogCancel class="bg-dark-surface-400 text-surface-400 font-bold">Cancel</AlertDialogCancel>
            </AlertDialogFooter>
        </AlertDialogContent>
    </AlertDialog>
</template>
