<template>
<div>
    <div class="row">
        <div class="col-12">
            <nav aria-label="active">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Active</li>
                </ol>
            </nav>
            <ul class="list-group" v-for="article in active">
                <li class="d-flex justify-content-between align-items-center list-group-item">{{ article.name }}: {{ article.value }} points<button class="btn btn-warning btn-sm" @click="deactivate(article.id)">Désactiver</button></li>
            </ul>
        </div>
    </div>
    <div class="row pt-3">
        <div class="col-12">
            <nav aria-label="notactive">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Not Active</li>
                </ol>
            </nav>
            <ul class="list-group" v-for="article in notActive">
                <li class="d-flex justify-content-between align-items-center list-group-item">{{ article.name }}: {{ article.value }} points<button class="btn btn-warning btn-sm" @click="activate(article.id)">Activer</button></li>
            </ul>
        </div>
    </div>
    <div class="row pt-3">
        <div class="col-12">
            <a class="btn btn-secondary btn-block" :href="route" role="button">Create</a>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        name: "AdminComponent",
        props: ['connecteduser', 'route'],
        data() {
            return {
                articles: [],
            }
        },
        computed: {
            active: function() {
                return this.articles.filter(article => {
                    return article.active == 1;
                });
            },
            notActive: function() {
                return this.articles.filter(article => {
                    return article.active == 0;
                });
            }
        },
        methods: {
            activate(id) {
                let data = {
                    active: '1'
                };
                console.log(data);
                axios.post('/api/articles/' + id, data).then((response) => {
                    console.log(response);
                    let index = this.articles.findIndex((obj => obj.id == id));
                    this.articles[index].active = 1;
                    Vue.$toast.open({
                        message: "200: L'article a bien été activé",
                        duration: 3000,
                    });
                }).catch(error => {
                    console.log(error.response);
                    Vue.$toast.open({
                        message: 'Error: ' + error.response.data.message,
                        duration: 3000,
                        type: 'error'
                    });
                });
            },
            deactivate(id) {
                let data = {
                    active: 0
                };
                console.log(data);
                axios.post('/api/articles/' + id, data).then((response) => {
                    console.log(response);
                    let index = this.articles.findIndex((obj => obj.id == id));
                    this.articles[index].active = 0;
                    Vue.$toast.open({
                        message: "200: L'article a bien été désactivé",
                        duration: 3000,
                    });
                }).catch(error => {
                    console.log(error.response);
                    Vue.$toast.open({
                        message: 'Error: ' + error.response.data.message,
                        duration: 3000,
                        type: 'error'
                    });
                });
            },
            loadData() {
                axios.get('/api/articles').then((response) => {
                    this.articles = response.data;
                    Vue.$toast.open({
                        message: "200: Fetched " + response.data.length + " articles",
                        duration: 500,
                    });
                }).catch(error => {
                    console.log(error);
                    Vue.$toast.open({
                        message: 'Error: ' + error.response.data.message,
                        duration: 3000,
                        type: 'error'
                    });
                });
                // axios.get('/api/houses', function (response) {
                //     this.houses = response.houses;
                // }.bind(this));
            }
        },
        mounted () {
            //Initial Load
            this.loadData();
            setInterval(function() {this.loadData()}.bind(this), 60000);
        }
    }
</script>

<style scoped>

</style>
