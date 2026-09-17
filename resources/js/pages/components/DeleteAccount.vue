<script setup lang="ts">
import { Trash2 } from '@lucide/vue';

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
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

</script>

<template>
    <AlertDialog>
        <AlertDialogTrigger
            class="bg-red-500 px-3 py-1.5 rounded-lg sm:rounded-xl text-account text-white font-bold flex items-center gap-1">
            <Trash2 class="size-(--text-account)" />
            <span>Delete the account</span>
        </AlertDialogTrigger>
        <AlertDialogContent>
            <AlertDialogHeader>
                <AlertDialogTitle>
                    Are you absolutely sure?
                </AlertDialogTitle>
                <AlertDialogDescription>
                    This action cannot be undone. This will permanently delete your account
                    and remove your data from our servers.
                </AlertDialogDescription>
            </AlertDialogHeader>
            <AlertDialogFooter class="text-white font-bold *:hover:cursor-pointer">
                <AlertDialogCancel class="bg-frosted">
                    Cancel
                </AlertDialogCancel>
                <AlertDialogAction class="bg-red-500">
                    <Link :href="route('delete.user')" method="delete">
                        Continue
                    </Link>
                </AlertDialogAction>
            </AlertDialogFooter>
        </AlertDialogContent>
    </AlertDialog>
</template>
