<template>
  <div>
    <DataTable :data="trabajos" :columns="tableColumns" />
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
import DataTable from '@/Components/DataTable.vue';

const { trabajos, tableColumns } = defineProps(['trabajos', 'tableColumns']);
</script>

