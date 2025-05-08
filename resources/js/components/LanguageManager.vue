<script setup lang="ts">
import { ref } from 'vue'
import { useI18n } from 'vue-i18n'
import Papa from 'papaparse'
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';

//Tipagem para traduções por idioma
type Translations = Record<string, string>

const { t, locale, availableLocales, messages } = useI18n()

const exportLocale = ref(locale.value)
const importLocale = ref(locale.value)
const csvFile = ref<File | null>(null)

//Funçao para ir buscar objectos aninhados (formato flat)
function flattenTranslations(obj: Record<string, any>, prefix = ''): Record<string, string> {
    return Object.entries(obj).reduce((acc, [key, value]) => {
        const newKey = prefix ? `${prefix}.${key}` : key

        if (typeof value === 'object' && value !== null) {
            Object.assign(acc, flattenTranslations(value, newKey))
        } else {
            acc[newKey] = String(value)
        }

        return acc
    }, {} as Record<string, string>)
}

//Exportação do CSV
const exportLanguage = () => {
    const targetMessages: Translations = messages.value[exportLocale.value] || {}

    const flat = flattenTranslations(targetMessages)

    const csv = Papa.unparse(
        Object.entries(flat).map(([key, translation]) => ({
            key,
            translation,
        }))
    )

    const blob = new Blob(["\uFEFF" + csv], { type: 'text/csv;charset=utf-8;' })
    const link = document.createElement('a')
    link.href = URL.createObjectURL(blob)
    link.download = `translations_${exportLocale.value}.csv`
    link.click()
}

//Carrega o ficheiro CSV
const handleFileUpload = (event: Event) => {
    const target = event.target as HTMLInputElement
    if (target.files?.length) {
        csvFile.value = target.files[0]
    }
}

//Importação do CSV
const importLanguage = () => {
    if (!csvFile.value) {
        alert(t('language_manager.noFileSelected'))
        return
    }

    Papa.parse(csvFile.value, {
        header: true,
        skipEmptyLines: true,
        complete: (results) => {
            const translations = results.data.reduce((acc: Translations, row: any) => {
                if (row.key && row.translation) acc[row.key] = row.translation
                return acc
            }, {})

            //Atualiza o dicionário de mensagens
            messages.value[importLocale.value] = translations

            //Guardar em localStorage (opcional)
            localStorage.setItem(`translations_${importLocale.value}`, JSON.stringify(translations))

            alert(t('language_manager.importSuccess'))
        },
        error: (err) => {
            console.error('Erro ao importar CSV:', err)
            alert(t('language_manager.importError'))
        },
    })
}
</script>

<template>
    <div class="space-y-4 p-4">
        <h2 class="text-lg font-semibold mb-2">{{ t('language_manager.title') }}</h2>

        <!-- Exportar Idiomas -->
        <div class="flex flex-col gap-2">
            <Label>{{ t('language_manager.selectExportLanguage') }}</Label>
            <select v-model="exportLocale" class="border p-2 rounded">
                <option v-for="loc in availableLocales" :key="loc" :value="loc">{{ loc }}</option>
            </select>
            <Button @click="exportLanguage">{{ t('language_manager.exportButton') }}</Button>
        </div>

        <!-- Importar Idiomas -->
        <div class="flex flex-col gap-2 mt-6">
            <label>{{ t('language_manager.selectImportLanguage') }}</label>
            <!--
            <select v-model="importLocale" class="border p-2 rounded">
                <option v-for="loc in availableLocales" :key="loc" :value="loc">{{ loc }}</option>
            </select>
              -->
            <Input type="file" accept=".csv" @change="handleFileUpload" class="p-2 border rounded" />
            <Button @click="importLanguage">{{ t('language_manager.importButton') }}</Button>
        </div>
    </div>
</template>

