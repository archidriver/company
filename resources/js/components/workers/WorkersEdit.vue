<template>
    <div class="container">
        <div class="form-group">
            <router-link to="/" class="btn btn-success">Назад</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Редактирование сотрудника</div>
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
                            <input type="number" v-model="worker.salary" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Уровень иерархии</label>
                            <input type="number" v-model="worker.level" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">ID начальника</label>
                            <input type="number" v-model="worker.manager_id" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Фото</label>
                            <img v-if="worker.image != null" class="card-img" :src="worker.image" :alt="worker.name" >


                            <div v-if="!worker.image">
                                <h2>Select an image</h2>
                                <input type="file" @change="onFileChange" ref="file">
                            </div>
                            <div v-else>
                                <img class="card-img" :src="worker.image" />
                                <button @click="removeImage">Remove image</button>
                            </div>

                        </div>
                    </div>







                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <button class="btn btn-success">Сохранить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        mounted() {
            let app = this;
            let id = app.$route.params.id;
            app.workerId = id;
            axios.get('/api/v1/workers/' + id)
                .then(function (resp) {
                    app.worker = resp.data;
                })
                .catch(function () {
                    alert("Could not load your worker")
                });
        },
        data: function () {
            return {
                workerId: null,
                worker: {
                    name: '',
                    position_id: '',
                    date_start: '',
                    salary: '',
                    level: '',
                    manager_id: '',
                    image: '',
                },
                //imageSrc: '',
               // file: '',
               // showPreview: false,
              //  imagePreview: ''
            }
        },
        methods: {
            saveForm() {
                event.preventDefault();
                var app = this;
                var newWorker = app.worker;
               axios.patch('/api/v1/workers/' + app.workerId, newWorker)
                    .then(function (resp) {
                        app.$router.replace('/');
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your worker");
                    });
/*
                let formData = new FormData();
                formData.append('file', this.worker.image);
                axios.post( 'public/storage/images',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(function(){
                    console.log('SUCCESS!!');
                })
                    .catch(function(){
                        console.log('FAILURE!!');
                    });*/
            },

            onFileChange(e) {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
               // var image = new Image();
                var reader = new FileReader();
                var vm = this;

                reader.onload = (e) => {
                    vm.worker.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            removeImage: function (e) {
                this.worker.image = '';
            }

        }
    }
</script>
