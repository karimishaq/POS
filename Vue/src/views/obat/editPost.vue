<template>
  <main>
    <v-row>
      <v-col>
        <v-card>
          <v-card-title>Edit Obat</v-card-title>
          <HR />
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
                <input type="text" class="form-control" v-model="post.Nama" placeholder="Masukkan Judul Post">
              </div>

              <div class="form-group">
                <label for="Stock" class="font-weight-bold mb-2">Stock</label><br />
                <input type="text" class="form-control" v-model="post.Stock" placeholder="Masukkan Judul Post">
              </div>

              
              <div class="form-group">
                <label for="Harga_Beli" class="font-weight-bold mb-2">Harga Beli</label><br />
                <input type="text" class="form-control" v-model="post.Harga_Beli" placeholder="Masukkan Harga Beli">
              </div>

              <div class="form-group">
                <label for="Harga_Jual" class="font-weight-bold mb-2">Harga Jual</label><br />
                <input type="text" class="form-control" v-model="post.Harga_Jual" placeholder="Masukkan Harga Jual">
              </div>

              <div class="form-group">
                <label for="Satuan" class="font-weight-bold mb-2">Satuan Obat</label><br />
                <select class="form-control" v-model="post.Satuan">
                  <option v-for="(o, index) in satuan" :key="index" :value=o.Nama>{{o.Nama}}</option>
                  <option>Lainnya</option>
                </select>
              </div>
              
              <div class="form-group">
                <label for="Jenis" class="font-weight-bold mb-2">Jenis Obat</label><br />
                <select class="form-control" v-model="post.Jenis">
                  <option v-for="(o, index) in jenis" :key="index" :value=o.Nama>{{o.Nama}}</option>
                  <option>Lainnya</option>
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
    import { useRoute, useRouter } from 'vue-router'
    import axios from 'axios'

    const api=axios.create({baseURL:'http://localhost:8081/'});

    export default{
        setup() {
          const post = reactive({
            Nama: '',
            Id_Obat:'',
            Satuan:'',
            Stock:'',
            Harga_Beli:'',
            Harga_Jual:''
          })

          const validation= ref([])
          const satuan= ref([])
          const jenis= ref([])
          const router=useRouter()
          const route=useRoute()

          onMounted(() => {
            getData();
          })

          function getData(){
            api.get('api/obat/'+route.params.id).then(response => {
              let obat=response.data.obat;
              satuan.value=response.data.satuan;
              jenis.value=response.data.jenis;
              post.Nama = obat.Nama;
              post.Id_Obat= obat.Id_Obat;
              post.Satuan=obat.Satuan;
              post.Jenis=obat.Jenis;
              post.Stock=obat.Stock;
              post.Harga_Beli=obat.Harga_Beli;
              post.Harga_Jual=obat.Harga_Jual;
            }).catch(error => {
              console.log(error.response.data);
            });
          }

          function store(){ 
            api.patch('api/obat/'+route.params.id, {
              Nama:post.Nama,
              Satuan:post.Satuan,
              Jenis:post.Jenis,
              Stock:post.Stock,
              Harga_Beli:post.Harga_Beli,
              Harga_Jual:post.Harga_Jual,
              id:route.params.id
            }).then(() => {
              router.push({
                name:'obat.index'
              })
            }).catch(error => {
              validation.value=error.response.data;
            })
          }

          return{
            post,
            validation,
            router,
            store,
            jenis,
            satuan
          }
        }
    }
</script>

<style>
</style>