<template>
  <div>
    <DataTable
      :data="trabajos"
      :columns="tableColumns"
      @edit="editRow"
      @delete="deleteRow"
    />
  </div>
</template>

<script setup>
import { defineProps } from "vue";
import { useForm } from '@inertiajs/vue3';

const form = useForm({});

import DataTable from "@/Components/DataTable.vue";
const { trabajos, tableColumns } = defineProps(["trabajos", "tableColumns"]);
console.log(trabajos);

const editRow = (row) => {
  console.log("Edit row:", row);
};

const deleteRow = (rowId) => {
console.log("Delete row with ID:", rowId);
  form.delete(route("trabajos.destroy", rowId), {
    onSuccess: () => {
      ok("Curso eliminado");
    },
  });

};
</script>

