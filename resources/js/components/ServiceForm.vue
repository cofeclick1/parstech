<template>
    <div>
      <FormKit
        type="form"
        :actions="true"
        submit-label="ذخیره اطلاعات"
        @submit="handleSubmit"
      >
        <FormKit
          v-for="field in fields"
          :key="field.name"
          v-bind="field"
        />
      </FormKit>
      <div v-if="success" class="alert alert-success mt-3">
        اطلاعات با موفقیت ذخیره شد!
      </div>
    </div>
  </template>

  <script setup>
  import { ref } from 'vue';

  // فیلدهای فرم از prop دریافت می‌شود
  const props = defineProps({
    fields: {
      type: Array,
      required: true
    }
  });

  const success = ref(false);

  function handleSubmit(values) {
    // اینجا می‌توانید اطلاعات را با ajax به بک‌اند بفرستید (نمونه ساده)
    fetch('/services/save-form', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
      },
      body: JSON.stringify(values)
    })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          success.value = true;
        }
      });
  }
  </script>
