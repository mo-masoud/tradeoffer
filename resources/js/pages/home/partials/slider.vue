<script lang="ts" setup>
    import 'vue3-carousel/dist/carousel.css';

    import { Carousel, Pagination, Slide } from 'vue3-carousel';

    defineProps<{
        sliders: string[];
    }>();
</script>

<template>
    <carousel id="slider" :autoplay="10 * 1000" :items-to-show="1" :wrap-around="true">
        <slide v-for="(image, i) in sliders" :key="i">
            <img :src="`/storage/${image}`" alt="slider" class="h-52 lg:h-[35rem] w-full object-cover" />
        </slide>
        <template #addons>
            <pagination />
        </template>
    </carousel>
</template>
