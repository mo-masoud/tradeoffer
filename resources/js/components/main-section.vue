<script lang="ts" setup>

import {Link} from "@inertiajs/vue3";
import {ArrowTopRightOnSquareIcon} from "@heroicons/vue/24/outline";

interface MainSectionProps {
    title: string;
    subtitle: string;
    link?: string;
    linkText?: string;
}

withDefaults(defineProps<MainSectionProps>(), {
    linkText: 'View All'
})
</script>

<template>
    <div>
        <div class="flex items-center gap-x-4">
            <div class="w-4 h-8 bg-primary rounded"/>
            <h2 class="text-primary text-lg font-semibold">{{ title }}</h2>
        </div>
        <div class="flex items-center justify-between mt-6">
            <h1 class="text-2xl lg:text-4xl">{{ subtitle }}</h1>
            <Link v-if="link" :href="link"
                  class="flex gap-x-1 text-primary hover:border-b border-b-primary transition-all ease-in-out duration-75">
                <span>{{ linkText }}</span>
                <ArrowTopRightOnSquareIcon class="h-5 w-5"/>
            </Link>
        </div>

        <div class="mt-12">
            <slot/>
        </div>
    </div>
</template>
