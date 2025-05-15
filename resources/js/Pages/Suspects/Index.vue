<script setup>
import Sidevbar from "@/Layouts/Sidevbar.vue";
import { Link } from "@inertiajs/vue3";

defineProps({
    suspects: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <Sidevbar>
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-4">Suspects List</h1>

            <div class="overflow-x-auto">
                <table
                    class="min-w-full bg-white shadow-md rounded-lg overflow-hidden text-sm"
                >
                    <thead class="bg-gray-100 text-left">
                        <tr>
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Alias</th>
                            <th class="px-4 py-2">Age</th>
                            <th class="px-4 py-2">Gender</th>
                            <th class="px-4 py-2">Address</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Crime</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(suspect, index) in suspects.data"
                            :key="suspect.id"
                            class="border-b hover:bg-gray-50 transition"
                        >
                            <td class="px-4 py-2">{{ index + 1 }}</td>
                            <td class="px-4 py-2">
                                {{ suspect.first_name }} {{ suspect.last_name }}
                            </td>
                            <td class="px-4 py-2">
                                {{ suspect.alias ?? "—" }}
                            </td>
                            <td class="px-4 py-2">{{ suspect.age ?? "—" }}</td>
                            <td class="px-4 py-2">
                                {{ suspect.gender ?? "—" }}
                            </td>
                            <td class="px-4 py-2">
                                {{ suspect.address ?? "—" }}
                            </td>
                            <td class="px-4 py-2">
                                <span
                                    :class="{
                                        'text-green-600':
                                            suspect.status === 'released',
                                        'text-yellow-600':
                                            suspect.status === 'in custody',
                                        'text-red-600':
                                            suspect.status === 'at large',
                                    }"
                                >
                                    {{ suspect.status }}
                                </span>
                            </td>
                            <td class="px-4 py-2">
                                {{ suspect.crime?.title ?? "Unknown" }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4"></div>
        </div>
    </Sidevbar>
</template>
