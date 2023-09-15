<template>
    <div
        class="p-4 mb-4 text-sm text-green-700
        bg-green-100 dark:bg-green-200 rounded relative
        dark:text-green-800" role="alert">
        <slot/>
    </div>
</template>

<script>
export default {
    name: 'AlertSuccess'
}
</script>
