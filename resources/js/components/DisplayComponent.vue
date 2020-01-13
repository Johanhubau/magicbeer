<template>
    <div class="container vh-100" style="background-color: #f7e9c2">
        <div class="row h-75 justify-content-around">
            <div class="col-sm mr-4">
                <div class="row justify-content-around" style="margin-top: auto; margin-bottom: auto;">
                    <div v-for="house in houses" class="col-6" >
                        <img :src="images[house.id-1]" :alt="house.name" class="w-100">
                        <h3 class="text-center">{{house.points}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-sm ml-4" style="margin-top: auto; margin-bottom: auto;">
                <h1 class="potter text-center">{{wining.name}} est en tête!</h1>
                <apexchart width="500" type="bar" :options="options" :series="series"></apexchart>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "DisplayComponent",

        data() {
            return {
                houses: [],
                // houses: [{id: 1, name: "One"}, {id: 2, name: "Two"}],
                images: ['../images/Gryffindor.png', '../images/Hufflepuff.png', '../images/Ravenclaw.png', '../images/Slytherin.png'],
            }
        },

        computed: {
            options: function () {
                let names = [];
                this.houses.forEach(house => {
                    names.push(house.name);
                });
                return {
                    charts: {
                        id: 'vuechart-example'
                    },
                    xaxis: {
                        categories: names
                    },
                    dataLabels: {
                        enabled: false
                    },
                    colors: this.wining.color,
                };
            },
            series: function () {
                let temp = [];
                this.houses.forEach(house => {
                    temp.push(house.points);
                });
                return [{
                    name: 'houses',
                    data: temp
                }];
            },
            wining: function () {
                let temp = [];
                this.houses.forEach(house => {
                    temp.push(house.points);
                });
                let max = Math.max.apply(null, temp);
                let index = this.houses.findIndex((obj => obj.points == max));
                return this.houses[index];
            }
        },

        methods: {
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
        }
        ,
        mounted() {
            //Initial Load
            this.loadData();
            setInterval(function () {
                this.loadData()
            }.bind(this), 60000);
        }
    }
</script>

<style scoped>
</style>
