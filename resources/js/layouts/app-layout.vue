<script lang="ts" setup>

import {Head} from "@inertiajs/vue3";
import Header from "@/components/header/header.vue";

withDefaults(
    defineProps<{
        title?: string
    }>(),
    {
        title: 'Home'
    }
)
</script>

<template>
    <Head :title="title"/>

    <div class="min-h-screen">
        <Header/>
        <main class="container py-8">
            <slot/>
        </main>
    </div>
</template>

<style scoped>

</style>
