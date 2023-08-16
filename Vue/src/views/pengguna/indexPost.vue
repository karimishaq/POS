<template>
  <main>
    <v-row>
      <v-col>
        <v-card>
          <v-card-title>Data Pengguna</v-card-title>
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
                  <td>{{data.Nama}}</td>
                  <td>{{data.Username}}</td>
                  <td>{{data.JK}}</td>
                  <td>{{data.Alamat}}</td>
                  <td>{{data.No_HP}}</td>
                  <td>{{data.Level}}</td>
                  <td>
                    <div class="kolom">
                      <v-btn size="small" color="error" @click.prevent="deleteDataku(data.id)"><v-icon>mdi-delete</v-icon></v-btn>&nbsp;
                      <router-link :to="{name:'pengguna.edit', params:{id:data.id}}"><v-btn size="small" color="warning"><v-icon>mdi-pencil</v-icon></v-btn></router-link>
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
            <div class="form-group">
              <label for="Nama">Nama </label><br />
              <input type="text" v-model="post.Nama" placeholder="Masukkan Nama">
            </div>

            <div class="form-group">
              <label for="JK">Jenis Kelamin </label><br />
              <select v-model="post.JK">
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
            
            <div class="form-group">
              <label for="Alamat">Alamat </label><br />
              <input type="text" v-model="post.Alamat" placeholder="Masukkan Alamat">
            </div>

            <div class="form-group">
              <label for="Nomor_HP">Nomor HP </label><br />
              <input type="text" v-model="post.No_HP" placeholder="Masukkan No. HP">
            </div>

            <div class="form-group">
              <label for="Username">Username </label><br />
              <input type="text" v-model="post.Username" placeholder="Masukkan Username">
            </div>
            
            <br />
            <v-btn type="submit" color="success">Simpan</v-btn>
          </form>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script>
    import axios from 'axios';
    import {onMounted, ref, reactive} from 'vue'

    export default{
      
      setup(){
        const api=axios.create({baseURL:'http://localhost:8081/'});
        const post = reactive({
          Nama: '',
          JK: 'Laki-laki',
          Alamat: '',
          No_HP: '',
          Username: '',
          Level: ''
        })
        const validation= ref([])

        let dialog=ref(false)
        let pencarian=ref('')
        let nama_kolom=["Nama", "Username", "Jenis Kelamin", "Alamat", "No_HP", "Level"]
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
            api.get('api/pengguna', {params:{awal:(jtampil.value*(paginasi.value-1)), total:jtampil.value, pencarian:pencarian.value}}).then(response => {
              dataku.value = response.data.data
              jdata.value= response.data.jdata
            }).catch(error => {
              console.log(error.response.data);
            })
        }

        function deleteDataku(id){
            api.delete(`api/pengguna/${id}`)
            .then(response => {            
                getDataku();
                console.log(response);
            }).catch(error => {
                console.log(error.response);
            });
        }

        function store(){
          api.post('api/pengguna', {
            Nama:post.Nama,
            JK:post.JK,
            Username:post.Username,
            Alamat:post.Alamat,
            No_HP:post.No_HP,
            Level:post.Level,
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