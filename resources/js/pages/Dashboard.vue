<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { useI18n } from 'vue-i18n'
import { onMounted, ref } from 'vue';

import TaskList from '../components/TaskList.vue'
import CreateTask from '@/components/CreateTask.vue';
import TaskDetails from '@/components/TaskDetails.vue';
import TaskStatsChart from '@/components/TaskStatsChart.vue';
import LanguageSelector from '@/components/LanguageSelector.vue';

import axios from 'axios';

defineProps({
    tasks: Array,
    taskStats: Object
})

const { t } = useI18n()

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

const selectedTask = ref(null);
const showDetails = ref(false);
const refreshKey = ref(0);

const openDetails = (task) => {
    selectedTask.value = task;
    showDetails.value = true;
};

const closeDetails = () => {
    showDetails.value = false;
};

const updateLocalTask = () => {
    refreshKey.value++;
    showDetails.value = false;
};

onMounted(async () => {
    if ('serviceWorker' in navigator && 'PushManager' in window) {
        const permission = await Notification.requestPermission();

        if (permission === 'granted') {
            const registration = await navigator.serviceWorker.ready;

            const subscription = await registration.pushManager.subscribe({
                userVisibleOnly: true,
                applicationServerKey: import.meta.env.VITE_VAPID_PUBLIC_KEY,
            });

            await axios.post('/api/push/subscribe', subscription);
            console.log('Subscrição enviada para o servidor.');
        } else {
            console.log('Permissão de notificações negada.');
        }
    }
});

</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <p>{{ t('welcome') }}</p>
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <!-- <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"> -->
                <div class="relative min-h-[300px] sm:h-auto overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <CreateTask @created="updateLocalTask"/>
                </div>
                <div class="relative min-h-[300px] sm:h-auto overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <TaskList @edit-task="openDetails" :refresh-key="refreshKey"/>
                    <TaskDetails :task="selectedTask" :show="showDetails" @close="closeDetails" @updated="updateLocalTask" />
                </div>
                <div class="relative min-h-[300px] sm:h-auto overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border bg-white dark:bg-gray-800">
                    <TaskStatsChart :stats="taskStats" />
                </div>
            </div>
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                <LanguageSelector />
               <center>Diogo Louro @ inovcorp group</center>
            </div>
        </div>
    </AppLayout>
</template>
