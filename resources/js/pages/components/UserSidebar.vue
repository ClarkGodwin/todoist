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

let page = usePage()
let test = 'Dashboard'
console.log(page.url.includes(test.toLowerCase()))

/*
From the following line, I get the user's informations from any of the pages inside the user folder.
Why am I doing it ?
Well, to simply follow the Do Not Repeat Yourself Rule. All the pages in user and folder will share the same sidebar, so that the browser doesn't re-render the sidebar every time, I'm going to use this component as the layout for every component inside the user folder.

So, I sent the user, from the UserController, to the dashboard component, as an example, and then send it to the layout
*/
defineProps<{ user: User }>()

/**
 * List of the links in the sidebar. It makes it easier to manage
 */
const items = reactive([
    {
        'id': 1,
        'title': 'Dashboard',
        'url': 'user.dashboard',
        'icon': LayoutDashboard,
        'active': true,
    },
    {
        'id': 2,
        'title': 'Tasks',
        'url': 'user.tasks',
        'icon': ListTodo,
        'active': false,
    },
    // {
    //     'id' : 3,
    //     'title' : 'Settings',
    //     'url' : '#',
    //     'icon' : Settings,
    //     'active' : false,
    // },
])

/**
 * When I navigate in a page containing the sidebar, this function is called, checks on which page the user is through the url and the title property of the items reactive variable , give the value true to its active property and false to all the others
 */
function switchActive() {
    items.forEach(item => {
        if(page.url.includes(item.title.toLowerCase())){
            item.active = true
        }
        else{
            item.active = false
        }
    });
}
switchActive()

</script>

<template>
    <SidebarProvider>
        <Sidebar collapsible="icon" variant="floating">
            <SidebarHeader>
                <SidebarMenu>
                    <SidebarMenu>
                        <SidebarMenuItem>
                            <SidebarMenuButton as-child class="">
                                <div class="flex gap-3 text-frosted text-bold">
                                    <!-- the component tag will act like the icon in :is -->
                                    <UserRound class="size-(--text-sidebar-header-content)" />
                                    <span class="text-sidebar-header-content">{{ user.name }}</span>
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
                            <!-- displaying the links on the sidebar
                            the links come from the items variable in the script tag -->
                            <SidebarMenuItem v-for="item in items" :key="item.id">
                                <SidebarMenuButton as-child class="mb-2">
                                    <Link :href="route(item.url, { id: user.id })"
                                        :class="{ 'bg-frosted text-white text-bold': item.active, 'hover:bg-surface-300 hover:text-frosted': !item.active }">
                                        <component :is="item.icon" />
                                        <span>{{ item.title }}</span>
                                    </Link>
                                </SidebarMenuButton>
                            </SidebarMenuItem>
                        </SidebarMenu>
                    </SidebarGroupContent>
                </SidebarGroup>
            </SidebarContent>
        </Sidebar>
        <SidebarTrigger />
    </SidebarProvider>
</template>
