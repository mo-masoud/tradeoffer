<script lang="ts" setup>
	import { Link } from '@inertiajs/vue3';

	import { Category } from '@/types/models';
	import { Card, CardContent } from '@/components/ui/card';

	defineProps<{
		category: Category;
	}>();
</script>

<template>
	<Link href="/">
		<Card
			class="transition duration-300 ease-in-out hover:bg-primary hover:text-white"
		>
			<CardContent
				class="flex h-44 flex-col items-center justify-center gap-y-2 p-0"
			>
				<img
					:src="`/storage/${category.image}`"
					alt="category"
					class="h-20 w-20 object-cover"
				/>
				<span class="text-sm font-semibold">{{ category.name }}</span>
			</CardContent>
		</Card>
	</Link>
</template>
