<script lang="ts" setup>
	import { Link } from '@inertiajs/vue3';
	import { Card, CardContent, CardHeader } from '@/components/ui/card';
	import { Offer } from '@/types/models';
	import { onMounted, onUnmounted, ref } from 'vue';
	import { formatNumber } from '@/lib/utils';

	const { offer } = defineProps<{ offer: Offer }>();

	interface Countdown {
		d: string;
		h: string;
		m: string;
		s: string;
	}

	const countdown = ref<Countdown>({
		d: '00',
		h: '00',
		m: '00',
		s: '00',
	});

	const calculateCountdown = () => {
		const endDate = new Date(offer.end_at).getTime();
		const now = new Date().getTime();
		const distance = endDate - now;
		const d = formatNumber(Math.floor(distance / (1000 * 60 * 60 * 24)));
		const h = formatNumber(
			Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
		);
		const m = formatNumber(
			Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)),
		);
		const s = formatNumber(Math.floor((distance % (1000 * 60)) / 1000));
		countdown.value = {
			d,
			h,
			m,
			s,
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
		<CardHeader class="grid grid-cols-4 divide-x px-2 py-0 lg:px-4">
			<div
				v-for="(object, i) in Object.entries(countdown)"
				:key="i"
				class="flex h-14 basis-1/4 flex-col-reverse items-center justify-center gap-x-0.5 md:flex-row"
			>
				<span class="text-lg font-black text-primary">
					{{ object[1] }}
				</span>
				<span class="text-lg font-semibold capitalize md:normal-case">
					{{ object[0] }}
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
				<h6 class="truncate text-xs capitalize lg:text-sm">
					<Link href="/">{{ offer.description }}</Link>
				</h6>
				<div class="mt-2 flex flex-wrap items-center gap-x-1">
					<Link
						v-if="offer.store"
						class="truncate text-xs font-semibold text-primary lg:text-sm"
						href="/"
					>
						{{ offer.store.name }}
					</Link>
				</div>
			</div>
		</CardContent>
	</Card>
</template>
