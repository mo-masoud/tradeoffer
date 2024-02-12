<script lang="ts" setup>
	import {
		Carousel,
		CarouselContent,
		CarouselItem,
	} from '@/components/ui/carousel';
	import { onMounted, ref } from 'vue';
	import axios from 'axios';

	import Autoplay from 'embla-carousel-autoplay';

	const isLoaded = ref(false);
	const sliders = ref<string[]>([]);

	onMounted(async () => {
		try {
			const {
				data: { data },
			} = await axios.get('/api/sliders');
			sliders.value = data;
			isLoaded.value = true;
		} catch (e) {
			console.log(e);
		}
	});
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
			<CarouselItem v-if="!isLoaded">
				<div
					class="h-52 w-full animate-pulse bg-muted-foreground object-cover lg:h-[40rem]"
				/>
			</CarouselItem>
			<template v-else>
				<CarouselItem
					v-for="(image, i) in sliders"
					:key="i"
				>
					<img
						:src="`${image}`"
						alt="slider"
						class="h-52 w-full object-cover lg:h-[40rem]"
					/>
				</CarouselItem>
			</template>
		</CarouselContent>
	</Carousel>
</template>
