<template>
    <div class="container">
        <h1>Statistiche</h1>
        <label for="month_filter">Filtra per mese</label>
        <select id="month_filter" name="month_filter" v-model="month" @change="getAllViews()">
            <option value="" disabled>Filtra per mese</option>
            <option value="all">Tutte</option>
            <option v-for="(month, index) in monthsSelect" :key="index" :value="month.number">{{month.name}}</option>
        </select>
        <div class="ms_chart_container">
            <canvas id="views-chart"></canvas>
        </div>
    </div>
</template>

<script>
import Chart from 'chart.js';

export default {

    name: 'Chart',

    data() {
        return {
            monthsSelect: [
                {
                    'name': 'Gennaio',
                    'number': '01'
                },
                {
                    'name': 'Febbraio',
                    'number': '02'
                },
                {
                    'name': 'Marzo',
                    'number': '03'
                },
                {
                    'name': 'Aprile',
                    'number': '04'
                },
                {
                    'name': 'Maggio',
                    'number': '05'
                },
                {
                    'name': 'Giugno',
                    'number': '06'
                },
                {
                    'name': 'Luglio',
                    'number': '07'
                },
                {
                    'name': 'Agosto',
                    'number': '08'
                },
                {
                    'name': 'Settembre',
                    'number': '09'
                },
                {
                    'name': 'Ottobre',
                    'number': '10'
                },
                {
                    'name': 'Novembre',
                    'number': '11'
                },
                {
                    'name': 'Dicembre',
                    'number': '12'
                }
            ],
            month: '',
        }
    },

    methods: {
        getAllViews() {
            let viewsData = [];
            console.log(viewsData);
            axios.get(`/api/show/statistics/${window.Laravel.id}/${this.month}`)
                .then(response => {
                    console.log(response);
                    for (const key in response.data.data) {
                        viewsData.push(response.data.data[key]);
                    }
                    console.log(viewsData);
                    const ctx = document.getElementById('views-chart');
                    ctx.innerHTML = '';
                    if(this.month == 'all') {
                        let lables = [];
                        this.monthsSelect.forEach(element => {
                            lables.push(element.name);
                        });
                        let data = [];
                        viewsData.forEach(element => {
                            data.push(element.length);
                        });
                        console.log(data);                        
                        let chart = new Chart(ctx, {
                        type: "line",
                        data: {
                            labels: lables,
                            datasets: [
                                {
                                    label: 'Tutte',
                                    data: data,
                                    backgroundColor: "rgba(54,73,93,.5)",
                                    borderColor: "#36495d",
                                    borderWidth: 3
                                },
                            ]
                        },
                        options: {
                            responsive: true,
                            lineTension: 1,
                            scales: {
                                yAxes: [
                                    {
                                        ticks: {
                                            beginAtZero: true,
                                            padding: 25
                                        }
                                    }
                                ]
                            }
                        }
                        });
                    }else {
                        let label = '';
                        this.monthsSelect.forEach(element => {
                            if (element.number == this.month){
                                label = element.name;
                            }
                        });
                        let chart = new Chart(ctx, {
                            type: "line",
                            data: {
                                labels: ["1^ Settimana", "2^ Settimana", "3^ Settimana", "4^ Settimana"],
                                datasets: [
                                    {
                                        label: `Visualizzazioni di ${label}`,
                                        data: [viewsData[0].length, viewsData[1].length, viewsData[2].length, viewsData[3].length],
                                        backgroundColor: "rgba(54,73,93,.5)",
                                        borderColor: "#36495d",
                                        borderWidth: 3
                                    },
                                ]
                            },
                            options: {
                                responsive: true,
                                lineTension: 1,
                                scales: {
                                    yAxes: [
                                        {
                                            ticks: {
                                                beginAtZero: true,
                                                padding: 25
                                            }
                                        }
                                    ]
                                }
                            }
                        });
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    },

    mounted() {
        let viewsData = []
        axios.get(`/api/show/statistics/${window.Laravel.id}/all`)
            .then(response => {
                console.log(response);
                for (const key in response.data.data) {
                    viewsData.push(response.data.data[key]);
                }
                console.log(viewsData);
                const ctx = document.getElementById('views-chart');
                ctx.innerHTML = '';
                let lables = [];
                this.monthsSelect.forEach(element => {
                    lables.push(element.name);
                });
                let data = [];
                viewsData.forEach(element => {
                    data.push(element.length);
                });
                console.log(data);                        
                let chart = new Chart(ctx, {
                    type: "line",
                    data: {
                        labels: lables,
                        datasets: [
                            {
                                label: 'Tutte',
                                data: data,
                                backgroundColor: "rgba(54,73,93,.5)",
                                borderColor: "#36495d",
                                borderWidth: 3
                            },
                        ]
                    },
                    options: {
                        responsive: true,
                        lineTension: 1,
                        scales: {
                            yAxes: [
                                {
                                    ticks: {
                                        beginAtZero: true,
                                        padding: 25
                                    }
                                }
                            ]
                        }
                    }
                });
            })
            .catch(function (error) {
                console.log(error);
            });
    }
}
</script>

<style lang="scss" scoped>
.ms_chart_container {
    max-width: 800px;
    margin: 0 auto;
    background-color: cornsilk;
}
</style>