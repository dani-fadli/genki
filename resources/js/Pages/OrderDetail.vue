<script setup>
import {Head} from "@inertiajs/vue3";
import Navbar from "@/Components/Navbar.vue";

const props = defineProps({
    order: Object,
})

function formatRupiah(value) {
    value = Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(value)

    return value.replace(/\s+/g, '')
}
</script>

<template>
    <Head title="Konfirmasi Pembayaran"/>
    <Navbar/>

    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">
                Detail Pesanan {{ props.order.invoice_number }}
            </h2>

            <div class="mt-6 sm:mt-8 lg:flex lg:gap-8">
                <div
                    class="w-full divide-y divide-gray-200 overflow-hidden rounded-lg border border-gray-200 dark:divide-gray-700 dark:border-gray-700 lg:max-w-2xl xl:max-w-2xl">
                    <div v-if="props.order.type === 'prescription' && props.order.status === 'pending'"
                         class="w-full flex flex-col items-center py-4">
                        <img alt="" class="max-w-xs" src="/assets/prescription_pending_illustration.webp">
                        <h1 class="text-xl my-4">
                            Apoteker kami sedang menyiapkan obat Anda
                        </h1>
                    </div>

                    <template v-else>
                        <div v-for="medicine in props.order.medicines" class="space-y-4 p-6">
                            <div class="flex items-center gap-6">
                                <a class="h-16 w-16 shrink-0" href="#">
                                    <img alt="imac image"
                                         class="h-full w-full dark:hidden"
                                         src="/assets/default_medicine.png"/>
                                </a>

                                <p class="min-w-0 flex-1 font-medium text-gray-900 hover:underline dark:text-white">
                                    {{ medicine.name }}
                                </p>
                            </div>

                            <div class="flex items-center justify-between gap-4">
                                <p class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ formatRupiah(medicine.price) }}</p>

                                <div class="flex items-center justify-end gap-4">
                                    <p class="text-base font-normal text-gray-900 dark:text-white">
                                        x{{ medicine.quantity }}
                                    </p>
                                    <p class="text-xl font-bold leading-tight text-gray-900 dark:text-white">
                                        {{ formatRupiah(medicine.total_price) }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4 bg-gray-50 p-6 dark:bg-gray-800">
                            <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                <dt class="text-lg font-bold text-gray-900 dark:text-white">Total</dt>
                                <dd class="text-lg font-bold text-gray-900 dark:text-white">
                                    {{ formatRupiah(props.order.total_payment) }}
                                </dd>
                            </dl>
                        </div>
                    </template>
                </div>

                <div class="mt-6 grow sm:mt-8 lg:mt-0">
                    <div
                        class="space-y-6 rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <template v-if="props.order.type === 'prescription'">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Resep</h3>

                            <img :src="props.order.prescription_image" alt="prescription"
                                 class="h-auto max-w-lg rounded-lg">
                        </template>

                        <div v-if="props.order.status === 'unpaid'" class="gap-4 sm:flex sm:items-center">
                            <a class="mt-4 flex w-full items-center justify-center rounded-lg bg-green-700  px-5 py-2.5 text-sm font-medium text-white hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300  dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 sm:mt-0"
                               href="#">Konfirmasi Pembayaran</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
