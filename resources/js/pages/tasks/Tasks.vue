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
import { Circle, CircleDot, CirclePlus, PenSquareIcon, Trash2Icon } from '@lucide/vue';

const props = defineProps<{
    auth: {
        user: User
    }
    tasks: Task[]
}>()

const day = ref('Today')

const targetDate = ref<string>(props.tasks[0].day); // YYYY-MM-DD format

// Helper to get local YYYY-MM-DD string
const getLocalDateString = (d = new Date()): string => {
    const year = d.getFullYear();
    const month = String(d.getMonth() + 1).padStart(2, '0');
    const day = String(d.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
};

// Computed property returning boolean
const isToday = computed(() => {
    return targetDate.value === getLocalDateString();
});

function switchStatus(task_id: number) {
    props.tasks.forEach(task => {
    });
}

</script>

<template>
    <div v-if="props.tasks.length === 0"
        class="flex flex-col justify-center items-center gap-4 text-dark-surface-400 w-fit mx-auto text-tasks-noTasks">
        <span>It looks like you don't have any tasks yet for {{ day.toLowerCase }}</span>
        <Link :href="route('create.task')" class="">
            <button
                class="bg-frosted text-white font-bold hover:cursor-pointer rounded-lg sm:rounded-xl p-tasks-p w-fit">Create
                a task</button>
        </Link>
    </div>

    <div v-else>
        <div class="m-10">
            <div class="flex items-center gap-2">
                <div class="text-dark-surface-400 font-bold text-[20px] mb-2">{{ day }}</div>
                <Link :href="route('create.task')">
                    <button class="bg-dark-surface-400 hover:cursor-pointer font-bold text-surface-400">Create a
                        task</button>
                </Link>
            </div>
            <div class="flex flex-col gap-1">
                <div v-for="task in props.tasks" :key="task.id" class="ml-7">
                    <div class="flex items-center gap-2">
                        <Link :href="route('switchStatus', task.id)" method="post">
                            <Circle v-if="task.status == 'to_do'" class="size-[16px] hover:cursor-pointer" />

                            <CircleDot v-if="task.status == 'done'"
                                class="size-[16px] text-dark-surface-400 hover:cursor-pointer" />
                        </Link>

                        <span :title="task.description"
                            :class="[task.status == 'to_do' ? 'text-dark-surface-100' : 'text-dark-surface-400 line-through']"
                            >
                            {{ task.title }}
                        </span>

                        <Link :href="route('update.task.form', task.id)">
                            <PenSquareIcon />
                        </Link>
                        <Trash2Icon />
                    </div>
                </div>

            </div>

            <Link :href="route('create.task', tasks[0].day)">
                <CirclePlus />
            </Link>
        </div>
    </div>
</template>
