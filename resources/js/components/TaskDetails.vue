<script setup lang="ts">
import { getCurrentInstance, ref, watch } from 'vue';
import axios from 'axios';
import { useI18n } from 'vue-i18n';

const { t } = useI18n();

const props = defineProps({
    task: Object,
    show: Boolean
});
const emit = defineEmits(['close', 'updated']);

const editedTask = ref({ ...props.task });
const app = getCurrentInstance();
const toast = app?.appContext.config.globalProperties.$toast;

watch(() => props.task, (newVal) => {
    editedTask.value = { ...newVal };
});

const updateTask = async () => {
    try {
        const response = await axios.put(`/tasks/${editedTask.value.id}`, editedTask.value);
        emit('updated', response.data);
        emit('close');
        toast.success(t('toastNotifications.edit'));
    } catch (error) {
        console.error(t('consoleError.edit'), error);
    }
};
</script>

<template>
    <div v-if="show" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-900 p-6 rounded shadow max-w-md w-full">
            <h2 class="text-xl font-semibold mb-4">{{ t('taskDetails.editTitle') }}</h2>
            <div class="space-y-3">
                <input v-model="editedTask.title" placeholder="t('taskDetails.title')" class="w-full border p-2 rounded" />
                <textarea v-model="editedTask.description" placeholder="t('taskDetails.description')" class="w-full border p-2 rounded"></textarea>
                <select v-model="editedTask.priority" class="w-full border p-2 rounded">
                    <option value="alta">{{ t('priority.high') }}</option>
                    <option value="media">{{ t('priority.medium') }}</option>
                    <option value="baixa">{{ t('priority.low') }}</option>
                </select>
                <input v-model="editedTask.due_date" type="date" class="w-full border p-2 rounded" />
            </div>
            <div class="flex justify-end gap-2 mt-4">
                <button @click="$emit('close')" class="px-4 py-2 bg-gray-400 text-white rounded">{{ t('buttonsDetails.cancel') }}</button>
                <button @click.prevent="updateTask" class="px-4 py-2 bg-blue-600 text-white rounded">{{ t('buttonsDetails.save') }}</button>
            </div>
        </div>
    </div>
</template>
