<script setup>
import { ref } from 'vue';
import axios from 'axios';

const cliente = ref('');
const produtos = ref([{ id: '', quantidade: '', preco_unitario: '' }]);

const adicionarLinha = () => produtos.value.push({ id: '', quantidade: '', preco_unitario: '' });

const registrarVenda = async () => {
    const response = await axios.post('/api/vendas', {
        cliente: cliente.value,
        produtos: produtos.value,
    });
    alert(`Venda concluída! Total: R$ ${response.data.total} | Lucro: R$ ${response.data.lucro}`);
    cliente.value = '';
    produtos.value = [{ id: '', quantidade: '', preco_unitario: '' }];
};
</script>

<template>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Registrar Venda</h1>

        <input v-model="cliente" placeholder="Cliente" class="border p-2 mb-4 w-full" />

        <table class="w-full border mb-4">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2">ID Produto</th>
                    <th class="p-2">Quantidade</th>
                    <th class="p-2">Preço Unitário</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(p, i) in produtos" :key="i" class="border-t">
                    <td class="p-2"><input v-model="p.id" class="border p-1 w-full" /></td>
                    <td class="p-2"><input v-model="p.quantidade" class="border p-1 w-full" /></td>
                    <td class="p-2"><input v-model="p.preco_unitario" class="border p-1 w-full" /></td>
                </tr>
            </tbody>
        </table>

        <button @click="adicionarLinha" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">
            + Adicionar Produto
        </button>
        <button @click="registrarVenda" class="bg-blue-500 text-white px-4 py-2 rounded">
            Registrar Venda
        </button>
    </div>
</template>
