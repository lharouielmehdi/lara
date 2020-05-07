<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">helo in our contry</div>

          <div class="card-body">I'm an example component.</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    username() {
      // We will see what `params` is shortly
      return this.$route.params.username;
    }
  },

  mounted() {
    console.log("Component mounted.");
  }
};
</script>
