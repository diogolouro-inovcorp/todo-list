<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { useI18n } from 'vue-i18n';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import { router } from '@inertiajs/vue3';

const { t } = useI18n();

const form = useForm({
    title: '',
    description: '',
    due_date: '',
    priority: 'media',
});
const emit = defineEmits(['created']);

const priorities = ['alta', 'media', 'baixa'];

const submitTask = () => {
    form.post('/tasks', {
        //apos sucesso, limpa os campos
        onSuccess: () => {
            form.reset();
            //notifica o dashboard
            emit('created');
            router.reload({ only: ['notifications'] });
        },
        //erros
        onError: (errors) => {
            console.log(errors);
        },
    });
};


</script>

<template>
    <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold mb-4">{{ t('create_task.title') }}</h3>
        <form @submit.prevent="submitTask">
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ t('create_task.field_title') }}</label>
                <input
                    v-model="form.title"
                    id="title"
                    type="text"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    required
                />
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ t('create_task.field_description') }}</label>
                <textarea
                    v-model="form.description"
                    id="description"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                ></textarea>
            </div>

            <div class="mb-4">
                <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ t('create_task.field_due_date') }}</label>
                <input
                    v-model="form.due_date"
                    id="due_date"
                    type="date"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                />
            </div>

            <div class="mb-4">
                <Label for="priority">{{ t('create_task.field_priority') }}</Label>
                <select
                    v-model="form.priority"
                    id="priority"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                >
                    <option v-for="priority in priorities" :key="priority" :value="priority">{{ t(`create_task.priorities.${priority}`) }}</option>
                </select>
            </div>

            <div class="mb-4">
                <Button
                    type="submit"
                >
                    {{ t('create_task.button') }}
                </Button>
                <p v-if="form.recentlySuccessful" class="text-green-600 mt-2">{{ t('create_task.success') }}</p>
            </div>
        </form>
    </div>
</template>
