<template>
  <div class="container">
    <div class="row mt-5" v-if="$gate.isAdmin()">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">user table</h3>

            <div class="card-tools">
              <button class="btn btn-success" @click="newModal">
                ajouter
                <i class="fas fa-user-plus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>User</th>
                  <th>Date</th>
                  <th>role</th>
                  <th>modifay</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="user in users" :key="user.id">
                  <td>{{ user.id }}</td>
                  <td>{{ user.name }}</td>
                  <td>{{ user.created_at | time }}</td>
                  <td>{{ user.type }}</td>

                  <td>
                    <a href="#" @click="editModal(user)">
                      <i class="fa fa-edit orang"></i>
                    </a>
                    <a href="#" @click="DeleteUser(user.id)">
                      <i class="fa fa-trash red"></i>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>

    <div v-if="!$gate.isAdmin()">
      <not-found></not-found>
    </div>

    <!-- Modal -->
    <div
      class="modal fade"
      id="addnew"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addnewLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 v-show="!mode" class="modal-title" id="addnewLabel">ajouter</h5>
            <h5 v-show="mode" class="modal-title" id="addnewLabel">update info</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="mode ? userUpdate() : userCreate()">
            <div class="modal-body">
              <div class="form-group">
                <label>Username</label>
                <input
                  v-model="form.name"
                  type="text"
                  name="name"
                  class="form-control"
                  placeholder="name"
                  :class="{
                                        'is-invalid': form.errors.has('name')
                                    }"
                />
                <has-error :form="form" field="name"></has-error>
              </div>
              <div class="form-group">
                <label>password</label>
                <input
                  v-model="form.password"
                  type="password"
                  name="password"
                  class="form-control"
                  placeholder="password"
                  :class="{
                                        'is-invalid': form.errors.has(
                                            'password'
                                        )
                                    }"
                />
                <has-error :form="form" field="password"></has-error>
              </div>
              <div class="form-group">
                <label>email</label>
                <input
                  v-model="form.email"
                  type="text"
                  name="email"
                  class="form-control"
                  placeholder="email@...com"
                  :class="{
                                        'is-invalid': form.errors.has('email')
                                    }"
                />
                <has-error :form="form" field="email"></has-error>
                <div class="form-group">
                  <label>biographie</label>
                  <textarea
                    v-model="form.bio"
                    type="text"
                    name="bio"
                    class="form-control"
                    placeholder="biographie"
                    :class="{
                                            'is-invalid': form.errors.has('bio')
                                        }"
                  ></textarea>
                  <has-error :form="form" field="bio"></has-error>
                </div>
                <div class="form-group">
                  <label>phone</label>
                  <input
                    v-model="form.phone"
                    type="text"
                    name="phone"
                    class="form-control"
                    placeholder="+212*****"
                    :class="{
                                            'is-invalid': form.errors.has(
                                                'phone'
                                            )
                                        }"
                  />
                  <has-error :form="form" field="phone"></has-error>
                </div>
                <div class="form-group">
                  <label>type</label>
                  <select
                    v-model="form.type"
                    type="text"
                    name="type"
                    class="form-control"
                    :class="{
                                            'is-invalid': form.errors.has(
                                                'type'
                                            )
                                        }"
                  >
                    <option value>role of user</option>
                    <option value="admin">admin</option>
                    <option value="user">user</option>
                    <option value="test">outhr</option>
                  </select>
                  <has-error :form="form" field="type"></has-error>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button v-show="mode" type="submit" class="btn btn-success">update</button>
              <button v-show="!mode" type="submit" class="btn btn-primary">create</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      mode: false,
      users: {},
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
    userUpdate() {
      this.$Progress.start();
      this.form
        .put("api/user/" + this.form.id)
        .then(() => {
          $("#addnew").modal("hide");

          Toast.fire({
            icon: "success",
            title: "Updated user successfully"
          });
          this.$Progress.finish();

          this.loadComponent();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },

    newModal() {
      this.mode = false;
      this.form.reset();
      $("#addnew").modal("show");
    },
    editModal(user) {
      this.mode = true;
      this.form.reset();
      $("#addnew").modal("show");
      this.form.fill(user);
    },
    DeleteUser(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        if (result.value) {
          this.$Progress.start();
          this.form
            .delete("api/user/" + id)
            .then(() => {
              Swal.fire("Deleted!", "Your file has been deleted.", "success");

              this.loadComponent();

              this.$Progress.finish();
            })
            .catch(() => {
              Swal.fire(
                "Deleted!",
                "Your file not has been deleted.",
                "warnning"
              );
            });
        }
      });
    },
    userCreate() {
      this.$Progress.start();

      this.form
        .post("api/user")
        .then(() => {
          $("#addnew").modal("hide");

          Toast.fire({
            icon: "success",
            title: "create user successfully"
          });
          this.$Progress.finish();

          this.loadComponent();
        })
        .catch(() => {});
    },
    loadComponent() {
      if (this.$gate.isAdmin()) {
        axios.get("api/user").then(({ data }) => (this.users = data.data));
      }
    }
  },

  computed: {
    username() {
      // We will see what `params` is shortly
      return this.$route.params.username;
    }
  },

  created() {
    Fire.$on("serching", () => {
      let query = this.$parent.search;
      axios
        .get("api/search?q=" + query)
        .then(({ data }) => (this.users = data.data));
    });
    this.loadComponent();
  }
};
</script>
