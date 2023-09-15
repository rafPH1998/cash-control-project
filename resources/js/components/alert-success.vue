<template>
    <div
        class="p-4 mb-4 text-black font-light mt-4
        bg-green-100 dark:bg-green-200 rounded relative" role="alert">
        <slot/>
    </div>
</template>

<script>
export default {
    name: 'AlertSuccess'
}
</script>
