<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Law Enforcement Portal - Authentication" />

        <div class="flex flex-col items-center mb-6">
            <div class="w-20 h-20 mb-2">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    class="text-blue-800"
                >
                    <path
                        d="M12 1v2M12 21v2M4.2 4.2l1.4 1.4M18.4 18.4l1.4 1.4M1 12h2M21 12h2M4.2 19.8l1.4-1.4M18.4 5.6l1.4-1.4M12 6a6 6 0 0 0 0 12 6 6 0 0 0 0-12z"
                    />
                </svg>
            </div>
            <h1 class="text-xl font-bold text-center text-blue-900">
                POLICE CRIME RECORD SYSTEM
            </h1>
            <div class="w-full border-t border-blue-800 mt-3"></div>
        </div>

        <div
            class="bg-gray-100 border border-gray-300 rounded-md p-6 shadow-md"
        >
            <h2 class="text-lg font-semibold text-blue-900 mb-4 text-center">
                SECURE LOGIN
            </h2>

            <div
                v-if="status"
                class="mb-4 p-2 bg-blue-50 border border-blue-200 text-sm font-medium text-blue-700 rounded"
            >
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div>
                    <InputLabel
                        for="email"
                        value="Officer ID / Email"
                        class="font-bold text-gray-700"
                    />

                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full border-gray-300 focus:border-blue-700 focus:ring focus:ring-blue-200"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                    />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel
                        for="password"
                        value="Security Password"
                        class="font-bold text-gray-700"
                    />

                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full border-gray-300 focus:border-blue-700 focus:ring focus:ring-blue-200"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                    />

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="mt-4 block">
                    <label class="flex items-center">
                        <Checkbox
                            name="remember"
                            v-model:checked="form.remember"
                            class="border-gray-400 text-blue-800 focus:ring-blue-500"
                        />
                        <span class="ms-2 text-sm text-gray-700 font-medium">
                            Remember credentials on this device
                        </span>
                    </label>
                </div>

                <div class="mt-6">
                    <PrimaryButton
                        class="w-full justify-center py-2 bg-blue-800 hover:bg-blue-900 focus:bg-blue-900 active:bg-blue-900 border-blue-900"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        AUTHENTICATE
                    </PrimaryButton>
                </div>

                <div class="mt-4 flex items-center justify-between text-sm">
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="text-blue-700 hover:text-blue-900 hover:underline focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 font-medium"
                    >
                        Password Recovery
                    </Link>

                    <span class="text-gray-600"> Access Level: Standard </span>
                </div>
            </form>

            <div
                class="mt-8 pt-4 border-t border-gray-200 text-xs text-gray-500 text-center"
            >
                <p>
                    This is a secure government system. Unauthorized access is
                    prohibited and subject to legal action.
                </p>
                <p class="mt-1">All login attempts are logged and monitored.</p>
            </div>
        </div>
    </GuestLayout>
</template>
