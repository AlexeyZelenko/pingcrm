<template>
  <div>
    <Head :title="form.name" />
    <h1 class="mb-8 text-2xl font-bold text-gray-800">{{ form.name || 'Edit Song' }}</h1>

    <div class="bg-white rounded-md shadow p-6">
      <form @submit.prevent="update">
        <!-- Основная информация -->
        <div class="space-y-4 border-b pb-4">
          <text-input v-model="form.name" :error="form.errors.name" label="Name" />
          <select-input v-model="form.category" :error="form.errors.category" label="Category">
            <option value="Worship">Worship</option>
            <option value="Praise">Praise</option>
            <option value="Other">Other</option>
          </select-input>
          <select-input v-model="form.language" :error="form.errors.language" label="Language">
            <option value="UA">Ukrainian</option>
            <option value="RU">Russian</option>
            <option value="EN">English</option>
          </select-input>
          <text-area v-model="form.note" :error="form.errors.note" label="Note" />
          <text-area v-model="form.description" :error="form.errors.description" label="Description" />
        </div>

        <!-- YouTube ссылки -->
        <div class="space-y-4 border-b pb-4 pt-4">
          <h2 class="text-lg font-semibold text-gray-700">YouTube Links</h2>
          <div v-for="(link, index) in form.youtube_links" :key="index" class="flex items-center space-x-4">
            <text-input v-model="form.youtube_links[index]" class="flex-1" placeholder="YouTube Link" />
            <button
              type="button"
              @click="removeYouTubeLink(index)"
              class="text-red-600 hover:text-red-800"
            >
              Remove
            </button>
          </div>
          <button
            type="button"
            @click="addYouTubeLink"
            class="text-indigo-600 hover:text-indigo-800"
          >
            Add Link
          </button>
        </div>

        <!-- Блоки -->
        <div class="space-y-4 pt-4">
          <h2 class="text-lg font-semibold text-gray-700">Blocks</h2>
          <div v-for="(block, index) in form.blocks" :key="index" class="p-4 border rounded">
            <text-input v-model="block.name" placeholder="Block Name" />
            <text-area v-model="block.content" placeholder="Block Content" />
            <button
              type="button"
              @click="removeBlock(index)"
              class="text-red-600 hover:text-red-800"
            >
              Remove Block
            </button>
          </div>
          <button
            type="button"
            @click="addBlock"
            class="text-indigo-600 hover:text-indigo-800"
          >
            Add Block
          </button>
        </div>

        <!-- Действия -->
        <div class="flex justify-end mt-6">
          <button
            type="button"
            @click="destroy"
            class="text-red-600 hover:underline mr-4"
            v-if="!song.deleted_at"
          >
            Delete
          </button>
          <loading-button :loading="form.processing" class="btn-indigo">
            Save
          </loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3'
import Layout from '@/Shared/Layout/DashboardLayout.vue'
import TextInput from '@/Shared/TextInput.vue'
import SelectInput from '@/Shared/SelectInput.vue'
import LoadingButton from '@/Shared/LoadingButton.vue'
import TrashedMessage from '@/Shared/TrashedMessage.vue'
import TextArea from '@/Shared/TextArea.vue'

export default {
  components: {
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
    TrashedMessage,
    TextArea,
  },
  layout: Layout,
  props: {
    song: {
      type: Object,
      required: true,
      default: () => ({}),
    }
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        name: this.song.name,
        category: this.song.category,
        language: this.song.language,
        youtube_links: [...(this.song.youtube_links || [])], // Инициализация ссылок
        note: this.song.note,
        description: this.song.description,
        blocks: this.song.blocks || [], // Инициализация блоков
      }),
    }
  },
  methods: {
    update() {
      this.form.put(`/songs/${this.song.id}`);
    },
    destroy() {
      if (confirm('Are you sure you want to delete this song?')) {
        this.$inertia.delete(`/songs/${this.song.id}`);
      }
    },
    restore() {
      if (confirm('Are you sure you want to restore this song?')) {
        this.$inertia.put(`/songs/${this.song.id}/restore`);
      }
    },
    addBlock() {
      this.form.blocks.push({ name: '', content: '' });
    },
    removeBlock(index) {
      this.form.blocks.splice(index, 1);
    },
    addYouTubeLink() {
      this.form.youtube_links.push(''); // Добавить пустую ссылку
    },
    removeYouTubeLink(index) {
      this.form.youtube_links.splice(index, 1); // Удалить ссылку
    },
  },
}
</script>
