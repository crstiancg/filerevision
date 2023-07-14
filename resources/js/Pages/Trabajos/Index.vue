<script setup>
import MyLayout from '@/Layouts/MyLayout.vue';
import { Head,useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue';
import Input from '@/Components/MyComponents/Input.vue';

import Swal from 'sweetalert2';

const modal = ref(false);
const title = ref('');
const operation = ref(1);
const id = ref();

const props = defineProps({
    trabajos: {
        type:Object,
    },
    cursos:{type:Object},
});

const form = useForm({
    titulo:'',
    descripcion:'',
    curso_id:''
});

const ok = (msj)=>{
    form.reset();
    closeModal();
    Swal.fire({
        title:msj,icon:'success',
        timer: 500, // Duración del mensaje en milisegundos (3 segundos)
        timerProgressBar: true, // Muestra una barra de progreso durante la duración del mensaje
        showConfirmButton: false // No muestra el botón de confirmación
    });
}

const openModal = (op,trabajo)=>{
    modal.value = true;
    // nextTick( () => nameInput.value.focus());
    operation.value = op;
    if(op==1){
        title.value = 'Crear Trabajo';
    }else{
        title.value = 'Editar Trabajo';
        // generar un bucle     ***********************************
        id.value = trabajo.id;
        form.titulo = trabajo.titulo;
        form.descripcion = trabajo.descripcion;
        form.curso_id = trabajo.curso.id;
    }
};
const closeModal = ()=>{
    modal.value = false;
    form.reset();
};
const save = () =>{
    if(operation.value == 1){
        // form.post(route('cursos.store'))
        // closeModal();
        form.post(route('trabajos.store'),{
            onSuccess: ()=>{ok('Trabajo Creado')}
        });
    }else{
        form.put(route('trabajos.update',id.value),{
            onSuccess: ()=>{ok('Trabajo Actualizado')}
        });
        closeModal();
    }
};

const deleteCur = (id,name) =>{
    // form.delete(route('cursos.destroy',id));
    const alerta = Swal.mixin({
        buttonsStyling:true
    });
    alerta.fire({
        title: 'Esta seguro de eliminar '+name+' ?',
        // iconHtml: '<i class="fas fa-question"></i>',
        icon: 'question',
        showCancelButton:true,
        confirmButtonText: '<i class="fa-solid fa-check"></i> Si, eliminar.',
        cancelButtonText: '<i class="fa-solid fa-ban"></i> Cancelar',
    }).then((result)=>{
        if(result.isConfirmed){
            form.delete(route('trabajos.destroy',id),{
                onSuccess: ()=>{ok('Curso eliminado')}
            });
        }
    });
}
</script>

<template>
    <Head title="Trabajos" />

    <MyLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Trabajos</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="py-2">
                        <!-- tabla de datos -->
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <!-- accione de tabla -->
                            <div class="flex items-center justify-between p-4 bg-white dark:bg-gray-900">
                                <div class="flex">
                                    <div>
                                        <button @click="openModal(1)" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                            <i class="fa-solid fa-plus-circle"></i>
                                            Agregar
                                        </button>
                                    </div>
                                </div>
                                <label for="table-search" class="sr-only">Search</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                    </div>
                                    <input type="text" id="table-search-users" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for users">
                                </div>
                            </div>
                            
                            <!-- tabla -->
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="p-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-all" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="checkbox-all" class="sr-only">checkbox</label>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            id
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Titulo
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Descripción
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            ID Curso
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Curso
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="tra,i in trabajos" :key="tra.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <template v-if="$page.props.auth.user.id === tra.curso.user_id">
                                            <td class="w-4 p-4">
                                                <div class="flex items-center">
                                                    <input id="checkbox-table-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="checkbox-table-1" class="sr-only">checkbox</label>
                                                </div>
                                            </td>
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ tra.id }}
                                            </th>
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ tra.titulo }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ tra.descripcion }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ tra.curso_id }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ tra.curso.name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex">
                                                    <button @click="openModal(0,tra)" type="button" class="focus:outline-none mr-1 text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm py-2 px-3 dark:focus:ring-yellow-900">
                                                        <i class="fa-solid fa-edit"></i>
                                                    </button>
                                                    <button @click="deleteCur(tra.id,tra.titulo)" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm py-2 px-3 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </template>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- modal  -->
                        <Modal :show="modal" @close="closeModal">
                            <h2 class="p-3 text-lg font.medium text-hray-900 bg-gray-800 text-white">{{ title }}</h2>
                            <div class="grid justify-center">
                                <div class="p-3 mt-2">
                                    <Input label="Titulo" type="text" v-model="form.titulo" :error="form.errors.titulo"></Input>
                                </div>
                                <div class="p-3 mt-2">
                                    <Input label="Descripción" type="text" v-model="form.descripcion" :error="form.errors.descripcion"></Input>
                                </div>
                                <div class="p-3">
                                    <Input label="Cursos:" type="select" v-model="form.curso_id" :options="cursos" :error="form.errors.curso_id"/>
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <div class="m-6">
                                    <button :disabled="form.processing" @click="save" type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                        <i class="fa-solid fa-save"></i> Guardar
                                    </button>
                                </div>
                                <div class="m-6">
                                    <button :disabled="form.processing" @click="closeModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                        <i class="fa-solid fa-ban"></i> Salir
                                    </button>
                                </div>
                            </div>
                        </Modal>
                    </div>
                </div>
            </div>
        </div>
    </MyLayout>
</template>
