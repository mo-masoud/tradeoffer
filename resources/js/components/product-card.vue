<script lang="ts" setup>
	import { HeartIcon, ShoppingCartIcon } from '@heroicons/vue/24/outline';
	import { Card, CardContent, CardFooter } from '@/components/ui/card';
	import { Product } from '@/types/models';
	import { Link } from '@inertiajs/vue3';
	import StarRating from '@/components/star-rating.vue';
	import { Button } from '@/components/ui/button';

	defineProps<{
		product: Product;
	}>();
</script>

<template>
	<Card class="relative">
		<div
			class="absolute right-2 top-2 z-20 flex h-20 w-20 flex-col items-end justify-between"
		>
			<Button
				class="rounded-full shadow"
				size="icon"
				variant="outline"
			>
				<ShoppingCartIcon class="h-6 w-6 text-primary" />
			</Button>

			<Button
				class="rounded-full shadow"
				size="icon"
				variant="outline"
			>
				<HeartIcon class="h-6 w-6 text-primary" />
			</Button>
		</div>
		<CardContent
			class="relative items-center justify-center rounded-t-lg bg-muted p-4"
		>
			<Link href="/">
				<span
					v-if="product.has_offer"
					class="absolute inline-flex items-center justify-center rounded bg-green-500 p-1 text-sm text-white"
				>
					Offer
				</span>
				<img
					:alt="product.name"
					:src="product.media[0].url"
					class="h-40 w-full rounded-t-lg object-contain"
				/>
			</Link>
		</CardContent>
		<CardFooter class="flex-col items-start px-2">
			<Link href="/">
				<h3 class="text-sm font-semibold capitalize lg:text-base">
					{{ product.name }}
				</h3>
			</Link>
			<div class="mt-2 flex items-center gap-x-6">
				<span
					v-if="product.discount === 0"
					class="font-bold text-primary"
				>
					${{ Math.round(product.price) }}
				</span>

				<template v-else>
					<span class="font-bold text-primary">
						${{
							Math.round(
								product.price -
									(product.price * product.discount) / 100,
							)
						}}
					</span>
					<span
						class="text-sm font-semibold text-muted-foreground line-through"
					>
						${{ Math.round(product.price) }}
					</span>
				</template>
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
