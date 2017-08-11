<template>
    <tr>
        <td>
            <span>{{ data.user.name }}</span>
            <input type="hidden" v-model="editForm.id" >
            <input type="hidden" v-model="editForm.user_id">
        </td>
        <td>
            <input type="text" class="form-control" v-if="edit" v-model="editForm.title">
            <span v-else>{{ data.title }}</span>
        </td>
        <td>
            <textarea class="form-control" v-if="edit" v-model="editForm.description"></textarea>
            <span v-else>{{ data.description }}</span>
        </td>
        <td>
            <button class="btn btn-info" v-if="edit" v-on:click="cancelEdit">Cancel</button>
            <button class="btn btn-success" v-if="edit" v-on:click="productUpdate(data,editForm)">Save</button>
            <button class="btn btn-warning" v-if="!edit" v-on:click="editProduct">Edit</button>
            <button class="btn btn-danger" v-on:click="$emit('delete-product',data)" v-if="!edit">Delete</button>
        </td>
    </tr>
</template>
<script>
    export default {
        props: ['data'],
        data() {
            return {
                edit: false,
                editForm: {
                    id:'',
                    user_id: '',
                    title: '',
                    description: ''
                }
            }
        },
        methods: {
            editProduct() {
                this.edit = true;
                this.editForm.title = this.data.title;
                this.editForm.description = this.data.description;
                this.editForm.id = this.data.id;
                this.editForm.user_id = this.data.user_id;
            },
            cancelEdit() {
                this.edit = false;
            },
            productUpdate(oldProduct,newProduct) {
                this.edit = false;
                axios.post('/home/update/'+oldProduct.id,newProduct).then(response => {
                    this.$emit('update-product');
                });

            }
        }
    }
</script>
<style lang="css"></style>