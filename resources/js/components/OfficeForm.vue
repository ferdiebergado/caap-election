<template>
    <!-- Modal -->
    <div class="modal fade" id="office-form" tabindex="-1" role="dialog" aria-labelledby="Role" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form @submit.prevent="save">
                    <div class="modal-header">
                        <h4 class="modal-title"> &nbsp;Create Office</h4>
                        <span class="float-right"><button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button></span>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="alert alert-danger" role="alert" v-if="error">
                                <strong>Error</strong> {{ error }}
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="name">Name <span><small class="text-muted">(Required)</small></span></label>
                                        <input type="text" class="form-control" name="name" id="name" v-model="role.name" required />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="priority">Priority</label>
                                        <input type="number" class="form-control" name="priority" id="priority" v-model="role.priority" />
                                    </div>
                                </div>
                            </div>
                        </div> <!-- container -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary float-left" data-dismiss="modal"><i class="fa fa-ban"></i> Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div> <!-- modal dialog -->
    </div> <!-- Modal -->
</template>
<script>
export default {
  name: "role-form",
  data() {
    return {
      office: {
        name: ""
      },
      error: ""
    };
  },
  methods: {
    save() {
      var vm = this;
      axios
        .post("/offices", this.office)
        .then(res => {
          console.table([res.data.data]);
          this.$emit("role-created");
          this.role = {};
        })
        .catch(err => {
          this.error = err.response.data.error;
        });
    }
  }
};
</script>
