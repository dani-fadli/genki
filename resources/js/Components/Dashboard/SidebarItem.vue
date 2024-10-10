<script setup>

const props = defineProps({
    href: {
        type: String,
        default: '#'
    },
})

</script>

<template>
    <a :href="href"
       class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
        <slot name="icon"/>

        <p class="ms-3">
            <slot/>
        </p>
    </a>
</template>

<style scoped>

</style>
