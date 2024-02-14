<script lang="ts" setup>
	import { Link } from '@inertiajs/vue3';
	import { Button } from '@/components/ui/button';

	interface MainSectionProps {
		title: string;
		subtitle: string;
		link?: string;
		linkText?: string;
		linkAsButton?: boolean;
	}

	withDefaults(defineProps<MainSectionProps>(), {
		linkText: 'View All',
	});
</script>

<template>
	<div>
		<div class="flex items-center gap-x-4">
			<div class="h-8 w-4 rounded bg-primary" />
			<h2 class="text-lg font-semibold text-primary">{{ title }}</h2>
		</div>
		<div class="mt-6 flex items-center justify-between">
			<h1 class="text-2xl lg:text-4xl">{{ subtitle }}</h1>
			<slot name="link" />
			<Button
				v-if="link"
				as-child
				size="lg"
			>
				<Link :href="link">
					{{ linkText }}
				</Link>
			</Button>
		</div>

		<div class="mt-12">
			<slot />
		</div>
	</div>
</template>
