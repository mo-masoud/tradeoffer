<script lang="ts" setup>

import {DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger} from "@/components/ui/dropdown-menu";
import {ChevronDownIcon} from "@heroicons/vue/16/solid";
</script>

<template>
    <div class="bg-black flex items-center h-12">
        <div class="flex items-center justify-between container">
            <div class="hidden md:block"/>
            <h2 class="text-white text-xs"><span class="font-black">TradeOffer</span> - Where Every Find
                is a
                Treasure!</h2>
            <DropdownMenu>
                <DropdownMenuTrigger class="text-white flex items-center text-xs gap-x-1">
                    <span>English</span>
                    <ChevronDownIcon class="w-4 h-4"/>
                </DropdownMenuTrigger>
                <DropdownMenuContent align="end">
                    <DropdownMenuItem>English</DropdownMenuItem>
                    <DropdownMenuItem>عربي</DropdownMenuItem>
                </DropdownMenuContent>
            </DropdownMenu>
        </div>
    </div>
</template>
