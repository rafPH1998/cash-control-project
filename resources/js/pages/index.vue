<template>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <div class="container mx-auto mt-10">
                        <h1 class="text-3xl uppercase 2xl flex justify-center">Listagem de jogadores do horário</h1>

                        <div v-if="processing" class="flex justify-center items-center mt-10 text-xs">
                            <img src="images/spinner.svg" alt="loader" class="w-14 h-14">
                            <p class="ml-1">Carregando jogadores...</p>
                        </div>
                        <div class="mt-20" v-else>
                            <div class="flex justify-between">
                                <router-link to="/" class="">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-8 h-8  stroke-blue-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </router-link>

                                <div class="p-3 px-5">
                                    <select class="bg-white rounded p-2 text-xs shadow font-light">
                                        <option class="text-black font-light" selected>Buscar dados por mês</option>
                                        <option class="text-black font-light">Janeiro</option>
                                        <option class="text-black font-light">Fevereiro</option>
                                        <option class="text-black font-light">Março</option>
                                        <option class="text-black font-light">Abril</option>
                                        <option class="text-black font-light">Maio</option>
                                        <option class="text-black font-light">Junho</option>
                                        <option class="text-black font-light">Julho</option>
                                        <option class="text-black font-light">Agosto</option>
                                        <option class="text-black font-light">Setembro</option>
                                        <option class="text-black font-light">Outubro</option>
                                        <option class="text-black font-light">Novembro</option>
                                        <option class="text-black font-light">Dezembro</option>
                                    </select>
                                </div>
                            </div>
                            <table
                                class="min-w-full shadow-lg mt-2">
                                <thead class="bg-white border-b">
                                    <tr>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">#</th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">NOME</th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">VALOR</th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">TIPO</th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">STATUS</th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">AÇÕES</th>
                                    </tr>
                                </thead>
                                <tbody v-for="user in users" :key="user.id">
                                    <tr class="bg-white transition duration-300 ease-in-out hover:bg-gray-100 rounded-md">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ user.id }}</td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{user.name}}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            40,00
                                        </td>
                                        <td class="text-xs text-green-600 font-light px-6 py-4 whitespace-nowrap">
                                            Mensalista
                                        </td>

                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                           <div class="flex">
                                                <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-emerald-500 border border-emerald-500">
                                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10 3L4.5 8.5L2 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>

                                                    <p class="text-xs font-normal">PAGO</p>
                                                </div>
                                           </div>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <div class="flex">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="stroke-blue-500 w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                </svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="stroke-red-500 w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="mt-4 text-white font-bold rounded-full text-xs px-2 py-1 bg-red-700 hover:bg-red-800 mr-2">
                                <span class="flex items-center">Fechar caixa
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                            </button>
                            <div class="border w-72 p-2 rounded bg-[#86efac] mt-4 text-xs">
                                <div class="flex">
                                    <p class="text-sm font-light">Sobra do mês de setembro:<b class="ml-2"> R$ 400,00</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import axios from 'axios'
import { ref, onMounted } from 'vue'

export default {
    name: "Index",
    setup(){
        const processing = ref(false)
        const users = ref('')

        onMounted(() => {
            processing.value = true
            axios.get('http://localhost:8989/api/users')
                .then((response) => {
                    users.value = response.data.data
                })
                .catch((error) => {
                    console.log(error)
                })
                .finally(() =>  {
                    processing.value = false
                })
        })

        return { processing, users }
    }
}
</script>
