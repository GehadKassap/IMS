<script setup>
import RoleCards from '@/views/apps/roles/RoleCards.vue'
import { usePage, Head } from '@inertiajs/vue3'

const props = defineProps({
  data: Object,
  all_permissions : Array
});
</script>

<template>
  <Head title="Roles" /> 
  <VRow>
    <VCol cols="12">
      <h4 class="text-h4 mb-1">
        Roles List
      </h4>
      
    </VCol>

    <!-- 👉 Roles Cards -->
    <VCol cols="12">
      <RoleCards :roles="data.data" :permissionsList="all_permissions" />
    </VCol>

  </VRow>
</template>
