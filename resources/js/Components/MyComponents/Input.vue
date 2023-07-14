<script setup>
import { computed } from 'vue';
import InputError from '@/Components/InputError.vue';
defineProps({
    type: {
        type: String,
        required: true,
    },
    label: {
        type: String,
        required: true,
    },
    modelValue: {
        required: true,
    },
    error: {
        required:true,
    },
    options:{
        type: Array,
    },
    opt:{
        type: String,
    },
});
defineEmits(['update:modelValue']);

</script>

<template>
    <div v-if="type === 'select'" class="relative z-0 w-full mb-6 group">
        <label class="block font-medium text-sm text-gray-700">
            {{ label }}
        </label>
        <select
            class="border-gray-300 focus:border-blue-800 focus:ring-blue-800 rounded-md shadow-sm"
            :value="modelValue"
            @change="$emit('update:modelValue', $event.target.value)"
            ref="input">
            <option  value="" disabled>
                Seleccione...
            </option>
            <option v-for="op in options" :key="op.i" :value="op.id">
                <template v-if="opt === 'titulo'">
                    {{ op.titulo }}
                </template>
                <template v-if="opt === 'user.name'">
                    {{ op.user.name }}
                </template>
                <template v-else>
                    {{ op.name }}
                </template>
            </option>
        </select>
    </div>

    <div v-if="type === 'email'" class="relative z-0 w-full mb-6 group">
      <input type="email" name="floating_email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
         />
      <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
        {{label}}
        </label>
    </div>
    <div v-if="type === 'password'" class="relative z-0 w-full mb-6 group">
        <input :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            type="password" name="floating_password" id="floating_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="floating_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
            {{label}}
        </label>
    </div>
    <div v-if="type === 'text'" class="relative z-0 w-full mb-6 group">
        <input :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            type="text" name="floating_first_name" id="floating_first_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="floating_first_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
            {{label}}
        </label>
    </div>
    
    <div v-if="type === 'tel'" class="relative z-0 w-full mb-6 group">
        <input :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="floating_phone" id="floating_phone" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="floating_phone" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
            {{label}}</label>
    </div>
    <InputError :message="error" class="mt-2"></InputError>
</template>