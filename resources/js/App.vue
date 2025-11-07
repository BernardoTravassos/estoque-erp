<template>
  <div class="container">
    <h1>ERP de Estoque</h1>

    <!-- 🔹 Barra de navegação simples -->
    <div class="menu">
      <button @click="pagina = 'produtos'" :class="{ ativo: pagina === 'produtos' }">Produtos</button>
      <button @click="pagina = 'compras'" :class="{ ativo: pagina === 'compras' }">Compras</button>
      <button @click="pagina = 'vendas'" :class="{ ativo: pagina === 'vendas' }">Vendas</button>
      <button @click="pagina = 'historico'" :class="{ ativo: pagina === 'historico' }">Histórico</button>
    </div>

    <!-- 🔹 Conteúdo dinâmico -->
    <div v-if="pagina === 'produtos'"><Produtos /></div>
    <div v-if="pagina === 'compras'"><Compras /></div>
    <div v-if="pagina === 'vendas'"><Vendas /></div>
    <div v-if="pagina === 'historico'"><Historico /></div>
  </div>
</template>

<script>
import Produtos from './Components/Produtos.vue'
import Compras from './Components/Compras.vue'
import Vendas from './Components/Vendas.vue'
import Historico from './Components/Historico.vue'

export default {
  name: 'App',
  components: { Produtos, Compras, Vendas, Historico },
  data() {
    return {
      pagina: 'produtos', // Página inicial
    }
  },
}
</script>

<style>
.container {
  max-width: 900px;
  margin: 0 auto;
  padding: 20px;
  font-family: Arial, sans-serif;
}

h1 {
  text-align: center;
  margin-bottom: 20px;
}

.menu {
  display: flex;
  justify-content: center;
  gap: 10px;
  margin-bottom: 20px;
}

.menu button {
  padding: 8px 14px;
  border: none;
  background-color: #e0e0e0;
  cursor: pointer;
  border-radius: 6px;
  font-weight: bold;
}

.menu button:hover {
  background-color: #ccc;
}

.menu button.ativo {
  background-color: #4caf50;
  color: white;
}
</style>
