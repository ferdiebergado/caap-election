<template>
    <div class="input-group">
        <select class="form-control" v-model="val" @change="updateVal">
            <option value="">Select</option>
            <option v-for="val in values" :key="val.id" :value="val.id">{{ val.name }}</option>
        </select>
        <div class="input-group-append">
            <span class="input-group-text"><a href="javascript:void();" data-toggle="modal" data-target="#role-form" title="Create Role"><i class="fa fa-plus-circle"></i></a></span>
        </div>
        <role-form @role-created="refreshRoles"></role-form>
    </div>
</template>
<script>
import OfficeForm from "./OfficeForm.vue";
export default {
  name: "office-select",
  components: {
    OfficeForm
  },
  data() {
    return {
      role: "",
      roles: {}
    };
  },
  mounted() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      var vm = this;
      axios
        .get("/" + this.table)
        .then(res => {
          vm.$set(vm.$data, "roles", res.data);
        })
        .catch(err => {
          alert(err.response.data);
          console.log(err.response.data);
        });
    },
    updateRole() {
      function checkRole(role) {
        return role.id === this;
      }
      var role = this.roles.find(checkRole, this.role);
      this.$emit("role-selected", role);
    },
    resetRole() {
      this.role = "";
    },
    refreshRoles() {
      this.fetchRoles();
      $("#role-form").modal("hide");
    }
  }
};
</script>
