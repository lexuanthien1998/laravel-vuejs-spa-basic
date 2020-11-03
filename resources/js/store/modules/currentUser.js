import Vue from "vue";
import axios from "axios";
import VueAxios from "vue-axios";
Vue.use(VueAxios, axios);

const state = {
    user: {
    }
};
const getters = {};
const actions = {
    getUser( {commit} ) {
        axios.get("/api/auth/current_user")
        .then( response => {
            commit('setUser', response.data);
        });
    },
    loginUser({}, user) {
        axios
        .post("/api/auth/login", {
            email: user.email,
            password: user.password
        })
        .then(response => {
            if(response.data.access_token) {
                //save token
                localStorage.setItem(
                    "token_user",
                    response.data.access_token
                )
                window.location.replace("/profile")
                console.log('đăng nhập thành công');
                // console.log(response.data.user.name);
            }
        })
    }
};
const mutations = {
    setUser(state, data) {
        state.user = data;
    }
};

export default {
    namespaced:true,
    state,
    getters,
    actions,
    mutations
}