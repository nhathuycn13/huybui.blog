<template>
    <div class="invoice">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    Cập Nhật Bài Viết
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
                    <div class="form-group" :class="{'has-error': form.$errors.has('title')}">
                        <label class="col-sm-2 control-label">Tiêu đề *</label>
                        <div class="col-sm-8">
                            <input v-model="form.$fields.title" class="form-control">
                            <label v-if="form.$errors.has('title')" class="control-label"><i class="fa fa-times-circle-o"></i> {{form.$errors.$errors.title[0]}}</label>
                        </div>
                    </div>
                    <div class="form-group" :class="{'has-error': form.$errors.has('category_id')}">
                        <label class="col-sm-2 control-label">Thể loại</label>
                        <div class="col-sm-8">
                            <multiselect :options="categories"
                                         :local-search="false"
                                         :clear-on-select="true"
                                         :close-on-select="true"
                                         :loading="isLoading"
                                         v-model="form.$fields.category"
                                         @search-change="findCategory"
                                         track-by="id"
                                         label="name"
                                         selectedLabel="đã chọn"
                                         placeholder="Nhập để tìm thể loại"
                                         selectLabel="chọn"
                                         deselectLabel = "bỏ chọn"
                                         @input="updateCategory">
                                <span slot="noResult">Không có kết quả</span>
                            </multiselect>
                            <label v-if="form.$errors.has('category_id')" class="control-label"><i class="fa fa-times-circle-o"></i> {{form.$errors.$errors.category_id[0]}}</label>
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
                    <div class="form-group" :class="{'has-error': form.$errors.has('intro')}">
                        <label class="col-sm-2 control-label">Giới thiệu *</label>
                        <div class="col-sm-8">
                            <textarea v-model="form.$fields.intro" class="form-control"></textarea>
                            <label v-if="form.$errors.has('intro')" class="control-label"><i class="fa fa-times-circle-o"></i> {{form.$errors.$errors.intro[0]}}</label>
                        </div>
                    </div>
                    <div class="form-group" :class="{'has-error': form.$errors.has('tags')}">
                        <label class="col-sm-2 control-label">Tags</label>
                        <div class="col-sm-8">
                            <multiselect :options="tags"
                                         :value="form.$fields.tags"
                                         :multiple="true"
                                         :searchable="searchable"
                                         :taggable="true"
                                         @tag="addTag"
                                         @update="updateSelectedTagging"
                                         @search-change="findTags"
                                         track-by="id"
                                         label="name"
                                         selectedLabel="đã chọn"
                                         tag-placeholder="thêm"
                                         placeholder="Nhập tag"
                                         selectLabel="Nhấn enter để chọn"
                                         deselectLabel = "bỏ chọn"
                                         @input="updateTags">
                                <span slot="noResult">Không tìm thấy</span>
                            </multiselect>
                            <label v-if="form.$errors.has('tags')" class="control-label"><i class="fa fa-times-circle-o"></i> {{form.$errors.$errors.tags[0]}}</label>
                        </div>
                    </div>
                    <div class="form-group" :class="{'has-error': form.$errors.has('content')}">
                        <label class="col-sm-2 control-label">Nội dung *</label>
                        <div class="col-sm-8">
                            <textarea v-model="form.$fields.content" class="form-control"></textarea>
                            <label v-if="form.$errors.has('content')" class="control-label"><i class="fa fa-times-circle-o"></i> {{form.$errors.$errors.content[0]}}</label>
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
                    title: '',
                    intro: '',
                    content: '',
                    thumbnail: null,
                    tags: [],
                    description: '',
                    category: {
                        id: null,
                        name: 'không có'
                    },
                    category_id: null,
                }),
                categories: [],
                tags: [],
                isLoading: false,
                content: '',
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
                            this.categories = response.body.data;
                        }
                        this.isLoading = false;
                    }, function (response) {
                        this.isLoading = false;
                    });
                }
            },
            updateCategory: function (newValue) {
                this.form.$fields.category = newValue;
                this.form.$fields.category_id = newValue.id;
                if (newValue === null)
                    this.form.$fields.category_id = null;
            },
            findTags: function (query) {
                if (query.length !== 0) {
                    this.$http.get('api/search/tag/' + query).then(function (response) {
                        if (response.body === [])
                        {
                            console.log('empty')
                        }else{
                            this.tags = response.body.data;
                        }
                    }, function (response) {
                    });
                }
            },
            updateTags: function (newValue) {
                this.form.$fields.tags = newValue;
            },
            updateSelectedTagging: function (value) {
                this.form.$fields.tags.push(value);
            },
            addTag: function (newTag) {
                const tag = {name: newTag};
                if (this.tags.indexOf(newTag) > -1){
                    window.alert();
                    return;
                }
                this.tags.push(tag);
                this.form.$fields.tags.push(tag);
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
