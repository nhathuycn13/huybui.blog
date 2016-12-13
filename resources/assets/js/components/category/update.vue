<template>
    <div class="invoice">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    Cập Nhật Thể Loại
                    <div class="pull-right">
                        <i class="fa fa-globe"></i> Huybui.blog
                    </div>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-xs-12">
                <form @submit.prevent="updateMe" class="form form-horizontal">
                    <div class="form-group" :class="{'has-error': form.$errors.has('name')}">
                        <label class="col-sm-2 control-label">Tên *</label>
                        <div class="col-sm-8">
                            <input v-model="form.$fields.name" class="form-control">
                            <label v-if="form.$errors.has('name')" class="control-label"><i class="fa fa-times-circle-o"></i> {{form.$errors.$errors.name[0]}}</label>
                        </div>
                    </div>

                    <div class="form-group" :class="{'has-error': form.$errors.has('parent_id')}">
                        <label class="col-sm-2 control-label">Thể loại cha</label>
                        <div class="col-sm-8">
                            <multiselect :options="parentCategory"
                                         :selected="selected"
                                         :local-search="false"
                                         :clear-on-select="true"
                                         :close-on-select="true"
                                         :loading="isLoading"
                                         v-model="form.$fields.parent_id"
                                         @search-change="findCategory"
                                         track-by="id"
                                         label="name"
                                         selectedLabel="đã chọn"
                                         placeholder="Nhập thể loại cha"
                                         selectLabel="Nhấn enter để chọn"
                                         deselectLabel = "Nhấn enter bỏ chọn"
                                         @input="updateCategory">
                                <span slot="noResult">Không tìm thấy</span>
                            </multiselect>
                            <label v-if="form.$errors.has('parent_id')" class="control-label"><i class="fa fa-times-circle-o"></i> {{form.$errors.$errors.parent_id[0]}}</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-8">
                            <button :disabled="form.$busy" type="submit" class="btn btn-primary" @click="updateMe"><i class="fa fa-save"></i> Cập Nhật</button>
                            <router-link :to="{ name: 'list' }" class="btn btn-default"><i class="fa fa-mail-reply"></i> Quay Lại</router-link>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import MultiSelect from 'vue-multiselect'
    export default{
        data : function () {
            return {
                form : this.$form({
                    id: null,
                    name: '',
                    parent_id: {
                        id: 0,
                        name: 'không có',
                        parent_id: null,
                    },
                }),
                parentCategory: [],
                isLoading: false,
            };
        },
        components: {
            multiselect: MultiSelect,
        },
        created: function () {
            this.$Progress.start();
            var meme = this;
            this.$http.get(this.$parent.apiUrl + '/' + this.$route.params.id).then(function (response) {
                meme.form.$fields = response.body;
                meme.form.$fields.parent_id = response.body.parent ? response.body.parent : {id: 0,name: 'không có',parent_id: null,};
                this.$Progress.finish();
            }, function () {
                this.$Progress.fail();
                this.$parent.notifyError('Không tìm thấy.')
            });
            this.$http.get(this.$parent.apiUrl).then(function (response) {
                this.parentCategory = response.body.data;
                this.parentCategory.unshift({
                    id: 0,
                    name: 'không có',
                    parent_id: null,
                })
                this.$Progress.finish();
            }, function () {
                this.$Progress.fail();
            });
        },
        methods : {
            updateMe : function () {
                this.$Progress.start();
                var meme = this;
                this.form.$fields.parent_id = this.form.$fields.parent_id.id;
                this.form.put(this.$parent.apiUrl + '/' + this.form.$fields.id).then(function (response) {
                    meme.$parent.notifySuccess('Cập nhật thành công! </br>');
                    meme.$Progress.finish();
                    meme.form.$fields = response.body;
                    meme.form.$fields.parent_id = response.body.parent ? response.body.parent : {id: 0,name: 'không có',parent_id: null,};
                }, function (response) {
                    meme.form.$fields = {
                        name: '',
                        parent_id: {
                            id: 0,
                            name: 'không có',
                            parent_id: null,
                        },
                    };
                    meme.$Progress.fail();
                });
            },
            findCategory: function (query) {
                if (query.length !== 0) {
                    this.isLoading = true
                    this.$http.get('api/search/category/' + query).then(function (response) {
                        if (response.body === [])
                        {
                            console.log('empty')
                        }else{
                            this.parentCategory = response.body;
                        }
                        this.isLoading = false;
                    }, function (response) {
                        this.isLoading = false;
                    });
                }
            },
            updateCategory: function (newValue) {
                this.form.$fields.parent_id = newValue;
            }
        }
    }
</script>
