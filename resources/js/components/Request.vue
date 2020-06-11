<template>
  <div class="container">
    <div class="row mt-5">
      <div class="col-md-12">
        <flash-message position="right bottom"></flash-message>

        <div class="card-header">
          <h3 class="card-title">post</h3>
          <div class="card-tools">
            <button>
              <router-link to="/add_post">POST Add</router-link>
              <i class="fas fa-user-plus"></i>
            </button>
            <button>
              <router-link to="/detail">owen POST</router-link>
              <i class="fas fa-user"></i>
            </button>
          </div>
        </div>
        <div class="row" id="app">
          <div class="col-sm-4 col-md-3" v-for="post in posts" :key="post.id">
            <div class="thumbnail">
              <img :src="photo()" alt="..." class="img-thumbnail" />
              <div class="caption">
                <h3>
                  {{post.namee}}
                  <br />
                  <h6>{{post.name}}</h6>
                </h3>
                <p>{{post.ville}}</p>
                <p>
                  <a @click="editModal(post)" class="btn btn-primary" role="button">modifay</a>
                  <a @click=" postDelete(post.id)" class="btn btn-warning" role="button">supprimer</a>
                  <a @click=" detail(post)" class="btn btn-danger" role="button">detail</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

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
            <h5
              v-show="!mode"
              class="modal-title"
              id="addnewLabel"
              style="text-align: center"
            >THE INFORMATION OF {{form.owner}}</h5>
            <h5 v-show="mode" class="modal-title" id="addnewLabel">update info</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="mode ? UpdatePost() : detail()">
            <div class="modal-body">
              <div class="form-group">
                <label>name</label>
                <br v-show="!mode" />
                <strong class="list-group-item list-group-item-secondary">{{form.namee }}</strong>
                <input
                  v-show="mode"
                  v-model="form.namee"
                  type="text"
                  name="namee"
                  class="form-control"
                  placeholder="name"
                  :class="{
                                        'is-invalid': form.errors.has('namee')
                                    }"
                />
                <has-error :form="form" field="namee"></has-error>
              </div>
              <div class="form-group">
                <label>description</label>
                <br v-show="!mode" />
                <strong class="list-group-item list-group-item-primary">{{form.description }}</strong>
                <br v-show="!mode" />
                <textarea
                  v-show="mode"
                  v-model="form.description"
                  type="text"
                  name="description"
                  class="form-control"
                  placeholder="description"
                  :class="{
                                        'is-invalid': form.errors.has(
                                            'discription'
                                        )
                                    }"
                ></textarea>
                <has-error :form="form" field="description"></has-error>
              </div>

              <div class="form-group">
                <label>date</label>
                <br v-show="!mode" />
                <strong class="list-group-item list-group-item-success">{{form.date | time}}</strong>
                <input
                  v-show="mode"
                  v-model="form.date"
                  type="date"
                  name="name"
                  class="form-control"
                  placeholder="date"
                  :class="{
                                        'is-invalid': form.errors.has('date')
                                    }"
                />
                <has-error :form="form" field="date"></has-error>
              </div>

              <div class="form-group">
                <label>city</label>
                <br v-show="!mode" />
                <strong class="list-group-item list-group-item-info">{{form.ville }}</strong>
                <input
                  v-show="mode"
                  v-model="form.ville"
                  type="text"
                  name="ville"
                  class="form-control"
                  placeholder="city"
                  :class="{
                                        'is-invalid': form.errors.has('ville')
                                    }"
                />
                <has-error :form="form" field="ville"></has-error>
              </div>

              <div class="form-group">
                <label>place</label>
                <br v-show="!mode" />
                <strong class="list-group-item list-group-item-warning">{{form.place }}</strong>
                <input
                  v-show="mode"
                  v-model="form.place"
                  type="number"
                  name="place"
                  class="form-control"
                  placeholder="place"
                  :class="{
                                        'is-invalid': form.errors.has('place')
                                    }"
                />
                <has-error :form="form" field="place"></has-error>
              </div>

              <div class="form-group">
                <label>owner</label>
                <br v-show="!mode" />
                <strong class="list-group-item list-group-item-danger">{{form.owner }}</strong>
                <input
                  v-show="mode"
                  v-model="form.owner"
                  type="text"
                  name="owner"
                  class="form-control"
                  placeholder="owner"
                  :class="{
                                        'is-invalid': form.errors.has('owner')
                                    }"
                />
                <has-error :form="form" field="owner"></has-error>
              </div>
              <div class="form-group">
                <label>owner phone</label>
                <br v-show="!mode" />
                <strong class="list-group-item list-group-item-dark">{{form.owner_phone }}</strong>
                <input
                  v-show="mode"
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
                <has-error :form="form" field="owner"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button v-show="mode" type="submit" class="btn btn-primary">update</button>
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
      posts: {},
      form: new Form({
        id: "",
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
    photo() {
      return "img/i.png";
    },
    loadComponent() {
      axios.get("api/post").then(({ data }) => (this.posts = data));
    },

    editModal(post) {
      this.mode = true;
      this.form.reset();
      $("#addnew").modal("show");
      this.form.fill(post);
    },
    UpdatePost() {
      this.form
        .put("api/post/" + this.form.id)
        .then(() => {
          $("#addnew").modal("hide");
          Toast.fire({
            icon: "success",
            title: "Updated user successfully"
          });
          this.loadComponent();
        })
        .catch(() => {});
    },
    postDelete(id) {
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
            .delete("api/post/" + id)
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
    detail(post) {
      this.mode = false;
      /* axios
        .get("api/post/" + id)
        .then(({ data }) => (this.$parent.detail = data));*/
      this.form.reset();
      $("#addnew").modal("show");
      this.form.fill(post);
    }
  },
  mounted() {
    console.log("Component mounted.");
  },
  created() {
    this.loadComponent();
    console.log(this.posts);
    //this.form.id = this.$parent.ui;
  }
};
</script>
