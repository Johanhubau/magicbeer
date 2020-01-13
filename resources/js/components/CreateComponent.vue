<template>
    <div>
        <h1>Ajouter un article</h1>
        <form>
            <div class="form-row py-3">
                <div class="col-md-9 col">
                    <input id="name" v-model="name" type="text" class="form-control" placeholder="Nom de l'article">
                </div>
                <div class="col-md-3 col">
                    <input id="value" v-model="value" type="number" class="form-control" placeholder="Valeur en points">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <a @click="submit()" class="col btn btn-secondary text-light">Submit</a>
                </div>
                <div class="col">
                    <a class=" col btn btn-secondary text-light" :href="route" role="button">Back</a>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "CreateComponent",
        props: ['route'],
        data() {
            return {
                name: "",
                value: 0,
            }
        },
        methods: {
            submit() {
                let data = {
                    name: this.name,
                    value: this.value,
                    active: '1'
                };
                console.log(data);
                axios.post('/api/articles/', data).then((response) => {
                    console.log(response);
                    Vue.$toast.open({
                        message: "200: L'article a bien été ajouté",
                        duration: 3000,
                    });
                    this.reset();
                }).catch(error => {
                    console.log(error.response);
                    Vue.$toast.open({
                        message: 'Error: ' + error.response.data.message,
                        duration: 3000,
                        type: 'error'
                    });
                });
            },
            reset() {
                this.name = "";
                this.value = 0;
            }
        }
    }
</script>

<style scoped>

</style>
