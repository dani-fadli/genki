<script setup>

import {Head, useForm} from "@inertiajs/vue3"
import DashboardLayout from "@/Layouts/DashboardLayout.vue"
import {onMounted} from "vue"

const props = defineProps({
    order: {
        type: Object,
        default: null
    },
})

function formatRupiah(value) {
    value = Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(value)

    return value.replace(/\s+/g, '')
}

const title = "Edit Pesanan"
const breadcrumbs = ['Kelola Pesanan', title]

const form = useForm({
    invoice_number: "",
    status: "",
})

const statuses = [
    'pending',
    'unpaid',
    'finished'
]

const submit = () => {
    form.put(route('dashboard.order.update', props.order.id))
}

onMounted(() => {
    console.log(props.order)
    if (props.order) {
        form.invoice_number = props.order.invoice_number
        form.status = props.order.status
    }
})
</script>

<template>
    <Head :title="title"/>

    <DashboardLayout :breadcrumbs="breadcrumbs" :title="title">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ title }}
            </h2>
        </template>

        <section class="bg-none shadow-md dark:bg-gray-900 py-3 max-w-screen-2xl mx-auto">
            <div class="px-4">
                <form @submit.prevent="submit">
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                   for="invoice_number">
                                No. Invoice
                            </label>
                            <input id="invoice_number"
                                   v-model="form.invoice_number"
                                   class="bg-gray-200 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   disabled
                                   name="invoice_number"
                                   placeholder="No. Invoice" required="" type="text">
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="category">Status</label>
                            <select id="category"
                                    v-model="form.status"
                                    :value="props.order?.status"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Status pesanan</option>
                                <option v-for="status in statuses" :value="status">{{
                                        status.toUpperCase()
                                    }}
                                </option>
                            </select>
                        </div>
                        <div v-if="order.type === 'prescription'">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                   for="prescription">Resep</label>
                            <img :src="props.order.prescription_image" alt="prescription"
                                 class="h-auto max-w-lg rounded-lg">
                        </div>
                        <div v-for="medicine in props.order.medicines" v-else-if="order.status === 'unpaid'"
                             class="space-y-4 p-6">
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
                    </div>
                    <button
                        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-green-400 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800"
                        type="submit">
                        Simpan
                    </button>
                </form>
            </div>
        </section>
    </DashboardLayout>
</template>

<style scoped>

</style>
