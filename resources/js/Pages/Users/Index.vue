<script setup>
import Sidevbar from "@/Layouts/Sidevbar.vue";
import { ref, computed } from "vue";

const props = defineProps({
    users: {
        type: Object,
        required: true,
    },
});

const searchQuery = ref("");

// Filter users by name or email
const filteredUsers = computed(() => {
    if (!searchQuery.value.trim()) return props.users.data;
    const query = searchQuery.value.toLowerCase();
    return props.users.data.filter(
        (user) =>
            user.name.toLowerCase().includes(query) ||
            user.email.toLowerCase().includes(query)
    );
});
</script>

<template>
    <Sidevbar>
        <div class="bg-white text-gray-800 p-4 min-h-screen">
            <div class="border-b-2 border-gray-300 mb-6 pb-2">
                <h1 class="text-2xl font-bold tracking-wide text-gray-900">
                    Users
                </h1>
                <div class="text-gray-600 text-xs tracking-wide mt-1">
                    Manage all users in the system.
                </div>
            </div>

            <!-- Search bar -->
            <div class="mb-4 max-w-md">
                <input
                    v-model="searchQuery"
                    type="text"
                    placeholder="Search by name or email..."
                    class="w-full pl-8 pr-4 py-2 border border-gray-300 bg-gray-100 text-gray-800 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
                <span
                    class="absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-500"
                    >🔍</span
                >
            </div>

            <!-- Users table -->
            <div class="overflow-x-auto rounded-lg shadow">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100 border-b border-gray-200">
                            <th
                                class="text-left p-3 font-semibold text-sm tracking-wide text-gray-700"
                            >
                                ID
                            </th>
                            <th
                                class="text-left p-3 font-semibold text-sm tracking-wide text-gray-700"
                            >
                                Name
                            </th>
                            <th
                                class="text-left p-3 font-semibold text-sm tracking-wide text-gray-700"
                            >
                                Email
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="user in filteredUsers"
                            :key="user.id"
                            class="hover:bg-gray-50 border-b border-gray-200 transition-colors"
                        >
                            <td class="p-3 text-sm">{{ user.id }}</td>
                            <td class="p-3 text-sm font-medium">
                                {{ user.name }}
                            </td>
                            <td class="p-3 text-sm">{{ user.email }}</td>
                        </tr>
                        <tr v-if="filteredUsers.length === 0">
                            <td
                                colspan="3"
                                class="text-center py-4 text-gray-500"
                            >
                                No users found.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </Sidevbar>
</template>
