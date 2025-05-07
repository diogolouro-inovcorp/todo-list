<script setup lang="ts">
import { useI18n } from 'vue-i18n';

const { locale } = useI18n();
const currentLocale = locale;

const changeLocale = () => {
    localStorage.setItem('locale', currentLocale.value);
};
</script>

<template>
    <select v-model="currentLocale" @change="changeLocale" class="border rounded p-2">
        <option value="pt">Português</option>
        <option value="en">English</option>
    </select>
</template>


