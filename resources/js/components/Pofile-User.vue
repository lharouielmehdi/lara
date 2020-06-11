<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 mt-4">
        <!-- Widget: user widget style 1 -->
        <div class="card card-widget widget-user">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="widget-user-header bg-info">
            <h3 class="widget-user-username">{{form.name | keys}}</h3>
            <h5 class="widget-user-desc">{{form.type}}</h5>
          </div>
          <div class="widget-user-image">
            <img class="img-circle elevation-2" alt="User Avatar" :src="photo()" />
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-sm-4 border-right">
                <div class="description-block">
                  <h5 class="description-header">3,200</h5>
                  <span class="description-text">SALES</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-4 border-right">
                <div class="description-block">
                  <h5 class="description-header">13,000</h5>
                  <span class="description-text">FOLLOWERS</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-4">
                <div class="description-block">
                  <h5 class="description-header">35</h5>
                  <span class="description-text">PRODUCTS</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
        </div>
        <!-- /.widget-user -->
        <ul class="nav nav-pills mt-4 md-12">
          <li class="nav-item">
            <a class="nav-link active" href="#activity" data-toggle="tab">Activity</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
          </li>
        </ul>
        <div class="card-body">
          <div class="tab-content">
            <div class="tab-pane" id="activity">
              <!-- Post -->

              <!-- Post -->
              <div class="post">
                <!-- /.row -->

                <input
                  class="form-control form-control-sm"
                  type="text"
                  placeholder="Type a comment"
                />
              </div>
              <!-- /.post -->
            </div>

            <div class="tab-pane active" id="settings">
              <form class="form-horizontal">
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input
                      type="email"
                      class="form-control"
                      v-model="form.name"
                      id="inputName"
                      placeholder="Name"
                      :class="{
                                        'is-invalid': form.errors.has(
                                            'name'
                                        )
                                    }"
                    />
                    <has-error :form="form" field="name"></has-error>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input
                      type="email"
                      class="form-control"
                      id="inputEmail"
                      v-model="form.email"
                      placeholder="Email"
                      :class="{
                                        'is-invalid': form.errors.has(
                                            'email'
                                        )
                                    }"
                    />
                    <has-error :form="form" field="email"></has-error>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputName2" class="col-sm-2 col-form-label">Phone</label>
                  <div class="col-sm-10">
                    <input
                      type="text"
                      class="form-control"
                      id="inputName2"
                      v-model="form.phone"
                      placeholder="phone"
                    />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                  <div class="col-sm-10">
                    <textarea
                      class="form-control"
                      id="inputExperience"
                      v-model="form.bio"
                      placeholder="Experience"
                    ></textarea>
                  </div>
                </div>

                <!--    <div class="form-group row">
                  <label for="photo" class="col-sm-2 control-label">profile photo</label>
                  <div class="col-sm-12">
                    <input type="file" class="form-input" name="photo" />
                  </div>
                </div>
                -->
                <div class="form-group row">
                  <label for="passpord" class="col-sm-12 control-label">Password</label>
                  <div class="col-sm-12">
                    <input
                      type="password"
                      class="form-control"
                      id="passpord"
                      v-model="form.password"
                      placeholder="passpord"
                      :class="{
                                        'is-invalid': form.errors.has(
                                            'password'
                                        )
                                    }"
                    />
                    <has-error :form="form" field="password"></has-error>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button
                      type="submit"
                      @click.prevent="updateProfile"
                      class="btn btn-danger"
                    >Submit</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: new Form({
        id: "",
        name: "",
        email: "",
        password: "",
        phone: "",
        type: "",
        bio: ""
      })
    };
  },
  methods: {
    photo() {
      return "img/user.png";
    },
    updateProfile() {
      this.$Progress.start();
      this.form
        .put("api/profile")
        .then(() => {
          Toast.fire({
            icon: "success",
            title: "Updated user successfully"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    }
  },
  computed: {
    username() {
      // We will see what `params` is shortly
      return this.$route.params.username;
    }
  },

  mounted() {
    console.log("Component mounted.");
  },
  created() {
    axios.get("api/profile").then(({ data }) => this.form.fill(data));
  }
};
</script>
