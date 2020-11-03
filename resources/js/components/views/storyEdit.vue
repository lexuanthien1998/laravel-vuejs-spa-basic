<template>
    <div>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="editStory">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" v-model="story.title">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" v-model="story.description">
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <input type="text" class="form-control" v-model="story.content">
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                story: {
                    // title:''
                }
            }
        },
        mounted() {
            this.axios
               .get('/api/stories/edit/' + this.$route.params.id )
               .then((response) => {
                   this.story = response.data;
                    console.log(response.data);
                });
        },
        methods: {
            editStory() {
                this.loader = true;
                this.axios
                    .post('/api/stories/update/' + this.$route.params.id , this.story)
                    .then((response) => {
                        this.$router.push({name: 'Story'});
                    });
            }
        }
    }
</script>