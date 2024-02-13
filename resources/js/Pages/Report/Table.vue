<template>
    <table class="table-auto">
        <thead>
        <tr>
            <th class="py-2 px-4">
                    <input placeholder="Название канала">
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
            <th class="py-2 px-4">Итого/Среднее
                <input type="date">

            </th>
                <th class="py-2 px-4">{{ report }}</th>
                <th class="py-2 px-4">1.8%</th>
                <th class="py-2 px-4">1111</th>
                <th class="py-2 px-4">1111</th>
                <th class="py-2 px-4">44513</th>
                <th class="py-2 px-4">1111</th>
                <th class="py-2 px-4">1601%</th>
            </tr>

<!--            <tr v-if="reports" class="text-center">-->
<!--                <template v-for="report in reports">-->
<!--                    <td class="py-2 px-4">{{ report.channel_name }}</td>-->
<!--                    <td class="py-2 px-4">{{ report.application }}</td>-->
<!--                    <td class="py-2 px-4">{{ report.conversion_to_sales }} %</td>-->
<!--                    <td class="py-2 px-4">{{ report.sales }}</td>-->
<!--                    <td class="py-2 px-4">{{ report.revenue }}</td>-->
<!--                    <td class="py-2 px-4">{{ report.average_check }}</td>-->
<!--                    <td class="py-2 px-4">{{ report.profit }}</td>-->
<!--                </template>-->
<!--            </tr>-->
        </tbody>
    </table>
</template>

<script setup>

defineProps({
    report: String,
})

</script>
