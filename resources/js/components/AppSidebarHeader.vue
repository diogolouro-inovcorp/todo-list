<script setup lang="ts">
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import { SidebarTrigger } from '@/components/ui/sidebar';
import type { BreadcrumbItemType } from '@/types';
import NotificationBell from '@/components/NotificationBell.vue';

import { ref, defineExpose } from 'vue';

defineProps<{
    breadcrumbs?: BreadcrumbItemType[];
}>();

const notificationsBell = ref(null);

defineExpose({
    refreshNotifications() {
        if (notificationsBell.value) {
            notificationsBell.value.fetchNotifications();
        }
    }
});
</script>

<template>
    <header
        class="flex h-16 shrink-0 justify-between gap-2 border-b border-sidebar-border/70 px-6 transition-[width,height] ease-linear group-has-data-[collapsible=icon]/sidebar-wrapper:h-12 md:px-4"
    >
        <div class="flex items-center gap-2">
            <SidebarTrigger class="-ml-1" />
            <template v-if="breadcrumbs.length > 0">
                <Breadcrumbs :breadcrumbs="breadcrumbs" />
            </template>
        </div>
        <div class="flex items-center gap-2">
            <NotificationBell ref="notificationsBell" />
        </div>
    </header>
</template>
