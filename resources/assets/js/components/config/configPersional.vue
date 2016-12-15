<template>
    <div>

        <!-- Main content -->
        <section class="invoice">
            <div class="row">
                <div class="col-xs-12">
                    <form @submit.prevent="updateMe" class="form form-horizontal">
                        <div class="form-group" :class="{'has-error': form.$errors.has('name')}">
                            <label class="col-sm-2 control-label">Họ Tên *</label>
                            <div class="col-sm-8">
                                <input v-model="form.$fields.name" class="form-control">
                                <label v-if="form.$errors.has('name')" class="control-label"><i class="fa fa-times-circle-o"></i> {{ form.$errors.$errors.name[0] }}</label>
                            </div>
                        </div>
                        <div class="form-group" :class="{'has-error': form.$errors.has('email')}">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-8">
                                <input v-model="form.$fields.email" class="form-control">
                                <label v-if="form.$errors.has('email')" class="control-label"><i class="fa fa-times-circle-o"></i> {{ form.$errors.$errors.email[0] }}</label>
                            </div>
                        </div>
                        <div class="form-group" :class="{'has-error': form.$errors.has('job')}">
                            <label class="col-sm-2 control-label">Chức Danh</label>
                            <div class="col-sm-8">
                                <input v-model="form.$fields.job" class="form-control">
                                <label v-if="form.$errors.has('job')" class="control-label"><i class="fa fa-times-circle-o"></i> {{ form.$errors.$errors.job[0] }}</label>
                            </div>
                        </div>
                        <div class="form-group" :class="{'has-error': form.$errors.has('thumbnail')}">
                            <label class="col-sm-2 control-label">Ảnh Đại Diện</label>
                            <div class="col-sm-3">
                                <div class="btn btn-default btn-file">
                                    <i class="fa fa-paperclip"></i> Chọn
                                    <input id="image" type="file" class="form-control" @change="loadImage">
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <label v-if="form.$errors.has('thumbnail')" class="control-label"><i class="fa fa-times-circle-o"></i> {{form.$errors.$errors.thumbnail[0]}}</label>
                                <img :src="form.$fields.thumbnail" v-else id="imageLoad" class="img img-responsive img-thumbnail" @load="updateThumbnail"/>
                                <input id="ImageBase64" type="hidden" value="" v-model="form.$fields.thumbnail" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-8">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Cập Nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
</template>
<script>
    export default{
        data(){
            return{
                form : this.$form({

                }),
            }
        },
        created: function () {
            this.$Progress.start();
            this.$http.get(this.$parent.apiUrl).then(function (response) {
                let result = response.body;
                this.form.$fields = result;
                this.$Progress.finish();
            }, function (response) {
                this.$Progress.fail();
            })
        },
        methods: {
            updateMe: function () {
                let me = this;
                this.$Progress.start();
                this.form.post(this.$parent.apiUrl).then(function (response) {
                    me.$Progress.finish();
                    me.$parent.notifySuccess('Cập nhật thành công!');
                }, function (response) {
                    me.$Progress.fail();
                    me.$parent.notifyError('Xảy ra lỗi trong quá trình cập nhật!');
                })
            },
            loadImage : function(){
                var input = document.getElementById('image');
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        document.getElementById('imageLoad').setAttribute('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);

                }

                this.form.$fields.thumbnail = document.getElementById('ImageBase64').getAttribute('value');

            },
            updateThumbnail : function () {
                this.form.$fields.thumbnail = document.getElementById('imageLoad').src;
            },
        }
    }
</script>
