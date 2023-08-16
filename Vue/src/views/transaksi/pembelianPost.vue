<template>
  <main style="height:100%;padding-left:8px;padding-right:8px">
    <v-card style="height:100%">
      <v-row>
        <v-col>
          <div style="padding:8px;" v-if="data_transaksi.length>0">
            <h2>Transaksi Pembelian</h2>
            <div>
              <table style="width:100%">
                <thead>
                  <th v-for="(s, index) in kolomku" :key="index">{{s}}</th>
                </thead>
                <tbody>
                  <tr v-for="(data, index) in data_transaksi" :key="index">
                    <td>{{data.Nama}}</td>
                    <td>
                      <VueDatePicker style="min-width:140px;" v-model="data.Expired" placeholder="Pilih Tanggal"></VueDatePicker>
                    </td>
                    <td><input type="number" min=1 v-model="data.Jumlah" @change="cek_harga()"/></td>
                    <td><input type="number" min=1 v-model="data.Harga" @change="cek_harga()"/></td>
                    <td>
                      <input type="number" v-model="data.Diskon" @change="cek_harga()" min="0" max="100" />
                    </td>
                    <td><v-btn @click="hapus_item(data.Id_Obat)"><v-icon>mdi-delete</v-icon></v-btn></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div>
              <v-btn @click="dialog = true">Lanjut</v-btn>
            </div>
          </div>
        </v-col>
        <v-col cols='3'>
          <div>
            <div>
              <h2>Data Obat</h2>
            </div>
            <div class="data_obat">
              <v-card v-for="(data, index) in data_produk" :key="index">
                <v-card-title>{{data.Nama}}</v-card-title>
                <v-card-text style="padding:18px">
                  <ul>
                    <li>Jenis : {{data.Jenis}}</li>
                    <li>Harga Beli : {{data.Harga_Beli}}</li>
                    <li>Stok : {{data.Stock}}</li>
                  </ul>
                  <v-btn @click="tambah_item(data)">Add</v-btn>
                </v-card-text>
              </v-card>
            </div>
          </div>
          <v-pagination :length=Math.ceil(jdata/jtampil) :total-visible="5" v-model="paginasi" @update:modelValue="getDataku()"/>
        </v-col>
      </v-row>
    </v-card>
  </main>
  <v-dialog v-model="dialog" style="width:50%">
    <v-card>
      <v-card-title>
        <v-row>
          <v-col><h2>Detail Transaksi</h2></v-col>      
          <v-col>
            <div class="d-flex justify-end">
                <v-btn @click="dialog = false">X</v-btn>
            </div>
          </v-col>
        </v-row>  
      </v-card-title>
      
      <v-card-text>
        <div v-if="validation.errors">
          <ul>
            <li v-for="(error, index) in validation.errors" :key="index">
              {{'${error.param}:${error.msg}'}}
            </li>
          </ul>
        </div>
        <form @submit.prevent="store">
          <div class="form-group">
            <label for="Supplier">Supplier</label><br />
            <input type="text" v-model="post.Supplier" placeholder="Masukkan Supplier">
          </div>

          <div class="form-group">
            <label for="Harga">Harga</label><br />
            <input type="number" v-model="post.Harga" placeholder="Masukkan Harga">
          </div>

          <div class="form-group">
            <label for="keterangan">Keterangan</label><br />
            <input type="text" v-model="post.Keterangan" placeholder="Masukkan Keterangan">
          </div>

          <br />
          <v-btn type="submit" color="success">Simpan</v-btn>
        </form>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script>
  import axios from 'axios'
  import {onMounted, ref, reactive} from 'vue'
  import {generate_id} from '../scriptku.js';
  import VueDatePicker from '@vuepic/vue-datepicker'
  import '@vuepic/vue-datepicker/dist/main.css'

  export default{
    components: {VueDatePicker},
    setup(){
      const api=axios.create({baseURL:'http://localhost:8081/'});

      let data_produk=ref([])
      let data_transaksi=ref([])
      let paginasi=ref(1)
      let jdata=ref(0)
      let jtampil=ref(10)
      let validation=ref([])
      let dialog=ref(false)
      let date=ref(null)

      const kolomku=["Nama", "Tanggal", "Kuantitas", "Harga", "Diskon", ""]
      const post=reactive({
        Id_Pembelian:'',
        Supplier:'',
        Operator:'',
        Harga:'',
        Keterangan:''
      })

      onMounted(() =>{
        getDataku();
      })

      function getDataku(){
          api.get('api/obat', {params:{awal:(jtampil.value*(paginasi.value-1)), total:jtampil.value, pencarian:''}}).then(response => {
            data_produk.value = response.data.data
            jdata.value=response.data.jdata
          }).catch(error => {
            console.log(error.response.data);
          })
      }

      function cek_harga(){
        let harga=0;
        data_transaksi.value.map((o)=>harga+=((o.Harga*(100-o.Diskon)/100)*o.Jumlah))
        post.Harga=harga;
      }

      function hapus_item(id){
        data_transaksi.value=data_transaksi.value.filter((o)=> o.Id_Obat!==id);
        
        cek_harga();
      }

      function tambah_item(data){
        let o=data_transaksi.value.find((o)=>o.Id_Obat==data.Id_Obat);
        if(!o)
          data_transaksi.value.push({
            id:data.id, 
            Id_Obat:data.Id_Obat, 
            Nama:data.Nama, 
            Jumlah:1, 
            Harga:data.Harga_Beli, 
            Stock:data.Stock, 
            Diskon:0, 
            Expired:'2000-1-1'
          })
        else
          alert("item sudah ditambahkan");

        cek_harga();
      }

      function store(){
        let id=generate_id('TR');
        api.post('api/pembelian', {id:id, Supplier:post.Supplier, Operator:'anonim', Harga:post.Harga, Keterangan:post.Keterangan}).then(() => {        
          api.post('api/item_pembelian', {id:id, barang:data_transaksi.value}).then(()=>{dialog.value=false;});
        })
      }

      return {
        kolomku,
        data_produk,
        data_transaksi,
        tambah_item,
        hapus_item,
        cek_harga,
        paginasi,
        jtampil,
        jdata,
        getDataku,
        post,
        dialog,
        validation,
        store,
        date,
      }
    }
  }
</script>

<style>
  .data_obat{
    display:grid;
  }

  .data_obat > *{
    margin-bottom:4px;
    margin-right:4px;
  }

  .data_obat{
    grid-template-columns: auto;
  }

  td{
    padding:4px;
  }
</style>