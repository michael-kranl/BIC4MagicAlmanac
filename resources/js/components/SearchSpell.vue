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
                        <div class="field">
                            <label class="label">Search: name/quote/description</label>
                            <div class="control">
                                <input class="input" type="text" placeholder="Search" v-model="inputSearch">
                            </div>
                        </div>
                        <div v-if="form.spells.length > 0 && inputSearch ">
                            <table class="table is-hoverable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Quote</th>
                                    <th>Description</th>
                                    <th>Spell kind</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="spell in form.spells " @dblclick="showSpell(spell)">
                                    <td>{{spell.id}}</td>
                                    <td>{{spell.name}}</td>
                                    <td>{{spell.quote}}</td>
                                    <td>{{spell.description}}</td>
                                    <td v-for="kind in form.kinds" v-if="kind.id == spell.kind_id">{{kind.name}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    let form = new Form({
        'kinds': [],
        'spells': [],
    });

    export default {
        props: ['title'],
        data() {
            return {
                form: form,
                inputSearch: null,
            };
        },
        watch: {
            inputSearch: function() {
                this.search();
            }
        },
        methods: {
            search() {
                axios.post('/search/spell?q='+this.inputSearch)
                    .then(response => {
                        this.form.spells = response.data})
                    .catch(error => {
                        console.log(error, error.status)});
            },
            showSpell(spell){
                window.location.href = '/spell/' + spell.slug;
            }
        },
        created() {
            axios.get('/list/kind')
                .then(response => {
                    this.form.kinds = response.data
                })
                .catch(error =>
                    {console.log(error.data, error.status)});
        }
    }
</script>

<style scoped>

</style>
