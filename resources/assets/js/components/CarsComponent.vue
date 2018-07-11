<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Projekt samochodowy</h1>
            </div>
            <div class="col-md-2 col-md-offset-4 mt-2">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#car" @click="createCar()">
                    <i class="fas fa-plus"></i> Dodaj nowy
                </button>
            </div>
        </div>
        <hr>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Marka</th>
                <th scope="col">Model</th>
                <th scope="col">Rocznik</th>
                <th scope="col">Pojemność</th>
                <th scope="col">Akcje</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="v,k in cars">
                    <th scope="row">{{v.id}}</th>
                    <td>{{v.marka}}</td>
                    <td>{{v.model}}</td>
                    <td>{{v.rocznik}}</td>
                    <td>{{v.pojemnosc}}</td>
                    <td>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#car" @click="editCar(k)">Edytuj</button>
                        <button class="btn btn-danger" @click="deleteCar(k)">Usuń</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="modal fade" id="car" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Samochód</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="marka">Marka</label>
                            <input type="hidden" v-model="id">
                            <input type="text" id="marka" class="form-control" v-model="marka">
                        </div>
                        <div class="form-group">
                            <label for="model">Model</label>
                            <input type="text" id="model" class="form-control" v-model="model">
                        </div>
                        <div class="form-group">
                            <label for="pojemnosc">Pojemność</label>
                            <input type="number" id="pojemnosc" class="form-control" v-model="pojemnosc">
                        </div>
                        <div class="form-group">
                            <label for="rocznik">Rocznik</label>
                            <input type="number" id="rocznik" class="form-control" v-model="rocznik" >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="saveCar()">Zapisz</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                cars: {},
                id: null,
                marka: "",
                model: "",
                rocznik: "",
                pojemnosc: ""
            }
        },
        mounted() {
            this.getCars();
        },
        methods: {
            getCars () {
                var _self = this;
                axios.get('/cars').then(function (response) {
                    _self.cars = response.data.data;
                });
            },
            createCar () {
                this.id = null;
                this.marka = "";
                this.model = "";
                this.pojemnosc = "";
                this.rocznik = "";
            },
            editCar(i) {
                this.id = this.cars[i].id;
                this.marka = this.cars[i].marka;
                this.model = this.cars[i].model;
                this.pojemnosc = this.cars[i].pojemnosc;
                this.rocznik = this.cars[i].rocznik;

            },
            deleteCar (i) {
                var _self = this;
                var id = this.cars[i].id;
                axios.delete('/cars/' + id).then(function (response) {
                    _self.getCars();
                });
            },
            saveCar () {
                var car = {
                    "marka": this.marka,
                    "model": this.model,
                    "pojemnosc": this.pojemnosc,
                    "rocznik": this.rocznik,
                }
                var _self = this;
                if (this.id != null) {
                    axios.put('/cars/' + this.id, car).then(function (response) {
                        _self.getCars();
                    });
                } else {
                    axios.post('/cars', car).then(function (response) {
                        _self.getCars();
                    });
                }
            }
        }
    }
</script>
