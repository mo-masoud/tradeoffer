<script lang="ts" setup></script>

<template>
	<div class="flex justify-center space-x-4">
		<div class="animate-dot1 h-4 w-4 rounded-full bg-primary" />
		<div class="animate-dot2 h-4 w-4 rounded-full bg-primary" />
		<div class="animate-dot3 h-4 w-4 rounded-full bg-primary" />
	</div>
</template>

<style scoped>
	@keyframes dotFluctuate {
		0%,
		100% {
			transform: translateY(0);
		}
		50% {
			transform: translateY(-5px);
		}
	}

	.animate-dot1 {
		animation: dotFluctuate 0.6s infinite;
	}

	.animate-dot2 {
		animation: dotFluctuate 0.6s infinite 0.2s;
	}

	.animate-dot3 {
		animation: dotFluctuate 0.6s infinite 0.4s;
	}
</style>
