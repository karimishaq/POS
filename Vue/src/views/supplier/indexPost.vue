<template>
  <main>
    <v-row>
      <v-col>
        <v-card>
          <v-card-title>Data Supplier</v-card-title>
          <HR />
          <v-card-text>
            <v-select v-model="jtampil" :items="itemku" @update:modelValue="muat_ulang()">
            </v-select><br />
            <v-row>
              <v-col>
                <v-btn color="primary" @click="dialog = true">Tambah Data</v-btn>
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
                  <td>{{data.Id_Supplier}}</td>
                  <td>{{data.Nama}}</td>
                  <td>{{data.Kota}}</td>
                  <td>{{data.Alamat}}</td>
                  <td>{{data.No_HP}}</td>
                  <td>{{data.Status}}</td>
                  <td>
                    <div class="kolom">
                      <v-btn size="small" color="error" @click.prevent="deleteDataku(data.id)"><v-icon>mdi-delete</v-icon></v-btn>&nbsp;
                      <router-link :to="{name:'supplier.edit', params:{id:data.id}}"><v-btn size="small" color="warning"><v-icon>mdi-pencil</v-icon></v-btn></router-link>
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
        <form @submit.prevent="store">
          <div class="fgroup">
            <label for="Nama">Nama</label><br />
            <input type="text" v-model="post.Nama" placeholder="Masukkan Nama Supplier">
          </div>

          <div class="fgroup">
            <label for="Kota">Kota</label><br />
            <input type="text" v-model="post.Kota" placeholder="Masukkan Nama Kota">
          </div>
          
          <div class="fgroup">
            <label for="Alamat" >Alamat</label><br />
            <input type="text" v-model="post.Alamat" placeholder="Masukkan Alamat">
          </div>

          <div class="fgroup">
            <label for="No_HP" >Nomor HP</label><br />
            <input type="text" v-model="post.No_HP" placeholder="Masukkan Nomor HP">
          </div>

          <div class="fgroup">
            <label for="Status" >Status</label><br />
            <select class="form-control" v-model="post.Status">
              <option value="aktif">Aktif</option>
              <option value="tidak aktif">Tidak aktif</option>
            </select>
          </div>

          <v-btn type="submit" color="success">Simpan</v-btn>
        </form>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script>
    import axios from 'axios';
    import {onMounted, ref, reactive} from 'vue'
    import {generate_id} from '../scriptku.js'

    const api=axios.create({baseURL:'http://localhost:8081/'});
        
    export default{
      
      setup(){
        const post = reactive({
          Id_Supplier:'',
          Nama: '',
          Kota: '',
          Alamat:'',
          No_HP:'',
          Status:'aktif'
        })

        const validation= ref([])
        let dialog= ref(false)
        let pencarian= ref('')
        let nama_kolom=["Id_Supplier", "Nama", "Kota", "Alamat", "No_HP", "Status", ""]
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
            api.get('api/supplier', {params:{awal:(jtampil.value*(paginasi.value-1)), total:jtampil.value, pencarian:pencarian.value}}).then(response => {
              dataku.value = response.data.data
              jdata.value= response.data.jdata
            }).catch(error => {
              console.log(error.response.data);
            })
        }

        function deleteDataku(id){
            api.delete(`api/supplier/${id}`)
            .then(response => {            
                getDataku();
                console.log(response);
            }).catch(error => {
                console.log(error.response);
            });
        }

        function store(){
          api.post('api/supplier', {
            Id_Supplier:generate_id('SP'),
            Nama:post.Nama,
            Kota:post.Kota,
            Alamat:post.Alamat,
            No_HP:post.No_HP,
            Status:post.Status,
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
          pencarian
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