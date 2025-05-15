<script setup>
import Sidevbar from "@/Layouts/Sidevbar.vue";
import ViewModal from "./ViewModal.vue";
import CreateReport from "./CreateReport.vue";
import { Link, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";

const props = defineProps({
    reports: {
        type: Object,
        required: true,
    },
});

// Status colors for badges
const statusColors = {
    Open: "bg-green-100 text-green-800",
    Closed: "bg-gray-100 text-gray-800",
    "In Progress": "bg-blue-100 text-blue-800",
    "Under Review": "bg-yellow-100 text-yellow-800",
    Rejected: "bg-red-100 text-red-800",
};

const getStatusColor = (status) => {
    return statusColors[status] || "bg-gray-100 text-gray-800";
};

// Modal state
const showViewModal = ref(false);
const showCreateModal = ref(false);
const selectedReport = ref(null);

// Search functionality
const searchQuery = ref("");
const filteredReports = ref([...props.reports.data]);

watch(searchQuery, (newQuery) => {
    if (!newQuery.trim()) {
        filteredReports.value = [...props.reports.data];
        return;
    }

    const query = newQuery.toLowerCase();
    filteredReports.value = props.reports.data.filter(
        (report) =>
            report.title.toLowerCase().includes(query) ||
            report.description.toLowerCase().includes(query) ||
            report.status.toLowerCase().includes(query) ||
            report.type.toLowerCase().includes(query) ||
            report.location.toLowerCase().includes(query) ||
            report.case_number.toLowerCase().includes(query)
    );
});

const openReportModal = (report) => {
    // console.log("Opening modal with report:", report);
    console.log("showViewModal before:", showViewModal.value);

    selectedReport.value = report;
    showViewModal.value = true;

    console.log("showViewModal after:", showViewModal.value);
};

const closeReportModal = () => {
    showViewModal.value = false;
};

const openCreateModal = () => {
    showCreateModal.value = true;
};

const closeCreateModal = () => {
    showCreateModal.value = false;
};

const deleteReport = (id) => {
    if (confirm("Are you sure you want to delete this report?")) {
        router.delete(route("delete.report", id));
    }
};
</script>

<template>
    <Sidevbar>
        <div class="bg-white text-gray-800 p-4 min-h-screen">
            <!-- Header -->
            <div class="border-b-2 border-gray-300 mb-6 pb-2">
                <h1 class="text-2xl tracking-wide text-gray-900 font-bold">
                    REPORTS
                </h1>
                <div class="text-gray-600 text-xs tracking-wide mt-1">
                    Manage and review all reports in the system.
                </div>
            </div>

            <!-- Search bar and Add button -->
            <div class="flex justify-between mb-4">
                <div class="relative max-w-md">
                    <input
                        v-model="searchQuery"
                        type="text"
                        placeholder="Search by title, author, status..."
                        class="w-full pl-8 pr-4 py-2 border border-gray-300 bg-gray-100 text-gray-800 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    <span
                        class="absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-500"
                        >🔍</span
                    >
                </div>
                <button
                    @click="openCreateModal"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-500 transition-colors text-sm font-medium flex items-center"
                >
                    <span class="mr-1">+</span> Add New Report
                </button>
            </div>

            <!-- Reports table -->
            <div class="overflow-x-auto rounded-lg shadow">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100 border-b border-gray-200">
                            <th
                                class="text-left p-3 font-semibold text-sm tracking-wide text-gray-700"
                            >
                                Case Number
                            </th>
                            <th
                                class="text-left p-3 font-semibold text-sm tracking-wide text-gray-700"
                            >
                                Title
                            </th>
                            <th
                                class="text-left p-3 font-semibold text-sm tracking-wide text-gray-700"
                            >
                                Description
                            </th>
                            <th
                                class="text-left p-3 font-semibold text-sm tracking-wide text-gray-700"
                            >
                                Type
                            </th>
                            <th
                                class="text-left p-3 font-semibold text-sm tracking-wide text-gray-700"
                            >
                                Location
                            </th>
                            <th
                                class="text-left p-3 font-semibold text-sm tracking-wide text-gray-700"
                            >
                                Incident Date
                            </th>
                            <th
                                class="text-left p-3 font-semibold text-sm tracking-wide text-gray-700"
                            >
                                Status
                            </th>
                            <th
                                class="text-left p-3 font-semibold text-sm tracking-wide text-gray-700"
                            >
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="report in filteredReports"
                            :key="report.id"
                            class="hover:bg-gray-50 border-b border-gray-200 transition-colors"
                        >
                            <td class="p-3 text-sm">
                                {{ report.case_number }}
                            </td>
                            <td class="p-3 text-sm font-medium">
                                {{ report.title }}
                            </td>
                            <td class="p-3 text-sm">
                                {{
                                    report.description.length > 50
                                        ? report.description.substring(0, 50) +
                                          "..."
                                        : report.description
                                }}
                            </td>
                            <td class="p-3 text-sm">
                                <span
                                    class="px-2 py-1 rounded-full bg-gray-100 text-xs font-medium"
                                >
                                    {{ report.type }}
                                </span>
                            </td>
                            <td class="p-3 text-sm">{{ report.location }}</td>
                            <td class="p-3 text-sm">
                                {{ report.incident_date }}
                            </td>
                            <td class="p-3 text-sm">
                                <span
                                    :class="[
                                        getStatusColor(report.status),
                                        'px-2 py-1 rounded-full text-xs font-medium',
                                    ]"
                                >
                                    {{ report.status }}
                                </span>
                            </td>
                            <td class="p-3 whitespace-nowrap text-sm">
                                <Link
                                    :href="route('view.crime', report.id)"
                                    class="bg-blue-600 text-white px-3 py-1 rounded mr-2 hover:bg-blue-500 transition-colors text-xs font-medium"
                                >
                                    View
                                </Link>
                                <button
                                    @click="deleteReport(report.id)"
                                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-500 transition-colors text-xs font-medium"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                        <tr v-if="filteredReports.length === 0">
                            <td
                                colspan="8"
                                class="text-center py-4 text-gray-500"
                            >
                                No reports found
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
                        v-if="reports.prev_page_url"
                        :href="reports.prev_page_url"
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
                        v-if="reports.next_page_url"
                        :href="reports.next_page_url"
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
                            <span class="font-medium">{{ reports.from }}</span>
                            to
                            <span class="font-medium">{{ reports.to }}</span>
                            of
                            <span class="font-medium">{{ reports.total }}</span>
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
                                v-if="reports.prev_page_url"
                                :href="reports.prev_page_url"
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
                                v-for="(link, i) in reports.links.slice(1, -1)"
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
                                v-if="reports.next_page_url"
                                :href="reports.next_page_url"
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

            <!-- View Report Modal -->
            <ViewModal
                v-if="selectedReport"
                :report="selectedReport"
                :show="showViewModal"
                @close="closeReportModal"
            />
            <!-- Create Report Modal -->
            <CreateReport :show="showCreateModal" @close="closeCreateModal" />
        </div>
    </Sidevbar>
</template>
