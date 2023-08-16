<template>
  <main>
    <v-row>
      <v-col>
        <v-card>
          <v-card-title>Data Dokter</v-card-title>
          <HR />
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
                <label for="Nama" class="font-weight-bold mb-2">Nama</label><br />
                <input type="text" class="form-control" v-model="post.Nama" placeholder="Masukkan Judul Post">
              </div>

              <div class="form-group">
                <label for="JK" class="font-weight-bold mb-2">Jenis Kelamin</label><br />
                <select class="form-control" v-model="post.JK">
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>
              
              <div class="form-group">
                <label for="Alamat" class="font-weight-bold mb-2">Alamat</label><br />
                <input type="text" class="form-control" v-model="post.Alamat" placeholder="Masukkan Konten Post">
              </div>

              <div class="form-group">
                <label for="Nomor_HP" class="font-weight-bold mb-2">Nomor HP</label><br />
                <input type="text" class="form-control" v-model="post.No_HP" placeholder="Masukkan Konten Post">
              </div>

              <div class="form-group">
                <label for="Status" class="font-weight-bold mb-2">Status</label><br />
                <input type="text" class="form-control" v-model="post.Status" placeholder="Masukkan Konten Post">
              </div>

              <div class="form-group">
                <label for="SIP" class="font-weight-bold mb-2">SIP</label><br />
                <input type="text" class="form-control" v-model="post.SIP" placeholder="Masukkan Konten Post">
              </div>
              <br />
              <v-btn color="primary" type="submit">Simpan</v-btn>
            </form>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </main>
</template>

<script>
    import { onMounted, reactive, ref } from 'vue'
    import { useRouter, useRoute } from 'vue-router'
    import axios from 'axios'

    const api=axios.create({baseURL:'http://localhost:8081/'});
        
    export default{
        setup() {
          const post = reactive({
            Nama: '',
            JK: '',
            Alamat: '',
            No_HP: '',
            Status: ''
          })

          const validation= ref([])
          const router=useRouter()
          const route=useRoute()

          onMounted(() => {
            api.get('api/dokter/'+route.params.id).then(response => {
              post.Nama = response.data.Nama;
              post.JK = response.data.JK;
              post.Alamat = response.data.Alamat;
              post.No_HP = response.data.No_HP;
              post.Status = response.data.Status;
              post.SIP = response.data.SIP;
            }).catch(error => {
              console.log(error.response.data);
            });
          })

          
          function store(){
            api.patch('api/dokter/'+route.params.id, {
              Id:route.params.id,
              Nama:post.Nama,
              JK:post.JK,
              Alamat:post.Alamat,
              No_HP:post.No_HP,
              Status:post.Status,
              SIP:post.SIP,
            }).then(() => {
              router.push({
                name:'dokter.index'
              })
            }).catch(error => {
              validation.value=error.response.data;
            })
          }

          return{
            post,
            validation,
            router,
            store
          }
        }
    }
</script>


<style>
</style>