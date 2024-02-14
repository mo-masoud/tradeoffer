<script lang="ts" setup>
	import AppLayout from '@/layouts/app-layout.vue';
	import Slider from '@/pages/home/partials/slider.vue';
	import 'vue3-carousel/dist/carousel.css';
	import { Separator } from '@/components/ui/separator';
	import Specialists from '@/components/specialists.vue';
	import TopCategories from '@/pages/home/partials/top-categories.vue';
	import { Category, Offer, Product, Store } from '@/types/models';
	import MainSection from '@/components/main-section.vue';
	import ProductCard from '@/components/product-card.vue';
	import OfferCard from '@/components/offer-card.vue';
	import StoreCard from '@/components/store-card.vue';
	import { Link } from '@inertiajs/vue3';
	import { Button } from '@/components/ui/button';

	interface HomeProps {
		slider: string[];
		categories: Category[];
		offers: Offer[];
		topSellingProducts: Product[];
		stores: Store[];
		latestProducts: Product[];
	}

	defineProps<HomeProps>();
</script>

<template>
	<AppLayout title="Home">
		<!-- Slider -->
		<Slider :slider="slider" />
		<Separator class="mt-20" />

		<!-- Top Categories -->
		<TopCategories :categories="categories" />
		<Separator class="mt-20" />

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
			</div>
		</MainSection>

		<!-- Top Selling Products -->
		<MainSection
			class="mt-20"
			link="/"
			subtitle="Top Selling Products"
			title="This Month"
		>
			<div class="grid grid-cols-2 gap-4 lg:grid-cols-4 2xl:grid-cols-6">
				<ProductCard
					v-for="(product, i) in topSellingProducts"
					:key="i"
					:product="product"
				/>
			</div>
		</MainSection>
		<Separator class="mt-20" />

		<MainSection
			class="mt-20"
			link="/"
			subtitle="Top Stores"
			title="Stores"
		>
			<div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
				<StoreCard
					v-for="store in stores"
					:key="store.id"
					:store="store"
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
			<div class="grid grid-cols-2 gap-4 lg:grid-cols-4 2xl:grid-cols-6">
				<ProductCard
					v-for="(product, i) in latestProducts"
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
