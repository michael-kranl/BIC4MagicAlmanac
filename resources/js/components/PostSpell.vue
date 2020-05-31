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
                            <label class="label">Name</label>
                            <div class="control">
                                <input class="input" type="text" v-model='name' name="name" placeholder="Kind Name">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Quote</label>
                            <div class="control">
                                <textarea class="textarea" placeholder="quote description" v-model="quote"/>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Description</label>
                            <div class="control">
                                <textarea class="textarea" placeholder="Spell description" v-model="description" rows="10"/>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Kind_ID</label>
                            <div class="control">
                                <input class="input" type="number" v-model="kind_id">
                            </div>
                        </div>
                        <div class="control">
                            <input type="submit" value="Add to DB" @click="addSpell" class="button is-success is-rounded">
                        </div>
                        <br>
                        <div v-if="statusErr === 1" >
                            <article class="message is-danger">
                                <div class="message-body">
                                    This name is already assigned or/and no quote/description/kind_id has been added. <strong>Please try again!!!</strong>
                                </div>
                            </article>
                        </div>
                        <div v-if="statusErr === 2" >
                            <article class="message is-success">
                                <div class="message-body">
                                    The new Spell with the name <strong>{{statusName}}</strong> , was successfully added to the DB.
                                </div>
                            </article>
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
                name: '',
                quote: '',
                description: '',
                kind_id: 0,
                statusErr: 0,
                statusName: '',
            }
        },
        methods: {
            addSpell() {
                let name = this.name;
                let quote = this.quote;
                let description = this.description;
                let kind_id = this.kind_id;

                axios.post('/spell', {
                    name,
                    quote,
                    description,
                    kind_id
                })
                .then(response => {
                    this.statusErr = 2,
                    console.log(response)})
                .catch(error => {
                    this.statusErr = 1,
                        console.log(error, error.status)
                });

                this.statusName = this.name;
                this.statusErr = 0;
                this.name = '';
                this.quote = '';
                this.description = '';
                this.kind_id = 0;
            }
        }
    }
</script>

<style scoped>

</style>
