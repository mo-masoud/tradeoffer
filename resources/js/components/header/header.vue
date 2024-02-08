<script lang="ts" setup>
	import {
		HeartIcon,
		ShoppingCartIcon,
		UserCircleIcon,
	} from '@heroicons/vue/24/outline';
	import TopBanner from '@/components/header/top-banner.vue';
	import Logo from '@/components/logo.vue';
	import GlobalSearch from '@/components/header/global-search.vue';
	import { Button } from '@/components/ui/button';
</script>

<template>
	<header
		id="header"
		class="fixed left-0 right-0 top-0 z-40 border-b bg-background pb-2.5"
	>
		<TopBanner id="top-banner" />
		<div
			class="container flex flex-wrap items-center justify-between gap-y-4 pt-8"
		>
			<Logo class="order-1" />
			<GlobalSearch class="order-3 lg:order-2" />
			<div class="order-2 flex items-center lg:order-3">
				<Button
					size="icon"
					variant="ghost"
				>
					<HeartIcon class="h-6 w-6" />
				</Button>
				<Button
					class="relative"
					size="icon"
					variant="ghost"
				>
					<ShoppingCartIcon class="h-6 w-6" />
					<span
						class="absolute -right-px -top-px h-4 w-4 rounded-full bg-red-500 px-1 text-xs font-bold text-white"
						>1</span
					>
				</Button>
				<Button
					size="icon"
					variant="ghost"
				>
					<UserCircleIcon class="h-6 w-6" />
				</Button>
			</div>
		</div>
	</header>
</template>
