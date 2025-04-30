<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import TaskList from '../components/TaskList.vue'
import CreateTask from '@/components/CreateTask.vue';
import TaskDetails from '@/components/TaskDetails.vue';
import { ref } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

const selectedTask = ref(null);
const showDetails = ref(false);

const openDetails = (task) => {
    selectedTask.value = task;
    showDetails.value = true;
};

const closeDetails = () => {
    showDetails.value = false;
};

const updateLocalTask = (updatedTask) => {
    // Atualiza a lista local se estiveres a usar local state
};

</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <div class="bg-blue-200 text-black p-4 h-full">
                        Estou visível?
                    </div>
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <TaskList @select-task="openDetails"/>
                    <TaskDetails :task="selectedTask" :show="showDetails" @close="closeDetails" @updated="updateLocalTask" />
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
            </div>
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                <CreateTask />
            </div>
        </div>
    </AppLayout>
</template>
