<script setup lang="ts">
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const title = ref('');
const description = ref('');
const due_date = ref('');
const priority = ref('media');
const form = useForm({
    title: '',
    description: '',
    due_date: '',
    priority: 'media',
});

const priorities = ['alta', 'media', 'baixa'];

const submitTask = () => {
    form.post('/tasks', {
        //apos sucesso, limpa os campos
        onSuccess: () => {
            title.value = '';
            description.value = '';
            due_date.value = '';
            priority.value = 'media';
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
        <h3 class="text-xl font-semibold mb-4">Criar Nova Tarefa</h3>
        <form @submit.prevent="submitTask">
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título</label>
                <input
                    v-model="form.title"
                    id="title"
                    type="text"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    required
                />
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descrição</label>
                <textarea
                    v-model="form.description"
                    id="description"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                ></textarea>
            </div>

            <div class="mb-4">
                <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Data de Vencimento</label>
                <input
                    v-model="form.due_date"
                    id="due_date"
                    type="date"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                />
            </div>

            <div class="mb-4">
                <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Prioridade</label>
                <select
                    v-model="form.priority"
                    id="priority"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                >
                    <option v-for="priority in priorities" :key="priority" :value="priority">{{ priority }}</option>
                </select>
            </div>

            <div class="mb-4">
                <button
                    type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >
                    Criar Tarefa
                </button>
            </div>
        </form>
    </div>
</template>
