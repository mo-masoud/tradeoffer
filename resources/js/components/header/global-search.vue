<script lang="ts" setup>
	import { Input } from '@/components/ui/input';
	import { MagnifyingGlassIcon } from '@heroicons/vue/24/outline';
	import { Button } from '@/components/ui/button';
</script>

<template>
	<div class="relative w-full lg:w-[40rem]">
		<Input placeholder="What are you looking for?" />

		<Button
			class="absolute right-0 top-1/2 -translate-y-1/2 transform text-gray-400"
			size="icon"
			variant="ghost"
		>
			<MagnifyingGlassIcon class="h-6 w-6 text-black" />
		</Button>
	</div>
</template>
