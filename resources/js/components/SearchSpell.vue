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
                        <div v-if="spells.length > 0 && inputSearch ">
                            <table class="table is-hoverable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Quote</th>
                                    <th>Description</th>
                                    <th>Kind_ID</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="spell in spells " @dblclick="showSpell(spell)">
                                    <td>{{spell.id}}</td>
                                    <td>{{spell.name}}</td>
                                    <td>{{spell.quote}}</td>
                                    <td>{{spell.description}}</td>
                                    <td>{{spell.kind_id}}</td>
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
    export default {
        props: ['title'],
        data() {
            return {
                spells: [],
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
                    this.spells = response.data})
                .catch(error => {
                    this.statusErr = 1,
                        console.log(error, error.status)
                });
            },
            showSpell(spell){
                window.location.href = '/spell/' + spell.slug;
            }
        }
    }
</script>

<style scoped>

</style>
