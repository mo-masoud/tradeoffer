<script lang="ts" setup>
    import { Input } from '@/components/ui/input';
    import { MagnifyingGlassIcon } from '@heroicons/vue/24/outline';
    import { Button } from '@/components/ui/button';
</script>

<template>
    <div class="relative w-full md:w-96">
        <Input
            placeholder="What are you looking for?" />

        <Button class="absolute right-0 top-1/2 transform -translate-y-1/2 text-gray-400" size="icon" variant="ghost">
            <MagnifyingGlassIcon class="w-6 h-6 text-black" />
        </Button>
    </div>
</template>
