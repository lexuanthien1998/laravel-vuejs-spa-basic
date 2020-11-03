<template>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                <strong>Đăng nhập</strong>
            </div>
            <div class="panel-body">
                <div>
                    <div class="form-group">
                        <label>Địa chỉ Email</label>
                        <input class="form-control" placeholder="Enter your email address" type="email"  v-model="user.email" required>
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input class="form-control" placeholder="Enter your email address" type="password"  v-model="user.password" required>
                    </div>
                    <button type="submit" @click="login" class="btn btn-primary">Đăng nhập</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        // computed: {
        //     user: {
        //         get() {
        //             return this.$store.state.currentUser.user
        //         }
        //     }
        // },
        data: () => ({
            user: {
                email: "",
                password: ""
            }
        }),
        methods: {
            login() {
                this.$store.dispatch('currentUser/loginUser', this.user);
            }
        }
    }
</script>