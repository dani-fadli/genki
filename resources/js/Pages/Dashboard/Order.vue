<script setup>
import {Head} from "@inertiajs/vue3"
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

const title = "Kelola Pesanan"
const breadcrumbs = [title, "Daftar Pesanan"]
const props = defineProps({
    orders: Object
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

        <section class="bg-none dark:bg-gray-900 py-3">
            <div class="px-1 mx-auto max-w-screen-2xl">
                <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="p-4" scope="col">
                                    <div class="flex items-center">
                                        <input id="checkbox-all"
                                               class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                               type="checkbox">
                                        <label class="sr-only" for="checkbox-all">checkbox</label>
                                    </div>
                                </th>
                                <th class="px-4 py-3" scope="col">No. Invoice</th>
                                <th class="px-4 py-3" scope="col">Status</th>
                                <th class="px-4 py-3" scope="col">Pembaruan Terakhir</th>
                                <th class="px-4 py-3" scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="props.orders.data.length === 0">
                                <td class="text-center w-full py-5" colspan="4">
                                    No Data
                                </td>
                            </tr>
                            <tr v-for="order in props.orders.data" v-else
                                class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="w-4 px-4 py-3">
                                    <div class="flex items-center">
                                        <input id="checkbox-table-search-1"
                                               class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                               onclick="event.stopPropagation()"
                                               type="checkbox">
                                        <label class="sr-only" for="checkbox-table-search-1">checkbox</label>
                                    </div>
                                </td>
                                <th class="flex items-center px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                    scope="row">
                                    {{ order.invoice_number }}
                                </th>
                                <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div v-if="order.status === 'pending'"
                                         class="me-2 mt-1.5 inline-flex items-center rounded bg-primary-100 px-2.5 py-0.5 text-xs font-medium text-primary-800 dark:bg-primary-900 dark:text-primary-300">
                                        <svg aria-hidden="true" class="me-1 h-3 w-3" fill="none"
                                             height="24" viewBox="0 0 24 24" width="24"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M18.5 4h-13m13 16h-13M8 20v-3.333a2 2 0 0 1 .4-1.2L10 12.6a1 1 0 0 0 0-1.2L8.4 8.533a2 2 0 0 1-.4-1.2V4h8v3.333a2 2 0 0 1-.4 1.2L13.957 11.4a1 1 0 0 0 0 1.2l1.643 2.867a2 2 0 0 1 .4 1.2V20H8Z"
                                                stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"/>
                                        </svg>
                                        Sedang Ditinjau
                                    </div>
                                    <div v-else-if="order.status === 'unpaid'"
                                         class="me-2 mt-1.5 inline-flex items-center rounded bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">
                                        <svg aria-hidden="true" class="me-1 h-3 w-3" fill="none"
                                             height="24" viewBox="0 0 24 24" width="24"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M3 10h18M6 14h2m3 0h5M3 7v10a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1Z"
                                                stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"/>
                                        </svg>
                                        Menunggu Pembayaran
                                    </div>
                                    <div v-else-if="order.status === 'finished'"
                                         class="me-2 mt-1.5 inline-flex items-center rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
                                        <svg aria-hidden="true" class="me-1 h-3 w-3" fill="none"
                                             height="24" viewBox="0 0 24 24" width="24"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5 11.917 9.724 16.5 19 7.5" stroke="currentColor"
                                                  stroke-linecap="round"
                                                  stroke-linejoin="round" stroke-width="2"/>
                                        </svg>
                                        Selesai
                                    </div>
                                </td>
                                <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ order.updated_at }}
                                </td>
                                <td>
                                    <a :href="route('dashboard.order.edit', order.id)"
                                       class="mr-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-1.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <svg aria-hidden="true" class="w-6 h-6 text-white" fill="none" height="24"
                                             viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"
                                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <nav
                        aria-label="Table navigation"
                        class="flex flex-col items-start justify-between p-4 space-y-3 md:flex-row md:items-center md:space-y-0">
              <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                  Showing
                  <span class="font-semibold text-gray-900 dark:text-white">
                      {{ props.orders.from }}&ndash;{{ props.orders.to }}
                  </span>
                  of
                  <span class="font-semibold text-gray-900 dark:text-white">
                      {{ props.orders.total }}
                  </span>
              </span>
                        <ul class="inline-flex items-stretch -space-x-px">
                            <template v-for="link in props.orders.links">
                                <li v-if="link.label === 'pagination.previous'">
                                    <a :href="link.url"
                                       class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                        <span class="sr-only">Previous</span>
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path clip-rule="evenodd"
                                                  d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                  fill-rule="evenodd"/>
                                        </svg>
                                    </a>
                                </li>

                                <li v-else-if="link.label === 'pagination.next'">
                                    <a :href="link.url"
                                       class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                        <span class="sr-only">Next</span>
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path clip-rule="evenodd"
                                                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                  fill-rule="evenodd"/>
                                        </svg>
                                    </a>
                                </li>

                                <li v-else>
                                    <a :href="link.url"
                                       class="flex items-center justify-center px-3 py-2 text-sm leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                        {{ link.label }}
                                    </a>
                                </li>
                            </template>
                        </ul>
                    </nav>
                </div>
            </div>
        </section>
    </DashboardLayout>
</template>
