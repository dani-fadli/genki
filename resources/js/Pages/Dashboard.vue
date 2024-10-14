<script setup>
import {Head} from '@inertiajs/vue3'
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

const title = "Beranda"
const breadcrumbs = [title]
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
                <h1 class="text-4xl">
                    Selamat datang kembali, {{ $page.props.auth.user.first_name }}!
                </h1>
            </div>
        </section>
    </DashboardLayout>
</template>

<style scoped>

</style>
