<script setup>
import { computed,onMounted } from 'vue';
import InputError from '@/Components/InputError.vue';
import { ref } from 'vue';

const cl = ref("col-span-1");

const props = defineProps({
    modelValue: {required: true,},
    error: {required:true,},
    col: {typo: String,},
    data: {typo: Array,},
});

const emit = defineEmits(['update:modelValue']);
if (props.col === '2') {
    cl.value = "col-span-2";
}else if(props.col === '3'){
    cl.value = "col-span-2";
}else if(props.col === '4'){
    cl.value = "col-span-4";
}else if(props.col === '5'){
    cl.value = "col-span-5";
}else if(props.col === '6'){
    cl.value = "col-span-6";
}else if(props.col === '7'){
    cl.value = "col-span-7";
}else if(props.col === '8'){
    cl.value = "col-span-8";
}else if(props.col === '9'){
    cl.value = "col-span-9";
}else if(props.col === '10'){
    cl.value = "col-span-10";
}else if(props.col === '11'){
    cl.value = "col-span-11";
}else if(props.col === '12'){
    cl.value = "col-span-12";
}
const handleFileChange = (event) => {
    const selectedFile = event.target.files[0];     // Obtenemos el archivo seleccionado
    emit('update:modelValue', selectedFile);        // Emitimos el evento con el archivo seleccionado
};
</script>

<template>
    <div class="grid w-full mt-4 px-2 group" :class="cl">
        <div v-if="data.type === 'select'">
            <label class="text-sm text-gray-500 dark:text-gray-400 peer-focus:dark:text-blue-500">
            {{data.label}}
            </label>
            <select
                class="block px-4 pb-0 w-full h-9 text-[12px] text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                :value="modelValue"
                @change="$emit('update:modelValue', $event.target.value)"
                ref="input">
                <option  value="" disabled>-- Seleccione --</option>
                <option v-for="op in data.options" :key="op.i" :value="op.id" class="hover:bg-gray-500 mb-4">
                    <template>{{ op[data.optikey] }}</template>
                </option>
            </select>
        </div>
        <div v-else-if="data.type === 'email'" class="relative mt-4">
            <input type="email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required
                :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
                />
            <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                {{data.label}}
            </label>
        </div>
        <div v-else-if="data.type === 'password'" class="relative mt-4">
            <input :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
                type="password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                {{data.label}}
            </label>
        </div>
        <div v-else-if="data.type === 'text'" class="relative mt-4">
            <input :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
                type="text"  class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                {{data.label}}
            </label>
        </div>
        <div v-else-if="data.type === 'tel'" class="relative mt-4">
            <input :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
                type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" inputmode="numeric" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                {{data.label}}</label>
        </div>
        <div v-else-if="data.type === 'number'" class="relative mt-4">
            <input :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
                :min="1" :max="100" required
                type="number" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "/>
            <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                {{data.label}}</label>
        </div>
        <div v-else-if="data.type === 'file'" class="relative">
            <label class="peer-focus:font-medium text-sm text-gray-500 dark:text-gray-400 peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500">
                {{ data.label }}
            </label>
            <input
                type="file"
                class="block w-full p-3 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                accept="image/*"
                @change="handleFileChange"
            />
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">{{modelValue}}SVG, PNG, JPG or GIF (MAX. 800x400px).</p>
        </div>
        <div v-else-if="data.type === 'checkbox'" class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
            <input id="bordered-checkbox-1" type="checkbox" value="" name="bordered-checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="bordered-checkbox-1" class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Default radio</label>
        </div>
        <InputError :message="error" class="mt-2 text-xs text-red-600 dark:text-red-400"></InputError>
    </div>
</template>