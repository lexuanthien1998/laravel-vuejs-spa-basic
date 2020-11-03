<template>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                <strong>Đăng ký thành viên</strong>
            </div>
            <div class="panel-body">
                <form @submit.prevent="registerUser">
                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" placeholder="Enter your username" type="text"  v-model="user.name">
                    </div>

                    <div class="form-group">
                        <label>Địa chỉ Email</label>
                        <input class="form-control" placeholder="Enter your email address" type="text" v-model="user.email">
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input class="form-control" placeholder="Enter your pasword" type="password" v-model="user.password">
                    </div>
                    <button class="btn btn-success">Đăng ký</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                user: {}
            }
        },
        methods: {
            registerUser() {
                event.preventDefault();
                this.axios
                    .post('/api/register', this.user)
                    .then(response => (
                        this.$router.push({name: 'Login'})
                    ))
                    .catch(error => console.log(error));
                   
            }
        }
    }
</script>