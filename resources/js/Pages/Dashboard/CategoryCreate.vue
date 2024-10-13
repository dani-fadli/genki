<script setup>

import {Head, useForm} from "@inertiajs/vue3"
import DashboardLayout from "@/Layouts/DashboardLayout.vue"
import {onMounted} from "vue"

const props = defineProps({
    category: {
        type: Object,
        default: null,
    },
    isUpdating: {
        type: Boolean,
        default: false,
    },
})

const title = props.isUpdating ? "Edit Kategori Obat" : "Tambah Kategori Obat"
const breadcrumbs = ['Kelola Kategori Obat', title, ...props.isUpdating ? [props.category.name] : []]

const form = useForm({
    name: "",
})

const createCategory = () => form.post(route('dashboard.category.store'))
const updateCategory = () => form.put(route('dashboard.category.update', props.category.id))
const submit = () => props.isUpdating ? updateCategory() : createCategory()
onMounted(() => {
    if (props.isUpdating && props.category) {
        form.name = props.category.name
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
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="name">
                                Nama Kategori
                            </label>
                            <input id="name"
                                   v-model="form.name"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   name="name"
                                   placeholder="Masukkan nama kategori obat"
                                   required="" type="text">
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
