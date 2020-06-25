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
                        <table class="table is-hoverable">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Quote</th>
                                <th>Description</th>
                                <th>Spell kind</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="spell in form.spells " @dblclick="showSpell(spell)">
                                <td>{{spell.name}}</td>
                                <td>{{spell.quote}}</td>
                                <td>{{spell.description}}</td>
                                <td v-for="kind in form.kinds" v-if="kind.id == spell.kind_id"><a @click="showKind(kind)">{{kind.name}}</a></td>
                            </tr>
                            </tbody>
                        </table>
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
        props: {
            allSpells: {
                type: Array,
                required: true
            },
            title: {
                type: String,
                required: true
            },
        },
        data() {
            return {
                form: form,
            }
        },
        methods: {
            showSpell(spell){
                window.location.href = '/spell/' + spell.slug;
            },
            showKind(kind){
                window.location.href = '/kind/' + kind.slug;
            }
        },
        created() {
            /*axios.get('/list/spell')
                .then(response => {
                    this.form.spells = response.data})
                .catch(error =>
                    {console.log(error.data, error.status)});*/
            this.form.spells = this.allSpells;

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
