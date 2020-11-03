<template>

  <!-- <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="collapse navbar-collapse">
          <div class="navbar-nav">
              <router-link :to="{name: 'Home'}" class="nav-item nav-link" >Home</router-link>
              <router-link :to="{name: 'Category'}" class="nav-item nav-link" >Category</router-link>
              <router-link :to="{name: 'Story'}" class="nav-item nav-link" >Story</router-link>

              <span v-if="currentUser.token_user === null">
                <router-link :to="{name: 'Login'}" class="nav-item nav-link" >Đăng Nhập</router-link>
                <router-link :to="{name: 'Register'}" class="nav-item nav-link" >Đăng Ký</router-link>
              </span>
              <span v-else> -->
                <button class="btn btn-danger" @click="logoutUser()">Đăng xuất {{ currentUser }}</button>
              <!-- </span>

          </div>
      </div>
    </nav>
    <hr>
  </div> -->

</template>

<script>
import {mapState} from 'vuex';
export default {
  props: {
    source: String,
  },
  data: () => ({
    drawer: null
  }),
  computed: {
    currentUser: {
      get() {
        return this.$store.state.currentUser.user;
      }
    }
  },
  methods: {
    logoutUser() {
      axios
      .post('/api/logout')
      .then( response => {
        // window.localStorage.removeItem('token_user')
        localStorage.removeItem("token_user");
        this.$router.push({name: 'Login'})
      })
    }
  },
  created() {
    axios.defaults.headers.common["Authorization"] = 'Bearer ' + localStorage.getItem("token_user");
    this.$store.dispatch('currentUser/getUser');
  }
}
</script>