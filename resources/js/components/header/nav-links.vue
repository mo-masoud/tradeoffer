<script lang="ts" setup>
import {Link} from "@inertiajs/vue3";

const links = [
    {name: 'Home', href: 'home'},
    {name: 'Stores', href: 'stores'},
    {name: 'About us', href: 'about-us'},
]
</script>

<template>
    <nav class="flex flex-wrap items-center gap-x-4 md:gap-x-6 gap-y-4">
        <Link v-for="link in links" :key="link.name"
              :class="{'underline' : route().current() === link.href}"
              :href="route(link.href)"
              class="underline-offset-8 decoration-4 decoration-gray-300"
        >
            {{ link.name }}
        </Link>
    </nav>
</template>
