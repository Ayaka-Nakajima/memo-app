<script setup lang="ts">
import PlusSvg from './svgs/PlusSvg.vue'
import { ref, computed } from 'vue'
const text = ref('');
const empty = computed(() => !text.value.trim());
</script>


<template>
    <div class="flex flex-col justify-center mx-auto w-full">
        <textarea
            v-model="text"
            class="w-full p-4 mt-4 border border-gray-300 rounded-xl outline-none 
            focus:border-primary-500 focus:ring-2 focus:ring-primary-500 
            transition-all duration-300 min-h-[150px]"
            rows="4"
            placeholder="メモを入力してください"
        ></textarea>
        <button :disabled="empty"
                class="mt-4 p-2 disabled:opacity-50 rounded-xl
                bg-gradient-to-r from-primary-500 to-primary-600
                flex justify-center items-center gap-x-2 text-white transition-opacity duration-300 ease-in-out">
                <PlusSvg class="w-6 h-6"/>
                保存する
        </button>
    </div>

</template>



