<script setup lang="ts">
import { onMounted, ref } from 'vue'
import axios from 'axios'

const wantsPush = ref(true);
const loading = ref(false)

onMounted(async () => {
    try {
        const response = await axios.get('/settings/push-notifications/status');
        wantsPush.value = response.data.wantsPush;
    } catch (e) {
        console.error('Erro ao obter estado das notificações:', e);
    }
});

const toggle = async () => {
    loading.value = true;

    try {
        await axios.post('/settings/push-notifications/toggle', {
            wantsPush: !wantsPush.value,
        });
        wantsPush.value = !wantsPush.value;
    } catch (e) {
        console.error('Erro ao atualizar preferências de notificações:', e);
    } finally {
        loading.value = false;
    }
};

</script>

<template>
    <div class="flex items-center space-x-3">
        <span class="text-sm font-medium text-gray-700">Receber notificações push</span>
        <button
            @click="toggle"
            :disabled="loading"
            class="relative inline-flex items-center h-6 rounded-full w-11 transition-colors"
            :class="wantsPush ? 'bg-green-600' : 'bg-gray-300'"
        >
            <span
                class="inline-block w-4 h-4 transform bg-white rounded-full transition-transform"
                :class="wantsPush ? 'translate-x-6' : 'translate-x-1'"
            />
        </button>
    </div>
</template>
