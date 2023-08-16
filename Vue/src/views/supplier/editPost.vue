<template>
  <main>
    <v-row>
      <v-col>
        <v-card>
          <v-card-title>Edit Supplier</v-card-title>
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
                <input type="text" class="form-control" v-model="post.Nama" placeholder="Masukkan Nama Pelanggan">
              </div>

              <div class="form-group">
                <label for="Kota" class="font-weight-bold mb-2">Kota</label><br />
                <input type="text" class="form-control" v-model="post.Kota" placeholder="Masukkan Nama Kota">
              </div>
              
              <div class="form-group">
                <label for="Alamat" class="font-weight-bold mb-2">Alamat</label><br />
                <input type="text" class="form-control" v-model="post.Alamat" placeholder="Masukkan Alamat">
              </div>

              <div class="form-group">
                <label for="No_HP" class="font-weight-bold mb-2">Nomor HP</label><br />
                <input type="text" class="form-control" v-model="post.No_HP" placeholder="Masukkan Nomor HP">
              </div>
              <div class="form-group">
                <label for="Status" class="font-weight-bold mb-2">Status</label><br />
                <select class="form-control" v-model="post.Status">
                  <option value="aktif">Aktif</option>
                  <option value="tidak aktif">Tidak aktif</option>
                </select>
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
            Kota: '',
            Alamat:'',
            No_HP:'',
            Status:''
          })

          const validation= ref([])
          const router=useRouter()
          const route=useRoute()

          onMounted(() => {
            api.get('api/supplier/'+route.params.id).then(response => {
              let dt=response.data;
              post.Nama = dt.Nama;
              post.Kota=dt.Kota;
              post.Alamat = dt.Alamat;
              post.No_HP = dt.No_HP;
              post.Status = dt.Status;
            }).catch(error => {
              console.log(error.response.data);
            });
          })

          function store(){
            api.patch('api/supplier/'+route.params.id, {
              Nama: post.Nama,
              Kota: post.Kota,
              Alamat:post.Alamat,
              No_HP:post.No_HP,
              Status:post.Status,
              id:route.params.id
            }).then(() => {
              router.push({
                name:'supplier.index'
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