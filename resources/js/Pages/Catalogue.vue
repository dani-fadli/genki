<script setup>
import {Head} from '@inertiajs/vue3'
import Navbar from "@/Components/Navbar.vue";
import Footer from "@/Components/Footer.vue";

const props = defineProps({
    medicines: Object,
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
    <Head title="Katalog Obat"/>
    <Navbar/>

    <section class="bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-12">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <!-- Heading & Filters -->
            <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0 md:mb-8">
                <div>
                    <nav aria-label="Breadcrumb" class="flex">
                        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                            <li class="inline-flex items-center">
                                <a class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white"
                                   href="#">
                                    <svg aria-hidden="true" class="me-2.5 h-3 w-3" fill="currentColor"
                                         viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                                    </svg>
                                    Home
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg aria-hidden="true" class="h-5 w-5 text-gray-400 rtl:rotate-180"
                                         fill="none" height="24" viewBox="0 0 24 24" width="24"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="m9 5 7 7-7 7" stroke="currentColor" stroke-linecap="round"
                                              stroke-linejoin="round" stroke-width="2"/>
                                    </svg>
                                    <a class="ms-1 text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white md:ms-2"
                                       href="#">Products</a>
                                </div>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <svg aria-hidden="true" class="h-5 w-5 text-gray-400 rtl:rotate-180"
                                         fill="none" height="24" viewBox="0 0 24 24" width="24"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="m9 5 7 7-7 7" stroke="currentColor" stroke-linecap="round"
                                              stroke-linejoin="round" stroke-width="2"/>
                                    </svg>
                                    <span class="ms-1 text-sm font-medium text-gray-500 dark:text-gray-400 md:ms-2">Electronics</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <h2 class="mt-3 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Electronics</h2>
                </div>
                <div class="flex items-center space-x-4">
                    <button
                        class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 sm:w-auto"
                        data-modal-target="filterModal" data-modal-toggle="filterModal"
                        type="button">
                        <svg aria-hidden="true" class="-ms-0.5 me-2 h-4 w-4" fill="none"
                             height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M18.796 4H5.204a1 1 0 0 0-.753 1.659l5.302 6.058a1 1 0 0 1 .247.659v4.874a.5.5 0 0 0 .2.4l3 2.25a.5.5 0 0 0 .8-.4v-7.124a1 1 0 0 1 .247-.659l5.302-6.059c.566-.646.106-1.658-.753-1.658Z"
                                stroke="currentColor" stroke-linecap="round"
                                stroke-width="2"/>
                        </svg>
                        Filters
                        <svg aria-hidden="true" class="-me-0.5 ms-2 h-4 w-4" fill="none"
                             height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                            <path d="m19 9-7 7-7-7" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2"/>
                        </svg>
                    </button>
                    <button id="sortDropdownButton1"
                            class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 sm:w-auto"
                            data-dropdown-toggle="dropdownSort1"
                            type="button">
                        <svg aria-hidden="true" class="-ms-0.5 me-2 h-4 w-4" fill="none"
                             height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 4v16M7 4l3 3M7 4 4 7m9-3h6l-6 6h6m-6.5 10 3.5-7 3.5 7M14 18h4"
                                  stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2"/>
                        </svg>
                        Sort
                        <svg aria-hidden="true" class="-me-0.5 ms-2 h-4 w-4" fill="none"
                             height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                            <path d="m19 9-7 7-7-7" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2"/>
                        </svg>
                    </button>
                    <div id="dropdownSort1"
                         class="z-50 hidden w-40 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700"
                         data-popper-placement="bottom">
                        <ul aria-labelledby="sortDropdownButton"
                            class="p-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400">
                            <li>
                                <a class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                   href="#">
                                    The most popular </a>
                            </li>
                            <li>
                                <a class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                   href="#">
                                    Newest </a>
                            </li>
                            <li>
                                <a class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                   href="#">
                                    Increasing price </a>
                            </li>
                            <li>
                                <a class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                   href="#">
                                    Decreasing price </a>
                            </li>
                            <li>
                                <a class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                   href="#">
                                    No. reviews </a>
                            </li>
                            <li>
                                <a class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                   href="#">
                                    Discount % </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Medicine Cards-->
            <div class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">
                <div
                    v-for="medicine in props.medicines.data"
                    class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="h-56 w-full">
                        <a href="#">
                            <img alt=""
                                 class="mx-auto h-full"
                                 src="/assets/default_medicine.png"/>
                        </a>
                    </div>
                    <div class="pt-6">
                        <div class="flex items-center justify-between gap-4">
                            <span
                                class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                {{ medicine.category.name }}
                            </span>
                        </div>

                        <a class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white"
                           href="#">{{ medicine.name }}</a>

                        <div class="mt-2 flex items-center gap-2">
                            <div class="flex items-center">
                                <svg aria-hidden="true" class="h-4 w-4 text-yellow-400"
                                     fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z"/>
                                </svg>
                            </div>

                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{
                                    medicine.rating === 0 ? 'N/A' : medicine.rating
                                }}</p>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">(455)</p>
                        </div>

                        <div class="mt-2 flex items-center justify-between gap-4">
                            <p class="text-2xl font-extrabold leading-tight text-gray-900 dark:text-white">
                                {{ formatRupiah(medicine.price) }}
                            </p>

                            <button
                                class="inline-flex items-center rounded-full bg-green-700 px-3 py-2 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4  focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                type="button">
                                <svg aria-hidden="true" class="w-6 h-6 text-white"
                                     fill="none" height="24" viewBox="0 0 24 24" width="24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6"
                                        stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full text-center">
                <button
                    class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700"
                    type="button">
                    Show more
                </button>
            </div>
        </div>
        <!-- Filter modal -->
        <form id="filterModal" action="#" aria-hidden="true"
              class="fixed left-0 right-0 top-0 z-50 hidden h-modal w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0 md:h-full"
              method="get"
              tabindex="-1">
            <div class="relative h-full w-full max-w-xl md:h-auto">
                <!-- Modal content -->
                <div class="relative rounded-lg bg-white shadow dark:bg-gray-800">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between rounded-t p-4 md:p-5">
                        <h3 class="text-lg font-normal text-gray-500 dark:text-gray-400">Filters</h3>
                        <button
                            class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="filterModal"
                            type="button">
                            <svg aria-hidden="true" class="h-5 w-5" fill="none" height="24"
                                 viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 18 17.94 6M18 18 6.06 6" stroke="currentColor" stroke-linecap="round"
                                      stroke-linejoin="round" stroke-width="2"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="px-4 md:px-5">
                        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                            <ul id="myTab" class="-mb-px flex flex-wrap text-center text-sm font-medium"
                                data-tabs-toggle="#myTabContent" role="tablist">
                                <li class="mr-1" role="presentation">
                                    <button id="brand-tab" aria-controls="profile" aria-selected="false"
                                            class="inline-block pb-2 pr-1" data-tabs-target="#brand" role="tab"
                                            type="button">Brand
                                    </button>
                                </li>
                                <li class="mr-1" role="presentation">
                                    <button
                                        id="advanced-filers-tab"
                                        aria-controls="advanced-filters" aria-selected="false"
                                        class="inline-block px-2 pb-2 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300"
                                        data-tabs-target="#advanced-filters" role="tab" type="button">Advanced
                                        Filters
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div id="myTabContent">
                            <div id="brand" aria-labelledby="brand-tab" class="grid grid-cols-2 gap-4 md:grid-cols-3"
                                 role="tabpanel">
                                <div class="space-y-2">
                                    <h5 class="text-lg font-medium uppercase text-black dark:text-white">A</h5>

                                    <div class="flex items-center">
                                        <input id="apple"
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="apple"> Apple
                                            (56) </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="asus" checked
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="asus"> Asus
                                            (97) </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="acer"
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="acer"> Acer
                                            (234) </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="allview"
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="allview">
                                            Allview (45) </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="atari" checked
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="asus"> Atari
                                            (176) </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="amd"
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="amd"> AMD
                                            (49) </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="aruba"
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="aruba"> Aruba
                                            (16) </label>
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <h5 class="text-lg font-medium uppercase text-black dark:text-white">B</h5>

                                    <div class="flex items-center">
                                        <input id="beats"
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="beats"> Beats
                                            (56) </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="bose" checked
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="bose"> Bose
                                            (97) </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="benq"
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="benq"> BenQ
                                            (45) </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="bosch"
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="bosch"> Bosch
                                            (176) </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="brother" checked
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="brother">
                                            Brother (176) </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="biostar"
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="biostar">
                                            Biostar (49) </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="braun"
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="braun"> Braun
                                            (16) </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="blaupunkt"
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="blaupunkt">
                                            Blaupunkt (45) </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="benq2"
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="benq2"> BenQ
                                            (23) </label>
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <h5 class="text-lg font-medium uppercase text-black dark:text-white">C</h5>

                                    <div class="flex items-center">
                                        <input id="canon"
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="canon"> Canon
                                            (49) </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="cisco" checked
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="cisco"> Cisco
                                            (97) </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="cowon"
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="cowon"> Cowon
                                            (234) </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="clevo"
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="clevo"> Clevo
                                            (45) </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="corsair"
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="corsair">
                                            Corsair (15) </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="csl"
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="csl"> Canon
                                            (49) </label>
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <h5 class="text-lg font-medium uppercase text-black dark:text-white">D</h5>

                                    <div class="flex items-center">
                                        <input id="dell"
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="dell"> Dell
                                            (56) </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="dogfish"
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="dogfish">
                                            Dogfish (24) </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="dyson"
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="dyson"> Dyson
                                            (234) </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="dobe"
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="dobe"> Dobe
                                            (5) </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="digitus"
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="digitus">
                                            Digitus (1) </label>
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <h5 class="text-lg font-medium uppercase text-black dark:text-white">E</h5>

                                    <div class="flex items-center">
                                        <input id="emetec"
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="emetec"> Emetec
                                            (56) </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="extreme"
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="extreme">
                                            Extreme (10) </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="elgato"
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="elgato"> Elgato
                                            (234) </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="emerson"
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="emerson">
                                            Emerson (45) </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="emi" checked
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="emi"> EMI
                                            (176) </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="fugoo"
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="fugoo"> Fugoo
                                            (49) </label>
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <h5 class="text-lg font-medium uppercase text-black dark:text-white">F</h5>

                                    <div class="flex items-center">
                                        <input id="fujitsu"
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="fujitsu">
                                            Fujitsu (97) </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="fitbit" checked
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="fitbit"> Fitbit
                                            (56) </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="foxconn"
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="foxconn">
                                            Foxconn (234) </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="floston"
                                               class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                               type="checkbox"
                                               value=""/>

                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                               for="floston">
                                            Floston (45) </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="advanced-filters" aria-labelledby="advanced-filters-tab" class="space-y-4"
                             role="tabpanel">
                            <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-900 dark:text-white"
                                               for="min-price"> Min
                                            Price </label>
                                        <input id="min-price"
                                               class="h-2 w-full cursor-pointer appearance-none rounded-lg bg-gray-200 dark:bg-gray-700"
                                               max="7000" min="0" step="1" type="range"
                                               value="300"/>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-900 dark:text-white"
                                               for="max-price"> Max
                                            Price </label>
                                        <input id="max-price"
                                               class="h-2 w-full cursor-pointer appearance-none rounded-lg bg-gray-200 dark:bg-gray-700"
                                               max="7000" min="0" step="1" type="range"
                                               value="3500"/>
                                    </div>

                                    <div class="col-span-2 flex items-center justify-between space-x-2">
                                        <input id="min-price-input"
                                               class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500 "
                                               max="7000" min="0" placeholder=""
                                               required
                                               type="number" value="300"/>

                                        <div class="shrink-0 text-sm font-medium dark:text-gray-300">to</div>

                                        <input id="max-price-input"
                                               class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                               max="7000" min="0" placeholder=""
                                               required
                                               type="number" value="3500"/>
                                    </div>
                                </div>

                                <div class="space-y-3">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-900 dark:text-white"
                                               for="min-delivery-time"> Min
                                            Delivery Time (Days) </label>

                                        <input id="min-delivery-time"
                                               class="h-2 w-full cursor-pointer appearance-none rounded-lg bg-gray-200 dark:bg-gray-700"
                                               max="50" min="3" step="1" type="range"
                                               value="30"/>
                                    </div>

                                    <input id="min-delivery-time-input"
                                           class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500 "
                                           max="50" min="3" placeholder=""
                                           required
                                           type="number" value="30"/>
                                </div>
                            </div>

                            <div>
                                <h6 class="mb-2 text-sm font-medium text-black dark:text-white">Condition</h6>

                                <ul class="flex w-full items-center rounded-lg border border-gray-200 bg-white text-sm font-medium text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                    <li class="w-full border-r border-gray-200 dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input id="condition-all" checked
                                                   class="h-4 w-4 border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-500 dark:bg-gray-600 dark:ring-offset-gray-700 dark:focus:ring-primary-600"
                                                   name="list-radio" type="radio"
                                                   value=""/>
                                            <label
                                                class="ml-2 w-full py-3 text-sm font-medium text-gray-900 dark:text-gray-300"
                                                for="condition-all">
                                                All </label>
                                        </div>
                                    </li>
                                    <li class="w-full border-r border-gray-200 dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input id="condition-new"
                                                   class="h-4 w-4 border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-500 dark:bg-gray-600 dark:ring-offset-gray-700 dark:focus:ring-primary-600"
                                                   name="list-radio" type="radio"
                                                   value=""/>
                                            <label
                                                class="ml-2 w-full py-3 text-sm font-medium text-gray-900 dark:text-gray-300"
                                                for="condition-new">
                                                New </label>
                                        </div>
                                    </li>
                                    <li class="w-full">
                                        <div class="flex items-center pl-3">
                                            <input id="condition-used"
                                                   class="h-4 w-4 border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-500 dark:bg-gray-600 dark:ring-offset-gray-700 dark:focus:ring-primary-600"
                                                   name="list-radio" type="radio"
                                                   value=""/>
                                            <label
                                                class="ml-2 w-full py-3 text-sm font-medium text-gray-900 dark:text-gray-300"
                                                for="condition-used">
                                                Used </label>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="grid grid-cols-2 gap-4 md:grid-cols-3">
                                <div>
                                    <h6 class="mb-2 text-sm font-medium text-black dark:text-white">Colour</h6>
                                    <div class="space-y-2">
                                        <div class="flex items-center">
                                            <input id="blue"
                                                   class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                                   type="checkbox"
                                                   value=""/>

                                            <label
                                                class="ml-2 flex items-center text-sm font-medium text-gray-900 dark:text-gray-300"
                                                for="blue">
                                                <div class="mr-2 h-3.5 w-3.5 rounded-full bg-primary-600"></div>
                                                Blue
                                            </label>
                                        </div>

                                        <div class="flex items-center">
                                            <input id="gray"
                                                   class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                                   type="checkbox"
                                                   value=""/>

                                            <label
                                                class="ml-2 flex items-center text-sm font-medium text-gray-900 dark:text-gray-300"
                                                for="gray">
                                                <div class="mr-2 h-3.5 w-3.5 rounded-full bg-gray-400"></div>
                                                Gray
                                            </label>
                                        </div>

                                        <div class="flex items-center">
                                            <input id="green" checked
                                                   class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                                   type="checkbox"
                                                   value=""/>

                                            <label
                                                class="ml-2 flex items-center text-sm font-medium text-gray-900 dark:text-gray-300"
                                                for="green">
                                                <div class="mr-2 h-3.5 w-3.5 rounded-full bg-green-400"></div>
                                                Green
                                            </label>
                                        </div>

                                        <div class="flex items-center">
                                            <input id="pink"
                                                   class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                                   type="checkbox"
                                                   value=""/>

                                            <label
                                                class="ml-2 flex items-center text-sm font-medium text-gray-900 dark:text-gray-300"
                                                for="pink">
                                                <div class="mr-2 h-3.5 w-3.5 rounded-full bg-pink-400"></div>
                                                Pink
                                            </label>
                                        </div>

                                        <div class="flex items-center">
                                            <input id="red" checked
                                                   class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                                   type="checkbox"
                                                   value=""/>

                                            <label
                                                class="ml-2 flex items-center text-sm font-medium text-gray-900 dark:text-gray-300"
                                                for="red">
                                                <div class="mr-2 h-3.5 w-3.5 rounded-full bg-red-500"></div>
                                                Red
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h6 class="mb-2 text-sm font-medium text-black dark:text-white">Rating</h6>
                                    <div class="space-y-2">
                                        <div class="flex items-center">
                                            <input id="five-stars"
                                                   class="h-4 w-4 border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                                   name="rating" type="radio"
                                                   value=""/>
                                            <label class="ml-2 flex items-center" for="five-stars">
                                                <svg aria-hidden="true" class="h-5 w-5 text-yellow-400"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <title>First star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                                <svg aria-hidden="true" class="h-5 w-5 text-yellow-400"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <title>Second star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                                <svg aria-hidden="true" class="h-5 w-5 text-yellow-400"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <title>Third star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                                <svg aria-hidden="true" class="h-5 w-5 text-yellow-400"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <title>Fourth star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                                <svg aria-hidden="true" class="h-5 w-5 text-yellow-400"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <title>Fifth star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            </label>
                                        </div>

                                        <div class="flex items-center">
                                            <input id="four-stars"
                                                   class="h-4 w-4 border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                                   name="rating" type="radio"
                                                   value=""/>
                                            <label class="ml-2 flex items-center" for="four-stars">
                                                <svg aria-hidden="true" class="h-5 w-5 text-yellow-400"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <title>First star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                                <svg aria-hidden="true" class="h-5 w-5 text-yellow-400"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <title>Second star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                                <svg aria-hidden="true" class="h-5 w-5 text-yellow-400"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <title>Third star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                                <svg aria-hidden="true" class="h-5 w-5 text-yellow-400"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <title>Fourth star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                                <svg aria-hidden="true" class="h-5 w-5 text-gray-300 dark:text-gray-500"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <title>Fifth star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            </label>
                                        </div>

                                        <div class="flex items-center">
                                            <input id="three-stars" checked
                                                   class="h-4 w-4 border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                                   name="rating" type="radio"
                                                   value=""/>
                                            <label class="ml-2 flex items-center" for="three-stars">
                                                <svg aria-hidden="true" class="h-5 w-5 text-yellow-400"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <title>First star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                                <svg aria-hidden="true" class="h-5 w-5 text-yellow-400"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <title>Second star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                                <svg aria-hidden="true" class="h-5 w-5 text-yellow-400"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <title>Third star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                                <svg aria-hidden="true" class="h-5 w-5 text-gray-300 dark:text-gray-500"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <title>Fourth star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                                <svg aria-hidden="true" class="h-5 w-5 text-gray-300 dark:text-gray-500"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <title>Fifth star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            </label>
                                        </div>

                                        <div class="flex items-center">
                                            <input id="two-stars"
                                                   class="h-4 w-4 border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                                   name="rating" type="radio"
                                                   value=""/>
                                            <label class="ml-2 flex items-center" for="two-stars">
                                                <svg aria-hidden="true" class="h-5 w-5 text-yellow-400"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <title>First star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                                <svg aria-hidden="true" class="h-5 w-5 text-yellow-400"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <title>Second star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                                <svg aria-hidden="true" class="h-5 w-5 text-gray-300 dark:text-gray-500"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <title>Third star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                                <svg aria-hidden="true" class="h-5 w-5 text-gray-300 dark:text-gray-500"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <title>Fourth star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                                <svg aria-hidden="true" class="h-5 w-5 text-gray-300 dark:text-gray-500"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <title>Fifth star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            </label>
                                        </div>

                                        <div class="flex items-center">
                                            <input id="one-star"
                                                   class="h-4 w-4 border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                                   name="rating" type="radio"
                                                   value=""/>
                                            <label class="ml-2 flex items-center" for="one-star">
                                                <svg aria-hidden="true" class="h-5 w-5 text-yellow-400"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <title>First star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                                <svg aria-hidden="true" class="h-5 w-5 text-gray-300 dark:text-gray-500"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <title>Second star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                                <svg aria-hidden="true" class="h-5 w-5 text-gray-300 dark:text-gray-500"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <title>Third star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                                <svg aria-hidden="true" class="h-5 w-5 text-gray-300 dark:text-gray-500"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <title>Fourth star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                                <svg aria-hidden="true" class="h-5 w-5 text-gray-300 dark:text-gray-500"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <title>Fifth star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h6 class="mb-2 text-sm font-medium text-black dark:text-white">Weight</h6>

                                    <div class="space-y-2">
                                        <div class="flex items-center">
                                            <input id="under-1-kg"
                                                   class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                                   type="checkbox"
                                                   value=""/>

                                            <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                                   for="under-1-kg">
                                                Under 1 kg </label>
                                        </div>

                                        <div class="flex items-center">
                                            <input id="1-1-5-kg" checked
                                                   class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                                   type="checkbox"
                                                   value=""/>

                                            <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                                   for="1-1-5-kg">
                                                1-1,5 kg </label>
                                        </div>

                                        <div class="flex items-center">
                                            <input id="1-5-2-kg"
                                                   class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                                   type="checkbox"
                                                   value=""/>

                                            <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                                   for="1-5-2-kg">
                                                1,5-2 kg </label>
                                        </div>

                                        <div class="flex items-center">
                                            <input id="2-5-3-kg"
                                                   class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                                   type="checkbox"
                                                   value=""/>

                                            <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                                   for="2-5-3-kg">
                                                2,5-3 kg </label>
                                        </div>

                                        <div class="flex items-center">
                                            <input id="over-3-kg"
                                                   class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                                   type="checkbox"
                                                   value=""/>

                                            <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                                   for="over-3-kg">
                                                Over 3 kg </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h6 class="mb-2 text-sm font-medium text-black dark:text-white">Delivery type</h6>

                                <ul class="grid grid-cols-2 gap-4">
                                    <li>
                                        <input id="delivery-usa" checked class="peer hidden" name="delivery"
                                               type="radio" value="delivery-usa"/>
                                        <label
                                            class="inline-flex w-full cursor-pointer items-center justify-between rounded-lg border border-gray-200 bg-white p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-600 peer-checked:border-primary-600 peer-checked:text-primary-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:peer-checked:text-primary-500 md:p-5"
                                            for="delivery-usa">
                                            <div class="block">
                                                <div class="w-full text-lg font-semibold">USA</div>
                                                <div class="w-full">Delivery only for USA</div>
                                            </div>
                                        </label>
                                    </li>
                                    <li>
                                        <input id="delivery-europe" class="peer hidden" name="delivery" type="radio"
                                               value="delivery-europe"/>
                                        <label
                                            class="inline-flex w-full cursor-pointer items-center justify-between rounded-lg border border-gray-200 bg-white p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-600 peer-checked:border-primary-600 peer-checked:text-primary-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:peer-checked:text-primary-500 md:p-5"
                                            for="delivery-europe">
                                            <div class="block">
                                                <div class="w-full text-lg font-semibold">Europe</div>
                                                <div class="w-full">Delivery only for USA</div>
                                            </div>
                                        </label>
                                    </li>
                                    <li>
                                        <input id="delivery-asia" checked class="peer hidden" name="delivery"
                                               type="radio" value="delivery-asia"/>
                                        <label
                                            class="inline-flex w-full cursor-pointer items-center justify-between rounded-lg border border-gray-200 bg-white p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-600 peer-checked:border-primary-600 peer-checked:text-primary-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:peer-checked:text-primary-500 md:p-5"
                                            for="delivery-asia">
                                            <div class="block">
                                                <div class="w-full text-lg font-semibold">Asia</div>
                                                <div class="w-full">Delivery only for Asia</div>
                                            </div>
                                        </label>
                                    </li>
                                    <li>
                                        <input id="delivery-australia" class="peer hidden" name="delivery"
                                               type="radio" value="delivery-australia"/>
                                        <label
                                            class="inline-flex w-full cursor-pointer items-center justify-between rounded-lg border border-gray-200 bg-white p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-600 peer-checked:border-primary-600 peer-checked:text-primary-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:peer-checked:text-primary-500 md:p-5"
                                            for="delivery-australia">
                                            <div class="block">
                                                <div class="w-full text-lg font-semibold">Australia</div>
                                                <div class="w-full">Delivery only for Australia</div>
                                            </div>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="flex items-center space-x-4 rounded-b p-4 dark:border-gray-600 md:p-5">
                        <button
                            class="rounded-lg bg-primary-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-700 dark:hover:bg-primary-800 dark:focus:ring-primary-800"
                            type="submit">
                            Show 50 results
                        </button>
                        <button
                            class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700"
                            type="reset">
                            Reset
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <Footer/>
</template>

<style scoped>

</style>
