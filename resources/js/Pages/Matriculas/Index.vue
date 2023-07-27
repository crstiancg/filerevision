<script setup>
import MyLayout from '@/Layouts/MyLayout.vue';
import { Head,useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue';
import Input from '@/Components/MyComponents/Input.vue';
import Button from '@/Components/MyComponents/Button.vue'

import Swal from 'sweetalert2';

const modal = ref(false);
const title = ref('');
const operation = ref(1);
const id = ref();

const curs = ref([]);

const props = defineProps({
    matriculas: {type:Object,},
    cursos_: {type:Object},
    tableColumns:{type:Object},
    form_:{type:Object},
});

const form = useForm({
    curso_id:'',
    user_id:'',
    cursos:[],
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

const openModal = (op,matricula)=>{
    modal.value = true;
    // nextTick( () => nameInput.value.focus());
    operation.value = op;
    if(op==1){
        title.value = 'Crear Matricula';
    }else{
        title.value = 'Editar Matricula';
        // generar un bucle     ***********************************
        id.value = matricula.id;
        form.curso_id = matricula.curso.id;
        form.user_id = matricula.user.id;
    }
};
const closeModal = ()=>{
    modal.value = false;
    curs.value = [];
    form.reset();
};
const save = () =>{
    if(operation.value == 1){
        // form.post(route('cursos.store'))
        // closeModal();
        form.post(route('matriculas.store'),{
            onSuccess: ()=>{ok('Matricula Creado')}
        });
    }else{
        form.put(route('matriculas.update',id.value),{
            onSuccess: ()=>{ok('Matricula Actualizado')}
        });
    }
};

const deleteCur = (id) =>{
    // form.delete(route('cursos.destroy',id));
    const alerta = Swal.mixin({
        buttonsStyling:true
    });
    alerta.fire({
        title: 'Esta seguro de eliminar ?',
        // iconHtml: '<i class="fas fa-question"></i>',
        icon: 'question',
        showCancelButton:true,
        confirmButtonText: '<i class="fa-solid fa-check"></i> Si, eliminar.',
        cancelButtonText: '<i class="fa-solid fa-ban"></i> Cancelar',
    }).then((result)=>{
        if(result.isConfirmed){
            form.delete(route('matriculas.destroy',id),{
                onSuccess: ()=>{ok('Curso eliminado')}
            });
        }
    });
}
</script>

<template>
    <Head title="Matriculas" />

    <MyLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Matriculas</h2>
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
                                        <Button @click="openModal(1)" type="blue">
                                            <i class="fa-solid fa-plus-circle"></i>
                                            Agregar
                                        </Button>
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
                                            ID Usuario
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Usuario
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
                                    <tr v-for="mat,i in matriculas" :key="mat.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <!-- <template v-if="$page.props.auth.user.id === tra.curso.user_id"> -->
                                            <td class="w-4 p-4">
                                                <div class="flex items-center">
                                                    <input id="checkbox-table-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="checkbox-table-1" class="sr-only">checkbox</label>
                                                </div>
                                            </td>
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ mat.id }}
                                            </th>
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ mat.user_id }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ mat.user.name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ mat.curso_id }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ mat.curso.name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex">
                                                    <Button @click="openModal(0,mat)" type="teal">
                                                        <i class="fa-solid fa-edit"></i>
                                                    </Button>
                                                    <Button @click="deleteCur(mat.id)" type="red">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </Button>
                                                </div>
                                            </td>
                                        <!-- </template> -->
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- modal  -->
                        <Modal :show="modal" @close="closeModal">
                            <h2 class="p-3 text-lg font.medium text-hray-900 bg-gray-800 text-white">{{ title }}</h2>
                            <div class="grid grid-cols-2">
                                <Input col="3" :data="form_.users" v-model="form.user_id" :error="form.errors.user_id"/>
                                <template v-if="operation === 1">
                                    <div v-for="cur,ind in cursos_" :key="cur.id" class="my-2 mx-4">
                                        <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                                            <input v-model="curs[ind]" @change="curs[ind] ? form.cursos[ind]=cur.id : form.cursos[ind]=null;" id="bordered-checkbox-1" type="checkbox" value="" name="bordered-checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600">
                                            <label for="bordered-checkbox-1" class="w-full py-4 ml-2 text-sm font-medium text-gray-900">
                                                {{ cur.name }}</label>
                                        </div>
                                    </div>
                                </template>
                                <Input v-else col="3" :data="form_.cursos" v-model="form.curso_id" :error="form.errors.curso_id"/>
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
