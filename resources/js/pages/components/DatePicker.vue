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
                    <div class="flex w-full max-w-sm items-center space-x-2">
                        <Input type="email" placeholder="Email" />
                        <Button type="submit">
                            Subscribe
                        </Button>
                    </div>
                </AlertDialogDescription>
            </AlertDialogHeader>
            <AlertDialogFooter>
                <AlertDialogCancel>Cancel</AlertDialogCancel>
            </AlertDialogFooter>
        </AlertDialogContent>
    </AlertDialog>
</template>
