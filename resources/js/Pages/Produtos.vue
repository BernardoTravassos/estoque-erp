<script setup>

import { ref, onMounted } from 'vue';
import axios from 'axios';

const produtos = ref([]);
const nome = ref('');
const preco_venda = ref('');
const estoque = ref('');

const carregarProdutos = async () => {
  const res = await axios.get('/api/produtos');
  produtos.value = res.data;
};

const cadastrar = async () => {
  if (!nome.value || !preco_venda.value || !estoque.value) {
    alert('Preencha todos os campos antes de salvar!');
    return;
  }

  await axios.post('/api/produtos', {
    nome: nome.value,
    preco_venda: preco_venda.value,
    estoque: estoque.value,
  });

  alert('Produto cadastrado com sucesso!');

  nome.value = '';
  preco_venda.value = '';
  estoque.value = '';

  carregarProdutos();
};

onMounted(carregarProdutos);
</script>

<template>
  <div class="p-4">
    <h1 class="text-xl font-bold mb-4">Cadastro de Produtos</h1>

    <div class="mb-4 space-x-2">
      <a href="/compras" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        Ir para Compras
      </a>
      <a href="/vendas" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Ir para Vendas
      </a>
      <a href="/historico" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800">
        Histórico de Compras e Vendas
      </a>
    </div>

    <div class="mb-4">
      <input v-model="nome" placeholder="Nome" class="border p-2 mr-2" />
      <input v-model="preco_venda" placeholder="Preço" type="number" class="border p-2 mr-2" />
      <input v-model="estoque" placeholder="Estoque inicial" type="number" class="border p-2 mr-2" />
      <button @click="cadastrar" class="bg-blue-600 text-white px-4 py-2 rounded">
        Salvar
      </button>
    </div>

    <table class="table-auto w-full border">
      <thead class="bg-gray-100">
        <tr>
          <th class="p-2 border">Nome</th>
          <th class="p-2 border">Custo Médio</th>
          <th class="p-2 border">Preço Venda</th>
          <th class="p-2 border">Estoque</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="p in produtos" :key="p.id">
          <td class="p-2 border">{{ p.nome }}</td>
          <td class="p-2 border">{{ p.custo_medio }}</td>
          <td class="p-2 border">{{ p.preco_venda }}</td>
          <td class="p-2 border">{{ p.estoque }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
