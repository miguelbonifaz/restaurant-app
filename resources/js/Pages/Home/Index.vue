<template>
    <Layout title="Make your order" layout-for-guest>
        <div class="mx-auto max-w-6xl px-6">
            <FlashMessage />
            <ul class="mb-6 space-y-2">
                <li
                    v-for="order in orders"
                    :key="order.id"
                    :class="{
                        'animate__animated animate__fadeInUp':
                            order.quantity > 0,
                        'animate__animated animate__fadeOut':
                            order.quantity === 0,
                    }"
                    class="flex items-center justify-between rounded-lg bg-white px-4 py-3 shadow-lg"
                >
                    <span class="text-gray-700" v-text="order.name"></span>
                    <div class="flex items-center space-x-2">
                        $
                        <span>{{ calculatePrice(order) }}</span>
                        <button
                            @click="decrementOrder(order)"
                            type="button"
                            class="inline-flex items-center rounded-full border border-transparent bg-indigo-600 p-1 text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M20 12H4"
                                ></path>
                            </svg>
                        </button>
                        <span
                            v-text="order.quantity"
                            class="text-lg font-bold text-gray-600"
                        ></span>
                        <button
                            @click="incrementOrder(order)"
                            type="button"
                            class="inline-flex items-center rounded-full border border-transparent p-1 shadow-sm focus:outline-none"
                            :class="{
                                'bg-indigo-600 text-white hover:bg-indigo-700 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500':
                                    canIOrderMoreOrders(order),
                                'bg-gray-300 text-white cursor-default':
                                    !canIOrderMoreOrders(order),
                            }"
                        >
                            <svg
                                class="h-5 w-5"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </button>
                    </div>
                </li>
                <template v-if="orders.length">
                    <div class="flex justify-end">
                        <button
                            @click="isModalOpen = true"
                            type="button"
                            dusk="verPedido"
                            class="inline-flex items-center rounded-lg border border-transparent bg-indigo-600 px-4 py-2 font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            Ver Pedido
                            <svg
                                class="ml-2 h-6 w-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
                                ></path>
                            </svg>
                        </button>
                    </div>
                </template>
            </ul>

            <StackedList>
                <li v-for="plate in plates.data" :key="plate.id">
                    <a href="#" class="block hover:bg-gray-50">
                        <div class="px-4 py-4">
                            <div class="flex items-center">
                                <span
                                    class="mr-4 inline-block h-12 w-12 flex-shrink-0 rounded-full bg-gray-200"
                                >
                                </span>
                                <div class="w-full">
                                    <div
                                        class="flex items-center justify-between"
                                    >
                                        <p
                                            class="mb-2 font-medium text-indigo-600"
                                        >
                                            {{ plate.name }}
                                        </p>
                                        <div>
                                            <span
                                                class="inline-flex items-center rounded-full bg-gray-100 px-3 text-sm font-bold text-gray-800 py-0.5"
                                            >
                                                ${{ plate.price }}
                                            </span>
                                            <span
                                                class="ml-1 inline-flex items-center rounded-full bg-gray-100 px-3 text-sm font-bold text-gray-800 py-0.5"
                                            >
                                                <template
                                                    v-if="plate.quantity === 1"
                                                >
                                                    {{ plate.quantity }} order
                                                    available
                                                </template>
                                                <template v-else>
                                                    {{ plate.quantity }} orders
                                                    available
                                                </template>
                                            </span>
                                        </div>
                                    </div>
                                    <p
                                        class="inline-flex rounded-full text-sm font-semibold leading-5 text-gray-800"
                                    >
                                        {{ plate.description }}
                                    </p>
                                </div>
                            </div>
                            <div class="mt-4 flex items-end justify-end">
                                <div class="flex items-end">
                                    <button
                                        @click.prevent="addOrder(plate)"
                                        type="button"
                                        :dusk="`addOrder(${plate.id})`"
                                        class="flex inline-flex h-11 w-11 items-center justify-center rounded-full border-2 border-transparent text-base font-medium text-white text-gray-700 addOrder"
                                        :class="{
                                            'bg-indigo-600 hover:bg-white hover:border-indigo-600 hover:text-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500':
                                                !isOrdered(plate),
                                            'bg-gray-300': isOrdered(plate),
                                        }"
                                    >
                                        <svg
                                            class="h-6 w-6"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
                                            ></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
            </StackedList>
        </div>

        <Modal :is-modal-open="isModalOpen" @close-modal="closeModal">
            <template v-slot:default>
                <p class="text-lg font-bold text-gray-800">
                    Este son tus platos adjuntados:
                </p>
                <div v-if="$page.props.flash_warning" class="alert">
                    <div>
                        <div class="mb-6 rounded-md bg-yellow-100 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg
                                        class="h-5 w-5 text-yellow-500"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512"
                                    >
                                        <path
                                            fill="currentColor"
                                            d="M506.3 417l-213.3-364C284.8 39 270.4 32 256 32C241.6 32 227.2 39 218.1 53l-213.2 364C-10.59 444.9 9.851 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM52.58 432L255.1 84.8L459.4 432H52.58zM256 337.1c-17.36 0-31.44 14.08-31.44 31.44c0 17.36 14.11 31.44 31.48 31.44s31.4-14.08 31.4-31.44C287.4 351.2 273.4 337.1 256 337.1zM232 184v96C232 293.3 242.8 304 256 304s24-10.75 24-24v-96C280 170.8 269.3 160 256 160S232 170.8 232 184z"
                                        />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p
                                        class="text-sm font-medium leading-5 text-yellow-800"
                                    >
                                        {{ $page.props.flash_warning }}
                                    </p>
                                </div>
                                <div class="ml-auto pl-3">
                                    <div class="-mx-1.5 -my-1.5">
                                        <button
                                            @click="
                                                $page.props.flash_warning = null
                                            "
                                            class="inline-flex rounded-md text-yellow-500 transition duration-150 ease-in-out p-1.5 hover:bg-yellow-100 focus:bg-yellow-100 focus:outline-none"
                                        >
                                            <svg
                                                class="h-5 w-5"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ul role="list" class="divide-y divide-gray-200">
                    <li
                        class="flex py-4"
                        v-for="order in orders"
                        :key="order.id"
                    >
                        <div class="ml-3">
                            <p
                                :dusk="`order-list-${order.id}`"
                                :class="`text-sm font-medium text-gray-900 order-list-${order.id}`"
                            >
                                {{ order.name }}
                            </p>
                        </div>
                    </li>
                </ul>
                <p class="flex justify-end border-t border-gray-100 pt-2">
                    Total: $ {{ totalOfOrders() }}
                </p>

                <div class="bg-gray-50 p-4">
                    <div class="mb-4">
                        <label
                            for="client_name"
                            class="block text-sm font-medium text-gray-700"
                            >Nombre</label
                        >
                        <div class="mt-1">
                            <input
                                v-model="form.client_name"
                                type="text"
                                name="client_name"
                                id="client_name"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="Nombre"
                                autocomplete="off"
                            />
                        </div>
                        <p
                            class="text-red-600"
                            v-if="$page.props.errors.client_name"
                        >
                            {{ $page.props.errors.client_name }}
                        </p>
                    </div>
                    <div>
                        <label
                            for="table_number"
                            class="block text-sm font-medium text-gray-700"
                            >Número de mesa</label
                        >
                        <select
                            v-model="form.table_number"
                            id="table_number"
                            name="table_number"
                            class="mt-1 block w-full rounded-md border-gray-300 py-2 pr-10 pl-3 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                        >
                            <option
                                v-for="tableNumber in [1, 2, 3, 4, 5]"
                                :value="tableNumber"
                            >
                                {{ tableNumber }}
                            </option>
                        </select>
                    </div>
                </div>
            </template>
            <template v-slot:footer>
                <button
                    @click="makeOrder"
                    type="button"
                    dusk="confirmarPedido"
                    class="inline-flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Confirmar Pedido
                    <svg
                        class="ml-2 h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                        ></path>
                    </svg>
                </button>
            </template>
        </Modal>
    </Layout>
</template>

<style scoped></style>

<script setup>
import Layout from '@/Layouts/Layout.vue'
import FlashMessage from '@/Pages/Shared/FlashMessage.vue'
import Modal from '@/Pages/Shared/Modal.vue'
import StackedList from '@/Pages/Shared/StackedList.vue'
import { router, usePage } from '@inertiajs/vue3'
import { reactive, ref } from 'vue'

const props = defineProps({
    plates: Object,
})

let orders = reactive([])
let isModalOpen = ref(false)

let closeModal = () => {
    isModalOpen.value = false
}

let calculatePrice = ({ price, quantity }) => {
    return (price * quantity).toFixed(2)
}

let isOrdered = (plate) => {
    return orders.some((order) => order.id === plate.id)
}

let totalOfOrders = () => {
    return orders.reduce((total, order) => {
        return total + parseInt(order.price)
    }, 0)
}

let decrementOrder = (order) => {
    if (order.quantity === 0) {
        return null
    }

    order.quantity--

    if (order.quantity === 0) {
        setTimeout(() => {
            orders.splice(orders.indexOf(order), 1)
        }, 800)
    }
}

let canIOrderMoreOrders = (order) => {
    let plate = props.plates.data.find((plate) => plate.id === order.id)

    return order.quantity < plate?.quantity
}

let incrementOrder = (order) => {
    let plate = props.plates.data.find((plate) => plate.id === order.id)

    if (plate.quantity <= order.quantity) {
        return null
    }

    order.quantity++
}

let addOrder = (plate) => {
    if (orders.find((order) => order.id === plate.id)) {
        return
    }

    orders.push({
        id: plate.id,
        name: plate.name,
        description: plate.description,
        price: plate.price,
        quantity: 1,
    })
}

let form = reactive({
    client_name: null,
    table_number: 1,
})

let makeOrder = () => {
    router.post(
        route('orders.store'),
        {
            client_name: form.client_name,
            table_number: form.table_number,
            ordersId: orders.map(function (order) {
                return {
                    orderId: order.id,
                    quantity: order.quantity,
                }
            }),
        },
        {
            onSuccess: () => {
                if (!usePage().props.flash_success) {
                    orders.splice(0)
                    return
                }
                orders.splice(0)
                closeModal()
                form.client_name = null
                form.table_number = 1
            },
        },
    )
}
</script>
