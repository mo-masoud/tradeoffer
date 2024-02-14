<script lang="ts" setup>
	import { Link } from '@inertiajs/vue3';
	import {
		Card,
		CardContent,
		CardDescription,
		CardFooter,
		CardHeader,
		CardTitle,
	} from '@/components/ui/card';
	import { Store } from '@/types/models';

	defineProps<{ store: Store }>();
</script>

<template>
	<Link href="/">
		<Card>
			<CardHeader>
				<CardTitle class="text-primary">{{ store.name }}</CardTitle>
			</CardHeader>
			<CardContent class="p-0">
				<img
					:alt="store.name"
					:src="store.image"
					class="h-60 w-full object-cover"
				/>
			</CardContent>
			<CardDescription class="line-clamp-2 p-4">
				{{ store.description }}
			</CardDescription>
			<CardFooter> </CardFooter>
		</Card>
	</Link>
</template>
