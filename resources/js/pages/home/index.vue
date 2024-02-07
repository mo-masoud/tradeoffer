<script lang="ts" setup>
	import AppLayout from '@/layouts/app-layout.vue';
	import { Category, Offer } from '@/types/models';
	import Slider from '@/pages/home/partials/slider.vue';
	import 'vue3-carousel/dist/carousel.css';
	import { Separator } from '@/components/ui/separator';
	import MainSection from '@/components/main-section.vue';
	import CategoryCard from '@/components/category-card.vue';
	import OfferCard from '@/components/offer-card.vue';

	interface HomeProps {
		categories: Category[];
		sliders: string[];
		offers: Offer[];
	}

	defineProps<HomeProps>();
</script>

<template>
	<AppLayout title="Home">
		<!-- Slider -->
		<Slider :sliders="sliders" />

		<!-- Latest Offers -->
		<MainSection
			class="mt-28"
			link="/"
			subtitle="Our Offers"
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
	</AppLayout>
</template>
