<template>
    <div>
        <router-link :to="{name: 'StoryCreate'}" class="btn btn-success mb-2" >Create Story</router-link>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Content</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-if="stories.length > 0" v-for="story in stories" :key="story.id">
                <td>{{ story.id }}</td>
                <td>{{ story.title }}</td>
                <td>{{ story.description }}</td>
                <td>{{ story.content }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'StoryEdit', params: { id: story.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <!-- name: 'category-edit' là tên ở trong file app.js -->
                        <button class="btn btn-danger" @click="deleteStory(story.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                stories: []
            }
        },
        mounted() {
            this.axios
                .get('api/stories') //lấy dữ liệu in ra (get)
                .then(response => {
                    this.stories = response.data;
                })
                .catch(response => {
                    console.log(response);
                    alert('Not found');
                });
        },
        methods: {
            deleteStory(id) {
                if(confirm('Bạn có chắc chắn muốn xóa ?')) {
                    this.axios
                        .delete(`api/stories/delete/` + id) //xóa (delete)
                        .then(response => {
                            let i = this.stories.map(item => item.id).indexOf(id); // find index of your object
                            this.stories.splice(i, 1)
                        })
                        .catch(response => {
                            console.log(response);
                            alert('Error delete');
                        });
                }
            }    
        }
    }
</script>