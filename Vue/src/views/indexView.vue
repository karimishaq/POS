<template>
  <main>
      <v-container>
        <v-row>
          <v-col>
            <v-card>
              <v-card-title>Data Obat</v-card-title>
              <HR />
              <v-card-text>
                <v-row>
                  <v-col>
                    <v-card>
                      <v-card-title>Penjualan</v-card-title>
                      <v-card-text>
                        <h2>
                        <v-icon>mdi-upload</v-icon>
                        {{data_pembelian}}
                        </h2>  
                      </v-card-text>
                    </v-card>
                  </v-col>
                  <v-col>
                    <v-card>
                      <v-card-title>Pembelian</v-card-title>
                      <v-card-text>
                        <h2>
                        <v-icon>mdi-download</v-icon>
                        {{data_penjualan}}
                        </h2>
                      </v-card-text>
                    </v-card>
                  </v-col>
                </v-row>  
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
  </main>
</template>

<script>
    import axios from 'axios'
    import {onMounted, ref} from 'vue'
    
    export default{
      setup() {
        const api=axios.create({baseURL:'http://localhost:8081/'});
        const dataku=ref('');
        const data_penjualan=ref(0);
        const data_pembelian=ref(0);
        
        onMounted(() => {
          getDataku();
        })

        function getDataku(){
          api.get('api/penjualan', {params:{awal:0, total:1, pencarian:''}}).then(response => {
            dataku.value = response.data.data
            data_penjualan.value= response.data.jdata
            api.get('api/pembelian', {params:{awal:0, total:1, pencarian:''}}).then(response => {
              dataku.value = response.data.data
              data_pembelian.value= response.data.jdata
            })
          }).catch(error => {
            console.log(error.response.data);
          })
        }

        return{
          dataku,
          data_penjualan,
          data_pembelian
        }
      }
    }
</script>

<style>
</style>