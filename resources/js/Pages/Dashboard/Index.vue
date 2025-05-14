<script setup>
import Sidevbar from "@/Layouts/Sidevbar.vue";
</script>

<template>
    <Sidevbar>
        <h2 class="text-2xl font-semibold mb-4">Dashboard Overview</h2>
        <!-- Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-white p-4 rounded shadow">
                <p class="text-gray-500 text-sm">Total Crimes</p>
                <p class="text-2xl font-bold">120</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <p class="text-gray-500 text-sm">Open Cases</p>
                <p class="text-2xl font-bold">45</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <p class="text-gray-500 text-sm">Closed Cases</p>
                <p class="text-2xl font-bold">75</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <p class="text-gray-500 text-sm">Today's Reports</p>
                <p class="text-2xl font-bold">3</p>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white p-4 rounded shadow mb-6">
            <h3 class="font-semibold mb-2">🔔 Recent Activity</h3>
            <ul class="list-disc pl-5 text-sm space-y-1">
                <li>Officer Mark updated case #102</li>
                <li>New case added by Sgt. Cruz</li>
                <li>Evidence uploaded to case #98</li>
            </ul>
        </div>

        <!-- Graph Placeholders -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white p-4 rounded shadow">
                <h4 class="font-semibold">📈 Crimes by Type</h4>
                <div
                    class="h-40 bg-gray-200 flex items-center justify-center text-gray-500"
                >
                    [Graph Placeholder]
                </div>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h4 class="font-semibold">📊 Case Status Summary</h4>
                <div
                    class="h-40 bg-gray-200 flex items-center justify-center text-gray-500"
                >
                    [Pie Chart Placeholder]
                </div>
            </div>
        </div>
    </Sidevbar>
</template>
