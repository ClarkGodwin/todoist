<script lang="ts">
/*
 This component is the layout for all the forms throught the project
 */

export default {
    layout: GuestNavbar
}
</script>

<script setup lang="ts">
import { HttpMethod } from '@/types/httpMethod.js';
import GuestNavbar from './GuestNavbar.vue';
import Input from './Input.vue';
import { Form } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

//the custom built in ts interface type containing the name of the label/input and the type of the input
interface InputElement {
    id: number,
    type: string,
    name: string,
    label?: string,
    value?: string,
}

const props = defineProps<{
    title : string
    action : string
    method? : HttpMethod
    submitMessage? : string
    inputs : InputElement[]
    errors? : Record<string, string>
}>()

const httpMethod = props.method ? props.method : 'post'

</script>

<template>
    <Form :action="route(action)" :method="httpMethod" #default="{errors: formErrors}" class="bg-surface-300 h-fit rounded-2xl p-form-p mt-form-mt w-form mx-auto flex flex-col gap-7.5 text-form-content">
        <!-- page title -->
        <h2 class="text-frosted font-bold text-center text-form-h2">{{ title }}</h2>

        <!-- rendering the inputs -->
        <div v-for="input in inputs" :key="input.id" :class="{ hidden: input.type === 'hidden' }">
            <!-- composed of the label and input tag styled -->
            <Input :type="input.type" :name="input.name" :label="input.label" :value="input.value" :error="formErrors[input.name] || errors?.[input.name]" />
        </div>

        <!-- submission -->
        <button class="bg-frosted text-white font-bold rounded-xl p-form-button-p hover:cursor-pointer">{{ submitMessage ? submitMessage : 'Submit' }}</button>

        <!-- If there are any other information to display under the submission button like for the register and login page -->
        <div>
            <slot></slot>
        </div>
    </Form>
</template>
