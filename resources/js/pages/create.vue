<template>
    <div>
        <div class="flex justify-center mt-10">
            <p class="font-light uppercase">Cadastrar novo membro</p>
       </div>

        <div class="flex flex-col justify-center">
            <form
                @submit.prevent="storePlayers()"
                class="p-14 bg-white max-w-sm mx-auto rounded-xl shadow-xl overflow-hidden space-y-10 mt-10 relative">
                <div class="mb-4">
                    <label for="name" class="block text-sm text-gray-600 font-light">Nome</label>
                    <input v-model="form.name" type="text" id="name" name="name" class="w-full px-4 py-2 font-light rounded-lg focus:outline-none focus:ring-1 focus:ring-yellow-500 shadow" required>
                    <div v-show="errors.name">
                        <span class="fixed text-xs text-red-600"
                            v-for="error in errors.name"
                            :key="error.id">
                            {{ error }}
                        </span>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-sm text-gray-600 font-light">Valor</label>
                    <input v-model="form.price" type="text" id="price" name="price" class="w-full px-4 py-2 font-light rounded-lg focus:outline-none focus:ring-1 focus:ring-yellow-500 shadow" required>
                    <div v-show="errors.price">
                        <span class="fixed text-xs text-red-600"
                            v-for="error in errors.price"
                            :key="error.id">
                            {{ error }}
                        </span>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="type" class="block text-sm text-gray-600 font-light bg-white">Tipo</label>
                    <select v-model="form.type" id="type" name="type" class="font-light w-full px-5 py-2 rounded-lg focus:outline-none focus:ring-1 focus:ring-yellow-500 bg-white shadow" required>
                        <option value="avulso" class="font-light">Avulso</option>
                        <option value="mensal" class="font-light">Mensal</option>
                    </select>
                    <div v-show="errors.type">
                        <span class="fixed text-xs text-red-600"
                            v-for="error in errors.type"
                            :key="error.id">
                            {{ error }}
                        </span>
                    </div>
                </div>

                <div class="flex">
                    <button
                        :disabled="processing"
                        class="mt-4 text-white font-bold rounded-full text-xs px-2 py-1 bg-blue-700 hover:bg-blue-800 mr-2">
                        <span v-if="processing">Cadastrando...</span>
                        <span v-else>Cadastrar</span>
                    </button>
                    <router-link :to="{ name: 'index'}"  class="mt-4 text-white font-bold rounded-full text-xs px-2 py-1 bg-red-700 hover:bg-red-800 mr-2">
                        Voltar
                    </router-link>
                </div>
            </form>
        </div>
    </div>
</template>

<script>

import axios from 'axios'
import { reactive, ref } from 'vue'
import AlertSuccess from '../components/alert-success.vue'
import { useRouter } from 'vue-router'

export default {
    name: "CreateEmployee",
    components: { AlertSuccess },
    setup(){

        const months = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];

        const currentDate = new Date();
        const currentMonth = months[currentDate.getMonth()];

        const errors = ref('')
        const processing = ref(false)
        const router = useRouter()

        const form = reactive({
            name: '',
            price: '',
            type: '',
            month: currentMonth
        })

        const storePlayers = () => {

            processing.value = true;
            axios.post('http://localhost:8989/api/users', form)
                .then((response) => {
                    if (response.status === 201) {
                        router.push({name: 'index'})
                    }
                })
                .catch((error) => {
                    errors.value = error.response.data.errors
                    console.log(errors.value)
                })
                .finally(() => processing.value = false)
        }

        return { storePlayers, form, errors, processing }
    }
}

</script>
