<script setup>
import NavLink from '@/Components/NavLink.vue';
import {onMounted, ref} from "vue";

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('myCartDropdownButton1').click();
});

const carts = ref([]);

function formatRupiah(value) {
    value = Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(value)

    return value.replace(/\s+/g, '')
}

const getCarts = async () => {
    try {
        const response = await axios.get(route('api.carts.get'), {
            headers: {
                "Content-Type": "application/json",
            }
        });

        carts.value = response.data.carts; // Assuming the cart items are returned in 'cart'
    } catch (error) {
        console.error('Failed to fetch cart items:', error);
    }
}

onMounted(() => {
    const script = document.createElement('script');
    script.src = "https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js";
    script.async = true;
    document.head.appendChild(script);

    getCarts()
});
</script>

<template>
    <nav class="bg-white dark:bg-gray-800 antialiased">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-8">
                    <div class="shrink-0">
                        <a href="#">
                            <img alt=""
                                 class="block w-auto h-12 dark:hidden"
                                 src="/assets/genki_logo_full.png">
                            <img alt=""
                                 class="hidden w-auto h-12 dark:block"
                                 src="/assets/genki_logo_full_dark.png">
                        </a>
                    </div>

                    <ul class="hidden lg:flex items-center justify-start gap-6 md:gap-8 py-3 sm:justify-center">
                        <li>
                            <NavLink :active="route().current('homepage')" :href="route('homepage')">
                                Beranda
                            </NavLink>
                        </li>
                        <li>
                            <NavLink :active="route().current('catalogue')" :href="route('catalogue')">
                                Katalog Obat
                            </NavLink>
                        </li>
                        <li>
                            <NavLink :active="route().current('prescription')" :href="route('prescription')">
                                Upload Resep
                            </NavLink>
                        </li>
                    </ul>
                </div>

                <div class="flex items-center lg:space-x-2">
                    <div>
                        <button id="myCartDropdownButton1"
                                class="inline-flex items-center rounded-lg justify-center p-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm font-medium leading-none text-gray-900 dark:text-white"
                                data-dropdown-toggle="myCartDropdown1"
                                type="button">
                        <span class="sr-only">
                            Cart
                        </span>
                            <svg aria-hidden="true" class="w-5 h-5 lg:me-1" fill="none" height="24"
                                 viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"/>
                            </svg>
                            <span class="hidden sm:flex">Keranjang</span>
                            <span v-if="carts.length > 0"
                                  class="ml-1 bg-red-100 text-red-800 text-xs font-medium py-1.5 px-2.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                {{ carts.length }}
                            </span>
                            <svg aria-hidden="true" class="hidden sm:flex w-4 h-4 text-gray-900 dark:text-white ms-1"
                                 fill="none" height="24" viewBox="0 0 24 24" width="24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="m19 9-7 7-7-7" stroke="currentColor" stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"/>
                            </svg>
                        </button>
                    </div>
                    <div id="myCartDropdown1"
                         class="hidden z-10 mx-auto max-w-sm space-y-4 overflow-hidden rounded-lg bg-white p-4 antialiased shadow-lg dark:bg-gray-800">
                        <div v-for="cart in carts" class="grid grid-cols-2">
                            <div>
                                <a class="truncate text-sm font-semibold leading-none text-gray-900 dark:text-white hover:underline"
                                   href="#">
                                    {{ cart.medicine.name }}
                                </a>
                                <p class="mt-0.5 truncate text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ formatRupiah(cart.medicine.price) }}
                                </p>
                            </div>

                            <div class="flex items-center justify-end gap-6">
                                <p class="text-sm font-normal leading-none text-gray-500 dark:text-gray-400">
                                    Qty: {{ cart.quantity }}
                                </p>

                                <button
                                    class="text-red-600 hover:text-red-700 dark:text-red-500 dark:hover:text-red-600"
                                    data-tooltip-target="tooltipRemoveItem1a"
                                    type="button">
                                    <span class="sr-only"> Remove </span>
                                    <svg aria-hidden="true" class="h-4 w-4" fill="currentColor"
                                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path clip-rule="evenodd"
                                              d="M2 12a10 10 0 1 1 20 0 10 10 0 0 1-20 0Zm7.7-3.7a1 1 0 0 0-1.4 1.4l2.3 2.3-2.3 2.3a1 1 0 1 0 1.4 1.4l2.3-2.3 2.3 2.3a1 1 0 0 0 1.4-1.4L13.4 12l2.3-2.3a1 1 0 0 0-1.4-1.4L12 10.6 9.7 8.3Z"
                                              fill-rule="evenodd"/>
                                    </svg>
                                </button>
                                <div id="tooltipRemoveItem1a"
                                     class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700"
                                     role="tooltip">
                                    Remove item
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </div>
                        </div>

                        <a :href="route('cart.index')"
                           class="mb-2 me-2 inline-flex w-full items-center justify-center rounded-lg bg-green-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                           role="button"
                           title="">Lihat Keranjang</a>
                    </div>

                    <button id="userDropdownButton1"
                            class="inline-flex items-center rounded-lg justify-center p-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm font-medium leading-none text-gray-900 dark:text-white"
                            data-dropdown-toggle="userDropdown1"
                            type="button">
                        <svg aria-hidden="true" class="w-5 h-5 me-1" fill="none" height="24"
                             viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                stroke="currentColor"
                                stroke-width="2"/>
                        </svg>
                        Akun
                        <svg aria-hidden="true" class="w-4 h-4 text-gray-900 dark:text-white ms-1"
                             fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                            <path d="m19 9-7 7-7-7" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2"/>
                        </svg>
                    </button>

                    <div id="userDropdown1"
                         class="hidden z-10 w-56 divide-y divide-gray-100 overflow-hidden overflow-y-auto rounded-lg bg-white antialiased shadow dark:divide-gray-600 dark:bg-gray-700">
                        <ul class="p-2 text-start text-sm font-medium text-gray-900 dark:text-white">
                            <li><a
                                class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600"
                                href="#"
                                title="">
                                My Account </a></li>
                            <li><a
                                class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600"
                                href="#"
                                title="">
                                My Orders </a></li>
                            <li><a
                                class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600"
                                href="#"
                                title="">
                                Settings </a></li>
                            <li><a
                                class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600"
                                href="#"
                                title="">
                                Favourites </a></li>
                            <li><a
                                class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600"
                                href="#"
                                title="">
                                Delivery Addresses </a></li>
                            <li><a
                                class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600"
                                href="#"
                                title="">
                                Billing Data </a></li>
                        </ul>

                        <div class="p-2 text-sm font-medium text-gray-900 dark:text-white">
                            <a class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600"
                               href="#"
                               title="">
                                Sign Out </a>
                        </div>
                    </div>

                    <button aria-controls="ecommerce-navbar-menu-1" aria-expanded="false"
                            class="inline-flex lg:hidden items-center justify-center hover:bg-gray-100 rounded-md dark:hover:bg-gray-700 p-2 text-gray-900 dark:text-white"
                            data-collapse-toggle="ecommerce-navbar-menu-1"
                            type="button">
          <span class="sr-only">
            Open Menu
          </span>
                        <svg aria-hidden="true" class="w-5 h-5" fill="none" height="24"
                             viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 7h14M5 12h14M5 17h14" stroke="currentColor" stroke-linecap="round"
                                  stroke-width="2"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div id="ecommerce-navbar-menu-1"
                 class="bg-gray-50 dark:bg-gray-700 dark:border-gray-600 border border-gray-200 rounded-lg py-3 hidden px-4 mt-4">
                <ul class="text-gray-900 dark:text-white text-sm font-medium dark:text-white space-y-3">
                    <li>
                        <a class="hover:text-primary-700 dark:hover:text-primary-500" href="#">Home</a>
                    </li>
                    <li>
                        <a class="hover:text-primary-700 dark:hover:text-primary-500" href="#">Best Sellers</a>
                    </li>
                    <li>
                        <a class="hover:text-primary-700 dark:hover:text-primary-500" href="#">Gift Ideas</a>
                    </li>
                    <li>
                        <a class="hover:text-primary-700 dark:hover:text-primary-500" href="#">Games</a>
                    </li>
                    <li>
                        <a class="hover:text-primary-700 dark:hover:text-primary-500" href="#">Electronics</a>
                    </li>
                    <li>
                        <a class="hover:text-primary-700 dark:hover:text-primary-500" href="#">Home & Garden</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<style scoped>

</style>
