<template>
    <div>
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <!---->
                        Chi tiết bài viết #{{ getId(form.id) }}
                        <div class="pull-right">
                            <i class="fa fa-globe"></i> Huybui.blog
                        </div>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4">
                    <dl class="dl-horizontal">
                        <dt>Id</dt>
                        <dd>#{{ getId(form.id) }}</dd>

                        <dt>Tiêu đề</dt>
                        <dd>{{ form.title }}</dd>

                        <dt v-if="form.category">Thể loại</dt>
                        <dd v-if="form.category">{{ form.category.name }}</dd>
                        <dt>Giới thiệu</dt>
                        <dd>{{ form.intro }}</dd>

                        <dt>Link</dt>
                        <dd>{{ form.slug }}</dd>

                        <dt>Tag</dt>
                        <dd><span style="margin-right: 15px;" class="label label-success" v-for="tag in form.tags">{{ tag.name }}</span></dd>
                    </dl>
                </div>
                <div class="col-sm-4">
                    <div class="dt-horizontal">
                        <dt>Thời Gian Viết: </dt>
                        <dd><timeago :title="form.created_at" :since="form.created_at" :auto-update="60"></timeago></dd>

                        <dt>Cập nhật lần cuối</dt>
                        <dd><timeago :title="form.updated_at" :since="form.updated_at" :auto-update="60"></timeago></dd>
                    </div>
                </div>
                <div class="col-sm-4" v-if="form.thumbnail">
                    <div>
                        <img :src="form.thumbnail" class="img img-thumbnail"/>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="content" v-html="form.content"></div>
                </div>
            </div>
            <!-- /.row -->
            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-xs-12">
                    <router-link :to="{ name: 'list' }" class="btn btn-default"><i class="fa fa-mail-reply"></i> Quay Lại</router-link>
                    <button @click="updateMe" class="btn btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                    <button @click="deleteMe" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
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
                form : {}
            }
        },
        created : function () {
            this.fetchData();
        },
        methods : {
            fetchData : function () {
                this.$Progress.start();
                this.$http.get(this.$parent.apiUrl+ '/' + this.$route.params.id).then(function (response) {
                    this.form = (response.body);
                    this.$Progress.finish();

                }, function (response) {
                    this.$parent.notifyError('Không tìm thấy.')
                    this.$Progress.fail();

                })
            },
            getId : function (n) {
                n = n + '';
                return n.length >= 5 ? n : new Array(5 - n.length + 1).join('0') + n;
            },
            deleteMe : function () {
                var confirm = window.confirm("Bạn có chắc muốn xóa?");
                if (!confirm) return;
                this.$Progress.start();
                this.$http.delete(this.$parent.apiUrl + '/' + this.form.id).then(function (response) {
                    if (response.body == '1'){
                        this.$router.push({ name: 'list'});
                        this.$parent.notifySuccess('Xóa thành công!')
                        this.$Progress.finish();
                    }
                }, function () {
                    this.notify('Error', 'danger', '');
                    this.$Progress.fail();
                });
            },
            updateMe : function () {
                this.$router.push({ name: 'update', params : { id : this.$route.params.id}})
            },
        },
    }
</script>

