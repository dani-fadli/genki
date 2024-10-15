<script setup>
import {Head, useForm} from '@inertiajs/vue3'
import Navbar from "@/Components/Navbar.vue"
import Footer from "@/Components/Footer.vue";

const props = defineProps({
    categories: Object
})

const form = useForm({
    search: "",
})

const search = () => {
    form.get('catalogue')
}
</script>

<template>
    <Head title="Homepage"/>
    <Navbar/>
    <section class="bg-white px-4 py-8 antialiased dark:bg-gray-900 md:py-16">
        <div
            class="mx-auto grid max-w-screen-xl rounded-lg bg-gray-50 p-4 dark:bg-gray-800 md:p-8 lg:grid-cols-12 lg:gap-8 lg:p-16 xl:gap-16">
            <div class="lg:col-span-5 lg:mt-0">
                <a href="#">
                    <img alt="peripherals"
                         class="mb-4 h-56 w-56 dark:hidden sm:h-96 sm:w-96 md:h-full md:w-full"
                         src="/assets/homepage_illustration.webp"/>
                    <img alt="peripherals"
                         class="mb-4 hidden dark:block md:h-full"
                         src="/assets/homepage_illustration.webp"/>
                </a>
            </div>
            <div class="me-auto place-self-center lg:col-span-7">
                <h1 class="mb-3 text-2xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white md:text-4xl">
                    Layanan Apotek Online Terpercaya
                </h1>
                <p class="mb-6 text-gray-500 dark:text-gray-400"> Temukan berbagai macam obat, vitamin, dan suplemen
                    dengan deskripsi lengkap dan harga terjangkau.
                    Dapatkan rekomendasi obat sesuai kebutuhan Anda!</p>


                <form @submit.prevent="search">
                    <label class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white"
                           for="search">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                 fill="none" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" stroke="currentColor"
                                      stroke-linecap="round"
                                      stroke-linejoin="round" stroke-width="2"/>
                            </svg>
                        </div>
                        <input id="search"
                               v-model="form.search"
                               class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="Cari obat berdasarkan nama, kategori, indikasi, dsb." required
                               type="search"/>
                        <button
                            class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="submit">
                            Cari
                        </button>
                    </div>
                </form>

                <p class="my-2 text-gray-500 dark:text-gray-400">atau</p>

                <button
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button"
                >
                    <a href="#medicines-by-categories">
                        Telusuri Katalog
                    </a>
                    <svg aria-hidden="true" class="rtl:rotate-180 w-3.5 h-3.5 ms-2" fill="none"
                         viewBox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"/>
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mb-4 flex items-center justify-between gap-4 md:mb-8">
                <h2 id="medicines-by-categories"
                    class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">
                    Obat Berdasarkan Kategori
                </h2>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                <a v-for="category in props.categories"
                   :href="route('catalogue', {category_id: category.id})"
                   class="flex items-center rounded-lg border border-gray-200 bg-white px-4 py-2 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <svg aria-hidden="true" class="w-6 h-6 text-gray-800 dark:text-white"
                         fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9.143 4H4.857A.857.857 0 0 0 4 4.857v4.286c0 .473.384.857.857.857h4.286A.857.857 0 0 0 10 9.143V4.857A.857.857 0 0 0 9.143 4Zm10 0h-4.286a.857.857 0 0 0-.857.857v4.286c0 .473.384.857.857.857h4.286A.857.857 0 0 0 20 9.143V4.857A.857.857 0 0 0 19.143 4Zm-10 10H4.857a.857.857 0 0 0-.857.857v4.286c0 .473.384.857.857.857h4.286a.857.857 0 0 0 .857-.857v-4.286A.857.857 0 0 0 9.143 14Zm10 0h-4.286a.857.857 0 0 0-.857.857v4.286c0 .473.384.857.857.857h4.286a.857.857 0 0 0 .857-.857v-4.286a.857.857 0 0 0-.857-.857Z"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"/>
                    </svg>
                    <span class="text-sm font-medium text-gray-900 ml-1 dark:text-white">
                        {{ category.name }}
                    </span>
                </a>
            </div>
        </div>
    </section>

    <Footer/>

</template>

<style scoped>

</style>
