<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

import LanguageManager from '@/components/LanguageManager.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import { type BreadcrumbItem } from '@/types';

import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Language settings',
        href: '/settings/language',
    },
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Language settings" />

        <SettingsLayout>
            <div class="space-y-6">
                <HeadingSmall title="Language settings" description="Update your account's language settings" />
                <LanguageManager />
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
