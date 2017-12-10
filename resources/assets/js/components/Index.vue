<template>
  <div>

    <div class="row" style="margin-top:50px">
      <div class="col-md-8 col-md-offset-2">
        <div class="row">
          <div class="alert alert-success" role="alert" v-if="deleted">Delete successful!</div>
          <div class="alert alert-danger" role="alert" v-if="failed">Delete failed!</div>

          <div class="col-md-4">
            <router-link to="/create"><button class="btn btn-primary">New</button></router-link>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <vue-table
            ref="vuetable"
            api-url="/get-contacts"
            data-path="data"
            pagination-path=""
            @vuetable:pagination-data="onPaginationData"
            :fields="fields">
            <template slot="actions" slot-scope="props">
              <div class="custom-actions">
                <button class="ui basic button"
                  @click="edit(props.rowData, props.rowIndex)">
                  <i class="glyphicon glyphicon-pencil"></i>
                </button>
                <button class="ui basic button"
                  @click="destroy( props.rowData, props.rowIndex)">
                  <i class="glyphicon glyphicon-trash"></i>
                </button>
              </div>
            </template>
          </vue-table>
            <vuetable-pagination :css="pagination" ref="pagination" @vuetable-pagination:change-page="onChangePage"></vuetable-pagination>
          </div>
        </div>
      </div>
    </div>

  </div>

</template>
<script>
  export default {
    data(){
      return {
        fields: [
          { name: 'name', sortField: 'name' },
          { name: 'contact_number', sortField: 'contact_number', title: 'Contact Number' },
          { name: 'email', sortField: 'email' },
          {
            name: '__slot:actions',   // <----
            title: 'Actions',
            titleClass: 'center aligned',
            dataClass: 'center aligned'
          }
        ],
        pagination: {
          wrapperClass: "pagination pull-right",
          activeClass: "btn-primary",
          disabledClass: "disabled",
          pageClass: "btn btn-border",
          linkClass: "btn btn-border",
          icons: {
            first: "",
            prev: "",
            next: "",
            last: ""
          }
        },
        deleted: false,
        failed: false
      }
    },
    methods:{
      onPaginationData (paginationData) {
        this.$refs.pagination.setPaginationData(paginationData)
      },
      onChangePage (page) {
        this.$refs.vuetable.changePage(page)
      },
      edit(data, index){
        this.$router.push('/update/'+ data.id)
      },
      destroy(data, index){
        this.deleted = false;
        this.failed = false;
        axios.delete('destroy/' + data.id)
          .then( response => {
            this.deleted = true;
            this.$refs.vuetable.tableData.splice(index, 1);
          })
          .catch( error => {
            this.failed = true;
          })
      }
    }
  }
</script>
