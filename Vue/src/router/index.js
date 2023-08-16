import {createRouter, createWebHistory} from 'vue-router'

const routes=[
    {
        path: '/',
        name: 'home',
        component: () => import(/* webpackChunckName:"Home" */ '@/views/indexView.vue')
    },

    //transaksi
    {
        path: '/pembelian',
        name: 'pembelian.index',
        component: () => import(/* webpackChunckName:"Home" */ '@/views/transaksi/pembelianPost.vue')
    },

    {
        path: '/penjualan',
        name: 'penjualan.index',
        component: () => import(/* webpackChunckName:"Home" */ '@/views/transaksi/penjualanPost.vue')
    },

    //laporan
    {
        path: '/lpembelian',
        name: 'lpembelian.index',
        component: () => import(/* webpackChunckName:"Home" */ '@/views/laporan/pembelianPost.vue')
    },

    {
        path: '/lpenjualan',
        name: 'lpenjualan.index',
        component: () => import(/* webpackChunckName:"Home" */ '@/views/laporan/penjualanPost.vue')
    },

    //satuan
    {
        path: '/satuan',
        name: 'satuan.index',
        component: () => import(/* webpackChunckName:"satuan.index" */ '@/views/satuan/indexPost.vue')
    },
    
    {
        path: '/satuan/edit/:id',
        name: 'satuan.edit',
        component: () => import(/* webpackChunckName:"satuan.edit" */ '@/views/satuan/editPost.vue')
    },

    //jenis
    {
        path: '/jenis',
        name: 'jenis.index',
        component: () => import(/* webpackChunckName:"jenis.index" */ '@/views/jenis/indexPost.vue')
    },
    
    {
        path: '/jenis/edit/:id',
        name: 'jenis.edit',
        component: () => import(/* webpackChunckName:"jenis.edit" */ '@/views/jenis/editPost.vue')
    },

    //pengguna
    {
        path: '/pengguna',
        name: 'pengguna.index',
        component: () => import(/* webpackChunckName:"pengguna.index" */ '@/views/pengguna/indexPost.vue')
    },
    
    {
        path: '/pengguna/edit/:id',
        name: 'pengguna.edit',
        component: () => import(/* webpackChunckName:"pengguna.edit" */ '@/views/pengguna/editPost.vue')
    },

    //Obat
    
    {
        path: '/obat',
        name: 'obat.index',
        component: () => import(/* webpackChunckName:"pengguna.index" */ '@/views/obat/indexPost.vue')
    },
    
    {
        path: '/obat/edit/:id',
        name: 'obat.edit',
        component: () => import(/* webpackChunckName:"obat.edit" */ '@/views/obat/editPost.vue')
    },

    //dokter
    {
        path: '/dokter',
        name: 'dokter.index',
        component: () => import(/* webpackChunckName:"dokter.index" */ '@/views/dokter/indexPost.vue')
    },
    
    {
        path: '/dokter/edit/:id',
        name: 'dokter.edit',
        component: () => import(/* webpackChunckName:"dokter.edit" */ '@/views/dokter/editPost.vue')
    },

    //pelanggan
    {
        path: '/pelanggan',
        name: 'pelanggan.index',
        component: () => import(/* webpackChunckName:"pelanggan.index" */ '@/views/pelanggan/indexPost.vue')
    },
    
    {
        path: '/pelanggan/edit/:id',
        name: 'pelanggan.edit',
        component: () => import(/* webpackChunckName:"pelanggan.edit" */ '@/views/pelanggan/editPost.vue')
    },

    //supplier
    {
        path: '/supplier',
        name: 'supplier.index',
        component: () => import(/* webpackChunckName:"supplier.index" */ '@/views/supplier/indexPost.vue')
    },
    
    {
        path: '/supplier/edit/:id',
        name: 'supplier.edit',
        component: () => import(/* webpackChunckName:"supplier.edit" */ '@/views/supplier/editPost.vue')
    },
]

const router=createRouter({
    history:createWebHistory(),
    routes
})

export default router