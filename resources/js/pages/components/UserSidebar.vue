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

import { Component, LayoutDashboard, ListTodo, Settings, UserRound } from '@lucide/vue';
import { User } from '@/types';
import { reactive } from 'vue';

defineProps<{user : User}>()

const items = reactive([
    {
        'id' : 1,
        'title' : 'Dashboard',
        'url' : '#',
        'icon' : LayoutDashboard,
        'active' : true,
    },
    {
        'id' : 2,
        'title' : 'Tasks',
        'url' : '#',
        'icon' : ListTodo,
        'active' : false,
    },
    {
        'id' : 3,
        'title' : 'Settings',
        'url' : '#',
        'icon' : Settings,
        'active' : false,
    },
])

function switchActive(itemId : number){
    items.forEach(item => {
        if(item.id === itemId){
            item.active = true
        }
        else{
            item.active = false
        }
    });
}

</script>

<template>
    <SidebarProvider>
        <Sidebar collapsible="icon" variant="floating">
            <SidebarHeader >
                <!-- <slot name="header"></slot> -->
                <SidebarMenu>
                    <SidebarMenu>
                        <SidebarMenuItem>
                            <SidebarMenuButton as-child class="">
                                <div class="flex gap-3 text-frosted text-bold">
                                    <component :is="UserRound"/>
                                    <span>{{ user.name }}</span>
                                </div>
                            </SidebarMenuButton>
                        </SidebarMenuItem>
                    </SidebarMenu>
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent>
                <SidebarGroup>
                    <SidebarGroupLabel>Pages</SidebarGroupLabel>
                    <SidebarGroupContent>
                        <SidebarMenu>
                            <SidebarMenuItem v-for="item in items" :key="item.id">
                                <SidebarMenuButton as-child class="mb-2">
                                    <a :href="item.url" @click="switchActive(item.id)"  :class="{'bg-frosted text-white text-bold' : item.active, 'hover:bg-surface-300 hover:text-frosted' : !item.active}">
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
