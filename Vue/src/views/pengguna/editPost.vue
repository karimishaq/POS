<template>
  <main>
    <v-row>
      <v-col>
        <v-card>
          <v-card-title>Edit Pengguna</v-card-title>
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
                <label for="Username" class="font-weight-bold mb-2">Username</label><br />
                <input type="text" class="form-control" v-model="post.Username" placeholder="Masukkan Konten Post">
              </div>

              <div class="form-group">
                <label for="Level" class="font-weight-bold mb-2">Level</label><br />
                <input type="text" class="form-control" v-model="post.Level" placeholder="Masukkan Konten Post">
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

    export default{
        
        setup() {
          const api=axios.create({baseURL:'http://localhost:8081/'});
          const post = reactive({
              Nama : '',
              JK : '',
              Alamat : '',
              No_HP : '',
              Username : '',
              SIP : ''
          })

          const validation= ref([])
          const router=useRouter()
          const route=useRoute()

          onMounted(() => {
            api.get('api/pengguna/'+route.params.id).then(response => {
              post.Nama = response.data.Nama;
              post.JK = response.data.JK;
              post.Alamat = response.data.Alamat;
              post.No_HP = response.data.No_HP;
              post.Username = response.data.Username;
              post.Level = response.data.Level;
            }).catch(error => {
              console.log(error.response.data);
            });
          })

          function store(){
            api.patch('api/pengguna/'+route.params.id, {              
              Nama:post.Nama,
              JK:post.JK,
              Username:post.Username,
              Alamat:post.Alamat,
              No_HP:post.No_HP,
              Level:post.Level,
              Id:route.params.id,
            }).then(() => {
              router.push({
                name:'pengguna.index'
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