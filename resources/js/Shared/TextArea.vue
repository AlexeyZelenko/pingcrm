<template>
  <div>
    <label :for="id" class="block text-sm font-medium text-gray-700">{{ label }}</label>
    <textarea
      :id="id"
      :name="name"
      :rows="rows"
      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
      :placeholder="placeholder"
      :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
    ></textarea>
  </div>
</template>

<script>
export default {
  name: 'TextArea',
  props: {
    modelValue: String, // Обрабатываемое значение
    label: String,
    name: String,
    id: String,
    rows: {
      type: Number,
      default: 3
    },
    placeholder: String
  },
  emits: ['update:modelValue'], // Добавляем emits для регистрации события обновления значения
}
</script>

<style scoped>
/* Добавьте стили, если необходимо */
</style>
