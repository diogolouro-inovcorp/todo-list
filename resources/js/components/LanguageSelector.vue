<script setup lang="ts">
import { useI18n } from 'vue-i18n';

const { t } = useI18n();
const { locale } = useI18n();
const currentLocale = locale;

const changeLocale = () => {
    localStorage.setItem('locale', currentLocale.value);
};
</script>

<template>
    <div>
        <p class="mb-2">{{ t('language_selector.select') }}</p>
        <select v-model="currentLocale" @change="changeLocale" class="rounded border p-2">
            <option value="pt">🇵🇹 {{ t('language_selector.portuguese') }}</option>
            <option value="en">🇬🇧 {{ t('language_selector.english') }}</option>
            <option value="es">🇪🇸 {{ t('language_selector.spanish') }}</option>
            <option value="fr">🇫🇷 {{ t('language_selector.french') }}</option>
        </select>
    </div>
</template>
