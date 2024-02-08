<script lang="ts" setup>
	import { Head } from '@inertiajs/vue3';
	import Header from '@/components/header/header.vue';
	import { Footer } from '@/components/footer';
	import { Button } from '@/components/ui/button';
	import { ArrowUpIcon } from '@heroicons/vue/24/outline';

	withDefaults(
		defineProps<{
			title?: string;
		}>(),
		{
			title: 'Home',
		},
	);

	const goToTop = () => {
		window.scrollTo({
			top: 0,
			behavior: 'smooth',
		});
	};

	// add shadow to header on scroll
	window.addEventListener('scroll', () => {
		const header = document.getElementById('header');
		if (header) {
			if (window.scrollY > 0) {
				header.classList.add('shadow-xl');
			} else {
				header.classList.remove('shadow-xl');
			}
		}

		// hide top banner on scroll with animation
		const topBanner = document.getElementById('top-banner');
		if (topBanner) {
			if (window.scrollY > 0) {
				topBanner.style.height = '0';
				topBanner.style.opacity = '0';
			} else {
				topBanner.style.height = '3.5rem';
				topBanner.style.opacity = '1';
			}
		}
	});
</script>

<template>
	<Head :title="title" />

	<div class="min-h-screen">
		<Header />
		<main class="container mt-40 py-8 lg:mt-32">
			<slot />
		</main>

		<Button
			class="fixed bottom-20 right-20 z-40 rounded-full"
			size="icon"
			@click="goToTop"
		>
			<ArrowUpIcon class="h-6 w-6" />
		</Button>
		<Footer />
	</div>
</template>

<style scoped></style>
