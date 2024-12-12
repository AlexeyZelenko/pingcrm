<template>
  <div>
    <Head title="Про сайт пісень" />
    <h1 class="mb-8 text-3xl font-bold">Про сайт пісень.</h1>

    <!-- Блок 1: Привітання -->
    <section class="mb-10">
      <h2 class="text-2xl font-bold mb-4">Ласкаво просимо!</h2>
      <p class="text-gray-700">
        Ми раді вітати вас на нашому сайті, де ви можете знайти пісні різних жанрів, мов і категорій.
        Цей ресурс створений для тих, хто захоплюється музикою та хоче більше дізнатися про пісні.
      </p>
    </section>

    <!-- Блок 2: Основні функції -->
    <section class="mb-10 bg-gray-100 p-6 rounded-md shadow">
      <h2 class="text-2xl font-bold mb-4">Що пропонує наш сайт?</h2>
      <ul class="list-disc pl-6 text-gray-700">
        <li>Пошук пісень за назвою, мовою або категорією.</li>
        <li>Детальний опис кожної пісні.</li>
        <li>Зручний інтерфейс для перегляду інформації.</li>
      </ul>
    </section>

    <!-- Блок 3: Про майбутнє -->
    <section>
      <h2 class="text-2xl font-bold mb-4">Наші плани</h2>
      <p class="text-gray-700">
        Ми постійно працюємо над оновленням і розширенням нашої бази даних пісень, щоб забезпечити вас найкращим досвідом.
        У майбутньому ми плануємо додати можливість завантаження аудіо, перегляду відео та створення власних плейлистів.
      </p>
    </section>
  </div>
</template>

<script>
import { Head } from '@inertiajs/vue3'
import Layout from '@/Shared/Layout/DashboardLayout.vue'

export default {
  layout: Layout,
  components: {
    Head,
  },
}
</script>
