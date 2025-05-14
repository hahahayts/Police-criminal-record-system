<script setup>
import Modal from "@/Components/Modal.vue";

const props = defineProps({
    report: {
        type: Object,
        required: true,
    },
    show: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(["close"]);

const closeModal = () => {
    emit("close");
};

// Format date helper function
const formatDate = (dateString) => {
    if (!dateString) return "N/A";
    const date = new Date(dateString);
    return new Intl.DateTimeFormat("en-US", {
        year: "numeric",
        month: "long",
        day: "numeric",
        hour: "2-digit",
        minute: "2-digit",
    }).format(date);
};

// Status color mapping
const statusColors = {
    Open: "bg-green-100 text-green-800 border-green-200",
    Closed: "bg-gray-100 text-gray-800 border-gray-200",
    "In Progress": "bg-blue-100 text-blue-800 border-blue-200",
    "Under Review": "bg-yellow-100 text-yellow-800 border-yellow-200",
    Rejected: "bg-red-100 text-red-800 border-red-200",
};

const getStatusColor = (status) => {
    return statusColors[status] || "bg-gray-100 text-gray-800 border-gray-200";
};
</script>

<template>
    <Modal :show="show" @close="closeModal" max-width="2xl">
        <div class="p-6">
            <!-- Header -->
            <div
                class="flex justify-between items-start border-b border-gray-200 pb-4 mb-4"
            >
                <div>
                    <h2 class="text-xl font-bold text-gray-900">
                        {{ report.title }}
                    </h2>
                    <p class="text-sm text-gray-500 mt-1">
                        Case #{{ report.case_number }}
                    </p>
                </div>
                <div>
                    <span
                        :class="[
                            getStatusColor(report.status),
                            'px-3 py-1 rounded-full text-sm font-medium border',
                        ]"
                    >
                        {{ report.status }}
                    </span>
                </div>
            </div>

            <!-- Report Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <h3 class="text-sm font-semibold text-gray-700 mb-2">
                        Report Details
                    </h3>
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm space-y-3">
                        <div>
                            <label class="block text-xs text-gray-500"
                                >Type</label
                            >
                            <p class="font-medium text-gray-800">
                                {{ report.type }}
                            </p>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500"
                                >Location</label
                            >
                            <p class="font-medium text-gray-800">
                                {{ report.location }}
                            </p>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500"
                                >Incident Date</label
                            >
                            <p class="font-medium text-gray-800">
                                {{ formatDate(report.incident_date) }}
                            </p>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500"
                                >Reported Date</label
                            >
                            <p class="font-medium text-gray-800">
                                {{ formatDate(report.created_at) }}
                            </p>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-gray-700 mb-2">
                        Contact Information
                    </h3>
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm space-y-3">
                        <div>
                            <label class="block text-xs text-gray-500"
                                >Reported By</label
                            >
                            <p class="font-medium text-gray-800">
                                {{ report.reported_by || "Anonymous" }}
                            </p>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500"
                                >Contact Email</label
                            >
                            <p class="font-medium text-gray-800">
                                {{ report.contact_email || "Not provided" }}
                            </p>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500"
                                >Contact Phone</label
                            >
                            <p class="font-medium text-gray-800">
                                {{ report.contact_phone || "Not provided" }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="mb-6">
                <h3 class="text-sm font-semibold text-gray-700 mb-2">
                    Description
                </h3>
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                    <p class="text-gray-800 whitespace-pre-line">
                        {{ report.description || "No description provided." }}
                    </p>
                </div>
            </div>

            <!-- Additional Details -->
            <div v-if="report.additional_details || report.attachments">
                <h3 class="text-sm font-semibold text-gray-700 mb-2">
                    Additional Details
                </h3>
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                    <p class="text-gray-800 whitespace-pre-line">
                        {{
                            report.additional_details ||
                            "No additional details provided."
                        }}
                    </p>

                    <!-- Attachments -->
                    <div
                        v-if="
                            report.attachments && report.attachments.length > 0
                        "
                        class="mt-4"
                    >
                        <h4 class="text-xs font-semibold text-gray-700 mb-2">
                            Attachments
                        </h4>
                        <div class="flex flex-wrap gap-2">
                            <div
                                v-for="(
                                    attachment, index
                                ) in report.attachments"
                                :key="index"
                                class="flex items-center bg-white p-2 rounded border border-gray-200"
                            >
                                <span class="text-blue-600 mr-2">
                                    <!-- Document icon -->
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </span>
                                <span class="text-sm">{{
                                    attachment.name
                                }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status History -->
            <!-- <div
                v-if="report.history && report.history.length > 0"
                class="mt-6"
            >
                <h3 class="text-sm font-semibold text-gray-700 mb-2">
                    Status History
                </h3>
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                    <ul class="space-y-3">
                        <li
                            v-for="(item, index) in report.history"
                            :key="index"
                            class="flex"
                        >
                            <span
                                class="mr-3 flex-shrink-0 flex items-center justify-center w-8 h-8 bg-blue-100 rounded-full text-blue-500"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </span>
                            <div>
                                <p class="text-sm font-medium text-gray-800">
                                    Status changed to {{ item.status }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    {{ formatDate(item.date) }} by
                                    {{ item.by || "System" }}
                                </p>
                                <p
                                    v-if="item.note"
                                    class="text-sm text-gray-600 mt-1"
                                >
                                    {{ item.note }}
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div> -->

            <!-- Action Buttons -->
            <div class="mt-8 flex justify-end space-x-3">
                <button
                    v-if="report.status !== 'Closed'"
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-500 transition-colors text-sm font-medium"
                >
                    Update Status
                </button>
                <button
                    v-if="report.status !== 'Closed'"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500 transition-colors text-sm font-medium"
                >
                    Add Comment
                </button>
                <button
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-100 transition-colors text-sm font-medium"
                    @click="closeModal"
                >
                    Close
                </button>
            </div>
        </div>
    </Modal>
</template>
