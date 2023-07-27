<script setup>
import { computed,onMounted } from 'vue';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    type: {
        type: String,
        required: true,
    },
    label: {
        type: String,
        required: true,
    },
    modelValue: {required: true,},
    error: {required:true,},
    options: {type: Array,},
    opt: {type: String,},
    col: {typo: String,},
});

const emit = defineEmits(['update:modelValue']);

const handleFileChange = (event) => {
    const selectedFile = event.target.files[0];     // Obtenemos el archivo seleccionado
    emit('update:modelValue', selectedFile);        // Emitimos el evento con el archivo seleccionado
};
</script>

<template>
    <div class="grid w-full mb-2 group ">
        <div v-if="type === 'select'">
            <label class="peer-focus:font-medium text-sm text-gray-500 dark:text-gray-400 peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
            {{label}}
            </label>
            <select
                class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer"
                :value="modelValue"
                @change="$emit('update:modelValue', $event.target.value)"
                ref="input">
                <option  value="" disabled>-- Seleccione --</option>
                <option v-for="op in options" :key="op.i" :value="op.id" class="hover:bg-gray-500">
                    <template>{{ op[opt] }}</template>
                </option>
            </select>
        </div>
        <div v-else-if="type === 'email'" class="relative">
            <input type="email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required
                :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
                />
            <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                {{label}}
            </label>
        </div>
        <div v-else-if="type === 'password'" class="relative">
            <input :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
                type="password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                {{label}}
            </label>
        </div>
        <div v-else-if="type === 'text'" class="relative">
            <input :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
                type="text"  class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                {{label}}
            </label>
        </div>
        <div v-else-if="type === 'tel'" class="relative">
            <input :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
                type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" inputmode="numeric" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                {{label}}</label>
        </div>
        <div v-else-if="type === 'number'" class="relative">
            <input :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
                :min="1" :max="100" required
                type="number" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "/>
            <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                {{label}}</label>
        </div>
        <div v-else-if="type === 'file'" class="relative">
            <label class="peer-focus:font-medium text-sm text-gray-500 dark:text-gray-400 peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500">
                {{ label }}
            </label>
            <input
                type="file"
                class="block w-full p-3 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                accept="image/*"
                @change="handleFileChange"
            />
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">{{modelValue}}SVG, PNG, JPG or GIF (MAX. 800x400px).</p>
        </div>
        <InputError :message="error" class="mt-2 text-xs text-red-600 dark:text-red-400"></InputError>
    </div>
</template>