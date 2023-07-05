<script setup>
import MyLayout from '@/Layouts/MyLayout.vue';
import { Head,useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import MySelectInput from '@/Components/MyComponents/MySelectInput.vue'

// import Swal from 'sweetalert2';
// import Swal from 'sweetalert2/dist/sweetalert2.js'

const modal = ref(false);
const title = ref('');
const operation = ref(1);
const id = ref();

const props = defineProps({
    cursos: {
        type:Object,
    },
    carreras:{type:Object},
});

const form = useForm({
    nombre:'',
    descripcion:'',
    estado:'',
    carrera_id:1
});
// const ok = (msj)=>{
//     form.reset();
//     closeModal();
//     Swal.fire({title:msj,icon:'success'});
// }

const openModal = (op,curso)=>{
    modal.value = true;
    // nextTick( () => nameInput.value.focus());
    operation.value = op;
    if(op==1){
        title.value = 'Crear Curso';
    }else{
        title.value = 'Editar Curso';
        id.value = curso.id;
        form.nombre = curso.nombre;
        form.descripcion = curso.descripcion;
        form.estado = curso.estado;
        form.carrera_id = curso.carrera.id;
    }
};
const closeModal = ()=>{
    modal.value = false;
    form.reset();
};
const save = () =>{
    if(operation.value == 1){
        form.post(route('cursos.store'))
        closeModal();
        // form.post(route('cursos.store'),{
        //     onSuccess: ()=>{ok('Curso Creado')}
        // });
    }else{
        form.put(route('cursos.update',id.value));
        // const alerta = Swal.mixin({
        //     buttonsStyling:true
        // });
        // alerta.fire({
        //     title: '¿Esta seguro de editar el campo?',
        //     iconHtml: '<i class="fas fa-question"></i>',
        //     showCancelButton:true,
        //     confirmButtonText: '<i class="fa-solid fa-check"></i> Si, Editar.',
        //     cancelButtonText: '<i class="fa-solid fa-ban"></i> Cancelar',
        // }).then((result)=>{
        //     if(result.isConfirmed){
        //         // console.log(id.value);
        //         form.put(route('employees.update',id.value),{
        //             onSuccess: ()=>{ok('Empleado Actualizado')}
        //         });
        //     }
        // });
        closeModal();
    }
};

const deleteCur = (id,name) =>{
    form.delete(route('cursos.destroy',id));
    // const alerta = Swal.mixin({
    //     buttonsStyling:true
    // });
    // alerta.fire({
    //     title: 'Esta seguro de eliminar '+name+' ?',
    //     iconHtml: '<i class="fas fa-question"></i>',
    //     showCancelButton:true,
    //     confirmButtonText: '<i class="fa-solid fa-check"></i> Si, eliminar.',
    //     cancelButtonText: '<i class="fa-solid fa-ban"></i> Cancelar',
    // }).then((result)=>{
    //     if(result.isConfirmed){
    //         form.delete(route('employees.destroy',id),{
    //             onSuccess: ()=>{ok('Empleado eliminado')}
    //         });
    //     }
    // });
}
</script>

<template>
    <Head title="Cursos" />

    <MyLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cursos</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="py-4">
                        <div class="bg-white grid v-screen place-items-center">
                            <div class="mt-3 mb-3 flex">
                                <button @click="openModal(1)" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    <i class="fa-solid fa-plus-circle"></i>
                                    Agregar
                                </button>
                            </div>
                        </div>
                        <div class="bg-white grid v-screen place-items-center">
                            <table class="table-auto border border-gray-400">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="px-2 py-4">#</th>
                                        <th class="px-2 py-4">Nombres</th>
                                        <th class="px-2 py-4">Estado</th>
                                        <th class="px-2 py-4">Descripción</th>
                                        <th class="px-2 py-4">Docente</th>
                                        <th class="px-2 py-4">Carrera</th>
                                        <th class="px-2 py-4"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="cur,i in cursos" :key="cur.id">
                                        <th class="border border-gray-400 px-2 py-2"> {{ i+1 }}</th>
                                        <th class="border border-gray-400 px-2 py-2"> {{ cur.nombre }} </th>
                                        <th class="border border-gray-400 px-2 py-2"> {{ cur.estado }} </th>
                                        <th class="border border-gray-400 px-2 py-2"> {{ cur.descripcion }} </th>
                                        <th class="border border-gray-400 px-2 py-2"> {{ cur.user.name }} </th>
                                        <th class="border border-gray-400 px-2 py-2"> {{ cur.carrera.nombre }} </th>
                                        <th class="border border-gray-400 px-2 py-2 flex"> 
                                            <button @click="openModal(0,cur)" type="button" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">
                                                <i class="fa-solid fa-edit"></i>
                                            </button>
                                            <!-- <DangerButton @click="$event => deleteEmployee(emp.id,emp.name)">
                                                <i class="bg-yellow-800 fa-solid fa-trash "></i>
                                            </DangerButton> -->
                                            <button @click="deleteCur(cur.id,cur.nombre)" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <Modal :show="modal" @close="closeModal">
                            <h2 class="p-3 text-lg font.medium text-hray-900">{{ title }}</h2>
                            <div class="p-3 mt-2">
                                <InputLabel for="name" value="Nombre: "></InputLabel>
                                <TextInput id="name" ref="nameInput" 
                                v-model="form.nombre" type="text" class="mt-1 block w-3/4"
                                placeholder="Name"></TextInput>
                                <InputError :message="form.errors.nombre" class="mt-2"></InputError>
                            </div>
                            <div class="p-3 mt-2">
                                <InputLabel for="est" value="Estado: "></InputLabel>
                                <TextInput id="est"
                                v-model="form.estado" type="text" class="mt-1 block w-3/4"
                                placeholder="Estado"></TextInput>
                                <InputError :message="form.errors.estado" class="mt-2"></InputError>
                            </div>
                            <div class="p-3 mt-2">
                                <InputLabel for="des" value="Decripción: "></InputLabel>
                                <TextInput id="des"
                                v-model="form.descripcion" type="text" class="mt-1 block w-3/4"
                                placeholder="Descripción"></TextInput>
                                <InputError :message="form.errors.descripcion" class="mt-2"></InputError>
                            </div>
                            
                            <div class="p-3">
                                <InputLabel for="carre" value="Carreras:"></InputLabel>
                                <MySelectInput id="carre" 
                                v-model="form.carrera_id" :options="carreras" class="mt-1 block w-3/4"
                                placeholder="Telefono"></MySelectInput>
                                <InputError :message="form.errors.carrera_id" class="mt-2"></InputError>
                            </div>
                            <div class="flex justify-center">
                                <div class="m-6">
                                    <button :disabled="form.processing" @click="save" type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                        <i class="fa-solid fa-save"></i>Guardar
                                    </button>
                                </div>
                                <div class="m-6">
                                    <button :disabled="form.processing" @click="closeModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                        <i class="fa-solid fa-ban"></i>Salir
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
