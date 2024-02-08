<script lang="ts" setup>
	import { computed } from 'vue';
	import { StarIcon } from '@heroicons/vue/24/outline';

	const { rating } = defineProps<{
		rating: number;
	}>();

	const stars = computed(() => {
		const fullStars = Math.floor(rating);
		const halfStar = rating % 1 !== 0 ? 1 : 0;
		const emptyStars = 5 - fullStars - halfStar;

		return [
			...Array(fullStars).fill('full'),
			...(halfStar ? ['half'] : []),
			...Array(emptyStars).fill('empty'),
		];
	});
</script>

<template>
	<div class="flex items-center gap-x-1">
		<template
			v-for="(star, index) in stars"
			:key="index"
		>
			<div
				v-if="star === 'half'"
				class="flex items-center"
			>
				<span class="relative h-5 w-2.5 overflow-hidden">
					<StarIcon
						class="absolute h-5 w-5 fill-yellow-500 text-yellow-500"
					/>
				</span>
				<span class="relative h-5 w-2.5 overflow-hidden">
					<StarIcon
						class="absolute right-0 h-5 w-5 fill-gray-300 text-gray-300"
					/>
				</span>
			</div>
			<StarIcon
				v-else
				:class="[
					'h-5 w-5',
					star === 'full' && 'fill-yellow-500 text-yellow-500',
					star === 'empty' && 'fill-gray-300 text-gray-300',
				]"
			/>
		</template>
	</div>
</template>
