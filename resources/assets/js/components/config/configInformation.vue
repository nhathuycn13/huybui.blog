<template>
    <div>

        <!-- Main content -->
        <section class="invoice">
            <div class="row">
                <div class="col-xs-12">
                    <form @submit.prevent="updateMe" class="form form-horizontal">
                        <div class="form-group" :class="{'has-error': form.$errors.has('title')}">
                            <label class="col-sm-2 control-label">Tên trang *</label>
                            <div class="col-sm-8">
                                <input v-model="form.$fields.title" class="form-control">
                                <label v-if="form.$errors.has('title')" class="control-label"><i class="fa fa-times-circle-o"></i> {{ form.$errors.$errors.title[0] }}</label>
                            </div>
                        </div>
                        <div class="form-group" :class="{'has-error': form.$errors.has('domain')}">
                            <label class="col-sm-2 control-label">Tên miền</label>
                            <div class="col-sm-8">
                                <input v-model="form.$fields.domain" class="form-control">
                                <label v-if="form.$errors.has('domain')" class="control-label"><i class="fa fa-times-circle-o"></i> {{ form.$errors.$errors.domain[0] }}</label>
                            </div>
                        </div>
                        <div class="form-group" :class="{'has-error': form.$errors.has('email')}">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-8">
                                <input v-model="form.$fields.email" class="form-control">
                                <label v-if="form.$errors.has('email')" class="control-label"><i class="fa fa-times-circle-o"></i> {{ form.$errors.$errors.email[0] }}</label>
                            </div>
                        </div>
                        <div class="form-group" :class="{'has-error': form.$errors.has('phone')}">
                            <label class="col-sm-2 control-label">Điện thoại</label>
                            <div class="col-sm-8">
                                <input v-model="form.$fields.phone" class="form-control">
                                <label v-if="form.$errors.has('phone')" class="control-label"><i class="fa fa-times-circle-o"></i> {{ form.$errors.$errors.phone[0] }}</label>
                            </div>
                        </div>
                        <div class="form-group" :class="{'has-error': form.$errors.has('address')}">
                            <label class="col-sm-2 control-label">Địa chỉ</label>
                            <div class="col-sm-8">
                                <input v-model="form.$fields.address" class="form-control">
                                <label v-if="form.$errors.has('address')" class="control-label"><i class="fa fa-times-circle-o"></i> {{ form.$errors.$errors.address[0] }}</label>
                            </div>
                        </div>
                        <div class="form-group" :class="{'has-error': form.$errors.has('facebook')}">
                            <label class="col-sm-2 control-label">Facebook</label>
                            <div class="col-sm-8">
                                <input v-model="form.$fields.facebook" class="form-control">
                                <label v-if="form.$errors.has('facebook')" class="control-label"><i class="fa fa-times-circle-o"></i> {{ form.$errors.$errors.facebook[0] }}</label>
                            </div>
                        </div>
                        <div class="form-group" :class="{'has-error': form.$errors.has('skype')}">
                            <label class="col-sm-2 control-label">Skype</label>
                            <div class="col-sm-8">
                                <input v-model="form.$fields.skype" class="form-control">
                                <label v-if="form.$errors.has('skype')" class="control-label"><i class="fa fa-times-circle-o"></i> {{ form.$errors.$errors.skype[0] }}</label>
                            </div>
                        </div>
                        <div class="form-group" :class="{'has-error': form.$errors.has('instagram')}">
                            <label class="col-sm-2 control-label">Instagram</label>
                            <div class="col-sm-8">
                                <input v-model="form.$fields.instagram" class="form-control">
                                <label v-if="form.$errors.has('instagram')" class="control-label"><i class="fa fa-times-circle-o"></i> {{ form.$errors.$errors.instagram[0] }}</label>
                            </div>
                        </div>
                        <div class="form-group" :class="{'has-error': form.$errors.has('github')}">
                            <label class="col-sm-2 control-label">Github</label>
                            <div class="col-sm-8">
                                <input v-model="form.$fields.github" class="form-control">
                                <label v-if="form.$errors.has('github')" class="control-label"><i class="fa fa-times-circle-o"></i> {{ form.$errors.$errors.github[0] }}</label>
                            </div>
                        </div>
                        <div class="form-group" :class="{'has-error': form.$errors.has('logo')}">
                            <label class="col-sm-2 control-label">Logo</label>
                            <div class="col-sm-3">
                                <div class="btn btn-default btn-file">
                                    <i class="fa fa-paperclip"></i> Chọn
                                    <input id="image" type="file" class="form-control" @change="loadImage">
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <label v-if="form.$errors.has('logo')" class="control-label"><i class="fa fa-times-circle-o"></i> {{form.$errors.$errors.logo[0]}}</label>
                                <img :src="form.$fields.logo" v-else id="imageLoad" class="img img-responsive img-thumbnail" @load="updateLogo"/>
                                <input id="ImageBase64" type="hidden" value="" v-model="form.$fields.logo" />
                            </div>
                        </div>
                        <div class="form-group" :class="{'has-error': form.$errors.has('keywords')}">
                            <label class="col-sm-2 control-label">Từ khóa</label>
                            <div class="col-sm-8">
                                <textarea v-model="form.$fields.keywords" class="form-control"></textarea>
                                <label v-if="form.$errors.has('keywords')" class="control-label"><i class="fa fa-times-circle-o"></i> {{ form.$errors.$errors.keywords[0] }}</label>
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

                this.form.$fields.logo = document.getElementById('ImageBase64').getAttribute('value');

            },
            updateLogo : function () {
                this.form.$fields.logo = document.getElementById('imageLoad').src;
            },
        }
    }
</script>
