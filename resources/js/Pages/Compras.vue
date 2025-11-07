<script setup>
import { ref } from 'vue';
import axios from 'axios';

const fornecedor = ref('');
const produtos = ref([{ id: '', quantidade: '', preco_unitario: '' }]);

const adicionarLinha = () => produtos.value.push({ id: '', quantidade: '', preco_unitario: '' });

const salvarCompra = async () => {
    await axios.post('/api/compras', {
        fornecedor: fornecedor.value,
        produtos: produtos.value,
    });
    alert('Compra registrada com sucesso!');
    fornecedor.value = '';
    produtos.value = [{ id: '', quantidade: '', preco_unitario: '' }];
};
</script>

<template>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Registrar Compra</h1>

        <div>
            <button @click="adicionarLinha" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">
            + Adicionar Produto
            </button>
            <button @click="salvarCompra" class="bg-green-500 text-white px-4 py-2 rounded" style="margin-bottom: 10px">
                Salvar Compra
            </button>
        </div>

        <input v-model="fornecedor" placeholder="Fornecedor" class="border p-2 mb-4 w-full" />

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

        <a href="/" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Voltar para Produtos
        </a>
    </div>
</template>
