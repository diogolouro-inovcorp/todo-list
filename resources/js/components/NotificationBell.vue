<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue'
import axios from 'axios'
import { BellIcon } from 'lucide-vue-next'
import { router } from '@inertiajs/vue3'

const notifications = ref([])
const unreadCount = ref(0)
const dropdownOpen = ref(false)

const fetchNotifications = async () => {
    const res = await axios.get('/notifications')
    notifications.value = res.data.notifications
    unreadCount.value = res.data.unread
}

const toggleDropdown = () => {
    dropdownOpen.value = !dropdownOpen.value
    if (dropdownOpen.value) markAsRead()
}

const markAsRead = async () => {
    await axios.post('/notifications/mark-as-read')
    unreadCount.value = 0
}

const goTo = (notification) => {
    if (notification.data.url) {
        router.visit(notification.data.url)
    }
}

onMounted(() => {
    fetchNotifications();
});

defineExpose({ fetchNotifications });
</script>

<template>
    <div class="relative">
        <button @click="toggleDropdown" class="relative">
            <BellIcon class="w-6 h-6 text-gray-700 dark:text-white" />
            <span v-if="unreadCount > 0"
                  class="absolute -top-1 -right-1 bg-red-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
        {{ unreadCount }}
      </span>
        </button>

        <div v-if="dropdownOpen"
             class="absolute right-0 mt-2 w-72 bg-white dark:bg-gray-800 shadow-xl rounded-lg z-50 border dark:border-gray-700">
            <div v-if="notifications.length === 0" class="p-4 text-sm text-gray-500 dark:text-gray-300">
                Sem notificações.
            </div>
            <ul v-else class="divide-y divide-gray-200 dark:divide-gray-700 max-h-64 overflow-auto">
                <li v-for="notification in notifications" :key="notification.id" class="p-4 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer" @click="goTo(notification)">
                    <div class="font-semibold text-gray-800 dark:text-white">{{ notification.data.title || 'Notificação' }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-300">{{ notification.data.body }}</div>
                    <p class="text-xs text-gray-600 dark:text-gray-300">
                        {{ notification.data.priority }} — {{ notification.data.due_date }}
                    </p>
                    <p class="text-xs mt-1 text-gray-500 dark:text-gray-400" v-if="notification.data.description">
                        {{ notification.data.description }}
                    </p>
                </li>
            </ul>
        </div>
    </div>
</template>

