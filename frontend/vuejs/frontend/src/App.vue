<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <div class="min-h-screen bg-slate-100 dark:bg-slate-900 text-slate-800 dark:text-slate-200">
    <header class="dark:bg-slate-950 bg-slate-700 shadow">
      <nav class="max-w-7xl mx-auto flex items-center justify-between px-4 py-3">
        <div class="flex space-x-2">
        <RouterLink class="text-slate-200" to="/">Home</RouterLink>
        <RouterLink class="text-slate-200" to="/dashboard">Dashboard</RouterLink>
      </div>
        <div class="flex space-x-4">
          <RouterLink class="text-white hover:text-teal-300" to="/login">Login</RouterLink>
          <RouterLink class="text-white hover:text-teal-300" to="/register">Register</RouterLink>
        </div>
      </nav>
    </header>

    <main class="max-w-7xl mx-auto p-6">
      <RouterView />
    </main>
  </div>
</template>
