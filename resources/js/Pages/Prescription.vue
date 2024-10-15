<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import Navbar from "@/Components/Navbar.vue";
import Footer from "@/Components/Footer.vue";
import {ref} from "vue";

const props = defineProps({
    errors: Object,
})

const form = useForm({
    prescription: null,
})

const previewImage = ref(null)

const handleFileChange = (event) => {
    const file = event.target.files[0]
    if (file) {
        form.prescription = file
        const reader = new FileReader()
        reader.onload = (e) => {
            previewImage.value = e.target.result
        }
        reader.readAsDataURL(file)
    }
    props.errors.prescription = null
}

const submit = () => {
    form.post(route('order.store-prescription'))
}
</script>

<template>
    <Head title="Upload Resep"/>
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
                    Dapatkan Obat Dengan Mudah!
                </h1>
                <p class="mb-6 text-gray-500 dark:text-gray-400"> Upload resep dokter dan apoteker kami akan memproses
                    pesanan Anda!</p>
                <form @submit.prevent="submit">
                    <div class="flex items-center justify-center w-full">
                        <label
                            class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600"
                            for="prescription">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <img
                                    v-if="previewImage"
                                    :src="previewImage"
                                    alt="Preview Image"
                                    class="max-h-40 mb-2"
                                />
                                <svg v-else aria-hidden="true"
                                     class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400"
                                     fill="none" viewBox="0 0 20 16" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"
                                        stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"/>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span>
                                    or drag and drop</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG (maks. 1MB)</p>
                            </div>
                            <input id="prescription" class="hidden" type="file" @change="handleFileChange"/>

                        </label>
                    </div>
                    <p v-if="errors.prescription"
                       class="mt-2 text-xs text-red-600 dark:text-red-400">
                        {{ errors.prescription }}
                    </p>
                    <button
                        class="flex w-full mt-2 items-center justify-center rounded-lg bg-green-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4  focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                        type="submit">
                        Upload Resep
                    </button>
                </form>
            </div>
        </div>
    </section>

    <Footer/>
</template>

<style scoped>

</style>
