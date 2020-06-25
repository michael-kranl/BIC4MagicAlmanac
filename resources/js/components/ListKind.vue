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
                                <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="kind in form.kinds " @dblclick="showKind(kind)">
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
    let form = new Form({
        'kinds': [],
    });

    export default {
        props: {
            allKinds: {
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
            showKind(kind){
                window.location.href = '/kind/' + kind.slug;
            }
        },
        created() {
            this.form.kinds = this.allKinds;
        }
    }
</script>

<style scoped>

</style>
