<template>
    <div class="container">
        <div class="columns is-multiline">
            <div class="card column is-half is-offset-one-quarter">
                <header class="card-header">
                    <h1 class="card-header-title">
                        {{ title }}
                    </h1>
                </header>
                <div class="card-content">
                    <div class="content">
                        <div v-if="form.kind" >
                            <div class="field">
                                <label class="label">Slug</label>
                                <div class="control">
                                    <input class="input" type="text" v-model="form.kind.slug" disabled>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Name</label>
                                <div class="control">
                                    <input class="input" type="text" v-model="form.kind.name" disabled>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Description</label>
                                <div class="control">
                                    <textarea class="textarea" v-model="form.kind.description" disabled />
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <label class="label-small">Updated am {{form.kind.updated_at}}</label>
                                </div>
                            </div>
                            <div class="control">
                                <input type="submit" value="Cancel" @click="cancelKind" class="button is-dark is-rounded">
                                <input type="submit" value="Edit" @click="linkToEdit" class="button is-success is-rounded">
                                <div class="is-pulled-right">
                                    <input type="submit" value="Delete" @click="deleteKind(form.kind)" class="button is-dark">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    let form = new Form({
        'kind': null,
    });

    export default {
        props: ['title'],
        data() {
            return {
                form: form,
            }
        },
        methods : {
            linkToEdit(){
                window.location.href = window.location.pathname + '/edit';
            },
            cancelKind(){
                window.location.href = '/kind';
            },
            deleteKind(kind){
                if (confirm("Do you really want to delete the element!")) {
                    axios.delete('/kind/' + kind.slug)
                        .then(response => {
                            console.log(response);
                            window.location.href = '/kind';
                        })
                        .catch(error =>
                        {console.log(error.data, error.status)});
                }
            }
        },
        created() {
            let urlElement  =  window.location.pathname.split('/');
            let kindElement = urlElement[2];

            axios.get('/list/kind')
                .then(response => {
                    for (let idx = 0; idx < response.data.length; idx++) {
                        if (kindElement == response.data[idx].slug){
                            this.form.kind = response.data[idx];
                        }
                    }
                })
                .catch(error => {
                    console.log(error, error.status)});
        }
    }
</script>

<style scoped>

</style>
