<template>
    <b-container>
      <b-form @submit="onSubmit" @reset="onReset" v-if="show" method="post" action="/api/patient" >
        <b-row>
          <b-col md="4" class="p-1">
            <b-form-group id="input-group-1" label="Họ và tên:" label-for="input-1">
              <b-form-input
                id="input-1"
                v-model="form.name"
                type="text"
                name="name"
                placeholder="Họ và tên"
                required
                class="text-center"
              ></b-form-input>
            </b-form-group>
          </b-col>

          <b-col md="2" class="p-1">
            <b-form-group id="input-group-2" label="Tuổi:" label-for="input-2">
              <b-form-input
                id="input-2"
                v-model="form.age"
                name="age"
                placeholder="Tuổi"
                class="text-center"
                required
              ></b-form-input>
            </b-form-group>
          </b-col>

          <b-col md="3" class="p-1">
            <b-form-group id="input-group-3" label="Ngày vào:" label-for="input-3">
              <b-form-input
                id="input-3"
                v-model="form.validate"
                name="validate"
                type="date"
                class="text-center"
                required
              ></b-form-input>
            </b-form-group>
          </b-col>

          <b-col md="3" class="p-1">
            <b-form-group id="input-group-3" label="Số điện thoại:" label-for="input-3">
              <b-form-input
                id="input-3"
                v-model="form.phone_number"
                name="phone_number"
                type="text"
                class="text-center"
                placeholder="Số điện thoại liên hệ"
                required
              ></b-form-input>
            </b-form-group>
          </b-col>
        </b-row>

        <b-row>
          <b-col md="12" class="p-1">
            <b-form-group id="input-group-3" label="Thôn - Tên nhà" label-for="input-3">
              <b-form-input
                id="input-3"
                v-model="form.village"
                name="village"
                type="text"
                class="text-center"
                placeholder="Nhập địa chỉ nhà (nếu có)"
              ></b-form-input>
            </b-form-group>
          </b-col>
        </b-row>
        
        <b-row>
          <location-component></location-component>
        </b-row>

        <b-row>
          <b-col md="12" class="p-1">
            <b-form-group id="input-group-6" label="Tiền sử bệnh" label-for="input-6">
              <b-form-textarea
                id="input-6"
                size="md"
                v-model="form.anamnesis"
                name="anamnesis"
                type="text"
                class="text-center"
                placeholder="Tiền sử bệnh (nếu có)"
              ></b-form-textarea>
            </b-form-group>
          </b-col>
        </b-row>

        <b-row>
          <b-col md="12" class="p-1">
            <b-form-group id="input-group-6" label="Ghi chú:" label-for="input-7">
              <b-form-textarea
                id="input-7"
                size="md"
                v-model="form.note"
                name="note"
                type="text"
                class="text-center"
                rows="7"
                placeholder="Ghi chú (nếu có)"
              ></b-form-textarea>
            </b-form-group>
          </b-col>
        </b-row>

        <div class="mt-3">
          <b-button type="submit" variant="primary">Thêm bệnh nhân</b-button>
        </div>

      </b-form>
    </b-container>
</template>

<script>
import LocationComponent from './LocationComponent.vue'
import axios from 'axios'

  export default {
    components: { LocationComponent },

    data() {
      return {
        form: {
          validate: '',
          name: '',
          age:'',
          phone_number: '',
          village: '',
          anamnesis: '',
          note: '',
          // province_id: '',
          // district: '',
          // ward_id: ''
        },
        show: true
      }
    },              
    methods: {
      onSubmit() {
      axios.post('/api/patient', {
          name: this.form.name,
          age: this.form.age,
          name: this.form.name,
          phone_number: this.form.phone_number,
          village: this.form.village,
          anamnesis: this.form.anamnesis,
          note: this.form.note,
        })
        .then(function (response) {
          console.log(response.data);
        })
        .catch(function (error) {
          console.log(error);
        });
      },
      onReset(event) {
        event.preventDefault()
        // Reset our form values
        this.form.validate = ''
        this.form.name = ''
        this.form.age = ''
        this.form.anamnesis = ''
        this.form.note = ''
        // Trick to reset/clear native browser form validation state
        this.show = false
        this.$nextTick(() => {
          this.show = true
        })
      }
    }
  }
</script>