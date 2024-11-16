<template>
  <div>
    <Head title="Create Song" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/songs">Songs</Link>
      <span class="text-indigo-400 font-medium">/</span> Create
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="store">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2" label="Song Name" />
          <select-input v-model="form.category" :error="form.errors.category" class="pb-8 pr-6 w-full lg:w-1/2" label="Category">
            <option :value="null" />
            <option value="Worship">Worship</option>
            <option value="Praise">Praise</option>
            <option value="Other">Other</option>
          </select-input>
          <select-input v-model="form.language" :error="form.errors.language" class="pb-8 pr-6 w-full lg:w-1/2" label="Language">
            <option :value="null" />
            <option value="UA">Ukrainian</option>
            <option value="RU">Russian</option>
            <option value="EN">English</option>
          </select-input>

          <!-- Массив YouTube-ссылок -->
          <div class="w-full lg:w-full mb-6">
            <h2 class="text-lg font-bold mb-4">YouTube Links</h2>
            <div v-for="(link, index) in form.youtube_links" :key="index" class="mb-4 flex items-center">
              <text-input
                v-model="form.youtube_links[index]"
                class="flex-1 mr-4"
                label="YouTube Link"
                :error="form.errors[`youtube_links.${index}`]"
              />
              <button
                type="button"
                @click="removeYouTubeLink(index)"
                class="text-red-500 hover:text-red-700"
              >
                Удалить
              </button>
            </div>
            <button
              type="button"
              @click="addYouTubeLink"
              class="btn-indigo"
            >
              Добавить ссылку
            </button>
          </div>

          <text-area v-model="form.note" :error="form.errors.note" class="pb-8 pr-6 w-full lg:w-full" label="Note" />
          <text-area v-model="form.description" :error="form.errors.description" class="pb-8 pr-6 w-full lg:w-full" label="Description" />
        </div>

        <!-- Блоки JSON -->
        <div class="p-8">
          <h2 class="text-lg font-bold mb-4">Блоки</h2>
          <div v-for="(block, index) in form.blocks" :key="index" class="mb-4 p-4 border rounded bg-gray-50">
            <text-input v-model="block.name" class="mb-2" label="Название блока" />
            <text-area v-model="block.content" class="mb-2" label="Содержимое блока" />
            <button
              type="button"
              @click="removeBlock(index)"
              class="text-red-500 hover:text-red-700"
            >
              Удалить блок
            </button>
          </div>
          <button
            type="button"
            @click="addBlock"
            class="btn-indigo"
          >
            Добавить блок
          </button>
        </div>

        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Create Song</loading-button>
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
import TextArea from '@/Shared/TextArea.vue'

export default {
  components: {
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
    TextArea,
  },
  layout: Layout,
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        name: null,
        category: null,
        language: null,
        youtube_links: [], // Инициализация как массив
        note: null,
        description: null,
        blocks: [],
      }),
    }
  },
  methods: {
    store() {
      console.log('Отправляемые данные:', this.form)
      this.form.post('/songs')
    },
    addYouTubeLink() {
      this.form.youtube_links.push('') // Добавление новой пустой ссылки
    },
    removeYouTubeLink(index) {
      this.form.youtube_links.splice(index, 1) // Удаление ссылки по индексу
    },
    addBlock() {
      this.form.blocks.push({ name: '', content: '' }) // Добавление нового блока
    },
    removeBlock(index) {
      this.form.blocks.splice(index, 1) // Удаление блока по индексу
    },
  },
}
</script>

