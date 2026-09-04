<script setup lang="ts">
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

import { Component, LayoutDashboard, ListTodo, Settings } from '@lucide/vue';

const items = [
    {
        'title' : 'Dashboard',
        'url' : '#',
        'icon' : LayoutDashboard,
        'active' : true,
    },
    {
        'title' : 'Tasks',
        'url' : '#',
        'icon' : ListTodo,
        'active' : false,
    },
    {
        'title' : 'Settings',
        'url' : '#',
        'icon' : Settings,
        'active' : false,
    },
]

</script>

<template>
    <SidebarProvider>
        <Sidebar collapsible="icon" variant="floating">
            <SidebarHeader class="bg-surface-200">
                <!-- <slot name="header"></slot> -->
                <SidebarMenu>
                    <SidebarMenu>
                        <SidebarMenuItem>
                            <SidebarMenuButton as-child class="hover:text-frosted">
                                <slot name="header"></slot>
                            </SidebarMenuButton>
                        </SidebarMenuItem>
                    </SidebarMenu>
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent class="bg-surface-200">
                <SidebarGroup>
                    <SidebarGroupLabel>Pages</SidebarGroupLabel>
                    <SidebarGroupContent>
                        <SidebarMenu>
                            <SidebarMenuItem v-for="item in items" :key="item.title">
                                <SidebarMenuButton as-child>
                                    <a :href="item.url">
                                        <component :is="item.icon"/>
                                        <span>{{ item.title }}</span>
                                    </a>
                                </SidebarMenuButton>
                            </SidebarMenuItem>
                        </SidebarMenu>
                    </SidebarGroupContent>
                </SidebarGroup>
            </SidebarContent>
        </Sidebar>
        <SidebarTrigger/>
    </SidebarProvider>
</template>
