<script lang="ts" setup>

import {HeartIcon, ShoppingCartIcon, UserCircleIcon} from "@heroicons/vue/24/outline";
import TopBanner from "@/components/header/top-banner.vue";
import Logo from "@/components/logo.vue";
import GlobalSearch from "@/components/header/global-search.vue";
import {Button} from "@/components/ui/button";
</script>

<template>
    <header class="border-b pb-2.5">
        <TopBanner/>
        <div class="flex items-center flex-wrap justify-between container gap-y-4 pt-8">
            <Logo class="order-1"/>
            <GlobalSearch class="order-3 lg:order-2"/>
            <div class="order-2 lg:order-3 flex items-center">
                <Button size="icon" variant="ghost">
                    <HeartIcon class="w-6 h-6"/>
                </Button>
                <Button class="relative" size="icon" variant="ghost">
                    <ShoppingCartIcon class="w-6 h-6"/>
                    <span
                        class="absolute -top-px -right-px h-4 w-4 bg-red-500 text-white text-xs font-bold px-1 rounded-full">1</span>
                </Button>
                <Button size="icon" variant="ghost">
                    <UserCircleIcon class="w-6 h-6"/>
                </Button>
            </div>
        </div>
    </header>
</template>
