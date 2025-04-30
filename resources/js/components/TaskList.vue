<script setup lang="ts">
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { watch } from 'vue';

const tasks = ref([])
const loading = ref(true)
const filters = ref({
    status: '',
    priority: '',
    due_date: '',
});
const sortBy = ref('due_date');

onMounted(async () => {
    try {
        const response = await axios.get('/tasks')
        tasks.value = response.data
    } catch (error) {
        console.error('Erro ao buscar tarefas:', error)
    } finally {
        loading.value = false
    }
})

const fetchTasks = async () => {
    try {
        const params = {
            ...filters.value,
            sort_by: sortBy.value,
        };

        const response = await axios.get('/tasks', { params });
        tasks.value = response.data;
    } catch (error) {
        console.error('Erro ao buscar tarefas:', error);
    }
};
watch([filters, sortBy], fetchTasks, { deep: true });

const markAsCompleted = async (taskId: number) => {
    try {
        await axios.put(`/tasks/${taskId}`, { completed: true })
        await fetchTasks()
    } catch (error) {
        console.error('Erro ao marcar como concluída:', error)
    }
}

const markAsPending = async (id: number) => {
    try {
        await axios.put(`/tasks/${id}`, { completed: false });
        fetchTasks();
    } catch (error) {
        console.error('Erro ao marcar como pendente:', error);
    }
}

const confirmDelete = async (id: number) => {
    if (confirm('Tens a certeza que queres eliminar esta tarefa?')) {
        try {
            await axios.delete(`/tasks/${id}`);
            fetchTasks();
        } catch (error) {
            console.error('Erro ao eliminar a tarefa:', error);
        }
    }
}

onMounted(fetchTasks)

const scrollContainer = ref<HTMLElement | null>(null);
const isDragging = ref(false);
const startY = ref(0);
const scrollTop = ref(0);

const startDrag = (e: PointerEvent) => {
    isDragging.value = true;
    startY.value = e.clientY;
    scrollTop.value = scrollContainer.value?.scrollTop || 0;
};

const onDrag = (e: PointerEvent) => {
    if (!isDragging.value || !scrollContainer.value) return;
    const dy = e.clientY - startY.value;
    scrollContainer.value.scrollTop = scrollTop.value - dy;
};

const stopDrag = () => {
    isDragging.value = false;
};

</script>

<template>
    <div ref="scrollContainer" class="p-4 max-h-[500px] overflow-y-auto scrollbar-hide" @pointerdown="startDrag" @pointermove="onDrag" @pointerup="stopDrag" @pointerleave="stopDrag">
        <div class="flex flex-wrap gap-2 mb-2 text-xs">
            <select v-model="filters.status" class="border rounded p-2">
                <option value="">Todos os estados</option>
                <option value="pendente">Pendentes</option>
                <option value="concluida">Concluídas</option>
            </select>

            <select v-model="filters.priority" class="border rounded p-2">
                <option value="">Todas as prioridades</option>
                <option value="alta">Alta</option>
                <option value="media">Média</option>
                <option value="baixa">Baixa</option>
            </select>

            <input v-model="filters.due_date" type="date" class="border rounded p-2" placeholder="Data de vencimento" />

            <select v-model="sortBy" class="border rounded p-2">
                <option value="due_date">Ordenar por data</option>
                <option value="priority">Ordenar por prioridade</option>
            </select>
        </div>

        <h2 class="text-xl font-semibold mb-4">Lista de Tarefas</h2>

        <div v-if="loading" class="text-gray-500 dark:text-gray-400">A carregar...</div>

        <ul v-else class="space-y-2">
            <li v-for="task in tasks" :key="task.id" class="p-3 border rounded shadow-sm bg-white dark:bg-gray-800 cursor-pointer" @click="$emit('select-task', task)">
                <div class="flex justify-between items-center">
                    <div :class="{ 'line-through opacity-60': task.completed }">
                        <h3 class="font-medium text-lg">{{ task.title }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ task.description }}</p>
                        <p class="text-xs text-gray-400 mt-1">Vencimento: {{ task.due_date }}</p>
                    </div>
                    <div class="flex flex-col items-end gap-1">
                        <span :class="{'text-red-500': task.priority === 'alta', 'text-yellow-500': task.priority === 'media', 'text-green-500': task.priority === 'baixa'}" class="font-bold capitalize">
                            {{ task.priority }}
                        </span>
                    </div>
                    <div class="flex gap-2">
                        <button v-if="!task.completed" @click="markAsCompleted(task.id)" class="text-sm text-green-600 hover:underline" title="Marcar como concluída">✔️</button>
                        <button v-else @click="markAsPending(task.id)" class="text-sm text-yellow-600 hover:underline" title="Marcar como pendente">↩️</button>
                        <!-- <button @click="deleteTask(task.id)" class="text-sm text-red-600 hover:underline" title="Eliminar tarefa">🗑️</button> -->
                        <button @click="confirmDelete(task.id)" class="text-sm text-red-600 hover:underline" title="Eliminar tarefa">🗑️</button>

                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

