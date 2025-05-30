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
                                {{ suspect.crime.title }}
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
                        v-if="suspects.prev_page_url"
                        :href="suspects.prev_page_url"
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
                        v-if="suspects.next_page_url"
                        :href="suspects.next_page_url"
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
                            <span class="font-medium">{{ suspects.from }}</span>
                            to
                            <span class="font-medium">{{ suspects.to }}</span>
                            of
                            <span class="font-medium">{{
                                suspects.total
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
                                v-if="suspects.prev_page_url"
                                :href="suspects.prev_page_url"
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
                                v-for="(link, i) in suspects.links.slice(1, -1)"
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
                                v-if="suspects.next_page_url"
                                :href="suspects.next_page_url"
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
