<script lang="ts">
/*
 This component is the layout for all the forms throught the project
 */

export default {
    layout: GuestNavbar
}
</script>

<script setup lang="ts">
import GuestNavbar from './GuestNavbar.vue';
import Input from './Input.vue';
import { Form } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

//the custom built in ts interface type containing the name of the label/input and the type of the input
interface InputElement {
    id: number,
    type: string,
    label: string,
    name: string,
}

defineProps<{
    title : string
    action : string
    inputs : InputElement[]
    errors? : Record<string, string>
}>()

</script>

<template>
    <Form :action="route(action)" method="post" #default="{errors: formErrors}" class="bg-surface-300 rounded-2xl p-form-p mt-form-mt w-form mx-auto flex flex-col gap-[30px] text-form-content">
        <!-- page title -->
        <h2 class="text-frosted font-bold text-center text-form-h2">{{ title }}</h2>

        <!-- rendering the inputs -->
        <div v-for="input in inputs" :key="input.id">
            <!-- composed of the label and input tag styled -->
            <Input :type="input.type" :name="input.name" :label="input.label" :error="formErrors[input.name] || errors?.[input.name]" />
        </div>

        <!-- submission -->
        <button class="bg-frosted text-white font-bold rounded-xl p-form-button-p hover:cursor-pointer">Submit</button>

        <!-- If there are any other information to display under the submission button like for the register and login page -->
        <div>
            <slot></slot>
        </div>
    </Form>
</template>
