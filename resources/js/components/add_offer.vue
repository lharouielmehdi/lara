<template>
  <div class="container">
    <div class="row mt-5">
      <div class="col-md-12">
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">add a new offer</h3>

            <div class="card-tools">
              <button
                type="button"
                class="btn btn-tool"
                data-card-widget="collapse"
                data-toggle="tooltip"
                title="Collapse"
              >
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <form @submit.prevent="CreatePost" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <label>name</label>
                <input
                  v-model="form.namee"
                  type="text"
                  name="namee"
                  class="form-control"
                  placeholder="name"
                  :class="{
                                        'is-invalid': form.errors.has(
                                            'namee'
                                        )
                                    }"
                />
                <has-error :form="form" field="namee"></has-error>
              </div>
              <div class="form-group">
                <label>description</label>
                <textarea
                  v-model="form.description"
                  type="text"
                  name="description"
                  class="form-control"
                  placeholder="description"
                  :class="{
                                            'is-invalid': form.errors.has('description')
                                        }"
                ></textarea>
                <has-error :form="form" field="description"></has-error>
              </div>

              <div class="form-group">
                <label>date</label>
                <input
                  v-model="form.date"
                  type="date"
                  name="name"
                  class="form-control"
                  placeholder="date"
                  :class="{
                                        'is-invalid': form.errors.has(
                                            'date'
                                        )
                                    }"
                />
                <has-error :form="form" field="date"></has-error>
              </div>

              <div class="form-group">
                <label>city</label>
                <input
                  v-model="form.ville"
                  type="text"
                  name="ville"
                  class="form-control"
                  placeholder="city"
                  :class="{
                                        'is-invalid': form.errors.has(
                                            'ville'
                                        )
                                    }"
                />
                <has-error :form="form" field="ville"></has-error>
              </div>

              <div class="form-group">
                <label>place</label>
                <input
                  v-model="form.place"
                  type="number"
                  name="place"
                  class="form-control"
                  placeholder="place"
                  :class="{
                                        'is-invalid': form.errors.has(
                                            'place'
                                        )
                                    }"
                />
                <has-error :form="form" field="place"></has-error>
              </div>

              <div class="form-group">
                <label>owner</label>
                <input
                  v-model="form.owner"
                  type="text"
                  name="owner"
                  class="form-control"
                  placeholder="owner"
                  :class="{
                                        'is-invalid': form.errors.has(
                                            'owner'
                                        )
                                    }"
                />
                <has-error :form="form" field="owner"></has-error>
              </div>
              <div class="form-group">
                <label>owner phone</label>
                <input
                  v-model="form.owner_phone"
                  type="text"
                  name="owner_phone"
                  class="form-control"
                  placeholder="owner_phone"
                  :class="{
                                        'is-invalid': form.errors.has(
                                            'owner_phone'
                                        )
                                    }"
                />
                <has-error :form="form" field="owner_phone"></has-error>
              </div>

              <div class="col-12">
                <button type="submit" class="btn btn-success float-right">Create new Porject</button>
              </div>
            </div>
          </form>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      posts: {},
      form: new Form({
        idd: "",
        namee: "",
        date: "",
        place: "",
        owner: "",
        ville: "",
        description: "",
        owner_phone: ""
      })
    };
  },
  methods: {
    CreatePost() {
      this.$Progress.start();

      this.form
        .post("api/offer")
        .then(() => {
          $("#addnew").modal("hide");

          Toast.fire({
            icon: "success",
            title: "create user successfully"
          });
          this.$Progress.finish();
          this.$router.push({ path: "Request" });
          this.VueFlashMessage.success({
            message: "the trib has aadi",
            time: 5000
          });
        })
        .catch(() => {});
    }
  },

  mounted() {
    console.log("Component mounted.");
  }
};
</script>
