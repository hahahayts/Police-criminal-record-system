<template>
    <div class="flex min-h-screen bg-gray-100">
        <!-- Enhanced Sidebar -->
        <aside
            class="w-72 bg-[#1A2B47] text-white p-6 space-y-6 shadow-xl relative"
        >
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center space-x-3">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-10 w-10 text-white"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                    >
                        <path d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path
                            d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"
                        />
                    </svg>
                    <h1 class="text-2xl font-bold">Police System</h1>
                </div>
            </div>

            <nav class="space-y-2">
                <div class="group">
                    <a
                        href="#"
                        class="flex items-center space-x-3 px-4 py-2 rounded-lg hover:bg-[#233863] transition-colors group-hover:bg-opacity-75"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 text-blue-300"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                            />
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>
                </div>

                <div class="group">
                    <a
                        href="#"
                        class="flex items-center space-x-3 px-4 py-2 rounded-lg hover:bg-[#233863] transition-colors group-hover:bg-opacity-75"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 text-blue-300"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                            />
                        </svg>
                        <span class="font-medium">{{
                            role === "admin"
                                ? "All Crime Reports"
                                : "My Reports"
                        }}</span>
                        <span
                            class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full"
                        >
                            12
                        </span>
                    </a>
                </div>

                <div class="group">
                    <a
                        href="#"
                        class="flex items-center space-x-3 px-4 py-2 rounded-lg hover:bg-[#233863] transition-colors group-hover:bg-opacity-75"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 text-blue-300"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                            />
                        </svg>
                        <span class="font-medium">Suspects</span>
                    </a>
                </div>

                <div class="group">
                    <a
                        href="#"
                        class="flex items-center space-x-3 px-4 py-2 rounded-lg hover:bg-[#233863] transition-colors group-hover:bg-opacity-75"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 text-blue-300"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 10-4.243-4.242 3 3 0 004.243 4.242z"
                            />
                        </svg>
                        <span class="font-medium">Investigations</span>
                    </a>
                </div>

                <div class="group">
                    <a
                        href="#"
                        class="flex items-center space-x-3 px-4 py-2 rounded-lg hover:bg-[#233863] transition-colors group-hover:bg-opacity-75"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 text-blue-300"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>
                        <span class="font-medium">Evidences</span>
                    </a>
                </div>

                <div v-if="role === 'admin'" class="group">
                    <Link
                        href="/manage-users"
                        class="flex items-center space-x-3 px-4 py-2 rounded-lg hover:bg-[#233863] transition-colors group-hover:bg-opacity-75"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 text-blue-300"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                            />
                        </svg>
                        <span class="font-medium">Users</span>
                    </Link>
                </div>

                <div class="group">
                    <a
                        href="#"
                        class="flex items-center space-x-3 px-4 py-2 rounded-lg hover:bg-[#233863] transition-colors group-hover:bg-opacity-75"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 text-blue-300"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                            />
                        </svg>
                        <span class="font-medium">Settings</span>
                    </a>
                </div>
            </nav>

            <div
                class="absolute bottom-0 left-0 right-0 p-6 border-t border-[#233863]"
            >
                <div
                    class="flex items-center space-x-3 bg-[#233863] p-3 rounded-lg"
                >
                    <img
                        src="/api/placeholder/40/40"
                        alt="User Avatar"
                        class="w-10 h-10 rounded-full"
                    />
                    <div>
                        <p class="font-semibold text-sm capitalize">
                            {{ user.name }}
                        </p>
                        <p class="text-xs text-blue-300">
                            {{ role === "admin" ? "Administrator" : "User" }}
                        </p>
                    </div>
                    <Link
                        :href="route('logout')"
                        method="post"
                        as="button"
                        class="ml-auto hover:bg-[#2C4777] p-2 rounded-full transition-colors"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                            />
                        </svg>
                    </Link>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <slot />
    </div>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";

const user = usePage().props.auth.user;
const role = user.hasRole;

console.log(user.hasRole);
</script>
