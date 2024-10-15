<script setup>
import Navbar from "@/Components/Navbar.vue";
import {Head, useForm} from "@inertiajs/vue3";

const props = defineProps({
    carts: Object,
    payments: Object,
})

function formatRupiah(value) {
    value = Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(value)

    return value.replace(/\s+/g, '')
}

const form = useForm({
    action: "",
    quantity: 1,
})
const updateCart = (id, action, quantity) => {
    form.action = action
    form.quantity = parseInt(quantity)
    form.put(route('cart.update', id))
}
const deleteCart = id => {
    form.delete(route('cart.destroy', id))
}
const orderForm = useForm({
    cart_ids: []
})
const createOrder = () => {
    orderForm.cart_ids = props.carts.map(cart => cart.id)
    orderForm.post(route('order.store'))
}
</script>

<template>
    <Head title="Keranjang"/>
    <Navbar/>

    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Keranjang</h2>
            <div v-if="$page.props.flash.success"
                 id="alert-success"
                 class="flex items-center p-4 mt-2 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                 role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 w-4 h-4" fill="currentColor"
                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ $page.props.flash.success }}
                </div>
                <button aria-label="Close"
                        class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                        data-dismiss-target="#alert-success" type="button">
                    <span class="sr-only">Close</span>
                    <svg aria-hidden="true" class="w-3 h-3" fill="none" viewBox="0 0 14 14"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" stroke="currentColor" stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"/>
                    </svg>
                </button>
            </div>
            <div v-if="$page.props.flash.error"
                 id="alert-error"
                 class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                 role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 w-4 h-4" fill="currentColor"
                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ $page.props.flash.error }}
                </div>
                <button aria-label="Close"
                        class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                        data-dismiss-target="#alert-error" type="button">
                    <span class="sr-only">Close</span>
                    <svg aria-hidden="true" class="w-3 h-3" fill="none" viewBox="0 0 14 14"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" stroke="currentColor" stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"/>
                    </svg>
                </button>
            </div>

            <div class="mt-3 sm:mt-3 md:gap-6 lg:flex lg:items-start xl:gap-8">
                <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                    <div class="space-y-6">
                        <div v-if="carts.length === 0" class="w-full flex flex-col items-center">
                            <img alt="Keranjangmu masih kosong" class="max-w-xs"
                                 src="/assets/empty_cart_illustration.png">
                            <p class="text-gray-700">
                                Keranjangmu masih kosong nih!
                                <span>
                                    <a :href="route('catalogue')" class="underline font-semibold">
                                        Lihat katalog obat
                                    </a>
                                </span>
                            </p>
                        </div>
                        <div v-for="cart in carts" v-else
                             class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
                            <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                <a class="shrink-0 md:order-1" href="#">
                                    <img alt="imac image"
                                         class="h-20 w-20"
                                         src="/assets/default_medicine.png"/>
                                </a>

                                <label class="sr-only" for="counter-input">Choose quantity:</label>
                                <div class="flex items-center justify-between md:order-3 md:justify-end">
                                    <div class="flex items-center">
                                        <button id="decrement-button"
                                                class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700"
                                                data-input-counter-decrement="counter-input"
                                                type="button"
                                                @click="updateCart(cart.id, 'decrement')">
                                            <svg aria-hidden="true" class="h-2.5 w-2.5 text-gray-900 dark:text-white"
                                                 fill="none" viewBox="0 0 18 2" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1 1h16" stroke="currentColor"
                                                      stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                            </svg>
                                        </button>
                                        <input id="counter-input"
                                               v-model="cart.quantity"
                                               class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white"
                                               data-input-counter
                                               placeholder=""
                                               required type="text"
                                               @input="updateCart(cart, 'update', $event.target.value)"/>
                                        <button id="increment-button"
                                                class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700"
                                                data-input-counter-increment="counter-input"
                                                type="button"
                                                @click="updateCart(cart.id, 'increment')">
                                            <svg aria-hidden="true" class="h-2.5 w-2.5 text-gray-900 dark:text-white"
                                                 fill="none" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 1v16M1 9h16" stroke="currentColor"
                                                      stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="text-end md:order-4 md:w-32">
                                        <p class="text-base font-bold text-gray-900 dark:text-white">
                                            {{ formatRupiah(cart.medicine.price * cart.quantity) }}</p>
                                    </div>
                                </div>

                                <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                                    <a class="text-base font-medium text-gray-900 hover:underline dark:text-white"
                                       href="#">{{ cart.medicine.name }}</a>

                                    <div class="flex items-center gap-4">
                                        <button
                                            class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500"
                                            type="button"
                                            @click="deleteCart(cart.id)">
                                            <svg aria-hidden="true" class="w-6 h-6 text-red-600"
                                                 fill="none" height="24" viewBox="0 0 24 24" width="24"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"
                                                    stroke="currentColor"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"/>
                                            </svg>
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hidden xl:mt-8 xl:block">
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">People also bought</h3>
                        <div class="mt-6 grid grid-cols-3 gap-4 sm:mt-8">
                            <div
                                class="space-y-6 overflow-hidden rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                                <a class="overflow-hidden rounded" href="#">
                                    <img alt="imac image"
                                         class="mx-auto h-44 w-44 dark:hidden"
                                         src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg"/>
                                    <img alt="imac image"
                                         class="mx-auto hidden h-44 w-44 dark:block"
                                         src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg"/>
                                </a>
                                <div>
                                    <a class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white"
                                       href="#">iMac
                                        27”</a>
                                    <p class="mt-2 text-base font-normal text-gray-500 dark:text-gray-400">This
                                        generation has some improvements, including a longer continuous battery
                                        life.</p>
                                </div>
                                <div>
                                    <p class="text-lg font-bold text-gray-900 dark:text-white">
                                        <span class="line-through"> $399,99 </span>
                                    </p>
                                    <p class="text-lg font-bold leading-tight text-red-600 dark:text-red-500">$299</p>
                                </div>
                                <div class="mt-6 flex items-center gap-2.5">
                                    <button
                                        class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-200 bg-white p-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700"
                                        data-tooltip-target="favourites-tooltip-1"
                                        type="button">
                                        <svg aria-hidden="true" class="h-5 w-5" fill="none"
                                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z"
                                                  stroke="currentColor" stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"></path>
                                        </svg>
                                    </button>
                                    <div id="favourites-tooltip-1"
                                         class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700"
                                         role="tooltip">
                                        Add to favourites
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                    <button
                                        class="inline-flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium  text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                        type="button">
                                        <svg aria-hidden="true" class="-ms-2 me-2 h-5 w-5"
                                             fill="none" height="24" viewBox="0 0 24 24" width="24"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7h-1M8 7h-.688M13 5v4m-2-2h4"
                                                stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"/>
                                        </svg>
                                        Add to cart
                                    </button>
                                </div>
                            </div>
                            <div
                                class="space-y-6 overflow-hidden rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                                <a class="overflow-hidden rounded" href="#">
                                    <img alt="imac image"
                                         class="mx-auto h-44 w-44 dark:hidden"
                                         src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/ps5-light.svg"/>
                                    <img alt="imac image"
                                         class="mx-auto hidden h-44 w-44 dark:block"
                                         src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/ps5-dark.svg"/>
                                </a>
                                <div>
                                    <a class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white"
                                       href="#">Playstation
                                        5</a>
                                    <p class="mt-2 text-base font-normal text-gray-500 dark:text-gray-400">This
                                        generation has some improvements, including a longer continuous battery
                                        life.</p>
                                </div>
                                <div>
                                    <p class="text-lg font-bold text-gray-900 dark:text-white">
                                        <span class="line-through"> $799,99 </span>
                                    </p>
                                    <p class="text-lg font-bold leading-tight text-red-600 dark:text-red-500">$499</p>
                                </div>
                                <div class="mt-6 flex items-center gap-2.5">
                                    <button
                                        class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-200 bg-white p-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700"
                                        data-tooltip-target="favourites-tooltip-2"
                                        type="button">
                                        <svg aria-hidden="true" class="h-5 w-5" fill="none"
                                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z"
                                                  stroke="currentColor" stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"></path>
                                        </svg>
                                    </button>
                                    <div id="favourites-tooltip-2"
                                         class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700"
                                         role="tooltip">
                                        Add to favourites
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                    <button
                                        class="inline-flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium  text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                        type="button">
                                        <svg aria-hidden="true" class="-ms-2 me-2 h-5 w-5"
                                             fill="none" height="24" viewBox="0 0 24 24" width="24"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7h-1M8 7h-.688M13 5v4m-2-2h4"
                                                stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"/>
                                        </svg>
                                        Add to cart
                                    </button>
                                </div>
                            </div>
                            <div
                                class="space-y-6 overflow-hidden rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                                <a class="overflow-hidden rounded" href="#">
                                    <img alt="imac image"
                                         class="mx-auto h-44 w-44 dark:hidden"
                                         src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/apple-watch-light.svg"/>
                                    <img alt="imac image"
                                         class="mx-auto hidden h-44 w-44 dark:block"
                                         src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/apple-watch-dark.svg"/>
                                </a>
                                <div>
                                    <a class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white"
                                       href="#">Apple
                                        Watch Series 8</a>
                                    <p class="mt-2 text-base font-normal text-gray-500 dark:text-gray-400">This
                                        generation has some improvements, including a longer continuous battery
                                        life.</p>
                                </div>
                                <div>
                                    <p class="text-lg font-bold text-gray-900 dark:text-white">
                                        <span class="line-through"> $1799,99 </span>
                                    </p>
                                    <p class="text-lg font-bold leading-tight text-red-600 dark:text-red-500">$1199</p>
                                </div>
                                <div class="mt-6 flex items-center gap-2.5">
                                    <button
                                        class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-200 bg-white p-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700"
                                        data-tooltip-target="favourites-tooltip-3"
                                        type="button">
                                        <svg aria-hidden="true" class="h-5 w-5" fill="none"
                                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z"
                                                  stroke="currentColor" stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"></path>
                                        </svg>
                                    </button>
                                    <div id="favourites-tooltip-3"
                                         class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700"
                                         role="tooltip">
                                        Add to favourites
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>

                                    <button
                                        class="inline-flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium  text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                        type="button">
                                        <svg aria-hidden="true" class="-ms-2 me-2 h-5 w-5"
                                             fill="none" height="24" viewBox="0 0 24 24" width="24"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7h-1M8 7h-.688M13 5v4m-2-2h4"
                                                stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"/>
                                        </svg>
                                        Add to cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                    <div
                        class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                        <p class="text-xl font-semibold text-gray-900 dark:text-white">Ringkasan Belanja</p>

                        <div class="space-y-4">
                            <div class="space-y-2 hidden">
                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">
                                        Harga
                                    </dt>
                                    <dd class="text-base font-medium text-gray-900 dark:text-white">
                                        {{ formatRupiah(payments.total_price) }}
                                    </dd>
                                </dl>
                            </div>

                            <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                                <dd class="text-base font-bold text-gray-900 dark:text-white">
                                    {{ formatRupiah(payments.total_price) }}
                                </dd>
                            </dl>
                        </div>
                        <button
                            class="w-full focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                            type="button"
                            @click="createOrder">
                            Buat Pesanan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
