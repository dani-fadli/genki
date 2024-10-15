<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import Navbar from "@/Components/Navbar.vue";

const props = defineProps({
    medicine: Object,
    reviews: Object,
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
    medicine_id: null,
    quantity: 1,
})

const submit = (medicine_id) => {
    form.medicine_id = medicine_id
    form.post(route('cart.store'))
}
</script>

<template>
    <Head :title="props.medicine.name"/>
    <Navbar/>
    <section class="py-8 bg-white md:py-16 dark:bg-gray-900 antialiased">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
                <div class="shrink-0 max-w-md lg:max-w-lg mx-auto">
                    <img :alt="'Image ' + medicine.name"
                         :src="medicine.medicine_image"
                         class="w-full shadow-xl"/>
                </div>

                <div class="mt-6 sm:mt-8 lg:mt-0">
                    <h1
                        class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white"
                    >
                        {{ props.medicine.name }}
                    </h1>
                    <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                        <p
                            class="text-2xl font-extrabold text-gray-900 sm:text-3xl dark:text-white"
                        >
                            {{ formatRupiah(props.medicine.price) }}
                        </p>

                        <div class="flex items-center gap-2 mt-2 sm:mt-0">
                            <div class="flex items-center gap-1">
                                <svg
                                    aria-hidden="true"
                                    class="w-4 h-4 text-yellow-300"
                                    fill="currentColor"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    width="24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"
                                    />
                                </svg>
                            </div>
                            <p
                                class="text-sm font-medium leading-none text-gray-500 dark:text-gray-400">
                                ({{ props.medicine.rating ?? 0 }})
                            </p>
                            <a
                                class="text-sm font-medium leading-none text-gray-900 underline hover:no-underline dark:text-white"
                                href="#"
                            >
                                {{ props.medicine.reviews_count ?? 0 }} Ulasan
                            </a>
                        </div>
                    </div>

                    <div class="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">
                        <form @submit.prevent="submit(medicine.id)">
                            <input v-model="form.medicine_id" name="medicine_id" type="hidden">
                            <input v-model="form.quantity" name="quantity" type="hidden">
                            <button
                                class="text-white mt-4 sm:mt-0 bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800 flex items-center justify-center"
                                type="submit">
                                <svg
                                    aria-hidden="true"
                                    class="w-5 h-5 -ms-2 me-2"
                                    fill="none"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    width="24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6"
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                    />
                                </svg>
                                Tambah Ke Keranjang
                            </button>
                        </form>
                        <p v-if="medicine.stock > 0">{{ medicine.stock }} Tersedia</p>
                        <p v-else>Stok Habis</p>
                    </div>

                    <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800"/>

                    <div v-if="medicine.detail?.reg_number.length > 0" class="flex flex-col">
                        <p class="font-semibold">Nomor Registrasi</p>
                        <p class="mb-6 text-gray-500 dark:text-gray-400">
                            {{ medicine.detail.reg_number }}
                        </p>
                    </div>
                    <div v-if="medicine.detail?.description.length > 0" class="flex flex-col">
                        <p class="font-semibold">Deskripsi</p>
                        <p class="mb-6 text-gray-500 dark:text-gray-400">
                            {{ medicine.detail.description }}
                        </p>
                    </div>
                    <div v-if="medicine.detail?.indication.length > 0" class="flex flex-col">
                        <p class="font-semibold">Indikasi</p>
                        <p class="mb-6 text-gray-500 dark:text-gray-400">
                            {{ medicine.detail.indication }}
                        </p>
                    </div>
                    <div v-if="medicine.detail?.contra_indication.length > 0" class="flex flex-col">
                        <p class="font-semibold">Kontra Indikasi</p>
                        <p class="mb-6 text-gray-500 dark:text-gray-400">
                            {{ medicine.detail.contra_indication }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white antialiased dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="flex items-center gap-2">
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Reviews</h2>

                <div class="mt-2 flex items-center gap-2 sm:mt-0">
                    <div class="flex items-center gap-0.5">
                        <svg aria-hidden="true" class="h-4 w-4 text-yellow-300" fill="currentColor"
                             height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
                        </svg>
                        <svg aria-hidden="true" class="h-4 w-4 text-yellow-300" fill="currentColor"
                             height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
                        </svg>
                        <svg aria-hidden="true" class="h-4 w-4 text-yellow-300" fill="currentColor"
                             height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
                        </svg>
                        <svg aria-hidden="true" class="h-4 w-4 text-yellow-300" fill="currentColor"
                             height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
                        </svg>
                        <svg aria-hidden="true" class="h-4 w-4 text-yellow-300" fill="currentColor"
                             height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
                        </svg>
                    </div>
                    <p class="text-sm font-medium leading-none text-gray-500 dark:text-gray-400">(4.6)</p>
                    <a class="text-sm font-medium leading-none text-gray-900 underline hover:no-underline dark:text-white"
                       href="#">
                        645 Reviews </a>
                </div>
            </div>

            <div class="my-6 gap-8 sm:flex sm:items-start md:my-8">
                <div class="shrink-0 space-y-4">
                    <p class="text-2xl font-semibold leading-none text-gray-900 dark:text-white">4.65 out of 5</p>
                    <button
                        class="mb-2 me-2 rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                        data-modal-target="review-modal" data-modal-toggle="review-modal"
                        type="button">
                        Write a review
                    </button>
                </div>

                <div class="mt-6 min-w-0 flex-1 space-y-3 sm:mt-0">
                    <div class="flex items-center gap-2">
                        <p class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900 dark:text-white">
                            5</p>
                        <svg aria-hidden="true" class="h-4 w-4 shrink-0 text-yellow-300"
                             fill="currentColor" height="24" viewBox="0 0 24 24" width="24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
                        </svg>
                        <div class="h-1.5 w-80 rounded-full bg-gray-200 dark:bg-gray-700">
                            <div class="h-1.5 rounded-full bg-yellow-300" style="width: 20%"></div>
                        </div>
                        <a class="w-8 shrink-0 text-right text-sm font-medium leading-none text-primary-700 hover:underline dark:text-primary-500 sm:w-auto sm:text-left"
                           href="#">239
                            <span class="hidden sm:inline">reviews</span></a>
                    </div>

                    <div class="flex items-center gap-2">
                        <p class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900 dark:text-white">
                            4</p>
                        <svg aria-hidden="true" class="h-4 w-4 shrink-0 text-yellow-300"
                             fill="currentColor" height="24" viewBox="0 0 24 24" width="24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
                        </svg>
                        <div class="h-1.5 w-80 rounded-full bg-gray-200 dark:bg-gray-700">
                            <div class="h-1.5 rounded-full bg-yellow-300" style="width: 60%"></div>
                        </div>
                        <a class="w-8 shrink-0 text-right text-sm font-medium leading-none text-primary-700 hover:underline dark:text-primary-500 sm:w-auto sm:text-left"
                           href="#">432
                            <span class="hidden sm:inline">reviews</span></a>
                    </div>

                    <div class="flex items-center gap-2">
                        <p class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900 dark:text-white">
                            3</p>
                        <svg aria-hidden="true" class="h-4 w-4 shrink-0 text-yellow-300"
                             fill="currentColor" height="24" viewBox="0 0 24 24" width="24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
                        </svg>
                        <div class="h-1.5 w-80 rounded-full bg-gray-200 dark:bg-gray-700">
                            <div class="h-1.5 rounded-full bg-yellow-300" style="width: 15%"></div>
                        </div>
                        <a class="w-8 shrink-0 text-right text-sm font-medium leading-none text-primary-700 hover:underline dark:text-primary-500 sm:w-auto sm:text-left"
                           href="#">53
                            <span class="hidden sm:inline">reviews</span></a>
                    </div>

                    <div class="flex items-center gap-2">
                        <p class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900 dark:text-white">
                            2</p>
                        <svg aria-hidden="true" class="h-4 w-4 shrink-0 text-yellow-300"
                             fill="currentColor" height="24" viewBox="0 0 24 24" width="24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
                        </svg>
                        <div class="h-1.5 w-80 rounded-full bg-gray-200 dark:bg-gray-700">
                            <div class="h-1.5 rounded-full bg-yellow-300" style="width: 5%"></div>
                        </div>
                        <a class="w-8 shrink-0 text-right text-sm font-medium leading-none text-primary-700 hover:underline dark:text-primary-500 sm:w-auto sm:text-left"
                           href="#">32
                            <span class="hidden sm:inline">reviews</span></a>
                    </div>

                    <div class="flex items-center gap-2">
                        <p class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900 dark:text-white">
                            1</p>
                        <svg aria-hidden="true" class="h-4 w-4 shrink-0 text-yellow-300"
                             fill="currentColor" height="24" viewBox="0 0 24 24" width="24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
                        </svg>
                        <div class="h-1.5 w-80 rounded-full bg-gray-200 dark:bg-gray-700">
                            <div class="h-1.5 rounded-full bg-yellow-300" style="width: 0%"></div>
                        </div>
                        <a class="w-8 shrink-0 text-right text-sm font-medium leading-none text-primary-700 hover:underline dark:text-primary-500 sm:w-auto sm:text-left"
                           href="#">13
                            <span class="hidden sm:inline">reviews</span></a>
                    </div>
                </div>
            </div>

            <div class="mt-6 divide-y divide-gray-200 dark:divide-gray-700">
                <div v-for="review in props.reviews" class="gap-3 pb-6 sm:flex sm:items-start">

                    <div class="space-y-0.5">
                        <p class="text-base font-semibold text-gray-900 dark:text-white">John Doe</p>
                    </div>
                    <div class="mt-4 min-w-0 flex-1 space-y-4 sm:mt-0">
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">{{ review.review }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-6 text-center">
                <button
                    class="mb-2 me-2 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700"
                    type="button">
                    View more reviews
                </button>
            </div>
        </div>
    </section>

    <!-- Add review modal -->
    <div id="review-modal" aria-hidden="true"
         class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0 antialiased"
         tabindex="-1">
        <div class="relative max-h-full w-full max-w-2xl p-4">
            <!-- Modal content -->
            <div class="relative rounded-lg bg-white shadow dark:bg-gray-800">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between rounded-t border-b border-gray-200 p-4 dark:border-gray-700 md:p-5">
                    <div>
                        <h3 class="mb-1 text-lg font-semibold text-gray-900 dark:text-white">Add a review for:</h3>
                        <a class="font-medium text-primary-700 hover:underline dark:text-primary-500" href="#">Apple
                            iMac 24" All-In-One Computer, Apple M1, 8GB RAM, 256GB SSD</a>
                    </div>
                    <button
                        class="absolute right-5 top-5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="review-modal"
                        type="button">
                        <svg aria-hidden="true" class="h-3 w-3" fill="none" viewBox="0 0 14 14"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" stroke="currentColor" stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5">
                    <div class="mb-4 grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <div class="flex items-center">
                                <svg aria-hidden="true" class="h-6 w-6 text-yellow-300"
                                     fill="currentColor" viewBox="0 0 22 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                                <svg aria-hidden="true" class="ms-2 h-6 w-6 text-yellow-300"
                                     fill="currentColor" viewBox="0 0 22 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                                <svg aria-hidden="true" class="ms-2 h-6 w-6 text-yellow-300"
                                     fill="currentColor" viewBox="0 0 22 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                                <svg aria-hidden="true" class="ms-2 h-6 w-6 text-gray-300 dark:text-gray-500"
                                     fill="currentColor" viewBox="0 0 22 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                                <svg aria-hidden="true" class="ms-2 h-6 w-6 text-gray-300 dark:text-gray-500"
                                     fill="currentColor" viewBox="0 0 22 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                                <span class="ms-2 text-lg font-bold text-gray-900 dark:text-white">3.0 out of 5</span>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white" for="title">Review
                                title</label>
                            <input id="title"
                                   class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                   name="title"
                                   required=""
                                   type="text"/>
                        </div>
                        <div class="col-span-2">
                            <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                                   for="description">Review
                                description</label>
                            <textarea id="description"
                                      class="mb-2 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                      required=""
                                      rows="6"></textarea>
                            <p class="ms-auto text-xs text-gray-500 dark:text-gray-400">Problems with the product or
                                delivery? <a class="text-primary-600 hover:underline dark:text-primary-500" href="#">Send
                                    a report</a>.</p>
                        </div>
                        <div class="col-span-2">
                            <p class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Add real photos of
                                the product to help other customers <span class="text-gray-500 dark:text-gray-400">(Optional)</span>
                            </p>
                            <div class="flex w-full items-center justify-center">
                                <label
                                    class="dark:hover:bg-bray-800 flex h-52 w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:border-gray-500 dark:hover:bg-gray-600"
                                    for="dropzone-file">
                                    <div class="flex flex-col items-center justify-center pb-6 pt-5">
                                        <svg aria-hidden="true" class="mb-4 h-8 w-8 text-gray-500 dark:text-gray-400"
                                             fill="none" viewBox="0 0 20 16" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"
                                                stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"/>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                            class="font-semibold">Click to upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                            800x400px)</p>
                                    </div>
                                    <input id="dropzone-file" class="hidden" type="file"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <div class="flex items-center">
                                <input id="review-checkbox"
                                       class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                       type="checkbox"
                                       value=""/>
                                <label class="ms-2 text-sm font-medium text-gray-500 dark:text-gray-400"
                                       for="review-checkbox">By publishing
                                    this review you agree with the <a
                                        class="text-primary-600 hover:underline dark:text-primary-500"
                                        href="#">terms
                                        and conditions</a>.</label>
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 pt-4 dark:border-gray-700 md:pt-5">
                        <button
                            class="me-2 inline-flex items-center rounded-lg bg-primary-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                            type="submit">
                            Add review
                        </button>
                        <button
                            class="me-2 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700"
                            data-modal-toggle="review-modal"
                            type="button">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
