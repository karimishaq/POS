<template>
  <v-container fluid="true">
    <v-row style="height:100vh">
      <v-col cols="3">
        <v-card>
          <v-card-title>
            Data
          </v-card-title>
          <v-card-text>
            <ul class='menu'>
              <li>
                <router-link :to="{name: 'home'}" class="nav-link" active-class="active">Dashboard</router-link>
              </li>
              <li>
                <router-link :to="{name: 'satuan.index'}" class="nav-link" active-class="active">Satuan</router-link>
              </li>
              <li>
                <router-link :to="{name: 'jenis.index'}" class="nav-link" active-class="active">Golongan Obat</router-link>
              </li>
              <li>
                <router-link :to="{name: 'pengguna.index'}" class="nav-link" active-class="active">Pengguna</router-link>
              </li>
              <li>
                <router-link :to="{name: 'obat.index'}" class="nav-link" active-class="active">Obat</router-link>
              </li>
              <li>
                <router-link :to="{name: 'dokter.index'}" class="nav-link" active-class="active">Dokter</router-link>
              </li>
              <li>
                <router-link :to="{name: 'pelanggan.index'}" class="nav-link" active-class="active">Pelanggan</router-link>
              </li>
              <li>
                <router-link :to="{name: 'supplier.index'}" class="nav-link" active-class="active">Supplier</router-link>
              </li>
            </ul>          
          </v-card-text>
        </v-card>

        <br />
        <v-card>
          <v-card-title>
            Transaksi
          </v-card-title>
          <v-card-text>
            <ul class='menu'>
              <li>
                <router-link :to="{name: 'pembelian.index'}" class="nav-link" active-class="active">Pembelian</router-link>
              </li>
              <li>
                <router-link :to="{name: 'penjualan.index'}" class="nav-link" active-class="active">Penjualan</router-link>
              </li>
            </ul>          
          </v-card-text>
        </v-card>

        <br />
        <v-card>
          <v-card-title>
            Laporan
          </v-card-title>
          <v-card-text>
            <ul class='menu'>
              <li>
                <router-link :to="{name: 'lpembelian.index'}" class="nav-link" active-class="active">Pembelian</router-link>
              </li>
              <li>
                <router-link :to="{name: 'lpenjualan.index'}" class="nav-link" active-class="active">Penjualan</router-link>
              </li>
            </ul>          
          </v-card-text>
        </v-card>
      </v-col>
      <v-col>
        <router-view></router-view>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    setup(){
      return ({
      })
    }
  }
</script>

<style>
  body{
    background-color:lightgray;
  }
  
  .menu{
    padding:8px;
    display:flex;
    flex-flow:column;
  }

  .menu li{
    list-style:none;
  }

  .menu li a{
    color:green;
    font-size:18px;
    text-decoration:none;
  }

  .menu li a:hover{
    color:red;
  }

  .active{
    font-weight:bold;
  }
</style>