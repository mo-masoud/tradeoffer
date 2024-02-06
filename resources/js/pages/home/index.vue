<script lang="ts" setup>
import {Link} from "@inertiajs/vue3";
import AppLayout from "@/layouts/app-layout.vue";
import {Category} from "@/types/models";
import Slider from "@/pages/home/partials/slider.vue";
import {Carousel, CarouselContent, CarouselItem,} from '@/components/ui/carousel'
import emblaCarouselVue from 'embla-carousel-vue'

const [emblaRef] = emblaCarouselVue({loop: true})

interface HomeProps {
    categories: Category[];
    sliders: string[];
}

defineProps<HomeProps>();
</script>

<template>
    <AppLayout title="Home">
        <!-- Slider -->
        <Slider :sliders="sliders"/>
        <!-- Categories -->
        <div class="mt-20">
            <div class="flex items-center gap-x-4">
                <div class="w-4 h-8 bg-primary rounded"/>
                <h2 class="text-primary text-lg font-semibold">Categories</h2>
            </div>
            <div class="flex items-center justify-between mt-6">
                <h1 class="text-4xl">Browse By Category</h1>
            </div>

            <Carousel ref="emblaRef" class="w-full mt-6">
                <CarouselContent>
                    <CarouselItem v-for="category in categories" :key="category.id" class="basis-1/6">
                        <Link class="flex flex-col gap-y-2 items-center justify-center border rounded h-44 w-44"
                              href="/">
                            <img :src="`/storage/${category.image}`" alt="category" class="h-20 w-20 object-cover"/>
                            <span class="text-sm font-semibold">{{ category.name }}</span>
                        </Link>
                    </CarouselItem>
                </CarouselContent>
            </Carousel>
        </div>
    </AppLayout>
</template>
