<script setup>
import { Head } from '@inertiajs/vue3';
import Produtos from '@/Components/Produtos.vue';
import Compras from '@/Components/Compras.vue';
import Vendas from '@/Components/Vendas.vue';
</script>

<template>
    <Head title="Página Inicial" />

    <div class="min-h-screen bg-gray-100 py-10">
        <div class="max-w-6xl mx-auto bg-white p-8 rounded-2xl shadow">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Bem-vindo ao Sistema de Estoque</h1>

            <div class="grid md:grid-cols-3 gap-6">
                <Produtos />
                <Compras />
                <Vendas />
            </div>
        </div>
    </div>
</template>
