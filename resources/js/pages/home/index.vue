<script lang="ts" setup>
	import { Link } from '@inertiajs/vue3';
	import AppLayout from '@/layouts/app-layout.vue';
	import { Category, Offer, Product } from '@/types/models';
	import Slider from '@/pages/home/partials/slider.vue';
	import 'vue3-carousel/dist/carousel.css';
	import { Separator } from '@/components/ui/separator';
	import MainSection from '@/components/main-section.vue';
	import CategoryCard from '@/components/category-card.vue';
	import OfferCard from '@/components/offer-card.vue';
	import ProductCard from '@/components/product-card.vue';
	import { Button } from '@/components/ui/button';
	import Specialists from '@/components/specialists.vue';

	interface HomeProps {
		categories: Category[];
		sliders: string[];
		offers: Offer[];
		mostSoldProducts: Product[];
		latestArrivals: Product[];
	}

	defineProps<HomeProps>();
</script>

<template>
	<AppLayout title="Home">
		<!-- Slider -->
		<Slider :sliders="sliders" />

		<!-- Best Offers -->
		<MainSection
			class="mt-28"
			link="/"
			subtitle="Best Offers"
			title="Offers"
		>
			<div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
				<OfferCard
					v-for="(offer, i) in offers"
					:key="i"
					:offer="offer"
				/>
				<OfferCard
					v-for="(offer, i) in offers"
					:key="i"
					:offer="offer"
				/>
			</div>
		</MainSection>

		<Separator class="mt-20" />

		<!-- Best Selling Products -->
		<MainSection
			class="mt-28"
			link="/"
			subtitle="Best Selling Products"
			title="This Month"
		>
			<div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
				<ProductCard
					v-for="(product, i) in mostSoldProducts"
					:key="i"
					:product="product"
				/>
			</div>
		</MainSection>

		<Separator class="mt-20" />

		<!-- Top Categories -->
		<MainSection
			class="mt-28"
			link="/"
			subtitle="Browse By Category"
			title="Categories"
		>
			<div
				class="mt-12 grid grid-cols-2 grid-rows-3 gap-4 lg:grid-cols-6 lg:grid-rows-1"
			>
				<CategoryCard
					v-for="(category, i) in categories"
					:key="i"
					:category="category"
				/>
			</div>
		</MainSection>

		<Separator class="mt-20" />

		<!-- Latest Arrivals -->
		<MainSection
			class="mt-28"
			subtitle="Explore Our Products"
			title="Our Products"
		>
			<div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
				<ProductCard
					v-for="(product, i) in latestArrivals"
					:key="i"
					:product="product"
				/>
				<ProductCard
					v-for="(product, i) in latestArrivals"
					:key="i"
					:product="product"
				/>
				<ProductCard
					v-for="(product, i) in latestArrivals"
					:key="i"
					:product="product"
				/>
				<ProductCard
					v-for="(product, i) in latestArrivals"
					:key="i"
					:product="product"
				/>
			</div>

			<div class="mt-12 flex items-center justify-center">
				<Button
					as-child
					size="lg"
				>
					<Link href="/">View All Products</Link>
				</Button>
			</div>
		</MainSection>

		<Specialists class="mt-28" />
	</AppLayout>
</template>
