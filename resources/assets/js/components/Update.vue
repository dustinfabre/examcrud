<template>
  <div>
    <div class="row" style="margin-top:50px">
      <div class="col-md-8 col-md-offset-2">
        <div class="card">
          <div class="alert alert-success" role="alert" v-if="saved">Save successful!</div>
          <div class="alert alert-danger" role="alert" v-if="failed">Save failed!</div>
          <div class="alert alert-danger" role="alert" v-if="noData">No data found!</div>
          <form @submit.prevent="submitForm">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" required class="form-control" id="name" placeholder="Name" v-model="data.name">
            </div>
            <div class="form-group">
              <label for="contact">Contact Number</label>
              <input type="text" required class="form-control" id="contact" placeholder="Contact Number" v-model="data.contact_number">
            </div>
            <div class="form-group">
              <label for="email">email</label>
              <input type="email" required class="form-control" id="email" placeholder="Email" v-model="data.email">
            </div>
            <router-link to="/" class="btn col-md-2 col-md-offset-7">Cancel</router-link>
            <button class="btn btn-primary col-md-2 col-md-offset-1" type="submit" >Save</button>

          </form>
        </div>
      </div>
    </div>

  </div>

</template>
<script>
  export default {
    props: ['id'],
    data(){
      return {
        data: {
          name: '',
          contact_number: '',
          email: ''
        },
        saved: false,
        failed: false,
        noData: false,
      }
    },
    mounted(){
      this.initData();
    },
    methods: {
      initData(){
        axios.get('/' + this.id + '/edit')
        .then( response => {
          this.data = response.data;
        })
        .catch( error => {
          this.noData = true;
        })
      },
      submitForm(){
        this.saved = false;
        this.failed = false;
        axios.put('update/' + this.id, this.data)
        .then( response => {
          this.saved = true;
        })
        .catch( error => {
          this.failed = true;
        })
      }
    }
  }
</script>
