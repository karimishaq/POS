<template>
  <main>
    <v-row>
      <v-col>
        <v-card>
          <v-card-title>Data Satuan</v-card-title>
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
                <label for="Keterangan" class="font-weight-bold mb-2">Keterangan</label><br />
                <input type="text" class="form-control" v-model="post.Keterangan" placeholder="Masukkan Konten Post">
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
            Nama: '',
            Keterangan: ''
          })

          const validation= ref([])
          const router=useRouter()
          const route=useRoute()

          onMounted(() => {
            api.get('api/satuan/'+route.params.id).then(response => {
              post.Nama = response.data.Nama;
              post.Keterangan = response.data.Keterangan;
            }).catch(error => {
              console.log(error.response.data);
            });
          })

          function store(){
            let Nama = post.Nama
            let Keterangan = post.Keterangan
            
            axios.patch('http://localhost:8081/api/satuan/'+route.params.id, {
              Nama:Nama,
              Keterangan:Keterangan
            }).then(() => {
              router.push({
                name:'satuan.index'
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