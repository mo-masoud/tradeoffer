<script lang="ts" setup>
	import {
		Carousel,
		CarouselContent,
		CarouselItem,
	} from '@/components/ui/carousel';

	import Autoplay from 'embla-carousel-autoplay';

	defineProps<{ slider: string[] }>();
</script>

<template>
	<Carousel
		:opts="{ loop: true }"
		:plugins="[
			Autoplay({
				delay: 2000,
			}),
		]"
	>
		<CarouselContent>
			<CarouselItem
				v-for="(image, i) in slider"
				:key="i"
			>
				<img
					:src="`${image}`"
					alt="slider"
					class="h-52 w-full object-cover lg:h-[40rem]"
				/>
			</CarouselItem>
		</CarouselContent>
	</Carousel>
</template>
