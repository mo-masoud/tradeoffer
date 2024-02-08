<script lang="ts" setup>
	import {
		DropdownMenu,
		DropdownMenuContent,
		DropdownMenuItem,
		DropdownMenuTrigger,
	} from '@/components/ui/dropdown-menu';
	import { ChevronDownIcon } from '@heroicons/vue/16/solid';
</script>

<template>
	<div
		class="flex h-12 items-center bg-black transition-all duration-150 ease-in-out"
	>
		<div class="container flex items-center justify-between">
			<div class="hidden md:block" />
			<h2 class="text-xs text-white">
				<span class="font-black">TradeOffer</span> - Where Every Find is
				a Treasure!
			</h2>
			<DropdownMenu>
				<DropdownMenuTrigger
					class="flex items-center gap-x-1 text-xs text-white"
				>
					<span>English</span>
					<ChevronDownIcon class="h-4 w-4" />
				</DropdownMenuTrigger>
				<DropdownMenuContent align="end">
					<DropdownMenuItem>English</DropdownMenuItem>
					<DropdownMenuItem>عربي</DropdownMenuItem>
				</DropdownMenuContent>
			</DropdownMenu>
		</div>
	</div>
</template>
