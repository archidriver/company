<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'createWorker'}" class="btn btn-success">Добавить</router-link>
            <button class="btn btn-outline-success mr-3" @click="visiblitySearch = !visiblitySearch">Поиск</button>
        </div>

               <div class="container" v-if="visiblitySearch">
                <td><tr><label>ФИО:</label></tr>
                    <tr><label>Должность:</label></tr>
                    <tr><label>Дата приёма:</label></tr>
                    <tr><label>Зарплата от</label></tr>
                    <tr><label>Уровень</label></tr>
                    <tr><label>ID Начальника</label></tr>
                </td>
                   <td><tr><input  type="text" placeholder="ФИО" v-model="inputName" /></tr>
                       <tr><input  type="text" placeholder="Должность" v-model="inputPosition" /></tr>
                       <tr><input  type="date" placeholder="Дата приёма" v-model="inputDate" /></tr>
                       <tr><input  type="number" v-model.number="minSalary" />До:<input  type="number" v-model.number="maxSalary" /></tr>
                       <tr><input  type="number" placeholder="Уровень иерархии" v-model="selectLevel" /></tr>
                       <tr><input  type="number" placeholder="ID начальника" v-model="inputManager" /></tr>
                   </td>
                   <button @click="clear" class="primary small">Сбросить поиск</button>
             </div>
        <div class="panel panel-default">
            <div class="panel-heading"><h3>Список сотрудников</h3> Сортировать по:
                <select v-model="selectSort">
                    <option v-for="rule in sortRules" :key="rule.key" :value="rule.key">{{ rule.title }}</option>
                </select>


            </div>

            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Должность</th>
                        <th>Дата приёма на работу</th>
                        <th>Зарплата</th>
                        <th>Уровень</th>
                        <th>ID начальника</th>
                        <th>Фото</th>
                        <th width="200">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="worker, index in filteredLevel">
                        <td>{{ worker.id }}</td>
                        <td>{{ worker.name }}</td>
                        <td>{{ worker.position_id }}</td>
                        <td>{{ worker.date_start }}</td>
                        <td>{{ worker.salary }}</td>
                        <td>{{ worker.level }}</td>
                        <td>{{ worker.manager_id }}</td>
                        <td><img class="img-thumbnail" :src="worker.image" :alt="worker.name"> </td>
                        <td>
                            <router-link :to="{name: 'editWorker', params: {id: worker.id}}" class="btn btn-xs btn-default">
                                Правка
                            </router-link>
                            <a href="#"
                               class="btn btn-xs btn-danger"
                               v-on:click="deleteEntry(worker.id, index)">
                                Удалить
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data: function () {
            return {
                workers: [],
                inputName: '',
                inputPosition: '',
                inputDate: '',
                maxSalary: 0,
                minSalary: 0,
                selectLevel: '',
                inputManager: '',

                sortRules: [
                    { key: 'id:asc', title: 'ID' },
                    { key: 'name:asc', title: 'ФИО' },
                    { key: 'position_id:asc', title: 'Должности' },
                    { key: 'date_start:asc', title: 'Дате приёма' },
                    { key: 'salary:asc', title: 'Зарплате' },
                    { key: 'level:asc', title: 'Уровень возростание' },
                    { key: 'level:desc', title: 'Уровень убывание' },
                    { key: 'manager_id:asc', title: 'Начальнику' },
                ],
                selectSort: '',
                visiblitySearch: false
            }
        },


        computed: {
            filteredLevel() {
                const filtered = this.workers
                    .filter(worker => {
                        return this.inputName == '' || worker.name.toLowerCase().indexOf(this.inputName.toLowerCase()) !== -1;
                     })
                    .filter(worker => {
                        return this.inputPosition == '' || worker.position_id.toLowerCase().indexOf(this.inputPosition.toLowerCase()) !== -1;
                    })
                    .filter(worker => {
                        return this.inputDate == 0 || worker.date_start == this.inputDate;
                    })
                    .filter(worker => {
                        return Number(worker.salary) >= this.minSalary && Number(worker.salary) <= this.maxSalary;
                    })
                    .filter(worker => {
                        return this.selectLevel == 0 || worker.level == this.selectLevel;
                    })
                    .filter(worker => {
                        return this.inputManager == 0 || worker.manager_id == this.inputManager;
                    })

                var sorted = _.sortBy(filtered, worker => {
                    return worker[this.sortKey];
                    //return Number(worker[this.sortKey]);
                });

                if (this.sortDir === 'desc') {
                    sorted = sorted.reverse();
                }
                return sorted;
            },
            sortKey: function() {
                return this.selectSort.split(':')[0];
            },
            sortDir: function() {
                return this.selectSort.split(':')[1];
            }

        },
        mounted() {
            var app = this;
            axios.get('/api/v1/workers')
                .then(function (resp) {
                    app.workers = resp.data;
                    app.maxSalary = app.getMaxSalary();
                    app.minSalary = app.getMinSalary();
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load workers");
                });
        },

        methods: {
            deleteEntry(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    var app = this;
                    axios.delete('/api/v1/workers/' + id)
                        .then(function (resp) {
                            app.workers.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Could not delete worker");
                        });
                }
            },

            getMaxSalary: function() {
                return Number(_.maxBy(this.workers, 'salary').salary);
            },
            getMinSalary: function() {
                return Number(_.minBy(this.workers, 'salary').salary);
            },

            clear: function() {
                this.inputName = '';
                this.inputPosition = '';
                this.inputDate = '';
                this.minSalary = this.getMinSalary();
                this.maxSalary = this.getMaxSalary();
                this.selectLevel = '';
                this.inputManager = '';
                this.selectSort = '';
            }

        }
    }

</script>
