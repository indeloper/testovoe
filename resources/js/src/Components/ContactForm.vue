<script setup>

import TextInput from "../Components/Form/TextInput.vue";
import {ref} from "vue";
import DateInput from "../Components/Form/DateInput.vue";
import TextArea from "@/src/Components/Form/TextArea.vue";
import axios from "axios";


const form = ref({
    name: null,
    patronymic: null,
    surname: null,
    birthday: null,
    phone: null,
    email: null,
    comment: null
})

const message = ref(null);

const store = () => {
    axios.post('/api/lead/store', form.value)
        .then(r => {
            message.value = r.data.message
        })
        .catch(e => {
            console.log(e.response.data.message)
            message.value = 'Ошибка!'
        })
}
</script>

<template>
    <div class="justify-self-center w-1/2 rounded-lg p-12 bg-white">
        <div class="w-full p-4">
            {{ message }}
        </div>
        <div>
            <TextInput
                v-model="form.surname"
                label="Фамилия"
                type="text"
                placeholder="Фамилия"
                name="surname"
            />
        </div>
        <div class="mt-4 grid grid-cols-2 gap-4">
            <div>
                <TextInput
                    v-model="form.name"
                    label="Имя"
                    type="text"
                    placeholder="Имя"
                    name="name"
                />
            </div>
            <div>
                <TextInput
                    v-model="form.patronymic"
                    label="Отчество"
                    type="text"
                    placeholder="Отчество"
                    name="patronymic"
                />
            </div>
        </div>

        <div class="mt-4">
            <DateInput
                v-model="form.birthday"
                label="Дата рождения"
                placeholder="Дата рождения"
                name="birthday"
            />
        </div>

        <div class="grid grid-cols-2 gap-4 mt-4">
            <div>
                <TextInput
                    v-model="form.phone"
                    label="Телефон"
                    mask="+7(###) ### ## ##"
                    placeholder="Телефон"
                    name="phone"
                />
            </div>
            <div>
                <TextInput
                    v-model="form.email"
                    type="email"
                    label="Email"
                    placeholder="Email"
                    name="email"
                />
            </div>
        </div>

        <div class="mt-4">
            <TextArea
                v-model="form.comment"
                label="Комментарий"
                placeholder="Комментарий"
                name="comment"
            />
        </div>

        <button class="mt-4" @click="store">send</button>
    </div>
</template>

<style scoped>

</style>
