<template>
    <div class="container">
        <div class="form-group">
            <router-link to="/" class="btn btn-success">Назад</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Добавление сотрудника</div>
            <div class="panel-body">
                <form v-on:submit="saveForm()">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">ФИО Сотрудника</label>
                            <input type="text" v-model="worker.name" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Должность</label>
                            <input type="text" v-model="worker.position_id" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Дата трудоустройства</label>
                            <input type="date" v-model="worker.date_start" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Зарплата</label>
                            <input type="text" v-model="worker.salary" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Уровень иерархии</label>
                            <input type="text" v-model="worker.level" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">ID начальника</label>
                            <input type="text" v-model="worker.manager_id" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <button class="btn btn-success">Создать</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                worker: {
                    name: '',
                    position_id: '',
                    date_start: '',
                    salary: '',
                    level: '',
                    manager_id: '',
                    image: '',
                },

            }
        },
        methods: {
            saveForm() {
                event.preventDefault();
                var app = this;
                var newWorker = app.worker;
                axios.post('/api/v1/workers', newWorker)
                    .then(function (resp) {
                        app.$router.push({path: '/'});
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your worker");
                    });
            }
        }
    }
</script>
