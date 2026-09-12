<script setup lang="ts">

//NEEDED COMPONENT TO USE THE SIDEBAR COMPONENTS FROM SHADCN-VUE, TAKE A LOOK AT THE ONLINE DOC
import SidebarProvider from '@/components/ui/sidebar/SidebarProvider.vue';
import Sidebar from '@/components/ui/sidebar/Sidebar.vue';
import SidebarHeader from '@/components/ui/sidebar/SidebarHeader.vue';
import SidebarContent from '@/components/ui/sidebar/SidebarContent.vue';
import SidebarGroup from '@/components/ui/sidebar/SidebarGroup.vue';
import SidebarInset from '@/components/ui/sidebar/SidebarInset.vue';
import SidebarTrigger from '@/components/ui/sidebar/SidebarTrigger.vue';
import SidebarGroupLabel from '@/components/ui/sidebar/SidebarGroupLabel.vue';
import SidebarGroupContent from '@/components/ui/sidebar/SidebarGroupContent.vue';
import SidebarMenu from '@/components/ui/sidebar/SidebarMenu.vue';
import SidebarMenuItem from '@/components/ui/sidebar/SidebarMenuItem.vue';
import SidebarMenuButton from '@/components/ui/sidebar/SidebarMenuButton.vue';

import { Component, LayoutDashboard, ListTodo, Settings, UserRound } from '@lucide/vue';
import { User } from '@/types';
import { reactive } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

import Toast from './Toast.vue';

defineProps<{
    //to get the authenticated user
    auth: {
        user: User
    }
    //to get the active link so that a special style will be applied to it
    active: string
}>()

/**
 * List of the links in the sidebar. It makes it easier to manage
 */
const items = reactive([
    {
        'id': 1,
        'title': 'Dashboard',
        'url': 'dashboard',
        'icon': LayoutDashboard,
    },
    {
        'id': 2,
        'title': 'Tasks',
        'url': 'tasks',
        'icon': ListTodo,
        'active': false,
    },
    // {page.url
    //     'id' : 3,
    //     'title' : 'Settings',
    //     'url' : '#',
    //     'icon' : Settings,
    //     'active' : false,
    // },
])

</script>

<template>
    <div class="bg-surface-400">
        <SidebarProvider>
            <Sidebar collapsible="icon" variant="floating">
                <SidebarHeader>
                    <SidebarMenu>
                        <SidebarMenu>
                            <SidebarMenuItem>
                                <SidebarMenuButton as-child class="active:text-frosted">
                                    <Link :href="route('home')" class="flex gap-3 text-frosted font-semibold">
                                        <!-- the component tag will act like the icon in :is -->
                                        <UserRound class="size-(--text-sidebar-header-content)!" />
                                        <span class="text-sidebar-header-content">{{ auth.user.name }}</span>
                                    </Link>
                                </SidebarMenuButton>
                            </SidebarMenuItem>
                        </SidebarMenu>
                    </SidebarMenu>
                </SidebarHeader>

                <SidebarContent>
                    <SidebarGroup>
                        <SidebarGroupLabel class="text-sidebar-body-content font-semibold">Pages</SidebarGroupLabel>
                        <SidebarGroupContent>
                            <SidebarMenu>
                                <!-- displaying the links on the sidebar
                                the links come from the items variable in the script tag -->
                                <SidebarMenuItem v-for="item in items" :key="item.id">
                                    <SidebarMenuButton as-child class="mb-2">
                                        <!-- item.url == active , is used to see which one of the links is active to apply a special style to it -->
                                        <Link :href="route(item.url)"
                                            :class="{ 'bg-frosted text-white font-semibold active:bg-surface-300 active:text-frosted': item.url == active, 'hover:bg-surface-300 hover:text-frosted': item.url != active }">
                                            <component :is="item.icon" class="size-(--text-sidebar-body-content)!" />
                                            <span class="text-sidebar-body-content">{{ item.title }}</span>
                                        </Link>
                                    </SidebarMenuButton>
                                </SidebarMenuItem>
                            </SidebarMenu>
                        </SidebarGroupContent>
                    </SidebarGroup>
                </SidebarContent>
            </Sidebar>
            <SidebarTrigger />

            <!-- this toast is uses to displays toast messages when one of the components using it as a layout has a flash message sent to it -->
            <Toast />

            <slot></slot>
        </SidebarProvider>
    </div>
</template>
