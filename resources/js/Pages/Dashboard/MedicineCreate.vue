<script setup>

import {Head, useForm} from "@inertiajs/vue3"
import DashboardLayout from "@/Layouts/DashboardLayout.vue"
import {onMounted, ref} from "vue"

const props = defineProps({
    medicine: {
        type: Object,
        default: null
    },
    isUpdating: {
        type: Boolean,
        default: false
    },
    categories: {
        type: Object,
        default: null
    },
    errors: Object,
})

const title = props.isUpdating ? "Edit Obat" : "Tambah Obat"
const breadcrumbs = ['Kelola Obat', title, ...props.isUpdating ? [props.medicine.name] : []]

const form = useForm({
    name: "",
    price: 0,
    category: "",
    reg_number: "",
    description: "",
    indication: "",
    contra_indication: "",
    medicine_image: null
})

const createMedicine = () => form.post(route('dashboard.medicine.store'))
const updateMedicine = () => form.put(route('dashboard.medicine.update', props.medicine.id))
const submit = () => props.isUpdating ? updateMedicine() : createMedicine()
onMounted(() => {
    if (props.isUpdating && props.medicine) {
        form.name = props.medicine.name
        form.price = props.medicine.price
        form.category = props.medicine.category_id
        form.reg_number = props.medicine.detail.reg_number
        form.description = props.medicine.detail.description
        form.indication = props.medicine.detail.indication
        form.contra_indication = props.medicine.detail.contra_indication
    }
})

const previewImage = ref(null)

const handleFileChange = (event) => {
    const file = event.target.files[0]
    if (file) {
        form.medicine_image = file
        const reader = new FileReader()
        reader.onload = (e) => {
            previewImage.value = e.target.result
        }
        reader.readAsDataURL(file)
    }
    props.errors.medicine_image = null
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

        <section class="bg-none shadow-md dark:bg-gray-900 py-3 max-w-screen-2xl mx-auto">
            <div class="px-4">
                <form @submit.prevent="submit">
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="name">
                                Nama Obat
                            </label>
                            <input id="name"
                                   v-model="form.name"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   name="name"
                                   placeholder="Masukkan nama obat"
                                   required="" type="text">
                        </div>
                        <div class="w-full">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="price">
                                Harga
                            </label>
                            <input id="price"
                                   v-model="form.price"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   min="0"
                                   name="price"
                                   placeholder="Masukkan nominal harga"
                                   required="" type="number">
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="category">Kategori</label>
                            <select id="category"
                                    v-model="form.category"
                                    :value="props.medicine?.category_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Pilih kategori obat</option>
                                <option v-for="category in props.categories" :value="category.id">{{
                                        category.name
                                    }}
                                </option>
                            </select>
                        </div>
                        <div class="w-full">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                   for="reg_number">
                                No. Registrasi
                            </label>
                            <input id="reg_number"
                                   v-model="form.reg_number"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   name="reg_number"
                                   placeholder="cth: BPOM 12345xxx"
                                   type="text">
                        </div>
                        <div class="col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                   for="description">
                                Deskripsi
                            </label>
                            <textarea id="description"
                                      v-model="form.description"
                                      class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                      placeholder="Masukkan deskripsi, komposisi, instruksi"
                                      rows="8"></textarea>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                   for="indication">
                                Indikasi
                            </label>
                            <input id="indication"
                                   v-model="form.indication"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   name="indication"
                                   placeholder="Masukkan indikasi obat"
                                   type="text">
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                   for="contra_indication">
                                Kontra Indikasi
                            </label>
                            <input id="contra_indication"
                                   v-model="form.contra_indication"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   name="contra_indication"
                                   placeholder="Masukkan kontra indikasi obat"
                                   type="text">
                        </div>

                        <div class="flex flex-col justify-center w-full">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                   for="contra_indication">
                                Foto Produk
                            </label>
                            <label
                                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600"
                                for="medicine_image">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <img
                                        v-if="previewImage"
                                        :src="previewImage"
                                        alt="Preview Image"
                                        class="max-h-40 mb-2"
                                    />
                                    <svg aria-hidden="true" class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400"
                                         fill="none" viewBox="0 0 20 16" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"
                                            stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                        class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG (maks. 1MB)</p>
                                </div>
                                <input id="medicine_image" class="hidden" type="file" @change="handleFileChange"/>
                            </label>
                        </div>
                        <p v-if="errors.medicine_image"
                           class="mt-2 text-xs text-red-600 dark:text-red-400">
                            {{ errors.medicine_image }}
                        </p>
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
