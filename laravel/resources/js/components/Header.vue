<script setup lang="ts">
import DocumentSvg from './svgs/DocumentSvg.vue'
</script>

<template>
    <header class = "bg-white"> 
        <!-- background white -->
        <div class = "flex justify-center mt-5 gap-2">
            <!-- margin top 5, gap 2　画像とテキスト間のギャップ -->
            <DocumentSvg class="w-10 h-10"/>
            <!-- width 10, height 10 -->
            <p class = "text-orange-500 text-4xl font-bold">かんたんメモ</p>
            <!-- text 4xl(extra large) -->
        </div>
        <div class = "flex justify-center mt-3 mb-5">
            <!-- margin top 3, margin bottom 5 -->
            <p class = "text-black text-base">思いついたことをサッと記録しよう</p>
        </div>
    </header>
</template>