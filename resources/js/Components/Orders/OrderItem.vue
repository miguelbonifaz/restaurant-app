<template>
    <td class="px-6 py-4 space-y-2 w-32 text-sm font-medium whitespace-nowrap">
        <p class="text-xl text-gray-800">Order # {{ order.id }}</p>
        <p class="text-gray-700">Total: $ {{ total }}</p>
        <p class="text-gray-700">Mesa: # {{ order.table_number }}</p>
        <p class="text-gray-700">Cliente: {{ order.client_name }}</p>
        <button
            @click="finalizeOrder(order)"
            type="button"
            class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-700 bg-white rounded-md border border-gray-300 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
            Finalizar Pedido
        </button>
    </td>
    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
        <p class="mb-1 font-bold">Platos:</p>
        <ul class="rounded-lg border border-gray-200 divide-y divide-gray-200">
            <li
                class="flex items-center px-3 py-2"
                v-for="food in order.foods"
                :key="food.id"
            >
                <span
                    class="inline-flex justify-center items-center p-1 w-6 h-6 mr-2 text-yellow-800 bg-yellow-100 rounded-full"
                >
                    {{ food.pivot.quantity }}
                </span>
                {{ food.name }}
            </li>
        </ul>
    </td>
</template>

<script setup>
import { router } from '@inertiajs/vue3'
import { computed } from 'vue'

let props = defineProps({
    order: {
        type: Object,
        required: true,
    },
})

let total = computed(() => {
    return props.order.foods.reduce((total, food) => {
        return total + food.pivot.quantity * food.price
    }, 0)
})

let finalizeOrder = (order) => {
    router.post(
        route('orders.finalize', [order.id]),
        {},
        {
            onBefore: () =>
                confirm(`Seguro desea finalizar la order # ${order.id}?`),
        },
    )
}
</script>

<style scoped></style>
