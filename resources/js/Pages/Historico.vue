<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Histórico de Compras e Vendas</h1>

    <div class="flex gap-4 mb-6">
      <button
        class="px-4 py-2 rounded bg-blue-500 text-white hover:bg-blue-600"
        @click="abaAtiva = 'compras'"
        :class="{ 'bg-blue-700': abaAtiva === 'compras' }"
      >
        Compras
      </button>
      <button
        class="px-4 py-2 rounded bg-green-500 text-white hover:bg-green-600"
        @click="abaAtiva = 'vendas'"
        :class="{ 'bg-green-700': abaAtiva === 'vendas' }"
      >
        Vendas
      </button>
    </div>

    <div v-if="abaAtiva === 'compras'">
      <h2 class="text-xl font-semibold mb-2">🛒 Compras Realizadas</h2>
      <table class="min-w-full border border-gray-300">
        <thead class="bg-gray-100">
          <tr>
            <th class="border p-2">ID</th>
            <th class="border p-2">Produto</th>
            <th class="border p-2">Quantidade</th>
            <th class="border p-2">Preço Unitário</th>
            <th class="border p-2">Total</th>
            <th class="border p-2">Data</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="compra in compras" :key="compra.id">
            <td class="border p-2 text-center">{{ compra.id }}</td>
            <td class="border p-2">{{ compra.produto }}</td>
            <td class="border p-2 text-center">{{ compra.quantidade }}</td>
            <td class="border p-2 text-right">R$ {{ compra.precoUnitario.toFixed(2) }}</td>
            <td class="border p-2 text-right">R$ {{ (compra.quantidade * compra.precoUnitario).toFixed(2) }}</td>
            <td class="border p-2 text-center">{{ compra.data }}</td>
          </tr>
          <tr v-if="!compras.length">
            <td colspan="6" class="p-3 text-center text-gray-500">Nenhuma compra registrada</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div v-else>
      <h2 class="text-xl font-semibold mb-2">💰 Vendas Realizadas</h2>
      <table class="min-w-full border border-gray-300">
        <thead class="bg-gray-100">
          <tr>
            <th class="border p-2">ID</th>
            <th class="border p-2">Produto</th>
            <th class="border p-2">Quantidade</th>
            <th class="border p-2">Preço Unitário</th>
            <th class="border p-2">Total</th>
            <th class="border p-2">Data</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="venda in vendas" :key="venda.id">
            <td class="border p-2 text-center">{{ venda.id }}</td>
            <td class="border p-2">{{ venda.produto }}</td>
            <td class="border p-2 text-center">{{ venda.quantidade }}</td>
            <td class="border p-2 text-right">R$ {{ venda.precoUnitario.toFixed(2) }}</td>
            <td class="border p-2 text-right">R$ {{ (venda.quantidade * venda.precoUnitario).toFixed(2) }}</td>
            <td class="border p-2 text-center">{{ venda.data }}</td>
          </tr>
          <tr v-if="!vendas.length">
            <td colspan="6" class="p-3 text-center text-gray-500">Nenhuma venda registrada</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const abaAtiva = ref('compras');
const compras = ref([]);
const vendas = ref([]);

const carregarHistorico = async () => {
  try {
    const res = await axios.get('/api/historico');
    compras.value = res.data.compras;
    vendas.value = res.data.vendas;
  } catch (e) {
    console.error('Erro ao carregar histórico:', e);
  }
};

onMounted(carregarHistorico);
</script>

<style scoped>
table {
  border-collapse: collapse;
  width: 100%;
}
th,
td {
  border: 1px solid #ccc;
  padding: 8px;
}
</style>
