<script lang="ts" setup>
	import {
		EyeIcon,
		HeartIcon,
		ShoppingCartIcon,
	} from '@heroicons/vue/24/outline';
	import { Card, CardContent, CardFooter } from '@/components/ui/card';
	import { Product } from '@/types/models';
	import { Link } from '@inertiajs/vue3';
	import StarRating from '@/components/star-rating.vue';
	import { Button } from '@/components/ui/button';
	import { ref } from 'vue';

	defineProps<{
		product: Product;
	}>();

	const hover = ref(false);
</script>

<template>
	<Card class="relative">
		<div
			class="absolute right-0 top-4 z-20 flex h-20 w-20 flex-col items-center justify-between"
		>
			<Button
				class="rounded-full shadow"
				size="icon"
				variant="outline"
			>
				<HeartIcon class="h-6 w-6 text-primary" />
			</Button>

			<Button
				class="rounded-full shadow"
				size="icon"
				variant="outline"
			>
				<EyeIcon class="h-6 w-6 text-primary" />
			</Button>
		</div>
		<CardContent
			class="relative px-0"
			@mouseenter="hover = true"
			@mouseleave="hover = false"
		>
			<img
				:alt="product.name"
				:src="product.media[0].url"
				class="h-40 w-full rounded-t-lg object-cover lg:h-72"
			/>

			<button
				v-if="hover"
				class="absolute bottom-0 flex h-12 w-full items-center justify-center gap-x-2 bg-black text-white hover:text-muted"
			>
				<span>Add to Cart</span>
				<ShoppingCartIcon class="h-6 w-6" />
			</button>
		</CardContent>
		<CardFooter class="flex-col items-start px-2">
			<Link href="/">
				<h3 class="text-sm font-semibold capitalize lg:text-base">
					{{ product.name }}
				</h3>
			</Link>
			<div class="mt-2 flex items-center gap-x-6">
				<span class="font-bold text-primary">
					${{ Math.round(product.price) }}
				</span>
				<!-- Discount will be here in future -->
			</div>
			<div class="flex items-center gap-x-2">
				<StarRating :rating="3.5" />
				<span class="text-sm font-semibold text-muted-foreground">
					(80)
				</span>
			</div>
		</CardFooter>
	</Card>
</template>
