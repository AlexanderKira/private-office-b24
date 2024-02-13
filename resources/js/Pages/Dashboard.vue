<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    reports: Array,
    totalReport: Object,
})

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form :action="route('dashboard')" method="GET">
                            <input type="date" id="startDate" name="start_date">
                            ||
                            <input type="date" id="endDate" name="end_date">
                            ||
                            <input type="text" name="search" placeholder="Поиск по каналу">
                            ||
                            <button type="submit">Применить</button>
                        </form>
                        <table class="table-auto">
                            <thead>
                            <tr>
                                <th class="py-2 px-4">
<!--                                    <form :action="route('dashboard')" method="GET">-->
<!--                                        <div>-->

<!--                                            <button type="submit" />-->
<!--                                        </div>-->
<!--                                    </form>-->
                                </th>
                                <th class="py-2 px-4">Заявки</th>
                                <th class="py-2 px-4">Конверсия в продажи</th>
                                <th class="py-2 px-4">Продажи</th>
                                <th class="py-2 px-4">Выручка</th>
                                <th class="py-2 px-4">Средний чек</th>
                                <th class="py-2 px-4">Прибыль</th>
                                <th class="py-2 px-4">ROI</th>
                            </tr>
                            </thead>
                            <tbody>

                                <tr class="text-center">
                                    <th class="py-2 px-4">Итого/Среднее</th>
                                    <th class="py-2 px-4">{{ totalReport.totalApplication }}</th>
                                    <th class="py-2 px-4">{{ totalReport.conversion_to_sales }}%</th>
                                    <th class="py-2 px-4">{{ totalReport.totalSales }}</th>
                                    <th class="py-2 px-4">{{ totalReport.totalRevenue }}</th>
                                    <th class="py-2 px-4">{{ totalReport.average_check }}</th>
                                    <th class="py-2 px-4">{{ totalReport.totalProfit }}</th>
                                    <th class="py-2 px-4">{{ totalReport.roi }}%</th>
                                </tr>

                            <template v-if="reports" v-for="report in reports">
                                <tr class="text-center">
                                        <td class="py-2 px-4">{{ report.channel_name }}</td>
                                        <td class="py-2 px-4">{{ report.application }}</td>
                                        <td class="py-2 px-4">{{ report.conversion_to_sales }} %</td>
                                        <td class="py-2 px-4">{{ report.sales }}</td>
                                        <td class="py-2 px-4">{{ report.revenue }}</td>
                                        <td class="py-2 px-4">{{ report.average_check }}</td>
                                        <td class="py-2 px-4">{{ report.profit }}</td>
                                </tr>
                            </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
