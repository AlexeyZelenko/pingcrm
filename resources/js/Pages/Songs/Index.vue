<template>
  <div>
    <Head title="Songs" />
    <h1 class="mb-8 text-3xl font-bold">Songs</h1>
    <div class="flex items-center justify-between mb-6">
      <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset">
        <label class="block text-gray-700">Trashed:</label>
        <select v-model="form.trashed" class="form-select mt-1 w-full">
          <option :value="null" />
          <option value="with">With Trashed</option>
          <option value="only">Only Trashed</option>
        </select>
      </search-filter>
      <Link class="btn-indigo" href="/songs/create">
        <span>Create</span>
        <span class="hidden md:inline">&nbsp;Song</span>
      </Link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <thead>
        <tr class="text-left font-bold">
          <th class="pb-4 pt-6 px-6">Name</th>
          <th class="pb-4 pt-6 px-6 text-center">Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="song in songs.data" :key="song.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <!-- Display only the title -->
          <td class="border-t">
            <Link
              class="flex items-center px-6 py-4 focus:text-indigo-500"
              :href="`/songs/${song.id}/show`"
            >
              {{ song.name }}
              <icon v-if="song.deleted_at" name="trash" class="shrink-0 ml-2 w-3 h-3 fill-gray-400" />
            </Link>
          </td>
          <!-- Action buttons with icons -->
          <td class="border-t text-center">
            <div class="flex justify-center items-center space-x-4">
              <Link
                class="text-indigo-500 hover:text-indigo-700"
                :href="`/songs/${song.id}/edit`"
                title="Edit Song"
              >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
              </Link>
              <button
                @click="deleteSong(song.id)"
                class="text-red-500 hover:text-red-700"
                title="Delete Song"
              >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
          </td>
        </tr>
        <tr v-if="songs.data.length === 0">
          <td class="px-6 py-4 border-t text-center" colspan="2">No songs found.</td>
        </tr>
        </tbody>
      </table>
    </div>
    <pagination class="mt-6" :links="songs.links" />
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3'
import Icon from '@/Shared/Icon.vue'
import pickBy from 'lodash/pickBy'
import Layout from '@/Shared/Layout/DashboardLayout.vue'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination.vue'
import SearchFilter from '@/Shared/SearchFilter.vue'

export default {
  components: {
    Head,
    Icon,
    Link,
    Pagination,
    SearchFilter,
  },
  layout: Layout,
  props: {
    filters: Object,
    songs: Object,
  },
  data() {
    return {
      form: {
        search: this.filters.search,
        trashed: this.filters.trashed,
      },
    }
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get('/songs', pickBy(this.form), { preserveState: true })
      }, 150),
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
    deleteSong(id) {
      if (confirm('Are you sure you want to delete this song?')) {
        this.$inertia.delete(`/songs/${id}`)
      }
    },
  },
}
</script>
