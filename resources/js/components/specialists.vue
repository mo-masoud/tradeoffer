<script lang="ts" setup>
	import DeliveryIcon from '@/components/delivery-icon.vue';
	import HeadphoneIcon from '@/components/headphone-icon.vue';
	import SecurityCheckIcon from '@/components/security-check-icon.vue';
</script>

<template>
	<div
		class="flex flex-col items-center justify-center gap-y-4 md:flex-row md:justify-between lg:px-32"
	>
		<div class="flex flex-col items-center">
			<div class="rounded-full border-8 bg-black p-4">
				<DeliveryIcon />
			</div>
			<h4 class="mt-6 text-lg font-black">FREE AND FAST DELIVERY</h4>
			<h6 class="mt-2 text-sm">Free delivery for all orders over $140</h6>
		</div>
		<div class="flex flex-col items-center">
			<div class="rounded-full border-8 bg-black p-4">
				<HeadphoneIcon />
			</div>
			<h4 class="mt-6 text-lg font-black">24/7 CUSTOMER SERVICE</h4>
			<h6 class="mt-2 text-sm">Friendly 24/7 customer support</h6>
		</div>
		<div class="flex flex-col items-center">
			<div class="rounded-full border-8 bg-black p-4">
				<SecurityCheckIcon />
			</div>
			<h4 class="mt-6 text-lg font-black">MONEY BACK GUARANTEE</h4>
			<h6 class="mt-2 text-sm">We reurn money within 30 days</h6>
		</div>
	</div>
</template>
