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
                                <label class="label">Spell List</label>
                                <table class="table is-hoverable">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Quote</th>
                                        <th>Description</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="spell in form.spells.spells" @dblclick="showSpell(spell)">
                                        <td style="font-size: small" >{{spell.id}}</td>
                                        <td style="font-size: small">{{spell.name}}</td>
                                        <td style="font-size: small">{{spell.quote}}</td>
                                        <td style="font-size: small">{{spell.description}}</td>
                                    </tr>
                                    </tbody>
                                </table>
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
        'kind': [],
        'spells': [],
    });

    export default {
        props: ['title', 'showKind'],
        data() {
            return {
                form: form,
            }
        },
        methods : {
            showSpell(spell){
                window.location.href = '/spell/' + spell.slug;
            },
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
            this.form.kind = this.showKind;

            axios.get('/kind/'+ this.form.kind.slug + '/detail')
                .then(response => {
                    this.form.spells = response.data;
                })
        }
    }
</script>

<style scoped>

</style>
