<template>
  <div class="min-h-screen bg-gray-50">
    <header class="bg-white shadow">
      <div class="max-w-3xl mx-auto px-4 py-4 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">
          <router-link to="/">📝 Memo App</router-link>
        </h1>
        <router-link
          to="/create"
          class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition"
        >
          + New Memo
        </router-link>
      </div>
    </header>
    <main class="max-w-3xl mx-auto px-4 py-8">
      <router-view />
    </main>
  </div>
</template>
