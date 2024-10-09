<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {defineProps, onMounted} from 'vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import BaseButton from "@/Components/BaseButton.vue";

// Ambil data dari backend melalui prop
const props = defineProps({
    medicines: Array
});

onMounted(() => {
    const script = document.createElement('script');
    script.src = "https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js";
    script.async = true;
    document.head.appendChild(script);
});
</script>

<template>
    <AppLayout title="Kelola Obat">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Kelola Obat
            </h2>
        </template>

        <!-- Tabel untuk menampilkan daftar obat -->


        <div class="relative overflow-x-auto">
            <button
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                type="button"
            >
                Tambah
            </button>
            <PrimaryButton :active="route().current('dashboard')" :href="route('dashboard')">
                Alvin Tse
            </PrimaryButton>
            <BaseButton
                :isDisabled="false"
                :isLoading="false"
                label="Submit"
                size="md"
                type="secondary"
                @click="handleSubmit"
            />

            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-6 py-3" scope="col">
                        Nama Obat
                    </th>
                    <th class="px-6 py-3" scope="col">
                        Deskripsi
                    </th>
                    <th class="px-6 py-3" scope="col">
                        Harga
                    </th>
                    <th class="px-6 py-3" scope="col">
                        Stok
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="medicine in props.medicines" :key="medicine._id"
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" scope="row">
                        {{ medicine.name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ medicine.detail.description }}
                    </td>
                    <td class="px-6 py-4">
                        {{ medicine.price }}
                    </td>
                    <td class="px-6 py-4">
                        {{ medicine.stock }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>


        <img alt="Bordered avatar" class="w-10 h-10 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500"
             src="https://ui-avatars.com/api/?name=DF">
    </AppLayout>
</template>

<script>
export default {
    filters: {
        currency(value) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(value);
        }
    }
};
</script>
