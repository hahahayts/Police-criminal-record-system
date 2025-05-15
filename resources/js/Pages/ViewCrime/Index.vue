<script setup>
import Sidevbar from "@/Layouts/Sidevbar.vue";
import { Link } from "@inertiajs/vue3";

defineProps({
    crime: {
        type: Object,
        required: true,
    },
    officer: {
        type: Object,
        required: true,
    },
});

// Status badge color mapping
const statusColors = {
    open: "bg-yellow-100 text-yellow-800",
    "under investigation": "bg-blue-100 text-blue-800",
    closed: "bg-green-100 text-green-800",
};

// Crime type icon mapping
const crimeTypeIcons = {
    theft: "🕵️",
    assault: "👊",
    vandalism: "🔨",
    fraud: "💰",
    burglary: "🏠",
    robbery: "🔫",
    homicide: "⚠️",
    default: "📋",
};

const getTypeIcon = (type) => {
    return crimeTypeIcons[type.toLowerCase()] || crimeTypeIcons.default;
};

// Format date to be more readable
const formatDate = (dateString) => {
    const options = {
        year: "numeric",
        month: "long",
        day: "numeric",
        hour: "2-digit",
        minute: "2-digit",
    };
    return new Date(dateString).toLocaleDateString(undefined, options);
};
</script>

<template>
    <Sidevbar>
        <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-2xl mt-6">
            <Link href="/reports">
                <div class="flex items-center">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 mr-2"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>
                    <span>Back</span>
                </div>
            </Link>
            <!-- Header with basic info and status -->
            <div class="border-b pb-4 flex justify-between items-center">
                <div>
                    <div class="flex items-center gap-2">
                        <h1 class="text-2xl font-bold text-gray-800">
                            {{ crime.title }}
                        </h1>
                        <span
                            :class="`px-2 py-1 rounded-full text-xs font-medium ${
                                statusColors[crime.status]
                            }`"
                        >
                            {{ crime.status.toUpperCase() }}
                        </span>
                    </div>
                    <p class="text-sm text-gray-500">
                        Case #: {{ crime.case_number }}
                    </p>
                </div>

                <!-- Action buttons -->
                <div class="flex gap-2">
                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm flex items-center"
                    >
                        <span class="mr-1">✏️</span> Edit
                    </button>
                    <button
                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg text-sm flex items-center"
                    >
                        <span class="mr-1">🖨️</span> Print
                    </button>
                </div>
            </div>

            <!-- Main content grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <!-- Left column - Main details -->
                <div class="md:col-span-2 space-y-6">
                    <!-- Description section -->
                    <div class="space-y-2 bg-gray-50 p-4 rounded-lg">
                        <h2
                            class="text-lg font-semibold text-gray-700 flex items-center"
                        >
                            <span class="mr-2">📝</span> Description
                        </h2>
                        <p class="text-gray-600 whitespace-pre-line">
                            {{
                                crime.description || "No description provided."
                            }}
                        </p>
                    </div>

                    <!-- Incident details -->
                    <div class="space-y-4">
                        <h2
                            class="text-lg font-semibold text-gray-700 flex items-center"
                        >
                            <span class="mr-2">🔍</span> Incident Details
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Crime type -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-sm font-medium text-gray-500">
                                    Crime Type
                                </h3>
                                <p class="text-gray-800 font-medium">
                                    <span class="mr-1">{{
                                        getTypeIcon(crime.type)
                                    }}</span>
                                    {{ crime.type }}
                                </p>
                            </div>

                            <!-- Incident date -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-sm font-medium text-gray-500">
                                    Incident Date & Time
                                </h3>
                                <p class="text-gray-800 font-medium">
                                    <span class="mr-1">🗓️</span>
                                    {{ formatDate(crime.incident_date) }}
                                </p>
                            </div>

                            <!-- Location -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-sm font-medium text-gray-500">
                                    Location
                                </h3>
                                <p class="text-gray-800 font-medium">
                                    <span class="mr-1">📍</span>
                                    {{ crime.location || "Not specified" }}
                                </p>
                            </div>

                            <!-- Reported date -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-sm font-medium text-gray-500">
                                    Report Filed
                                </h3>
                                <p class="text-gray-800 font-medium">
                                    <span class="mr-1">📅</span>
                                    {{ formatDate(crime.created_at) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right column - Sidebar info -->
                <div class="space-y-6">
                    <!-- Reporting officer -->
                    <!-- <div class="bg-gray-50 p-4 rounded-lg">
                        <h2
                            class="text-lg font-semibold text-gray-700 mb-3 flex items-center"
                        >
                            <span class="mr-2">👮</span> Reporting Officer
                        </h2>
                        <div class="flex items-center">
                            <div
                                class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold"
                            >
                                {{
                                    officer.name ? officer.name.charAt(0) : "O"
                                }}
                            </div>
                            <div class="ml-3">
                                <p class="text-gray-800 font-medium">
                                    {{ officer.name || "Unknown Officer" }}
                                </p>
                                <p class="text-gray-500 text-sm">
                                    ID:
                                    {{
                                        officer.badge_number ||
                                        officer.id ||
                                        "N/A"
                                    }}
                                </p>
                            </div>
                        </div>
                    </div> -->

                    <!-- Case actions -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h2
                            class="text-lg font-semibold text-gray-700 mb-3 flex items-center"
                        >
                            <span class="mr-2">⚙️</span> Case Actions
                        </h2>
                        <!-- <div class="space-y-2">
                            <button
                                class="w-full bg-blue-50 hover:bg-blue-100 text-blue-600 p-2 rounded flex items-center justify-between"
                            >
                                <span>Add Evidence</span>
                                <span>+</span>
                            </button>
                            <button
                                class="w-full bg-blue-50 hover:bg-blue-100 text-blue-600 p-2 rounded flex items-center justify-between"
                            >
                                <span>Update Status</span>
                                <span>↻</span>
                            </button>
                            <button
                                class="w-full bg-blue-50 hover:bg-blue-100 text-blue-600 p-2 rounded flex items-center justify-between"
                            >
                                <span>Link Related Cases</span>
                                <span>🔗</span>
                            </button>
                            <button
                                class="w-full bg-blue-50 hover:bg-blue-100 text-blue-600 p-2 rounded flex items-center justify-between"
                            >
                                <span>Add Note</span>
                                <span>📝</span>
                            </button>
                        </div> -->
                    </div>

                    <!-- Case activity -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h2
                            class="text-lg font-semibold text-gray-700 mb-3 flex items-center"
                        >
                            <span class="mr-2">📊</span> Case Activity
                        </h2>
                        <div class="space-y-3">
                            <div class="border-l-2 border-blue-400 pl-3">
                                <p class="text-xs text-gray-500">
                                    {{ formatDate(crime.created_at) }}
                                </p>
                                <p class="text-sm text-gray-700">
                                    Case created
                                </p>
                            </div>
                            <div class="border-l-2 border-gray-300 pl-3">
                                <p class="text-xs text-gray-500">
                                    {{ formatDate(crime.updated_at) }}
                                </p>
                                <p class="text-sm text-gray-700">
                                    Last updated
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Sidevbar>
</template>
