<script setup>
import { ref, computed } from "vue";
import Sidevbar from "@/Layouts/Sidevbar.vue";
const props = defineProps({
    evidences: {
        type: Object,
        required: true,
    },
});

const searchQuery = ref("");

// Filter evidences by name, type, or collected_by
const filteredEvidences = computed(() => {
    if (!searchQuery.value.trim()) return props.evidences.data;
    const query = searchQuery.value.toLowerCase();
    return props.evidences.data.filter(
        (evidence) =>
            (evidence.name && evidence.name.toLowerCase().includes(query)) ||
            (evidence.type && evidence.type.toLowerCase().includes(query)) ||
            (evidence.collected_by &&
                evidence.collected_by.toLowerCase().includes(query))
    );
});
</script>

<template>
    <Sidevbar>
        <div class="bg-white text-gray-800 p-4 min-h-screen">
            <div class="border-b-2 border-gray-300 mb-6 pb-2">
                <h1 class="text-2xl font-bold tracking-wide text-gray-900">
                    Evidences
                </h1>
                <div class="text-gray-600 text-xs tracking-wide mt-1">
                    Manage all evidence records in the system.
                </div>
            </div>

            <!-- Search bar -->
            <div class="mb-4 max-w-md">
                <input
                    v-model="searchQuery"
                    type="text"
                    placeholder="Search by name, type, or collected by..."
                    class="w-full pl-8 pr-4 py-2 border border-gray-300 bg-gray-100 text-gray-800 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
                <span
                    class="absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-500"
                    >🔍</span
                >
            </div>

            <!-- Evidences table -->
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
                                Crime ID
                            </th>
                            <th
                                class="text-left p-3 font-semibold text-sm tracking-wide text-gray-700"
                            >
                                Type
                            </th>
                            <th
                                class="text-left p-3 font-semibold text-sm tracking-wide text-gray-700"
                            >
                                Name
                            </th>
                            <th
                                class="text-left p-3 font-semibold text-sm tracking-wide text-gray-700"
                            >
                                Description
                            </th>
                            <th
                                class="text-left p-3 font-semibold text-sm tracking-wide text-gray-700"
                            >
                                File
                            </th>
                            <th
                                class="text-left p-3 font-semibold text-sm tracking-wide text-gray-700"
                            >
                                Date Collected
                            </th>
                            <th
                                class="text-left p-3 font-semibold text-sm tracking-wide text-gray-700"
                            >
                                Collected By
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="evidence in filteredEvidences"
                            :key="evidence.id"
                            class="hover:bg-gray-50 border-b border-gray-200 transition-colors"
                        >
                            <td class="p-3 text-sm">{{ evidence.id }}</td>
                            <td class="p-3 text-sm">{{ evidence.crime_id }}</td>
                            <td class="p-3 text-sm">{{ evidence.type }}</td>
                            <td class="p-3 text-sm font-medium">
                                {{ evidence.name }}
                            </td>
                            <td class="p-3 text-sm">
                                {{
                                    evidence.description &&
                                    evidence.description.length > 50
                                        ? evidence.description.substring(
                                              0,
                                              50
                                          ) + "..."
                                        : evidence.description
                                }}
                            </td>
                            <td class="p-3 text-sm">
                                <a
                                    v-if="evidence.file_path"
                                    :href="evidence.file_path"
                                    target="_blank"
                                    class="text-blue-600 underline"
                                    >View</a
                                >
                                <span v-else class="text-gray-400">-</span>
                            </td>
                            <td class="p-3 text-sm">
                                {{ evidence.date_collected }}
                            </td>
                            <td class="p-3 text-sm">
                                {{ evidence.collected_by }}
                            </td>
                        </tr>
                        <tr v-if="filteredEvidences.length === 0">
                            <td
                                colspan="8"
                                class="text-center py-4 text-gray-500"
                            >
                                No evidence found.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div
                class="mt-6 flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6"
            >
                <div class="flex flex-1 justify-between sm:hidden">
                    <Link
                        v-if="evidences.prev_page_url"
                        :href="evidences.prev_page_url"
                        class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                    >
                        Previous
                    </Link>
                    <span
                        v-else
                        class="relative inline-flex items-center rounded-md border border-gray-300 bg-gray-100 px-4 py-2 text-sm font-medium text-gray-500 cursor-not-allowed"
                    >
                        Previous
                    </span>

                    <Link
                        v-if="evidences.next_page_url"
                        :href="evidences.next_page_url"
                        class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                    >
                        Next
                    </Link>
                    <span
                        v-else
                        class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-gray-100 px-4 py-2 text-sm font-medium text-gray-500 cursor-not-allowed"
                    >
                        Next
                    </span>
                </div>

                <div
                    class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between"
                >
                    <div>
                        <p class="text-sm text-gray-700">
                            Showing
                            <span class="font-medium">{{
                                evidences.from
                            }}</span>
                            to
                            <span class="font-medium">{{ evidences.to }}</span>
                            of
                            <span class="font-medium">{{
                                evidences.total
                            }}</span>
                            results
                        </p>
                    </div>

                    <div>
                        <nav
                            class="isolate inline-flex -space-x-px rounded-md shadow-sm"
                            aria-label="Pagination"
                        >
                            <!-- Previous Page Link -->
                            <Link
                                v-if="evidences.prev_page_url"
                                :href="evidences.prev_page_url"
                                class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
                            >
                                <span class="sr-only">Previous</span>
                                <svg
                                    class="h-5 w-5"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                    aria-hidden="true"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </Link>
                            <span
                                v-else
                                class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-300 ring-1 ring-inset ring-gray-300 focus:outline-offset-0 cursor-not-allowed"
                            >
                                <span class="sr-only">Previous</span>
                                <svg
                                    class="h-5 w-5"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                    aria-hidden="true"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </span>

                            <!-- Pagination Elements -->
                            <template
                                v-for="(link, i) in evidences.links.slice(
                                    1,
                                    -1
                                )"
                                :key="i"
                            >
                                <Link
                                    v-if="link.url"
                                    :href="link.url"
                                    :class="[
                                        link.active
                                            ? 'bg-blue-50 border-blue-500 text-blue-600'
                                            : 'text-gray-500 hover:bg-gray-50',
                                        'relative inline-flex items-center px-4 py-2 text-sm font-semibold ring-1 ring-inset ring-gray-300 focus:z-20 focus:outline-offset-0',
                                    ]"
                                >
                                    {{ link.label }}
                                </Link>
                                <span
                                    v-else
                                    :class="[
                                        link.active
                                            ? 'bg-blue-50 border-blue-500 text-blue-600'
                                            : 'text-gray-500',
                                        'relative inline-flex items-center px-4 py-2 text-sm font-semibold ring-1 ring-inset ring-gray-300 focus:z-20 focus:outline-offset-0',
                                    ]"
                                >
                                    {{ link.label }}
                                </span>
                            </template>

                            <!-- Next Page Link -->
                            <Link
                                v-if="evidences.next_page_url"
                                :href="evidences.next_page_url"
                                class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
                            >
                                <span class="sr-only">Next</span>
                                <svg
                                    class="h-5 w-5"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                    aria-hidden="true"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </Link>
                            <span
                                v-else
                                class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-300 ring-1 ring-inset ring-gray-300 focus:outline-offset-0 cursor-not-allowed"
                            >
                                <span class="sr-only">Next</span>
                                <svg
                                    class="h-5 w-5"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                    aria-hidden="true"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </Sidevbar>
</template>
