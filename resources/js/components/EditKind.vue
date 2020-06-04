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
                                    <input class="input" type="text" v-model="form.kind.name">
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Description</label>
                                <div class="control">
                                    <textarea class="textarea" v-model="form.kind.description"/>
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <label class="label-small">Updated am {{form.kind.updated_at}}</label>
                                </div>
                            </div>
                            <div class="control">
                                <input type="submit" value="Cancel" @click="cancelKind" class="button is-dark is-rounded">
                                <input type="submit" value="Update" @click="updateKind(form.kind)" class="button is-success is-rounded">
                            </div>
                            <br>
                            <div v-if="form.statusErr === 1" >
                                <article class="message is-danger">
                                    <div class="message-body">
                                        This name is already assigned or/and no description has been added. <strong>Please try again!!!</strong>
                                    </div>
                                </article>
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
        'statusErr': ''
    });

    export default {
        props: ['title'],
        data() {
            return {
                form: form,
            }
        },
        methods : {
            updateKind(kind){
                let name = kind.name;
                let description = kind.description;
                axios.put('/kind/' + kind.slug, {
                    name,
                    description
                })
                .then(response => {
                    window.location.href = '/kind/'})
                .catch(error => {
                    this.form.statusErr = 1;
                    console.log(error, error.status)});

                this.form.statusErr = 0;
            },
            cancelKind(){
                window.location.href = '/kind/';
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
