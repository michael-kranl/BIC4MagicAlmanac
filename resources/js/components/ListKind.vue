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
                                <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="kind in kinds " @dblclick="showKind(kind)">
                                <td>{{kind.id}}</td>
                                <td>{{kind.name}}</td>
                                <td>{{kind.description}}</td>
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
    export default {
        props: ['title'],
        data() {
            return {
                kinds: []
            }
        },
        methods: {
            showKind(kind){
                window.location.href = '/kind/' + kind.slug;
            }
        },
        created() {
            axios.get('/list/kind')
            .then(response => {
                this.kinds = response.data})
            .catch(error =>
                {console.log(error.data, error.status)});
        }
    }
</script>

<style scoped>

</style>
