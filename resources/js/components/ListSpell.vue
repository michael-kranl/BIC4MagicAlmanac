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
            }
        },
        methods: {
            showSpell(spell){
                window.location.href = '/spell/' + spell.slug;
            }
        },
        created() {
            axios.get('/list/spell')
                .then(response => {
                    this.form.spells = response.data})
                .catch(error =>
                {console.log(error.data, error.status)});
            axios.get('/list/kind')
                .then(response => {
                    //for (let idx = 0; idx < response.data.length; idx++) {
                        //this.form.kinds[response.data[idx].id] = response.data[idx];
                        this.form.kinds = response.data
                    //}
                })
        }
    }
</script>

<style scoped>

</style>
