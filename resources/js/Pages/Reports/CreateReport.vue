<script setup>
import Modal from "@/Components/Modal.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(["close"]);

const closeModal = () => {
    emit("close");
};

// Define report types
const reportTypes = [
    "Safety Issue",
    "Technical Problem",
    "Maintenance Request",
    "Security Concern",
    "Personnel Issue",
    "Environmental Hazard",
    "Other",
];

// Define status options
const statusOptions = ["open", "under investigation", "closed"];

// Create form using Inertia's useForm
const form = useForm({
    title: "",
    description: "",
    type: "",
    location: "",
    incident_date: "",
    reported_by: "",
    status: "open", // Default status is 'open'
});

// Handle form submission
const submit = () => {
    // alert(form);
    form.post(route("create.report"), {
        onSuccess: () => {
            closeModal();
            form.reset();
        },
    });
};

// Set default date to today
const today = new Date().toISOString().substr(0, 10);
form.incident_date = today;
</script>

<template>
    <Modal :show="show" @close="closeModal" max-width="2xl">
        <form @submit.prevent="submit" class="p-6 bg-white rounded-lg">
            <div class="border-b border-gray-200 pb-4 mb-6">
                <h2 class="text-2xl font-bold text-gray-800">
                    Create New Report
                </h2>
                <p class="text-sm text-gray-600 mt-1">
                    Complete the form below to submit a new report.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-5">
                    <!-- Report Title -->
                    <div>
                        <InputLabel
                            for="title"
                            value="Report Title"
                            class="font-medium text-gray-700"
                        />
                        <TextInput
                            id="title"
                            type="text"
                            v-model="form.title"
                            class="mt-1 block w-full shadow-sm rounded-md"
                            required
                            autofocus
                            placeholder="Enter a concise title"
                        />
                        <InputError :message="form.errors.title" class="mt-1" />
                    </div>

                    <!-- Report Type -->
                    <div>
                        <InputLabel
                            for="type"
                            value="Report Type"
                            class="font-medium text-gray-700"
                        />
                        <select
                            id="type"
                            v-model="form.type"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white"
                            required
                        >
                            <option value="" disabled>
                                Select a report type
                            </option>
                            <option
                                v-for="type in reportTypes"
                                :key="type"
                                :value="type"
                            >
                                {{ type }}
                            </option>
                        </select>
                        <InputError :message="form.errors.type" class="mt-1" />
                    </div>

                    <!-- Location -->
                    <div>
                        <InputLabel
                            for="location"
                            value="Location"
                            class="font-medium text-gray-700"
                        />
                        <TextInput
                            id="location"
                            type="text"
                            v-model="form.location"
                            class="mt-1 block w-full shadow-sm rounded-md"
                            required
                            placeholder="Building, floor, room, etc."
                        />
                        <InputError
                            :message="form.errors.location"
                            class="mt-1"
                        />
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-5">
                    <!-- Incident Date -->
                    <div>
                        <InputLabel
                            for="incident_date"
                            value="Incident Date"
                            class="font-medium text-gray-700"
                        />
                        <TextInput
                            id="incident_date"
                            type="date"
                            v-model="form.incident_date"
                            class="mt-1 block w-full shadow-sm rounded-md"
                            required
                        />
                        <InputError
                            :message="form.errors.incident_date"
                            class="mt-1"
                        />
                    </div>

                    <!-- Status (replaces Priority Level) -->
                    <div>
                        <InputLabel
                            for="status"
                            value="Status"
                            class="font-medium text-gray-700"
                        />
                        <select
                            id="status"
                            v-model="form.status"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white"
                            required
                        >
                            <option
                                v-for="option in statusOptions"
                                :key="option"
                                :value="option"
                            >
                                {{
                                    option.charAt(0).toUpperCase() +
                                    option.slice(1)
                                }}
                            </option>
                        </select>
                        <InputError
                            :message="form.errors.status"
                            class="mt-1"
                        />
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="mt-6">
                <InputLabel
                    for="description"
                    value="Description"
                    class="font-medium text-gray-700"
                />
                <textarea
                    id="description"
                    v-model="form.description"
                    class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    rows="5"
                    required
                    placeholder="Describe the incident or issue in detail..."
                >
                </textarea>
                <p class="mt-1 text-xs text-gray-500">
                    Please include relevant details such as when the incident
                    occurred, who was involved, and any immediate actions taken.
                </p>
                <InputError :message="form.errors.description" class="mt-1" />
            </div>

            <!-- Error Message -->
            <div
                v-if="form.errors.length > 0"
                class="mt-6 p-4 bg-red-50 border-l-4 border-red-400 rounded text-red-700 text-sm"
            >
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg
                            class="h-5 w-5 text-red-400"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="font-medium">
                            Please fix the errors above before submitting the
                            form.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Form processing indicator -->
            <div
                v-if="form.processing"
                class="mt-6 p-4 bg-blue-50 border-l-4 border-blue-400 rounded text-blue-700 text-sm"
            >
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg
                            class="animate-spin h-5 w-5 text-blue-500"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <circle
                                class="opacity-25"
                                cx="12"
                                cy="12"
                                r="10"
                                stroke="currentColor"
                                stroke-width="4"
                            ></circle>
                            <path
                                class="opacity-75"
                                fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                            ></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="font-medium">
                            Submitting your report, please wait...
                        </p>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="mt-8 flex justify-end space-x-3">
                <SecondaryButton
                    type="button"
                    @click="closeModal"
                    class="px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                >
                    Cancel
                </SecondaryButton>
                <PrimaryButton
                    type="submit"
                    class="px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    :disabled="form.processing"
                >
                    <svg
                        v-if="form.processing"
                        class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <circle
                            class="opacity-25"
                            cx="12"
                            cy="12"
                            r="10"
                            stroke="currentColor"
                            stroke-width="4"
                        ></circle>
                        <path
                            class="opacity-75"
                            fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                        ></path>
                    </svg>
                    {{ form.processing ? "Submitting..." : "Submit Report" }}
                </PrimaryButton>
            </div>
        </form>
    </Modal>
</template>
