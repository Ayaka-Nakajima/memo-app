<template>
  <div class="bg-white rounded shadow p-6">
    <h2 class="text-xl font-semibold mb-4 text-gray-800">
      {{ isEdit ? 'Edit Memo' : 'New Memo' }}
    </h2>

    <form @submit.prevent="submit" class="space-y-4">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
        <input
          v-model="form.title"
          type="text"
          required
          class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300"
          placeholder="Memo title"
        />
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Content</label>
        <textarea
          v-model="form.content"
          rows="6"
          class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300"
          placeholder="Write your memo here…"
        ></textarea>
      </div>

      <div v-if="errors.length" class="text-red-500 text-sm space-y-1">
        <p v-for="(e, i) in errors" :key="i">{{ e }}</p>
      </div>

      <div class="flex gap-3">
        <button
          type="submit"
          :disabled="saving"
          class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded transition disabled:opacity-50"
        >
          {{ saving ? 'Saving…' : 'Save' }}
        </button>
        <router-link to="/" class="text-gray-500 hover:text-gray-700 px-4 py-2">
          Cancel
        </router-link>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

const props = defineProps({ id: { type: String, default: null } });
const router = useRouter();

const isEdit = computed(() => !!props.id);
const form = ref({ title: '', content: '' });
const errors = ref([]);
const saving = ref(false);

onMounted(async () => {
  if (isEdit.value) {
    const { data } = await axios.get(`/api/memos/${props.id}`);
    form.value = { title: data.title, content: data.content ?? '' };
  }
});

async function submit() {
  errors.value = [];
  saving.value = true;
  try {
    if (isEdit.value) {
      await axios.put(`/api/memos/${props.id}`, form.value);
    } else {
      await axios.post('/api/memos', form.value);
    }
    router.push('/');
  } catch (err) {
    if (err.response?.data?.errors) {
      errors.value = Object.values(err.response.data.errors).flat();
    } else {
      errors.value = ['An error occurred. Please try again.'];
    }
  } finally {
    saving.value = false;
  }
}
</script>
