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
    </DashboardLayout>
</template>

<style scoped>

</style>
