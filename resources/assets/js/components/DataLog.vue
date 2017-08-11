<template>
    <div>
        <form v-on:submit.prevent="createProduct" method="post">
            <div class="form-group">
                <label for="title-id">Title</label>
                <input type="text" class="form-control" id="title-id" v-model="data.title">
            </div>
            <div class="form-group">
                <label for="description-id">Description</label>
                <input type="text" class="form-control" id="description-id" v-model="data.description">
            </div>
            <button class="btn btn-primary" type="submit">Create Product</button>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>By(Username)</td>
                    <td>Title</td>
                    <td>Description</td>
                    <td>Status</td>
                </tr>
            </thead>
            <tbody>
                <single-data-log v-for="data in allData" v-bind:data="data" v-on:delete-product="deleteProduct" v-on:update-product="fetchData"></single-data-log>
            </tbody>
        </table>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                allData: [],
                data: {
                    user: '',
                    id: '',
                    title: '',
                    description: ''
                }
            }
        },
        created() {
            this.fetchData();
        },
        methods: {
            fetchData() {
                axios.get('/home/all').then(response => {
                    this.allData = response.data.products;
                });
            },
            createProduct() {
                axios.post('/home/create',this.data).then(response => {
//                  this.allData.push(response.data.product);
                    this.data = {title: '',description: ''};
                    if(response.data.verrors){
                        console.log(response.data.verrors);
                    }
                    this.allData.push(response.data.product);
                });

            },
            deleteProduct($data){
                axios.post('/home/delete/'+$data.id).then(response => {
                    let index = this.allData.indexOf($data);
                    this.allData.splice(index,1);
                });
            }
        }
    }
</script>
<style lang="css">

</style>