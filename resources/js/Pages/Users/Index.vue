<script setup>
import { ref, computed } from "vue";
import Sidevbar from "@/Layouts/Sidevbar.vue";

// Sample user data - replace with actual API call in production
const users = ref([
    {
        id: 1,
        badge: "BD4392",
        name: "John Smith",
        role: "Detective",
        department: "Homicide",
        status: "Active",
        lastActive: "2025-05-12",
    },
    {
        id: 2,
        badge: "BD2187",
        name: "Maria Rodriguez",
        role: "Officer",
        department: "Patrol",
        status: "Active",
        lastActive: "2025-05-13",
    },
    {
        id: 3,
        badge: "BD8823",
        name: "Robert Johnson",
        role: "Lieutenant",
        department: "Narcotics",
        status: "On Leave",
        lastActive: "2025-05-01",
    },
    {
        id: 4,
        badge: "BD5519",
        name: "Sarah Williams",
        role: "Sergeant",
        department: "SWAT",
        status: "Active",
        lastActive: "2025-05-10",
    },
    {
        id: 5,
        badge: "BD6644",
        name: "David Chen",
        role: "Officer",
        department: "Cyber Crimes",
        status: "Inactive",
        lastActive: "2025-04-22",
    },
]);

const searchQuery = ref("");
const showAddUserModal = ref(false);
const selectedUser = ref(null);
const showUserDetailsModal = ref(false);
const showDeleteConfirmation = ref(false);

const newUser = ref({
    badge: "",
    name: "",
    role: "",
    department: "",
    status: "Active",
});

const roles = [
    "Officer",
    "Detective",
    "Sergeant",
    "Lieutenant",
    "Captain",
    "Chief",
];
const departments = [
    "Patrol",
    "Homicide",
    "Narcotics",
    "Cyber Crimes",
    "SWAT",
    "Forensics",
    "Administration",
];
const statuses = ["Active", "Inactive", "On Leave", "Suspended"];

const filteredUsers = computed(() => {
    if (!searchQuery.value) return users.value;

    const query = searchQuery.value.toLowerCase();
    return users.value.filter(
        (user) =>
            user.name.toLowerCase().includes(query) ||
            user.badge.toLowerCase().includes(query) ||
            user.department.toLowerCase().includes(query) ||
            user.role.toLowerCase().includes(query)
    );
});

const addUser = () => {
    const id =
        users.value.length > 0
            ? Math.max(...users.value.map((u) => u.id)) + 1
            : 1;
    const today = new Date().toISOString().split("T")[0];

    users.value.push({
        id,
        badge: newUser.value.badge,
        name: newUser.value.name,
        role: newUser.value.role,
        department: newUser.value.department,
        status: newUser.value.status,
        lastActive: today,
    });

    showAddUserModal.value = false;
    resetNewUser();
};

const resetNewUser = () => {
    newUser.value = {
        badge: "",
        name: "",
        role: "",
        department: "",
        status: "Active",
    };
};

const editUser = (user) => {
    selectedUser.value = { ...user };
    showUserDetailsModal.value = true;
};

const updateUser = () => {
    const index = users.value.findIndex((u) => u.id === selectedUser.value.id);
    if (index !== -1) {
        users.value[index] = { ...selectedUser.value };
    }
    showUserDetailsModal.value = false;
};

const confirmDelete = (user) => {
    selectedUser.value = user;
    showDeleteConfirmation.value = true;
};

const deleteUser = () => {
    users.value = users.value.filter((u) => u.id !== selectedUser.value.id);
    showDeleteConfirmation.value = false;
};
</script>

<template>
    <Sidevbar>
        <div class="bg-white text-gray-800 p-4 min-h-screen">
            <!-- Header with police-themed styling -->
            <div class="border-b-2 border-gray-300 mb-6 pb-2">
                <h1 class="text-2xl tracking-wide text-gray-900 font-bold">
                    PERSONNEL DATABASE
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
                        placeholder="Search by name, badge #, department..."
                        class="w-full pl-8 pr-4 py-2 border border-gray-300 bg-gray-100 text-gray-800 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    <span
                        class="absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-500"
                        >🔍</span
                    >
                </div>
                <button
                    @click="showAddUserModal = true"
                    class="bg-blue-600 text-white px-4 py-2 rounded font-bold hover:bg-blue-500"
                >
                    + New Personnel
                </button>
            </div>

            <!-- Users table -->
            <div
                class="overflow-x-auto bg-gray-100 rounded border border-gray-300"
            >
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-200 text-gray-800">
                            <th class="text-left p-3 text-sm tracking-wide">
                                Badge #
                            </th>
                            <th class="text-left p-3 text-sm tracking-wide">
                                Name
                            </th>
                            <th class="text-left p-3 text-sm tracking-wide">
                                Role
                            </th>
                            <th class="text-left p-3 text-sm tracking-wide">
                                Department
                            </th>
                            <th class="text-left p-3 text-sm tracking-wide">
                                Status
                            </th>
                            <th class="text-left p-3 text-sm tracking-wide">
                                Last Active
                            </th>
                            <th class="text-left p-3 text-sm tracking-wide">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="user in filteredUsers"
                            :key="user.id"
                            class="hover:bg-gray-50 transition-colors"
                            :class="{
                                'bg-gray-200 bg-opacity-20':
                                    user.status === 'Inactive',
                                'bg-orange-100 bg-opacity-20':
                                    user.status === 'On Leave',
                                'bg-red-100 bg-opacity-20':
                                    user.status === 'Suspended',
                            }"
                        >
                            <td class="p-3">
                                <span class="font-bold text-blue-600">{{
                                    user.badge
                                }}</span>
                            </td>
                            <td class="p-3">{{ user.name }}</td>
                            <td class="p-3">{{ user.role }}</td>
                            <td class="p-3">{{ user.department }}</td>
                            <td class="p-3">
                                <span
                                    class="px-2 py-1 rounded text-xs font-bold"
                                    :class="{
                                        'bg-green-100 bg-opacity-50 text-green-700':
                                            user.status === 'Active',
                                        'bg-gray-300 bg-opacity-50 text-gray-600':
                                            user.status === 'Inactive',
                                        'bg-orange-100 bg-opacity-50 text-orange-600':
                                            user.status === 'On Leave',
                                        'bg-red-100 bg-opacity-50 text-red-600':
                                            user.status === 'Suspended',
                                    }"
                                >
                                    {{ user.status }}
                                </span>
                            </td>
                            <td class="p-3">{{ user.lastActive }}</td>
                            <td class="p-3 whitespace-nowrap">
                                <button
                                    @click="editUser(user)"
                                    class="bg-blue-600 text-white px-2 py-1 rounded mr-2 hover:bg-blue-500"
                                >
                                    Edit
                                </button>
                                <button
                                    @click="confirmDelete(user)"
                                    class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-500"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                        <tr v-if="filteredUsers.length === 0">
                            <td
                                colspan="7"
                                class="p-3 text-center text-gray-500"
                            >
                                No personnel records found matching search
                                criteria
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Add User Modal -->
            <div
                v-if="showAddUserModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center"
            >
                <div class="bg-white rounded p-6 w-full max-w-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold text-gray-900">
                            ADD NEW PERSONNEL
                        </h2>
                        <button
                            @click="showAddUserModal = false"
                            class="text-2xl text-gray-500 hover:text-gray-700"
                        >
                            ×
                        </button>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Badge Number:</label
                            >
                            <input
                                type="text"
                                v-model="newUser.badge"
                                placeholder="Enter badge number"
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
                                v-model="newUser.name"
                                placeholder="Enter full name"
                                required
                                class="w-full mt-1 p-2 border border-gray-300 bg-gray-100 text-gray-800 rounded"
                            />
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Role:</label
                            >
                            <select
                                v-model="newUser.role"
                                required
                                class="w-full mt-1 p-2 border border-gray-300 bg-gray-100 text-gray-800 rounded"
                            >
                                <option value="" disabled selected>
                                    Select role
                                </option>
                                <option
                                    v-for="role in roles"
                                    :key="role"
                                    :value="role"
                                >
                                    {{ role }}
                                </option>
                            </select>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Department:</label
                            >
                            <select
                                v-model="newUser.department"
                                required
                                class="w-full mt-1 p-2 border border-gray-300 bg-gray-100 text-gray-800 rounded"
                            >
                                <option value="" disabled selected>
                                    Select department
                                </option>
                                <option
                                    v-for="dept in departments"
                                    :key="dept"
                                    :value="dept"
                                >
                                    {{ dept }}
                                </option>
                            </select>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Status:</label
                            >
                            <select
                                v-model="newUser.status"
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
                    </div>
                    <div class="flex justify-end mt-6 space-x-2">
                        <button
                            @click="addUser"
                            class="bg-blue-600 text-white px-4 py-2 rounded font-bold hover:bg-blue-500"
                            :disabled="
                                !newUser.badge ||
                                !newUser.name ||
                                !newUser.role ||
                                !newUser.department
                            "
                        >
                            Add Personnel
                        </button>
                        <button
                            @click="showAddUserModal = false"
                            class="bg-gray-500 text-white px-4 py-2 rounded font-bold hover:bg-gray-400"
                        >
                            Cancel
                        </button>
                    </div>
                </div>
            </div>

            <!-- Edit User Modal -->
            <div
                v-if="showUserDetailsModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center"
            >
                <div class="bg-white rounded p-6 w-full max-w-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold text-gray-900">
                            EDIT PERSONNEL
                        </h2>
                        <button
                            @click="showUserDetailsModal = false"
                            class="text-2xl text-gray-500 hover:text-gray-700"
                        >
                            ×
                        </button>
                    </div>
                    <div class="space-y-4" v-if="selectedUser">
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Badge Number:</label
                            >
                            <input
                                type="text"
                                v-model="selectedUser.badge"
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
                                v-model="selectedUser.name"
                                class="w-full mt-1 p-2 border border-gray-300 bg-gray-100 text-gray-800 rounded"
                            />
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Role:</label
                            >
                            <select
                                v-model="selectedUser.role"
                                class="w-full mt-1 p-2 border border-gray-300 bg-gray-100 text-gray-800 rounded"
                            >
                                <option
                                    v-for="role in roles"
                                    :key="role"
                                    :value="role"
                                >
                                    {{ role }}
                                </option>
                            </select>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Department:</label
                            >
                            <select
                                v-model="selectedUser.department"
                                class="w-full mt-1 p-2 border border-gray-300 bg-gray-100 text-gray-800 rounded"
                            >
                                <option
                                    v-for="dept in departments"
                                    :key="dept"
                                    :value="dept"
                                >
                                    {{ dept }}
                                </option>
                            </select>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Status:</label
                            >
                            <select
                                v-model="selectedUser.status"
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
                    </div>
                    <div class="flex justify-end mt-6 space-x-2">
                        <button
                            @click="updateUser"
                            class="bg-blue-600 text-white px-4 py-2 rounded font-bold hover:bg-blue-500"
                        >
                            Update Personnel
                        </button>
                        <button
                            @click="showUserDetailsModal = false"
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
                    <div class="space-y-4 text-center" v-if="selectedUser">
                        <div class="text-4xl text-yellow-500">⚠️</div>
                        <p class="text-gray-700">
                            Are you sure you want to delete personnel record
                            for:
                        </p>
                        <p class="text-lg font-bold text-gray-900">
                            {{ selectedUser.badge }} - {{ selectedUser.name }}
                        </p>
                        <p class="text-red-600 text-sm">
                            This action cannot be undone and all associated data
                            will be permanently removed from the system.
                        </p>
                    </div>
                    <div class="flex justify-end mt-6 space-x-2">
                        <button
                            @click="deleteUser"
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
