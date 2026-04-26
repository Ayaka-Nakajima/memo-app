<template>
  <div>
    <div v-if="loading" class="text-center py-8 text-gray-500">Loading…</div>
    <div v-else-if="memos.length === 0" class="text-center py-8 text-gray-400">
      No memos yet. Create your first one!
    </div>
    <ul v-else class="space-y-4">
      <li
        v-for="memo in memos"
        :key="memo.id"
        class="bg-white rounded shadow p-4"
      >
        <div class="flex items-start justify-between">
          <div>
            <h2 class="text-lg font-semibold text-gray-800">{{ memo.title }}</h2>
            <p v-if="memo.content" class="mt-1 text-gray-600 whitespace-pre-wrap">{{ memo.content }}</p>
          </div>
          <div class="ml-4 flex gap-2 shrink-0">
            <router-link
              :to="`/edit/${memo.id}`"
              class="text-blue-500 hover:text-blue-700"
            >Edit</router-link>
            <button
              @click="deleteMemo(memo.id)"
              class="text-red-500 hover:text-red-700"
            >Delete</button>
          </div>
        </div>
        <p class="mt-2 text-xs text-gray-400">{{ formatDate(memo.updated_at) }}</p>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const memos = ref([]);
const loading = ref(true);

async function fetchMemos() {
  loading.value = true;
  const { data } = await axios.get('/api/memos');
  memos.value = data;
  loading.value = false;
}

async function deleteMemo(id) {
  if (!confirm('Delete this memo?')) return;
  await axios.delete(`/api/memos/${id}`);
  memos.value = memos.value.filter((m) => m.id !== id);
}

function formatDate(iso) {
  return new Date(iso).toLocaleString();
}

onMounted(fetchMemos);
</script>
