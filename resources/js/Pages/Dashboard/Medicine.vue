<script setup>
import {Head, useForm} from "@inertiajs/vue3"
import DashboardLayout from "@/Layouts/DashboardLayout.vue"
import {onMounted} from "vue"

onMounted(() => {
    const script = document.createElement('script')
    script.src = "https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"
    script.async = true
    document.head.appendChild(script)
})

const title = "Kelola Obat"
const breadcrumbs = [title, "Daftar Obat"]
const props = defineProps({
    medicines: Object
})
const form = useForm({})
const deleteMedicine = (id) => {
    form.delete(route('dashboard.medicine.destroy', id))
}
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
                    <div
                        class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
                        <div class="flex items-center flex-1 space-x-4">
                            <p class="text-2xl">Daftar Obat</p>
                        </div>
                        <div
                            class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                            <a :href="route('dashboard.medicine.create')"
                               class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-primary-green-400 rounded-lg focus:outline-none hover:bg-primary-green-400 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                <svg aria-hidden="true" class="w-6 h-6 text-gray-800 dark:text-white" fill="none"
                                     height="24" viewBox="0 0 24 24" width="24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 12h14m-7 7V5" stroke="currentColor" stroke-linecap="round"
                                          stroke-linejoin="round" stroke-width="2.5"/>
                                </svg>
                                Tambah
                            </a>
                        </div>

                    </div>
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
                                <th class="px-4 py-3" scope="col">Nama Obat</th>
                                <th class="px-4 py-3" scope="col">Kategori</th>
                                <th class="px-4 py-3" scope="col">Stok</th>
                                <th class="px-4 py-3" scope="col">Penjualan</th>
                                <th class="px-4 py-3" scope="col">Rating</th>
                                <th class="px-4 py-3" scope="col">Pembaruan Terakhir</th>
                                <th class="px-4 py-3" scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="props.medicines.data.length === 0">
                                <td class="text-center w-full py-5" colspan="4">
                                    No Data
                                </td>
                            </tr>
                            <tr v-for="medicine in props.medicines.data" v-else
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
                                    <img
                                        :src="medicine.medicine_image"
                                        alt="Medicine"
                                        class="w-auto h-8 mr-3">
                                    {{ medicine.name }}
                                </th>
                                <td class="px-4 py-2">
                                    <span
                                        class="bg-primary-100 text-primary-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-primary-900 dark:text-primary-300">
                                        {{ medicine.category?.name }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="flex items-center">
                                        <div class="inline-block w-4 h-4 mr-2 bg-red-700 rounded-full"></div>
                                        {{ medicine.stock }}
                                    </div>
                                </td>
                                <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    58/hari
                                </td>
                                <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="flex items-center">
                                        <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor"
                                             viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        <span class="ml-1 text-gray-500 dark:text-gray-400">
                                            {{ medicine.rating }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ new Date(medicine.updated_at) }}
                                </td>
                                <td>
                                    <a :href="route('dashboard.medicine.edit', medicine.id)"
                                       class="mr-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-1.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <svg aria-hidden="true" class="w-6 h-6 text-white" fill="none" height="24"
                                             viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"
                                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"/>
                                        </svg>
                                    </a>
                                    <button
                                        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-1.5 text-center inline-flex items-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-blue-800"
                                        type="button"
                                        @click="deleteMedicine(medicine.id)">
                                        <svg aria-hidden="true" class="w-6 h-6 text-white"
                                             fill="none" height="24" viewBox="0 0 24 24" width="24"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"
                                                stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"/>
                                        </svg>
                                    </button>
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
                      {{ props.medicines.from }}&ndash;{{ props.medicines.to }}
                  </span>
                  of
                  <span class="font-semibold text-gray-900 dark:text-white">
                      {{ props.medicines.total }}
                  </span>
              </span>
                        <ul class="inline-flex items-stretch -space-x-px">
                            <template v-for="link in props.medicines.links">
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
