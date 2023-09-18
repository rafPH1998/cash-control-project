<template>
    <div class="flex flex-col">

        <modal-delete
            :modal="modal"
            @closeModal="modal.show = false"
            @delete="deletePlayer(modal.userId)"
            @closeBox="closeBoxMonth()"
            :text="text"
        />

        <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-x-auto">
                    <div class="container mx-auto mt-10">
                        <h1 class="text-3xl uppercase 2xl flex justify-center">Listagem de jogadores do horário</h1>

                        <alert-success v-show="msgSuccess">Jogador deletado com sucesso!</alert-success>

                        <div v-if="processing" class="flex justify-center items-center mt-10 text-xs">
                            <img src="images/spinner.svg" alt="loader" class="w-14 h-14">
                            <p class="ml-1">Carregando dados...</p>
                        </div>
                        <div class="mt-20" v-else>
                            <div class="flex justify-between">
                                <router-link :to="{ name: 'create'}" class="">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-8 h-8  stroke-blue-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </router-link>

                                <div class="p-3 px-5">
                                    <p class="text-black font-light text-xs">Buscar dados por mês</p>
                                    <form @change="searchMonth()" action="#" method="GET">
                                        <select class="bg-white rounded p-2 text-xs shadow font-light w-52" v-model="search">
                                            <option value="Janeiro" class="text-black font-light">Janeiro</option>
                                            <option value="Fevereiro" class="text-black font-light">Fevereiro</option>
                                            <option value="Março" class="text-black font-light">Março</option>
                                            <option value="Abril" class="text-black font-light">Abril</option>
                                            <option value="Maio" class="text-black font-light">Maio</option>
                                            <option value="Junho" class="text-black font-light">Junho</option>
                                            <option value="Julho" class="text-black font-light">Julho</option>
                                            <option value="Agosto" class="text-black font-light">Agosto</option>
                                            <option value="Setembro" class="text-black font-light">Setembro</option>
                                            <option value="Outubro" class="text-black font-light">Outubro</option>
                                            <option value="Novembro" class="text-black font-light">Novembro</option>
                                            <option value="Dezembro" class="text-black font-light">Dezembro</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <p class="font-light flex justify-center">Mês atual: {{ currentMonthName }}</p>
                                <table class="min-w-full shadow-lg mt-2">
                                    <thead class="bg-white border-b">
                                        <tr>
                                            <th scope="col" class="text-sm font-medium text-gray-900 px-3 py-2 md:px-6 md:py-4 text-left">#</th>
                                            <th scope="col" class="text-sm font-medium text-gray-900 px-3 py-2 md:px-6 md:py-4 text-left">NOME</th>
                                            <th scope="col" class="text-sm font-medium text-gray-900 px-3 py-2 md:px-6 md:py-4 text-left">VALOR</th>
                                            <th scope="col" class="text-sm font-medium text-gray-900 px-3 py-2 md:px-6 md:py-4 text-left">TIPO</th>
                                            <th scope="col" class="text-sm font-medium text-gray-900 px-3 py-2 md:px-6 md:py-4 text-left">STATUS</th>
                                            <th scope="col" class="text-sm font-medium text-gray-900 px-3 py-2 md:px-6 md:py-4 text-left">AÇÕES</th>
                                        </tr>
                                    </thead>
                                    <tbody v-for="user in users" :key="user.id">
                                        <tr
                                            class="transition duration-300 ease-in-out rounded-md bg-white hover:bg-gray-100">
                                            <td class="px-3 py-2 md:px-6 md:py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ user.id }}</td>
                                            <td class="text-sm text-gray-900 font-light px-3 py-2 md:px-6 md:py-4 whitespace-nowrap">
                                                {{user.name}}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-3 py-2 md:px-6 md:py-4 whitespace-nowrap">
                                                R$ {{ user.price }},00
                                            </td>
                                            <td
                                                :class="{'text-green-600': user.type === 'mensal', 'text-yellow-600': user.type === 'avulso'}"
                                                class="text-xs font-light px-3 py-2 md:px-6 md:py-4 whitespace-nowrap"
                                                >
                                                {{ user.type === 'mensal' ? 'Mensalista' : 'Avulso' }}
                                            </td>

                                            <td class="text-sm text-gray-900 font-light px-3 py-2 md:px-6 md:py-4 whitespace-nowrap">
                                                <div class="flex">
                                                    <div
                                                        :class="[
                                                            user.status === 'pendente' ? 'stroke-yellow-500 text-yellow-500 border-yellow-500' : '',
                                                            user.status === 'pago' ? 'stroke-emerald-500 text-emerald-500 border-emerald-500' : '',
                                                        ]"
                                                        class="inline-flex items-center px-2 py-1 rounded-full gap-x-2 border">

                                                        <div v-if="user.status === 'pago'">
                                                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M10 3L4.5 8.5L2 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                        <div v-else-if="user.status === 'pendente'">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                                <path stroke-linecap="round"
                                                                stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                                            </svg>
                                                        </div>
                                                        <p class="text-xs font-normal">{{ user.status }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-3 py-2 md:px-6 md:py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <select
                                                        v-model="user.status"
                                                        :disabled="(statusBox || box) && user.status !== 'pendente'"
                                                        @change="updatedStatus(user.status, user.id)"
                                                        class="bg-white rounded p-2 text-xs shadow font-light">
                                                        <option value="pago" class="text-black font-light" :selected="user.status === 'pago'">Pago</option>
                                                        <option value="pendente" class="text-black font-light" :selected="user.status === 'pendente'">Não pago</option>
                                                    </select>

                                                    <svg @click.prevent="openModal(user.id)" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.5" stroke="currentColor"
                                                        class="stroke-red-500 w-5 h-5 cursor-pointer ml-2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="flex pb-20">
                                <div
                                    class="border w-full p-2 rounded bg-blue-200 mt-4 text-xs">
                                    <div class="flex flex-col">
                                        <div class="flex items-center justify-between">
                                            <p class="text-sm font-light">Total pagantes:</p>
                                            <b class="text-right">R$ {{totalPrice}},00</b>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <p class="text-sm font-light">Valor da quadra:</p>
                                            <b class="text-right">R$ 710,00</b>
                                        </div>
                                        <div class="flex items-center justify-between" v-show="statusBox || box">
                                            <p class="text-sm font-light">Sobra do mês de setembro:</p>
                                            <b class="mt-1 text-right">R$ {{surplus}},00</b>
                                        </div>
                                    </div>

                                    <div class="flex flex-row-reverse" v-if="totalPrice > 0">
                                        <button
                                            :disabled="statusBox || box && currentMonthName === search"
                                            @click="closeBox()"
                                            class="mt-8 text-white font-bold rounded-full text-xs px-2"
                                            :class="{ 'bg-green-500 hover:bg-green-600': !statusBox && !box || currentMonthName !== search, 'bg-gray-400 hover:bg-gray-500': statusBox || box}">
                                            <span class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <p v-if="statusBox || box && currentMonthName === search" class="ml-1">Caixa Fechado</p>
                                                <p v-else class="ml-1">Fechar Caixa</p>
                                            </span>
                                        </button>
                                    </div>

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
import { ref, onMounted, computed } from 'vue'
import ModalDelete from '../components/modal-delete.vue'
import alertSuccess from '../components/alert-success.vue'

export default {
    name: "Index",
    components: { ModalDelete, alertSuccess },
    setup() {
        const processing = ref(false)
        const users = ref('')
        const text = ref('')
        const boxClosed = ref('');
        const statusBox = ref('');
        const search = ref('');
        const msgSuccess = ref(false)
        const showItem = ref(false)

        const modal = ref({
            show: false,
            userId: null,
        });

        onMounted(() => {
            search.value = currentMonthName.value

            processing.value = true
            axios.get('http://localhost:8989/api/users')
                .then((response) => {
                    users.value = response.data.data
                    boxClosed.value = response.data.boxClosed
                    currentMonthName.value = response.data.currentMonthName
                })
                .catch((error) => {
                    console.log(error)
                })
                .finally(() =>  {
                    processing.value = false
                })
        })

        const openModal = (userId) => {
            modal.value.show = true;
            modal.value.userId = userId;
            text.value = 'delete'
        };

        const searchMonth = () => {
            processing.value = true
            axios.get(`http://localhost:8989/api/users?mes=${search.value}`)
                .then((response) => {
                    users.value = response.data.data
                    boxClosed.value = response.data.boxClosed
                    currentMonthName.value = response.data.currentMonthName
                })
                .catch((error) => {
                    console.log(error)
                })
                .finally(() =>  {
                    processing.value = false
                })
        }

        const deletePlayer = (id) => {
            axios.delete(`http://localhost:8989/api/user/${id}`)
                .then((response) => {
                    if (response.status === 204) {

                        msgSuccess.value = true;
                        setTimeout(() => {
                            msgSuccess.value = false;
                        }, 2000);

                        const index = users.value.findIndex(user => user.id === id);
                        if (index !== -1) {
                            users.value.splice(index, 1);
                        }
                    }
                })
                .catch((error) => {
                    console.log('caiu no erro');
                })
                .finally(() => {
                    modal.value.show = false;
                });
        }

        const closeBox = () => {
            modal.value.show = true;
            text.value = 'box'
        }

        const closeBoxMonth = () => {
            axios.post('http://localhost:8989/api/payment/', {
                total: totalPrice.value,
                month: currentMonthName.value,
                users: users.value,
            })
            .then((response) => {
                statusBox.value = response.data.data.closed
                console.log(statusBox.value)
            })
            .catch((error) => {
                console.log(error);
            })
            .finally(() => {
                modal.value.show = false;
            });
        }

        const updatedStatus = (status, id) => {

            axios.post(`http://localhost:8989/api/user/${id}`, {
                    status: status,
                    month: currentMonthName.value,
                })
                .then((response) => {
                   console.log(response)
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    processing.value = false;
                });
        }

        const box = computed(() => {
            const res = boxClosed.value;

            let hasMatchingItem = false;

            for (let i = 0; i < res.length; i++) {
                const item = res[i];
                if (item.month === currentMonthName.value && item.closed === 1) {
                    hasMatchingItem = true; // Define como true se uma correspondência for encontrada
                }
            }

            return hasMatchingItem;
        });

        const totalPrice = computed(() => {

            if (users.value && users.value.length > 0) {
                    const paidUsers = users.value.filter(user => user.status === "pago");
                    const total = paidUsers.reduce((accumulator, user) => {
                    return accumulator + user.price;
                }, 0);

                return total;
            }
            return 0;
        });

        const surplus = computed(() => {
            const calculatedSurplus = totalPrice.value - 710;
            return calculatedSurplus < 0 ? 0 : calculatedSurplus;
        });

        const currentMonthName = computed(() => {
            const months = [
                "Janeiro",
                "Fevereiro",
                "Março",
                "Abril",
                "Maio",
                "Junho",
                "Julho",
                "Agosto",
                "Setembro",
                "Outubro",
                "Novembro",
                "Dezembro",
            ];

            const currentDate = new Date();
            const currentMonth = months[currentDate.getMonth()];

            return currentMonth;
        });

        return {
            processing,
            users,
            modal,
            openModal,
            deletePlayer,
            closeBoxMonth,
            closeBox,
            updatedStatus,
            searchMonth,
            showItem,
            msgSuccess,
            totalPrice,
            surplus,
            currentMonthName,
            text,
            search,
            box,
            statusBox
        }
    }
}
</script>


