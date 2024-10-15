<script setup>

import Navbar from "@/Components/Navbar.vue";
import {Head, useForm} from "@inertiajs/vue3";
import {onMounted, ref} from "vue";

onMounted(() => {
    const script = document.createElement('script');
    script.src = "https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js";
    script.async = true;
    document.head.appendChild(script);
});

const props = defineProps({
    errors: Object,
    order: Object,
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
    _method: "PUT",
    bank_account_name: "",
    bank_account_number: "",
    payment_confirmation_image: null,
});

const previewImage = ref(null)

const handleFileChange = (event) => {
    const file = event.target.files[0]
    if (file) {
        form.payment_confirmation_image = file
        const reader = new FileReader()
        reader.onload = (e) => {
            previewImage.value = e.target.result
        }
        reader.readAsDataURL(file)
    }
    props.errors.payment_confirmation_image = null
}

const submit = () => {
    form.post(route('order.update', props.order.id))
}
</script>

<template>
    <Head title="Konfirmasi Pembayaran"/>
    <Navbar/>

    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mx-auto max-w-5xl">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">
                    Konfirmasi Pembayaran Pesanan {{ props.order.invoice_number }}
                </h2>

                <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12">
                    <form
                        class="w-full rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6 lg:max-w-xl lg:p-8"
                        @submit.prevent="submit">
                        <div class="mb-6 grid grid-cols-2 gap-4">
                            <div class="col-span-2 sm:col-span-1">
                                <label
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                                    for="bank_account_name"
                                >
                                    Nama Lengkap
                                </label>
                                <input
                                    id="bank_account_name"
                                    v-model="form.bank_account_name"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                    placeholder="Nama lengkap sesuai rekening"
                                    required
                                    type="text"
                                />
                            </div>

                            <div class="col-span-2 sm:col-span-1">
                                <label
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                                    for="bank_account_number"
                                >
                                    Nomor Rekening
                                </label>
                                <input
                                    id="bank_account_number"
                                    v-model="form.bank_account_number"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pe-10 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                    placeholder="cth: 1234567890"
                                    required
                                    type="text"
                                    @input="form.bank_account_number = form.bank_account_number.replace(/[^0-9]/g, '')"
                                />
                            </div>

                            <div class="col-span-2">
                                <label
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                                    for="payment_confirmation_image"
                                >
                                    Upload Bukti Pembayaran
                                </label>
                                <label
                                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600"
                                    for="payment_confirmation_image"
                                >
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <img
                                            v-if="previewImage"
                                            :src="previewImage"
                                            alt="Preview Image"
                                            class="max-h-40 mb-2"
                                        />
                                        <svg
                                            v-if="!previewImage"
                                            aria-hidden="true"
                                            class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400"
                                            fill="none"
                                            viewBox="0 0 20 16"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"
                                                stroke="currentColor"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                            />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                            <span class="font-semibold">Click to upload</span> or drag and
                                            drop
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            PNG, JPG (maks. 1MB)
                                        </p>
                                    </div>
                                    <input
                                        id="payment_confirmation_image"
                                        class="hidden"
                                        type="file"
                                        @change="handleFileChange"
                                    />
                                </label>
                                <p v-if="errors.payment_confirmation_image"
                                   class="mt-2 text-xs text-red-600 dark:text-red-400">
                                    {{ errors.payment_confirmation_image }}
                                </p>
                            </div>
                        </div>

                        <button
                            class="flex w-full items-center justify-center rounded-lg bg-green-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4  focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                            type="submit">
                            Kirim Bukti Pembayaran
                        </button>
                    </form>

                    <div class="mt-6 grow sm:mt-8 lg:mt-0">
                        <div
                            class="space-y-4 rounded-lg border border-gray-100 bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-800">
                            <p class="text-xl font-semibold text-gray-900 dark:text-white">Detail Pembayaran</p>
                            <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                                <dd class="text-base font-bold text-gray-900 dark:text-white">
                                    {{ formatRupiah(props.order.total_payment) }}
                                </dd>
                            </dl>
                        </div>

                        <div id="accordion-open" data-accordion="open">
                            <h2 id="accordion-open-heading-1">
                                <button aria-controls="accordion-open-body-1"
                                        aria-expanded="true"
                                        class="mt-4 flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-gray-200 rounded-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                                        data-accordion-target="#accordion-open-body-1"
                                        type="button">
                                    <span class="flex items-center"><svg class="w-5 h-5 me-2 shrink-0"
                                                                         fill="currentColor" viewBox="0 0 20 20"
                                                                         xmlns="http://www.w3.org/2000/svg"><path
                                        clip-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                        fill-rule="evenodd"></path></svg>Pembayaran ke rekening BCA</span>
                                    <svg aria-hidden="true" class="w-3 h-3 rotate-180 shrink-0" data-accordion-icon
                                         fill="none" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 5 5 1 1 5" stroke="currentColor" stroke-linecap="round"
                                              stroke-linejoin="round" stroke-width="2"/>
                                    </svg>
                                </button>
                            </h2>
                            <div id="accordion-open-body-1" aria-labelledby="accordion-open-heading-1"
                                 class="hidden max-w-md">
                                <div
                                    class="p-5 border border-gray-200 dark:border-gray-700 dark:bg-gray-900">

                                    <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Transfer dengan
                                        BCA Mobile</h2>
                                    <ol class="max-w-md space-y-1 text-gray-500 list-decimal list-inside dark:text-gray-400">
                                        <li>Buka aplikasi <span class="font-semibold text-gray-900 dark:text-white">BCA Mobile</span>.
                                        </li>
                                        <li>Pilih menu <span class="font-semibold text-gray-900 dark:text-white">m-Transfer</span>
                                            lalu pilih <span class="font-semibold text-gray-900 dark:text-white">Transfer Antar Rekening</span>.
                                        </li>
                                        <li>Masukkan nomor rekening <span
                                            class="font-semibold text-gray-900 dark:text-white">1393458900</span>.
                                        </li>
                                        <li>Pastikan nama pemilik rekening adalah <span
                                            class="font-semibold text-gray-900 dark:text-white">PT GENKI PHARMA INDONESIA</span>.
                                        </li>
                                        <li>Masukkan jumlah pembayaran sesuai dengan tagihan yang tertera.</li>
                                        <li>Konfirmasi transaksi, lalu simpan bukti transfer sebagai referensi.</li>
                                        <li>Konfirmasi pembayaran melalui halaman <span
                                            class="font-semibold text-gray-900 dark:text-white">konfirmasi pembayaran</span>.
                                        </li>
                                    </ol>
                                    <h2 class="mt-4 mb-2 text-lg font-semibold text-gray-900 dark:text-white">Transfer
                                        dengan
                                        ATM BCA</h2>
                                    <ol class="max-w-md space-y-1 text-gray-500 list-decimal list-inside dark:text-gray-400">
                                        <li>Masukkan kartu ATM dan PIN Anda di mesin ATM BCA.</li>
                                        <li>Pilih menu <span class="font-semibold text-gray-900 dark:text-white">Transaksi Lainnya</span>
                                            lalu pilih <span class="font-semibold text-gray-900 dark:text-white">Transfer</span>.
                                        </li>
                                        <li>Pilih <span class="font-semibold text-gray-900 dark:text-white">Ke Rekening BCA</span>
                                            dan masukkan nomor rekening <span
                                                class="font-semibold text-gray-900 dark:text-white">1393458900</span>.
                                        </li>
                                        <li>Pastikan nama pemilik rekening adalah <span
                                            class="font-semibold text-gray-900 dark:text-white">PT GENKI PHARMA INDONESIA</span>.
                                        </li>
                                        <li>Masukkan jumlah pembayaran sesuai dengan tagihan yang tertera.</li>
                                        <li>Simpan struk ATM sebagai bukti pembayaran.</li>
                                        <li>Konfirmasi pembayaran melalui halaman <span
                                            class="font-semibold text-gray-900 dark:text-white">konfirmasi pembayaran</span>.
                                        </li>
                                    </ol>
                                    <h2 class="mt-4 mb-2 text-lg font-semibold text-gray-900 dark:text-white">Transfer
                                        dengan
                                        KlikBCA</h2>
                                    <ol class="max-w-md space-y-1 text-gray-500 list-decimal list-inside dark:text-gray-400">
                                        <li>Login ke akun <span class="font-semibold text-gray-900 dark:text-white">KlikBCA</span>
                                            Anda.
                                        </li>
                                        <li>Pilih menu <span class="font-semibold text-gray-900 dark:text-white">Transfer Dana</span>.
                                        </li>
                                        <li>Pilih <span class="font-semibold text-gray-900 dark:text-white">Transfer ke Rekening BCA</span>
                                            dan masukkan nomor rekening <span
                                                class="font-semibold text-gray-900 dark:text-white">1393458900</span>.
                                        </li>
                                        <li>Pastikan nama pemilik rekening adalah <span
                                            class="font-semibold text-gray-900 dark:text-white">PT GENKI PHARMA INDONESIA</span>.
                                        </li>
                                        <li>Masukkan jumlah pembayaran sesuai dengan tagihan yang tertera.</li>
                                        <li>Konfirmasi pembayaran dan simpan bukti transfer.</li>
                                        <li>Konfirmasi pembayaran melalui halaman <span
                                            class="font-semibold text-gray-900 dark:text-white">konfirmasi pembayaran</span>.
                                        </li>
                                    </ol>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
