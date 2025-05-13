<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    appVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Police Crime Record System" />
    <div class="bg-gray-50 text-black/50 dark:bg-gray-900 dark:text-white/50">
        <img
            id="background"
            class="absolute -left-20 top-0 max-w-[877px] opacity-20"
            src="https://laravel.com/assets/img/welcome/background.svg"
        />
        <div
            class="relative flex min-h-screen flex-col items-center justify-center selection:bg-blue-700 selection:text-white"
        >
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header
                    class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3"
                >
                    <div class="flex lg:col-start-2 lg:justify-center">
                        <svg
                            class="h-12 w-auto text-white lg:h-16 lg:text-blue-700"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25Z"
                            />
                        </svg>
                    </div>
                    <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-blue-700 dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Dashboard
                        </Link>

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-blue-700 dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Log in
                            </Link>

                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-blue-700 dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Register
                            </Link>
                        </template>
                    </nav>
                </header>

                <main class="mt-6">
                    <div class="text-center mb-12">
                        <h1
                            class="text-4xl font-bold text-blue-700 dark:text-blue-400"
                        >
                            Police Crime Record System
                        </h1>
                        <p
                            class="mt-4 text-lg text-gray-700 dark:text-gray-300"
                        >
                            Efficient crime data management for modern law
                            enforcement
                        </p>
                    </div>

                    <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
                        <a
                            href="#"
                            id="docs-card"
                            class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-blue-700 md:row-span-3 lg:p-10 lg:pb-10 dark:bg-gray-800 dark:ring-gray-700 dark:hover:text-white/70 dark:hover:ring-gray-600 dark:focus-visible:ring-blue-500"
                        >
                            <div
                                id="screenshot-container"
                                class="relative flex w-full flex-1 items-stretch"
                            >
                                <div
                                    class="aspect-video h-full w-full flex-1 rounded-[10px] bg-blue-100 dark:bg-blue-900 flex items-center justify-center"
                                >
                                    <svg
                                        class="h-24 w-24 text-blue-700 dark:text-blue-400"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"
                                        />
                                    </svg>
                                </div>
                                <div
                                    class="absolute -bottom-16 -left-16 h-40 w-[calc(100%+8rem)] bg-gradient-to-b from-transparent via-white to-white dark:via-gray-800 dark:to-gray-800"
                                ></div>
                            </div>

                            <div
                                class="relative flex items-center gap-6 lg:items-end"
                            >
                                <div
                                    id="docs-card-content"
                                    class="flex items-start gap-6 lg:flex-col"
                                >
                                    <div
                                        class="flex size-12 shrink-0 items-center justify-center rounded-full bg-blue-700/10 sm:size-16"
                                    >
                                        <svg
                                            class="size-5 sm:size-6"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"
                                            />
                                        </svg>
                                    </div>

                                    <div class="pt-3 sm:pt-5 lg:pt-0">
                                        <h2
                                            class="text-xl font-semibold text-black dark:text-white"
                                        >
                                            Case Management
                                        </h2>

                                        <p class="mt-4 text-sm/relaxed">
                                            Easily manage and track all crime
                                            cases from initial report to
                                            resolution. Our system provides
                                            comprehensive tools for documenting
                                            evidence, suspect information,
                                            victim details, and investigation
                                            progress.
                                        </p>
                                    </div>
                                </div>

                                <svg
                                    class="size-6 shrink-0 stroke-blue-700"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"
                                    />
                                </svg>
                            </div>
                        </a>

                        <a
                            href="#"
                            class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-blue-700 lg:pb-10 dark:bg-gray-800 dark:ring-gray-700 dark:hover:text-white/70 dark:hover:ring-gray-600 dark:focus-visible:ring-blue-500"
                        >
                            <div
                                class="flex size-12 shrink-0 items-center justify-center rounded-full bg-blue-700/10 sm:size-16"
                            >
                                <svg
                                    class="size-5 sm:size-6"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"
                                    />
                                </svg>
                            </div>

                            <div class="pt-3 sm:pt-5">
                                <h2
                                    class="text-xl font-semibold text-black dark:text-white"
                                >
                                    Suspect Tracking
                                </h2>

                                <p class="mt-4 text-sm/relaxed">
                                    Maintain detailed profiles of suspects with
                                    comprehensive history tracking. Record
                                    biometric data, criminal history, aliases,
                                    known associates, and current case
                                    involvement for quick identification and
                                    investigation support.
                                </p>
                            </div>

                            <svg
                                class="size-6 shrink-0 self-center stroke-blue-700"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"
                                />
                            </svg>
                        </a>

                        <a
                            href="#"
                            class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-blue-700 lg:pb-10 dark:bg-gray-800 dark:ring-gray-700 dark:hover:text-white/70 dark:hover:ring-gray-600 dark:focus-visible:ring-blue-500"
                        >
                            <div
                                class="flex size-12 shrink-0 items-center justify-center rounded-full bg-blue-700/10 sm:size-16"
                            >
                                <svg
                                    class="size-5 sm:size-6"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605"
                                    />
                                </svg>
                            </div>

                            <div class="pt-3 sm:pt-5">
                                <h2
                                    class="text-xl font-semibold text-black dark:text-white"
                                >
                                    Crime Analytics
                                </h2>

                                <p class="mt-4 text-sm/relaxed">
                                    Generate comprehensive reports and
                                    statistical analysis on crime patterns, hot
                                    spots, and trends. Our analytics tools help
                                    departments make data-driven decisions for
                                    resource allocation, patrol planning, and
                                    crime prevention strategies.
                                </p>
                            </div>

                            <svg
                                class="size-6 shrink-0 self-center stroke-blue-700"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"
                                />
                            </svg>
                        </a>

                        <div
                            class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] lg:pb-10 dark:bg-gray-800 dark:ring-gray-700"
                        >
                            <div
                                class="flex size-12 shrink-0 items-center justify-center rounded-full bg-blue-700/10 sm:size-16"
                            >
                                <svg
                                    class="size-5 sm:size-6"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"
                                    />
                                </svg>
                            </div>

                            <div class="pt-3 sm:pt-5">
                                <h2
                                    class="text-xl font-semibold text-black dark:text-white"
                                >
                                    Secure System
                                </h2>

                                <p class="mt-4 text-sm/relaxed">
                                    Our robust security features include:
                                    <span class="block mt-2"
                                        >• Role-based access control</span
                                    >
                                    <span class="block"
                                        >• Comprehensive audit trails</span
                                    >
                                    <span class="block"
                                        >• Advanced encryption</span
                                    >
                                    <span class="block"
                                        >• Two-factor authentication</span
                                    >
                                    <span class="block"
                                        >• Automatic backups</span
                                    >
                                    <span class="block mt-2"
                                        >Meeting all law enforcement security
                                        standards while ensuring your sensitive
                                        data remains protected.</span
                                    >
                                </p>
                            </div>
                        </div>
                    </div>
                </main>

                <div class="mt-16 text-center">
                    <a
                        href="#"
                        class="inline-block rounded-lg bg-blue-700 px-8 py-3 text-white hover:bg-blue-800 transition duration-300"
                    >
                        Request Demo
                    </a>
                </div>

                <footer
                    class="py-12 mt-12 text-center text-sm text-black border-t border-gray-200 dark:border-gray-700 dark:text-white/70"
                >
                    Police Crime Record System v{{ appVersion }} (PHP v{{
                        phpVersion
                    }})
                </footer>
            </div>
        </div>
    </div>
</template>
