<template>
    <div>
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <!---->
                        Chi tiết phản hồi #{{ getId(form.id) }}
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

                        <dt>Tên</dt>
                        <dd>{{ form.name }}</dd>

                        <dt>Email</dt>
                        <dd>{{ form.email }}</dd>

                        <dt v-if="form.phone">Điện thoại</dt>
                        <dd v-if="form.phone">{{ form.phone }}</dd>

                        <dt v-if="form.address">Địa chỉ</dt>
                        <dd v-if="form.address">{{ form.address }}</dd>

                    </dl>
                </div>
                <div class="col-sm-4">
                    <dl class="dl-horizontal">
                        <dt>Lời nhắn</dt>
                        <dd>{{ form.message }}</dd>
                    </dl>
                </div>
            </div>
            <!-- /.row -->
            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-xs-12">
                    <router-link :to="{ name: 'list' }" class="btn btn-default"><i class="fa fa-mail-reply"></i> Quay Lại</router-link>
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
        },
    }
</script>

