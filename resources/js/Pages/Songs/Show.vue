<template>
  <div class="bg-gray-100 min-h-screen py-6">
    <Head :title="song.name" />
    <div class="container mx-auto px-4">
      <!-- Заголовок -->
      <h1 class="mb-6 text-2xl font-extrabold text-indigo-600 text-center sm:text-3xl">
        <Link class="hover:text-indigo-800" href="/songs">Songs</Link>
        <span class="mx-2 text-gray-400">/</span>
        {{ song.name }}
      </h1>

      <!-- Основная информация -->
      <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h2 class="text-lg sm:text-2xl font-bold text-indigo-600 mb-6">Основная информация</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <!-- Категория -->
          <div class="flex flex-col">
            <span class="text-gray-600 font-semibold">Категория:</span>
            <span class="text-gray-800 bg-gray-50 rounded px-3 py-1 shadow-sm">
        {{ song.category }}
      </span>
          </div>

          <!-- Язык -->
          <div class="flex flex-col">
            <span class="text-gray-600 font-semibold">Язык:</span>
            <span class="text-gray-800 bg-gray-50 rounded px-3 py-1 shadow-sm">
        {{ song.language }}
      </span>
          </div>
        </div>

        <!-- Заметки -->
        <div class="mt-6">
          <span class="text-gray-600 font-semibold">Заметки:</span>
          <p class="text-gray-700 bg-gray-50 p-4 rounded-md shadow-sm mt-2">
            {{ song.note || 'Нет' }}
          </p>
        </div>

        <!-- Описание -->
        <div class="mt-6">
          <span class="text-gray-600 font-semibold">Описание:</span>
          <p class="text-gray-700 bg-gray-50 p-4 rounded-md shadow-sm mt-2">
            {{ song.description || 'Нет описания' }}
          </p>
        </div>
      </div>

      <!-- Блоки песни -->
      <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-4 sm:p-6 mt-6">
        <h2 class="text-lg sm:text-2xl font-semibold text-indigo-600 mb-4">Блоки песни</h2>
        <div v-if="song.blocks && song.blocks.length > 0" class="space-y-4">
          <div
            v-for="(block, index) in song.blocks"
            :key="index"
            class="p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-md shadow-sm"
          >
            <h3 class="text-md sm:text-lg font-semibold text-indigo-600 border-b pb-2 mb-2">
              {{ block.name }}
            </h3>
            <div class="prose max-w-none text-gray-700 mt-2" v-html="block.content"></div>
          </div>
        </div>
        <p v-else class="text-gray-500 text-center">Блоки отсутствуют.</p>
      </div>

      <!-- YouTube-плееры -->
      <div v-if="song.youtube_links && song.youtube_links.length > 0" class="max-w-5xl mx-auto bg-white rounded-lg shadow-md p-4 sm:p-6 mt-6">
        <h2 class="text-lg sm:text-2xl font-semibold text-indigo-600 mb-4">Видео</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
          <div
            v-for="(link, index) in song.youtube_links"
            :key="index"
            class="aspect-w-16 aspect-h-9 border border-gray-200 shadow-md rounded-md overflow-hidden"
          >
            <iframe
              v-if="youtubeEmbedUrl(link)"
              class="w-full h-full rounded-md"
              style="min-height: 200px;"
              :src="youtubeEmbedUrl(link)"
              title="YouTube Video Player"
              frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen
            ></iframe>
            <div
              v-else
              class="flex items-center justify-center text-red-500 text-center bg-gray-50 rounded-md shadow p-4"
            >
              Неверная ссылка: {{ link }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3'
import Layout from '@/Shared/Layout/DashboardLayout.vue'

export default {
  components: {
    Head,
    Link,
  },
  layout: Layout,
  props: {
    song: {
      type: Object,
      required: true,
    },
  },
  methods: {
    youtubeEmbedUrl(link) {
      const videoId = this.extractYouTubeId(link);
      return videoId ? `https://www.youtube.com/embed/${videoId}` : null;
    },
    extractYouTubeId(link) {
      const match = link.match(/(?:youtube\.com.*(?:\/|v=)|youtu\.be\/)([a-zA-Z0-9_-]+)/);
      return match ? match[1] : null;
    },
  },
};
</script>
