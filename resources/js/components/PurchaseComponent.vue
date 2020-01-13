<template>
    <div class="container h-100">
        <div class="row justify-content-around" v-show="isHouseSelect">
            <div v-for="article in articles" class="col-md-4 col-6 w-100">
                <button @click="addPoints(article.id, article.value)" class="btn btn-secondary btn-lg my-3 w-100"
                        :style="'height: 100px;background-color: ' + houseColor">{{ article.name }}: {{ article.value }}
                </button>
            </div>
            <button class="btn btn-secondary w-100" @click="back()">Back</button>
        </div>
        <div class="row justify-content-around" v-show="!isHouseSelect">
            <div v-for="house in houses" class="col-md-6 w-100">
                <button @click="chosenHouse(house.id, house.color)" class="btn btn-secondary btn-lg my-3 w-100"
                        :style="'height: 100px;background-color: ' + house.color">{{ house.name }}: {{ house.points }}
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "PurchaseComponent",
        props: ["connecteduser", "articles"],

        data() {
            return {
                isHouseSelect: false,
                houseSelect: -1,
                houseColor: "",
                houses: [],
                // houses: [{id: 1, name: "One"}, {id: 2, name: "Two"}],
            }
        },

        computed: {},

        methods: {
            chosenHouse(id, color) {
                this.houseSelect = id;
                this.houseColor = color;
                this.isHouseSelect = true;
            },
            back() {
                this.isHouseSelect = false;
                this.houseColor = "";
                this.houseSelect = -1;
            },
            addPoints(articleId, points) {
                let data = {
                    author_id: this.connecteduser,
                    article_id: articleId,
                    house_id: this.houseSelect,
                    points: points
                };
                console.log(data);
                axios.post('/api/transactions', data).then((response) => {
                    console.log(response);
                    let index = this.houses.findIndex((obj => obj.id == data.house_id));
                    this.houses[index].points = this.houses[index].points + data.points;
                    Vue.$toast.open({
                        message: "200: Points donnés",
                        duration: 1000,
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
                axios.get('/api/houses').then((response) => {
                    this.houses = response.data;
                    Vue.$toast.open({
                        message: "200: Fetched " + response.data.length + " houses",
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
