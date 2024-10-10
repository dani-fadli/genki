<script setup>
import {Head} from '@inertiajs/vue3'
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

const title = "Beranda"
const breadcrumbs = [title]
</script>

<template>
    <Head title="title"/>

    <DashboardLayout :breadcrumbs="breadcrumbs" :title="title">
    </DashboardLayout>
</template>

<style scoped>

</style>
