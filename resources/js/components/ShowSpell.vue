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
                        <div v-if="form.spell" >
                            <div class="field">
                                <label class="label">Slug</label>
                                <div class="control">
                                    <input class="input" type="text" v-model="form.spell.slug" disabled>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Name</label>
                                <div class="control">
                                    <input class="input" type="text" v-model="form.spell.name" disabled>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Quote</label>
                                <div class="control">
                                    <textarea class="textarea" v-model="form.spell.quote" disabled />
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Description</label>
                                <div class="control">
                                    <textarea class="textarea" v-model="form.spell.description" disabled />
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Spell kind</label>
                                <div class="control">
                                    <input class="input" type="text" v-model="form.kind.name" disabled>
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <label class="label-small">Updated am {{form.spell.updated_at}}</label>
                                </div>
                            </div>
                            <div class="control">
                                <input type="submit" value="Cancel" @click="cancelSpell" class="button is-dark is-rounded">
                                <input type="submit" value="Edit" @click="linkToEdit" class="button is-success is-rounded">
                                <div class="is-pulled-right">
                                    <input type="submit" value="Delete" @click="deleteSpell(form.spell)" class="button is-dark">
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
        'kind': [],
        'spell': [],
    });

    export default {
        props: ['title', 'showSpell'],
        data() {
            return {
                form: form,
            }
        },
        methods : {
            linkToEdit(){
                window.location.href = window.location.pathname + '/edit';
            },
            cancelSpell(){
                window.location.href = '/spell';
            },
            deleteSpell(spell){
                if (confirm("Do you really want to delete the element!")) {
                    axios.delete('/spell/' + spell.slug)
                        .then(response => {
                            console.log(response);
                            window.location.href = '/spell';
                        })
                        .catch(error =>
                        {console.log(error.data, error.status)});
                }
            }
        },
        created() {

            this.form.spell = this.showSpell;
            let kind_id = 0;
            kind_id = this.form.spell.kind_id;

            axios.get('/list/kind')
                .then(response => {
                    for (let idx = 0; idx < response.data.length; idx++) {
                        if (kind_id == response.data[idx].id){
                            this.form.kind = response.data[idx];
                            break;
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
