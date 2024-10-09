<template>
    <button
        :class="buttonClass"
        :disabled="isDisabled || isLoading"
        @click="onClick"
    >
        <span v-if="isLoading" class="spinner mr-2"></span>
        <span>{{ label }}</span>
    </button>
</template>

<script setup>
import {computed, defineEmits, defineProps} from 'vue';

// Props
const props = defineProps({
    label: {
        type: String,
        required: true,
    },
    type: {
        type: String,
        default: 'primary', // primary, secondary, success, danger
    },
    isDisabled: {
        type: Boolean,
        default: false,
    },
    isLoading: {
        type: Boolean,
        default: false,
    },
    size: {
        type: String,
        default: 'md', // sm, md, lg
    },
});

// Emit event on click
const emit = defineEmits(['click']);
const onClick = () => {
    if (!props.isLoading && !props.isDisabled) {
        emit('click');
    }
};

// Dynamic classes for the button
const buttonClass = computed(() => {
    let baseClass = `rounded focus:outline-none transition ease-in-out duration-150`;
    let typeClass = '';
    let sizeClass = '';

    switch (props.type) {
        case 'primary':
            typeClass = 'bg-blue-500 hover:bg-blue-600 text-white';
            break;
        case 'secondary':
            typeClass = 'bg-gray-500 hover:bg-gray-600 text-white';
            break;
        case 'success':
            typeClass = 'bg-green-500 hover:bg-green-600 text-white';
            break;
        case 'danger':
            typeClass = 'bg-red-500 hover:bg-red-600 text-white';
            break;
        default:
            typeClass = 'bg-blue-500 hover:bg-blue-600 text-white';
    }

    switch (props.size) {
        case 'sm':
            sizeClass = 'px-3 py-1 text-sm';
            break;
        case 'md':
            sizeClass = 'px-4 py-2';
            break;
        case 'lg':
            sizeClass = 'px-6 py-3 text-lg';
            break;
        default:
            sizeClass = 'px-4 py-2';
    }

    const disabledClass = props.isDisabled
        ? 'bg-gray-300 text-gray-500 cursor-not-allowed'
        : '';

    return `${baseClass} ${typeClass} ${sizeClass} ${disabledClass}`;
});
</script>

<style scoped>
.spinner {
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-top: 2px solid white;
    border-radius: 50%;
    width: 16px;
    height: 16px;
    animation: spin 0.6s linear infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}
</style>
