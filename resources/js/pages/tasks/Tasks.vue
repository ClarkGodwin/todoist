<script lang="ts">
export default {
    layout: [UserSidebar, { active: 'tasks' }]
}
</script>

<script setup lang="ts">
import { User } from '@/types/auth.js';
import UserSidebar from '../components/UserSidebar.vue';
import { Task } from '@/types/tasks.js';
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import { computed, ref } from 'vue';
import { Circle, CircleDot, CirclePlus, Move, PenSquareIcon, Trash2Icon } from '@lucide/vue';
import DatePicker from '../components/DatePicker.vue';

const props = defineProps<{
    auth: {
        user: User
    }
    tasks: Task[]
    day: string // the day on which the user would like to see the tasks
}>()

const targetDate = ref<string>(props.day); // YYYY-MM-DD format

// Helper to get local YYYY-MM-DD string, a.k.a the current date
const getLocalDateString = (d = new Date()): string => {
    const year = d.getFullYear();
    const month = String(d.getMonth() + 1).padStart(2, '0');
    const day = String(d.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
};

// Computed property returning boolean
const isToday = computed(() => {
    return props.day === getLocalDateString();
});

const displayedDay = isToday.value ? ref('Today') : ref(props.day)

</script>

<template>
    <div v-if="props.tasks.length === 0"
        class="flex flex-col justify-center items-center gap-4 text-dark-surface-400 w-fit mx-auto text-tasks-noTasks">
        <span>
            It looks like you don't have any tasks yet for
            <DatePicker>{{ displayedDay }}</DatePicker>
        </span>
        <Link :href="route('create.task', day)" class="">
            <button
                class="bg-frosted text-white font-bold hover:cursor-pointer rounded-lg sm:rounded-xl p-tasks-p w-fit">Create
                a task</button>
        </Link>
    </div>

    <div v-else>
        <div class="m-10">
            <div class="mb-task-mb">
                <DatePicker>
                    <span class="text-dark-surface-400 font-bold text-task-h">{{ displayedDay }}</span>
                </DatePicker>
            </div>
            <div class="flex flex-col gap-1 mb-task-mb">
                <div v-for="task in props.tasks" :key="task.id" class="ml-7">
                    <div class="flex items-center gap-task-gap text-task-t">
                        <Link :href="route('switchStatus', task.id)" method="post">
                            <Circle v-if="task.status == 'to_do'" class="size-(--text-task-t) hover:cursor-pointer" />

                            <CircleDot v-if="task.status == 'done'"
                                class="size-(--text-task-t) text-dark-surface-400 hover:cursor-pointer" />
                        </Link>

                        <span :title="task.description"
                            :class="[task.status == 'to_do' ? 'text-dark-surface-100' : 'text-dark-surface-400 line-through']">
                            {{ task.title }}
                        </span>

                        <Link :href="route('update.task.form', task.id)">
                            <PenSquareIcon :class="[task.status == 'to_do' ? 'text-frosted' : 'text-dark-surface-400 line-through', 'size-(--text-task-t)']"/>
                        </Link>
                        <Link :href="route('move.to.date.form', task.id)">
                            <Move :class="[task.status == 'to_do' ? 'text-yellow-500' : 'text-dark-surface-400 line-through', 'size-(--text-task-t)']" />
                        </Link>
                        <Link :href="route('delete.task', task.id)" method="post" class="hover:cursor-pointer">
                            <Trash2Icon :class="[task.status == 'to_do' ? 'text-red-500' : 'text-dark-surface-400 line-through', 'size-(--text-task-t)']" />
                        </Link>
                    </div>
                </div>

            </div>

            <Link :href="route('create.task', day)">
                <CirclePlus class="size-(--text-task-h)" />
            </Link>
        </div>
    </div>
</template>
