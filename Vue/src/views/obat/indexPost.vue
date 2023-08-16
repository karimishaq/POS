<template>
  <main>
    <v-row>
      <v-col>
        <v-card>
          <v-card-title>Data Obat</v-card-title>
          <HR />
          <v-card-text>
            <v-select v-model="jtampil" :items="itemku" @update:modelValue="muat_ulang()">
            </v-select><br />
            <v-row>
              <v-col>
                <v-btn color="primary" @click="dialog=true">Tambah Data</v-btn>
              </v-col>
              <v-col>
                <input name="cari" v-model="pencarian" type="text" style="border:1px solid black;height:100%"/>
                <v-btn @click="muat_ulang()">cari</v-btn>
              </v-col>
              <br />
            </v-row>
            <v-table class="tabelku">
              <thead>
                <th v-for="(data, index) in nama_kolom" :key="index">{{data}}</th>
              </thead>
              <tbody>
                <tr v-for="(data, index) in dataku" :key="index">
                  <td>{{data.Id_Obat}}</td>
                  <td>{{data.Nama}}</td>
                  <td>{{data.Satuan}}</td>
                  <td>{{data.Jenis}}</td>
                  <td>{{data.Stock}}</td>
                  <td>{{data.Harga_Jual}}</td>
                  <td>{{data.Harga_Beli}}</td>
                  <td>
                    <div class="kolom">
                      <v-btn size="small" color="error" @click.prevent="deleteDataku(data.id)"><v-icon>mdi-delete</v-icon></v-btn>&nbsp;
                      <router-link :to="{name:'obat.edit', params:{id:data.id}}"><v-btn size="small" color="warning"><v-icon>mdi-pencil</v-icon></v-btn></router-link>
                    </div>
                  </td>
                </tr>
              </tbody>
            </v-table>

            <v-pagination :length=Math.ceil(jdata/jtampil) :total-visible="5" v-model="paginasi" @update:modelValue="getDataku()"/>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </main>
  
  <v-dialog v-model="dialog" style="width:50%">
    <v-card>
      <v-card-title>
        <v-row>
          <v-col>Halaman Tambah</v-col>      
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
        <form @submit.prevent="store()">
          <div class="form-group">
            <label for="Nama" class="font-weight-bold mb-2">Nama</label><br />
            <input type="text" class="form-control" v-model="post.Nama" placeholder="Masukkan Nama">
          </div>
          
          <div class="form-group">
            <label for="Harga_Beli" class="font-weight-bold mb-2">Harga Beli</label><br />
            <input type="number" class="form-control" v-model="post.Harga_Beli" placeholder="Masukkan Harga Beli">
          </div>

          <div class="form-group">
            <label for="Harga_Jual" class="font-weight-bold mb-2">Harga Jual</label><br />
            <input type="number" class="form-control" v-model="post.Harga_Jual" placeholder="Masukkan Harga Jual">
          </div>
          
          <div class="form-group">
            <label for="Satuan" class="font-weight-bold mb-2">Satuan</label><br />
            <select class="form-control" v-model="post.Satuan">
              <option v-for="(o, index) in satuan" :key="index" :value=o.Nama>{{o.Nama}}</option>
              <option value='Lainnya'>Lainnya</option>
            </select>
          </div>
          <div class="form-group">
            <label for="Jenis" class="font-weight-bold mb-2">Jenis</label><br />
            <select class="form-control" v-model="post.Jenis">
              <option v-for="(o, index) in jenis" :key="index" :value=o.Nama>{{o.Nama}}</option>
              <option value='Lainnya'>Lainnya</option>
            </select>
          </div>
          <br />
          <v-btn color="primary" type="submit">Simpan</v-btn>
        </form>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script>
    import axios from 'axios';
    import {onMounted, ref, reactive} from 'vue'
    import {generate_id} from '../scriptku.js'

    export default{
      
      setup(){
        const api=axios.create({baseURL:'http://localhost:8081/'});
        const post = reactive({
          Id_Obat:'',
          Nama: '',
          Satuan:'Lainnya',
          Jenis:'Lainnya',
          Harga_Beli:0,
          Harga_Jual:0
        })
        
        const validation= ref([])        
        const satuan= ref([])        
        const jenis= ref([])

        let dialog=ref(false)
        let pencarian=ref("")
        let nama_kolom=["Id Obat", "Nama", "Satuan", "Stok", "Harga Jual", "Harga Beli", ""]
        let dataku= ref([])
        let paginasi= ref(1)
        let jdata= ref(0)
        let jtampil= ref(5)
        let itemku=["5", "10", "50", "100"]

        onMounted(() => {
            getDataku();
        })

        function muat_ulang(){
            paginasi.value=1;
            getDataku();
        }

        function getDataku(){
            api.get('api/obat', {params:{awal:(jtampil.value*(paginasi.value-1)), total:jtampil.value, pencarian:pencarian.value}}).then(response => {
              dataku.value = response.data.data
              post.satuan=response.data.satuan[0].Nama;
              jenis.value = response.data.jenis;
              post.jenis=response.data.jenis[0].Nama;
              satuan.value = response.data.satuan;
              
              jdata.value= response.data.jdata
            }).catch(error => {
              console.log(error.response.data);
            })
        }

        function deleteDataku(id){
            api.delete(`api/obat/${id}`)
            .then(response => {            
                getDataku();
                console.log(response);
            }).catch(error => {
                console.log(error.response);
            });
        }

        function store(){
          api.post('api/obat', {
            Id_Obat: generate_id('OB'),
            Nama: post.Nama,
            Satuan: post.Satuan,
            Jenis: post.Jenis,
            Harga_Jual: post.Harga_Jual,
            Harga_Beli: post.Harga_Beli
          }).then(() => {
            dialog.value=false;
            getDataku();
          }).catch(error => {
            validation.value=error.response.data;
          })
        }

        return {
          nama_kolom,
          dataku,
          paginasi,
          jtampil,
          jdata,
          itemku,
          getDataku,
          deleteDataku,
          muat_ulang,
          dialog,
          post,
          validation,
          store,
          pencarian,
          satuan,
          jenis
        }
      }
    }

</script>

<style>
  .tabelku{
    margin-top:24px;
    background:transparent;
    overflow-x:auto;
  }
  
  .tabelku .kolom{
    display:relative;
    white-space:nowrap;
  }
</style>