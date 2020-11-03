<template>
  <div class="container mt-3">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse">
          <div class="navbar-nav">
            <router-link to="/" class="nav-item nav-link" >Home</router-link>
            <router-link :to="{name: 'Category'}" class="nav-item nav-link" >Category</router-link>
            <router-link :to="{name: 'Story'}" class="nav-item nav-link" >Story</router-link>

            <!-- <span v-if="!$auth.check()"> -->
              <router-link :to="{name: 'Login'}" class="nav-item nav-link" >Đăng Nhập</router-link>
              <router-link :to="{name: 'Register'}" class="nav-item nav-link" >Đăng Ký</router-link>
            <!-- </span>
            <span v-if="$auth.check()"> -->
              <button class="btn btn-danger" @click="logoutUser()">Đăng xuất </button>
            <!-- </span> -->

          </div>
        </div>
    </nav>
    <hr>
    <router-view></router-view>

  </div>
</template>

<script>
export default {
  data() {
      return {
          user: {}
      }
  },
  mounted() {
    this.axios
        .get('/api/auth/current_user')
        .then((response) => {
            this.user = response.data;
        });
  },
  // computed: {
  //   user_infomation: {
  //     get() {
  //       return this.$store.state.currentUser.user;
  //     }
  //   }
  // },
  methods: {
    logoutUser() {
      axios
      .post('/api/logout')
      .then( response => {
        localStorage.removeItem("token_user");
        this.$router.push({name: 'Login'})
      })
    }
  },
  // created() {
  //   axios.defaults.headers.common["Authorization"] = "Bearer " + localStorage.getItem("token_user");
  //   this.$store.dispatch('currentUser/getUser');
  // }
}
</script>
