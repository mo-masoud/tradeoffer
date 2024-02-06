<script lang="ts" setup>
import AppLayout from "@/layouts/app-layout.vue";
import {Category} from "@/types/models";
import {Carousel, CarouselContent, CarouselItem, CarouselNext, CarouselPrevious,} from '@/components/ui/carousel'

interface HomeProps {
    categories: Category[];
}

defineProps<HomeProps>();

</script>

<template>
    <AppLayout title="Home">
        <!-- Slider -->
        <Carousel>
            <CarouselContent>
                <CarouselItem>...</CarouselItem>
                <CarouselItem>...</CarouselItem>
                <CarouselItem>...</CarouselItem>
            </CarouselContent>
            <CarouselPrevious/>
            <CarouselNext/>
        </Carousel>
    </AppLayout>
</template>
