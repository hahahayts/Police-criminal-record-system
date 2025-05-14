<script setup>
import { ref, computed } from "vue";
import Sidevbar from "@/Layouts/Sidevbar.vue";

// Sample suspect data - replace with actual API call in production
const suspects = ref([
    {
        id: 1,
        caseNumber: "CS1234",
        name: "John Doe",
        status: "At Large",
        lastKnownLocation: "Downtown",
        lastSeen: "2025-05-10",
    },
    {
        id: 2,
        caseNumber: "CS5678",
        name: "Jane Smith",
        status: "In Custody",
        lastKnownLocation: "West District",
        lastSeen: "2025-05-12",
    },
    {
        id: 3,
        caseNumber: "CS9012",
        name: "Robert Brown",
        status: "Released",
        lastKnownLocation: "East Side",
        lastSeen: "2025-05-01",
    },
    {
        id: 4,
        caseNumber: "CS3456",
        name: "Emily Davis",
        status: "At Large",
        lastKnownLocation: "Suburbs",
        lastSeen: "2025-05-08",
    },
    {
        id: 5,
        caseNumber: "CS7890",
        name: "Michael Lee",
        status: "Deceased",
        lastKnownLocation: "Industrial Area",
        lastSeen: "2025-04-20",
    },
]);

const searchQuery = ref("");
const showAddSuspectModal = ref(false);
const selectedSuspect = ref(null);
const showSuspectDetailsModal = ref(false);
const showDeleteConfirmation = ref(false);

const newSuspect = ref({
    caseNumber: "",
    name: "",
    status: "At Large",
    lastKnownLocation: "",
    lastSeen: "",
});

const statuses = ["At Large", "In Custody", "Released", "Deceased"];

const filteredSuspects = computed(() => {
    if (!searchQuery.value) return suspects.value;

    const query = searchQuery.value.toLowerCase();
    return suspects.value.filter(
        (suspect) =>
            suspect.name.toLowerCase().includes(query) ||
            suspect.caseNumber.toLowerCase().includes(query) ||
            suspect.lastKnownLocation.toLowerCase().includes(query) ||
            suspect.status.toLowerCase().includes(query)
    );
});

const addSuspect = () => {
    const id =
        suspects.value.length > 0
            ? Math.max(...suspects.value.map((s) => s.id)) + 1
            : 1;
    const today = new Date().toISOString().split("T")[0];

    suspects.value.push({
        id,
        caseNumber: newSuspect.value.caseNumber,
        name: newSuspect.value.name,
        status: newSuspect.value.status,
        lastKnownLocation: newSuspect.value.lastKnownLocation,
        lastSeen: newSuspect.value.lastSeen || today,
    });

    showAddSuspectModal.value = false;
    resetNewSuspect();
};

const resetNewSuspect = () => {
    newSuspect.value = {
        caseNumber: "",
        name: "",
        status: "At Large",
        lastKnownLocation: "",
        lastSeen: "",
    };
};

const editSuspect = (suspect) => {
    selectedSuspect.value = { ...suspect };
    showSuspectDetailsModal.value = true;
};

const updateSuspect = () => {
    const index = suspects.value.findIndex(
        (s) => s.id === selectedSuspect.value.id
    );
    if (index !== -1) {
        suspects.value[index] = { ...selectedSuspect.value };
    }
    showSuspectDetailsModal.value = false;
};

const confirmDelete = (suspect) => {
    selectedSuspect.value = suspect;
    showDeleteConfirmation.value = true;
};

const deleteSuspect = () => {
    suspects.value = suspects.value.filter(
        (s) => s.id !== selectedSuspect.value.id
    );
    showDeleteConfirmation.value = false;
};
</script>

<template>
    <Sidevbar>
        <div class="bg-white text-gray-800 p-4 min-h-screen">
            <!-- Header with police-themed styling -->
            <div class="border-b-2 border-gray-300 mb-6 pb-2">
                <h1 class="text-2xl tracking-wide text-gray-900 font-bold">
                    SUSPECT DATABASE
                </h1>
                <div class="text-red-600 text-xs tracking-wide mt-1">
                    CONFIDENTIAL - AUTHORIZED ACCESS ONLY
                </div>
                <div class="text-blue-600 text-xs mt-2">
                    {{ new Date().toLocaleDateString() }} -
                    {{ new Date().toLocaleTimeString() }}
                </div>
            </div>

            <!-- Action bar -->
            <div class="flex justify-between items-center mb-4">
                <div class="relative flex-1 max-w-md">
                    <input
                        type="text"
                        v-model="searchQuery"
                        placeholder="Search by name, case #, location..."
                        class="w-full pl-8 pr-4 py-2 border border-gray-300 bg-gray-100 text-gray-800 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    <span
                        class="absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-500"
                        >🔍</span
                    >
                </div>
                <button
                    @click="showAddSuspectModal = true"
                    class="bg-blue-600 text-white px-4 py-2 rounded font-bold hover:bg-blue-500"
                >
                    + New Suspect
                </button>
            </div>

            <!-- Suspects table -->
            <div
                class="overflow-x-auto bg-gray-100 rounded border border-gray-300"
            >
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-200 text-gray-800">
                            <th class="text-left p-3 text-sm tracking-wide">
                                Case #
                            </th>
                            <th class="text-left p-3 text-sm tracking-wide">
                                Name
                            </th>
                            <th class="text-left p-3 text-sm tracking-wide">
                                Status
                            </th>
                            <th class="text-left p-3 text-sm tracking-wide">
                                Last Known Location
                            </th>
                            <th class="text-left p-3 text-sm tracking-wide">
                                Last Seen
                            </th>
                            <th class="text-left p-3 text-sm tracking-wide">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="suspect in filteredSuspects"
                            :key="suspect.id"
                            class="hover:bg-gray-50 transition-colors"
                            :class="{
                                'bg-gray-200 bg-opacity-20':
                                    suspect.status === 'Released',
                                'bg-orange-100 bg-opacity-20':
                                    suspect.status === 'At Large',
                                'bg-red-100 bg-opacity-20':
                                    suspect.status === 'In Custody',
                                'bg-gray-300 bg-opacity-20':
                                    suspect.status === 'Deceased',
                            }"
                        >
                            <td class="p-3">
                                <span class="font-bold text-blue-600">{{
                                    suspect.caseNumber
                                }}</span>
                            </td>
                            <td class="p-3">{{ suspect.name }}</td>
                            <td class="p-3">
                                <span
                                    class="px-2 py-1 rounded text-xs font-bold"
                                    :class="{
                                        'bg-orange-100 bg-opacity-50 text-orange-600':
                                            suspect.status === 'At Large',
                                        'bg-red-100 bg-opacity-50 text-red-600':
                                            suspect.status === 'In Custody',
                                        'bg-gray-200 bg-opacity-50 text-gray-600':
                                            suspect.status === 'Released',
                                        'bg-gray-300 bg-opacity-50 text-gray-600':
                                            suspect.status === 'Deceased',
                                    }"
                                >
                                    {{ suspect.status }}
                                </span>
                            </td>
                            <td class="p-3">{{ suspect.lastKnownLocation }}</td>
                            <td class="p-3">{{ suspect.lastSeen }}</td>
                            <td class="p-3 whitespace-nowrap">
                                <button
                                    @click="editSuspect(suspect)"
                                    class="bg-blue-600 text-white px-2 py-1 rounded mr-2 hover:bg-blue-500"
                                >
                                    Edit
                                </button>
                                <button
                                    @click="confirmDelete(suspect)"
                                    class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-500"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                        <tr v-if="filteredSuspects.length === 0">
                            <td
                                colspan="6"
                                class="p-3 text-center text-gray-500"
                            >
                                No suspect records found matching search
                                criteria
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Add Suspect Modal -->
            <div
                v-if="showAddSuspectModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center"
            >
                <div class="bg-white rounded p-6 w-full max-w-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold text-gray-900">
                            ADD NEW SUSPECT
                        </h2>
                        <button
                            @click="showAddSuspectModal = false"
                            class="text-2xl text-gray-500 hover:text-gray-700"
                        >
                            ×
                        </button>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Case Number:</label
                            >
                            <input
                                type="text"
                                v-model="newSuspect.caseNumber"
                                placeholder="Enter case number"
                                required
                                class="w-full mt-1 p-2 border border-gray-300 bg-gray-100 text-gray-800 rounded"
                            />
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Full Name:</label
                            >
                            <input
                                type="text"
                                v-model="newSuspect.name"
                                placeholder="Enter full name"
                                required
                                class="w-full mt-1 p-2 border border-gray-300 bg-gray-100 text-gray-800 rounded"
                            />
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Status:</label
                            >
                            <select
                                v-model="newSuspect.status"
                                class="w-full mt-1 p-2 border border-gray-300 bg-gray-100 text-gray-800 rounded"
                            >
                                <option
                                    v-for="status in statuses"
                                    :key="status"
                                    :value="status"
                                >
                                    {{ status }}
                                </option>
                            </select>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Last Known Location:</label
                            >
                            <input
                                type="text"
                                v-model="newSuspect.lastKnownLocation"
                                placeholder="Enter last known location"
                                required
                                class="w-full mt-1 p-2 border border-gray-300 bg-gray-100 text-gray-800 rounded"
                            />
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Last Seen (YYYY-MM-DD):</label
                            >
                            <input
                                type="date"
                                v-model="newSuspect.lastSeen"
                                class="w-full mt-1 p-2 border border-gray-300 bg-gray-100 text-gray-800 rounded"
                            />
                        </div>
                    </div>
                    <div class="flex justify-end mt-6 space-x-2">
                        <button
                            @click="addSuspect"
                            class="bg-blue-600 text-white px-4 py-2 rounded font-bold hover:bg-blue-500"
                            :disabled="
                                !newSuspect.caseNumber ||
                                !newSuspect.name ||
                                !newSuspect.lastKnownLocation
                            "
                        >
                            Add Suspect
                        </button>
                        <button
                            @click="showAddSuspectModal = false"
                            class="bg-gray-500 text-white px-4 py-2 rounded font-bold hover:bg-gray-400"
                        >
                            Cancel
                        </button>
                    </div>
                </div>
            </div>

            <!-- Edit Suspect Modal -->
            <div
                v-if="showSuspectDetailsModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center"
            >
                <div class="bg-white rounded p-6 w-full max-w-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold text-gray-900">
                            EDIT SUSPECT
                        </h2>
                        <button
                            @click="showSuspectDetailsModal = false"
                            class="text-2xl text-gray-500 hover:text-gray-700"
                        >
                            ×
                        </button>
                    </div>
                    <div class="space-y-4" v-if="selectedSuspect">
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Case Number:</label
                            >
                            <input
                                type="text"
                                v-model="selectedSuspect.caseNumber"
                                class="w-full mt-1 p-2 border border-gray-300 bg-gray-100 text-gray-800 rounded"
                            />
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Full Name:</label
                            >
                            <input
                                type="text"
                                v-model="newSuspect.name"
                                placeholder="Enter full name"
                                required
                                class="w-full mt-1 p-2 border border-gray-300 bg-gray-100 text-gray-800 rounded"
                            />
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Status:</label
                            >
                            <select
                                v-model="selectedSuspect.status"
                                class="w-full mt-1 p-2 border border-gray-300 bg-gray-100 text-gray-800 rounded"
                            >
                                <option
                                    v-for="status in statuses"
                                    :key="status"
                                    :value="status"
                                >
                                    {{ status }}
                                </option>
                            </select>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Last Known Location:</label
                            >
                            <input
                                type="text"
                                v-model="selectedSuspect.lastKnownLocation"
                                class="w-full mt-1 p-2 border border-gray-300 bg-gray-100 text-gray-800 rounded"
                            />
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Last Seen (YYYY-MM-DD):</label
                            >
                            <input
                                type="date"
                                v-model="selectedSuspect.lastSeen"
                                class="w-full mt-1 p-2 border border-gray-300 bg-gray-100 text-gray-800 rounded"
                            />
                        </div>
                    </div>
                    <div class="flex justify-end mt-6 space-x-2">
                        <button
                            @click="updateSuspect"
                            class="bg-blue-600 text-white px-4 py-2 rounded font-bold hover:bg-blue-500"
                        >
                            Update Suspect
                        </button>
                        <button
                            @click="showSuspectDetailsModal = false"
                            class="bg-gray-500 text-white px-4 py-2 rounded font-bold hover:bg-gray-400"
                        >
                            Cancel
                        </button>
                    </div>
                </div>
            </div>

            <!-- Delete Confirmation Modal -->
            <div
                v-if="showDeleteConfirmation"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center"
            >
                <div class="bg-white rounded p-6 w-full max-w-md">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold text-gray-900">
                            CONFIRM DELETION
                        </h2>
                        <button
                            @click="showDeleteConfirmation = false"
                            class="text-2xl text-gray-500 hover:text-gray-700"
                        >
                            ×
                        </button>
                    </div>
                    <div class="space-y-4 text-center" v-if="selectedSuspect">
                        <div class="text-4xl text-yellow-500">⚠️</div>
                        <p class="text-gray-700">
                            Are you sure you want to delete suspect record for:
                        </p>
                        <p class="text-lg font-bold text-gray-900">
                            {{ selectedSuspect.caseNumber }} -
                            {{ selectedSuspect.name }}
                        </p>
                        <p class="text-red-600 text-sm">
                            This action cannot be undone and all associated data
                            will be permanently removed from the system.
                        </p>
                    </div>
                    <div class="flex justify-end mt-6 space-x-2">
                        <button
                            @click="deleteSuspect"
                            class="bg-red-600 text-white px-4 py-2 rounded font-bold hover:bg-red-500"
                        >
                            Confirm Delete
                        </button>
                        <button
                            @click="showDeleteConfirmation = false"
                            class="bg-gray-500 text-white px-4 py-2 rounded font-bold hover:bg-gray-400"
                        >
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </Sidevbar>
</template>
