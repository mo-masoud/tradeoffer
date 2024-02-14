<script lang="ts" setup>
	import MainSection from '@/components/main-section.vue';
	import { ref } from 'vue';
	import { ArrowLeftIcon, ArrowRightIcon } from '@heroicons/vue/24/outline';
	import { Category } from '@/types/models';
	import CategoryCard from '@/components/category-card.vue';
	import {
		Carousel,
		CarouselContent,
		CarouselItem,
	} from '@/components/ui/carousel';

	import { Button } from '@/components/ui/button';

	const carouselContainerRef = ref<InstanceType<typeof Carousel> | null>(
		null,
	);

	const scrollNext = () => {
		carouselContainerRef.value!.carouselApi?.scrollNext();
	};

	const scrollPrev = () => {
		carouselContainerRef.value!.carouselApi?.scrollPrev();
	};

	defineProps<{
		categories: Category[];
	}>();
</script>

<template>
	<MainSection
		class="mt-28"
		subtitle="Browse By Category"
		title="Categories"
	>
		<template #link>
			<div class="flex items-center justify-end gap-x-4">
				<Button
					class="rounded-full border"
					size="icon"
					variant="ghost"
					@click="scrollPrev"
				>
					<ArrowLeftIcon class="h-6 w-6" />
				</Button>

				<Button
					class="rounded-full border"
					size="icon"
					variant="ghost"
					@click="scrollNext"
				>
					<ArrowRightIcon class="h-6 w-6" />
				</Button>
			</div>
		</template>

		<Carousel
			ref="carouselContainerRef"
			:opts="{
				align: 'center',
			}"
			class="relative w-full"
		>
			<CarouselContent>
				<CarouselItem
					v-for="category in categories"
					:key="category.id"
					class="basis-1/2 md:basis-1/4 lg:basis-1/6"
				>
					<CategoryCard :category="category" />
				</CarouselItem>
			</CarouselContent>
		</Carousel>
	</MainSection>
</template>
