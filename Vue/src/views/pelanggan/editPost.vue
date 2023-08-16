<template>
  <main>
    <v-row>
      <v-col>
        <v-card>
          <v-card-title>Data Pelanggan</v-card-title>
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
                      <label>Nama</label><br />
                      <input type="text" class="form-control" v-model="post.Nama" placeholder="Masukkan Nama">
                  </div>
                  <div> 
                      <label>Jenis Kelamin</label><br />
                      <input type="text" class="form-control" v-model="post.JK" placeholder="Masukkan Jenis Kelamin">
                  </div>
                  <div>    
                      <label>Alamat</label><br />
                      <input type="text" class="form-control" v-model="post.Alamat" placeholder="Masukkan Alamat">
                  </div>
                  <div>
                      <label>No. HP</label><br />
                      <input type="text" class="form-control" v-model="post.No_HP" placeholder="Masukkan No. HP">
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
          const post = reactive({
            Nama: '',
            JK: '',
            Alamat:'',
            No_HP:''
          })

          const validation= ref([])
          const router=useRouter()
          const route=useRoute()

          onMounted(() => {
            axios.get('http://localhost:8081/api/pelanggan/'+route.params.id).then(response => {
              post.Nama = response.data.Nama;
              post.JK = response.data.JK;
              post.Alamat = response.data.Alamat;
              post.No_HP = response.data.No_HP;
            }).catch(error => {
              console.log(error.response.data);
            });
          })

          function store(){
            
            axios.patch('http://localhost:8081/api/pelanggan/'+route.params.id, {
              Nama:post.Nama,
              JK:post.JK,
              Alamat:post.Alamat,
              No_HP:post.No_HP
            }).then(() => {
              router.push({
                name:'pelanggan.index'
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