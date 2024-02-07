<script lang="ts" setup>
	import { Link } from '@inertiajs/vue3';
	import { Card, CardContent, CardHeader } from '@/components/ui/card';
	import { Offer } from '@/types/models';
	import { onMounted, onUnmounted, ref } from 'vue';
	import { formatNumber } from '@/lib/utils';

	const { offer } = defineProps<{ offer: Offer }>();

	interface Countdown {
		days: string;
		hours: string;
		mins: string;
		secs: string;
	}

	const countdown = ref<Countdown>({
		days: '00',
		hours: '00',
		mins: '00',
		secs: '00',
	});

	const calculateCountdown = () => {
		const endDate = new Date(offer.end_at).getTime();
		const now = new Date().getTime();
		const distance = endDate - now;
		const days = formatNumber(Math.floor(distance / (1000 * 60 * 60 * 24)));
		const hours = formatNumber(
			Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
		);
		const mins = formatNumber(
			Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)),
		);
		const secs = formatNumber(Math.floor((distance % (1000 * 60)) / 1000));
		countdown.value = {
			days,
			hours,
			mins,
			secs,
		};
	};

	let timer: number;

	onMounted(() => {
		calculateCountdown();
		timer = window.setInterval(calculateCountdown, 1000); // U
	});

	onUnmounted(() => {
		clearInterval(timer);
	});
</script>

<template>
	<Card>
		<CardHeader class="grid grid-cols-4 divide-x p-2 lg:p-4">
			<div
				v-for="(object, i) in Object.entries(countdown)"
				:key="i"
				class="flex basis-1/4 flex-col items-center justify-center"
			>
				<span class="text-xs font-semibold capitalize lg:text-lg">
					{{ object[0] }}
				</span>
				<span class="text-xs font-black text-primary lg:text-lg">
					{{ object[1] }}
				</span>
			</div>
		</CardHeader>
		<CardContent class="rounded-t-lg p-0">
			<Link href="/">
				<img
					:alt="offer.title"
					:src="offer.media[0].url"
					class="h-40 w-full object-cover lg:h-72"
				/>
			</Link>
			<div class="flex flex-col p-2 lg:p-4">
				<h3 class="text-sm font-semibold capitalize lg:text-base">
					<Link href="/">{{ offer.title }}</Link>
				</h3>
				<div class="mt-2 flex flex-wrap items-center gap-x-1">
					<Link
						class="truncate text-xs font-semibold text-primary lg:text-sm"
						href="/"
					>
						{{ offer.branch.store.name }}
					</Link>
					<span class="text-primary">-</span>
					<Link
						class="truncate text-xs text-primary lg:text-sm"
						href="/"
					>
						{{ offer.branch.name }}
					</Link>
				</div>
			</div>
		</CardContent>
	</Card>
</template>
