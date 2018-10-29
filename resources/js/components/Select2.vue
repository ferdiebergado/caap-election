<template>
  <select>
    <slot></slot>
  </select>    
</template>
<script>
export default {
  props: ["table", "value"],
  data() {
    return {
      options: {}
    };
  },
  mounted: function() {
    var vm = this;
    $(this.$el)
      // init select2
      .select2({ data: this.options })
      .val(this.value)
      .trigger("change")
      // emit event on change.
      .on("change", function() {
        vm.$emit("input", this.value);
      });
    this.getData();
  },
  methods: {
    getData() {
      axios
        .get("/" + this.table)
        .then(res => {
          this.options = res.data.data;
        })
        .catch(e => {
          console.log(e.response.data);
        });
      //   this.options = res.data.data;
    }
  },
  watch: {
    value: function(value) {
      // update value
      $(this.$el)
        .val(value)
        .trigger("change");
    },
    options: function(options) {
      // update options
      $(this.$el)
        .empty()
        .select2({ data: options });
    }
  },
  destroyed: function() {
    $(this.$el)
      .off()
      .select2("destroy");
  }
};
</script>
