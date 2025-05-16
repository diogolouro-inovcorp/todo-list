<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

import HeadingSmall from '@/components/HeadingSmall.vue';
import { type BreadcrumbItem } from '@/types';

import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';

import TogglePushNotifications from '@/components/TogglePushNotifications.vue';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Push Notifications settings',
        href: '/settings/pushnotifications',
    },
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Push Notifications settings" />

        <SettingsLayout>
            <div class="space-y-6">
                <HeadingSmall title="Push Notifications settings" description="Update your account's push notification settings" />
                <TogglePushNotifications />
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
