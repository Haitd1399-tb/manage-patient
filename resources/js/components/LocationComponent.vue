<template>
      <div class="form-group">
            <label for="location">Địa chỉ:</label>
            <b-row>
                  <b-col md="4" class="p-1">
                        <b-form-select v-model="province_id" class="form-control text-center" name="province_id" required>
                              <b-form-select-option 
                                    v-for="province in provinces" 
                                    :key="province.id"
                                    :value="province.id">
                                    {{province.name}}
                              </b-form-select-option>
                        </b-form-select>
                  </b-col>

                  <b-col md="4" class="p-1">
                        <b-form-select v-model="district_id" class="form-control text-center" name="district_id" required>
                              <b-form-select-option :value="null"></b-form-select-option>
                              <b-form-select-option 
                                    v-for="district in districts" 
                                    :key="district.id"
                                    :value="district.id">
                                    {{district.name}}
                              </b-form-select-option>
                        </b-form-select>
                  </b-col>

                  <b-col md="4" class="p-1">
                        <b-form-select v-model="ward_id" class="form-control text-center" name="ward_id" required>
                              <b-form-select-option :value="null"></b-form-select-option>
                              <b-form-select-option 
                                    v-for="ward in wards" 
                                    :key="ward.id"
                                    :value="ward.id">
                                    {{ward.name}}
                              </b-form-select-option>
                        </b-form-select>
                  </b-col>
            </b-row>
      </div>
</template>

<script>
import axios from 'axios'
export default {
      data(){
            return {
                  provinces:[],
                  province_id: 22,
                  districts:[],
                  district_id: 236,
                  wards:[],
                  ward_id: null
            }
      },
      mounted() {
            this.getProvinces();
            this.getDistricts();
            this.getWards();
      },
      methods: {
            getProvinces() {
                  axios.get("/admin/location/provinces").then(response => {
                        this.provinces = response.data;
                  })
            },
            getDistricts() {
                  axios.get("/admin/location/province/"+this.province_id+"/districts").then(response => {
                        this.districts = response.data;
                  })
            },
            getWards() {
                  axios.get("/admin/location/district/"+this.district_id+"/wards").then(response => {
                        this.wards = response.data;
                  })
            },
      },
      watch: {
            province_id() {
                  this.getDistricts();
            },
            district_id() {
                  this.getWards();
            }
      },
}
</script>

<style scoped>

</style>