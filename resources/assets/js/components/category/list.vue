<template>
    <div>
        <section class="content">
            <div class="row">
                <!--<div class="col-md-3">-->
                    <!--<div class="box box-primary">-->
                        <!--<div class="box-header with-border">-->
                            <!--<h3 class="box-title">Trạng thái</h3>-->

                            <!--<div class="box-tools">-->
                                <!--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>-->
                                <!--</button>-->
                            <!--</div>-->
                        <!--</div>-->
                        <!--<div class="box-body no-padding">-->
                            <!--<ul class="nav nav-pills nav-stacked">-->
                                <!--<li class="active"><a href="#"><i class="fa fa-inbox"></i> Tất cả-->
                                    <!--<span class="label label-primary pull-right">12</span></a></li>-->
                                <!--<li><a href="#"><i class="fa fa-envelope-o"></i> đang báo gía</a></li>-->
                                <!--<li><a href="#"><i class="fa fa-trash-o"></i> đã hủy <span class="label label-warning pull-right">65</span></a>-->
                                <!--</li>-->
                            <!--</ul>-->
                        <!--</div>-->
                        <!--&lt;!&ndash; /.box-body &ndash;&gt;-->
                    <!--</div>-->
                    <!--&lt;!&ndash; /. box &ndash;&gt;-->
                    <!--<div>-->
                        <!--<router-link :to="{ name: 'add' }" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Thêm Mới</router-link>-->
                    <!--</div>-->
                    <!--&lt;!&ndash; /.box &ndash;&gt;-->
                <!--</div>-->
                <!-- /.col -->
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Danh sách thể loại</h3>

                            <form class="box-tools pull-right" @submit.prevent="search">
                                <div class="has-feedback">
                                    <input v-model="keyword" type="text" class="form-control input-sm" placeholder="Tìm kiếm">
                                    <span class="fa fa-search form-control-feedback"></span>
                                </div>
                            </form>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <div class="mailbox-controls">
                                <button @click="fetchData(data.current_page)" type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                                <div class="pull-right">
                                    <form @submit.prevent="fetchData(data.current_page)" class="form-inline form-group">
                                        <label style="font-weight: 100;">Hiển thị</label>
                                        <input v-model="data.per_page" type="text" class="form-control" style="width: 50px;">
                                        <label style="font-weight: 100;">dòng</label>
                                    </form>
                                    <div class="btn-group">
                                        <button v-if="data.prev_page_url" @click="fetchData(data.current_page - 1)" type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                        <button v-if="data.next_page_url" @click="fetchData(data.current_page + 1)" type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                    </div>
                                    <!-- /.btn-group -->
                                </div>
                                <!-- Check all button -->
                                <button @click="checkAll" type="button" class="btn btn-default btn-sm checkbox-toggle"><i :class="[ isSelectAll ? 'fa fa-square-o' : 'fa fa-check-square-o']"></i>
                                </button>
                                <div class="btn-group">
                                    <button v-if="isCheck" @click="deleteMulti" type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                                </div>
                                <!-- /.btn-group -->
                                <!-- /.pull-right -->
                            </div>
                            <div class="table-responsive mailbox-messages">
                                <div v-show="loading.refresh" class="overlay">
                                    <i class="fa fa-spinner fa-spin"></i>
                                </div>
                                <table class="table table-hover">
                                    <tr>
                                        <th></th>
                                        <th>#id</th>
                                        <th>Tên</th>
                                        <th>Thể loại cha</th>
                                        <th class="pull-right"></th>
                                    </tr>

                                    <tr v-for="item in items">
                                        <td style="padding-left:15px;">
                                            <input @click="checkMe(item)" type="checkbox" :id="item.id">
                                        </td>
                                        <td><router-link :to="{ name:'view', params : { id : item.id} }">{{ getId(item.id) }}</router-link></td>
                                        <td><router-link :to="{ name:'view', params : { id : item.id} }">{{ item.name }}</router-link></td>
                                        <td><router-link v-if="item.parent" :to="{ name:'view', params : { id : item.parent.id} }">{{ item.parent.name }}</router-link></td>
                                        <td>
                                            <div class="btn-group">
                                                <router-link :to="{ name: 'update', params: { id : item.id} }"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></router-link>
                                                <a href="#" type="button" @click.prevent="deleteItem(item.id)"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <!-- /.table -->
                            </div>
                            <!-- /.mail-box-messages -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer no-padding">
                            <div class="mailbox-controls">
                                <button @click="fetchData(data.current_page)" type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                                <!-- Check all button -->
                                <button @click="checkAll" type="button" class="btn btn-default btn-sm checkbox-toggle"><i :class="[ isSelectAll ? 'fa fa-square-o' : 'fa fa-check-square-o']"></i>
                                </button>
                                <div class="btn-group">
                                    <button v-if="isCheck" @click="deleteMulti" type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                                </div>
                                <!-- /.btn-group -->
                                <div class="pull-right">
                                    {{ data.from }}-{{ data.to }}/{{ data.total }}
                                    <div class="btn-group">
                                        <button v-if="data.prev_page_url" @click="fetchData(data.current_page - 1)" type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                        <button v-if="data.next_page_url" @click="fetchData(data.current_page + 1)" type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                    </div>
                                    <!-- /.btn-group -->
                                </div>
                                <!-- /.pull-right -->
                            </div>
                        </div>
                        <div>
                            <router-link :to="{ name: 'add' }" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Thêm Mới</router-link>
                        </div>
                    </div>
                    <!-- /. box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
    </div>
</template>
<script>
    export default{
        data : function () {
            return {
                data : {},
                items : [],
                keyword : '',
                selected : [],
                isSelectAll : false,
                loading : {
                    refresh : false,
                },
            };
        },
        created: function () {
            this.fetchData(1);
        },
        computed : {
            isCheck : function () {
                return this.selected.length > 0;
            },
        },
        methods : {
            fetchData : function (page) {
                this.$Progress.start();
                this.$http.get(this.$parent.apiUrl, { params : { page : page, perPage : this.data.per_page}}).then                          (function (response) {
                            this.data = response.body;
                            this.items = this.data.data,
                            this.$Progress.finish();
                        }, function () {
                    this.$Progress.fail();
                });
            },
            deleteItem : function (id) {
                var confirm = window.confirm("Bạn có chắc muốn xóa?");
                if (!confirm) return;
                this.$Progress.start();
                this.$http.delete(this.$parent.apiUrl + '/' + id).then(function (response) {
                    if (response.body == '1'){
                        this.$parent.notifySuccess('Xóa thành công!')
                        this.fetchData(1);
                        this.$Progress.finish();
                    }
                }, function () {
                    this.$parent.notifyError('Lỗi rồi!')
                    this.$Progress.fail();
                });
            },
            deleteMulti : function (id) {
                var confirm = window.confirm("Bạn có chắc muốn xóa?");
                if (!confirm) return;
                this.$Progress.start();
                this.$http.delete(this.$parent.apiUrl + '/0', {params : {ids : this.selected}, multiple: true}).then(function (response) {
                    if (response.body > 0){
                        this.$parent.notifySuccess('Xóa thành công!')
                        this.fetchData(1);
                        this.$Progress.finish();
                    }
                }, function () {
                    this.$parent.notifyError('Lỗi rồi :(');
                    this.$Progress.fail();
                });
            },
            search : function () {
                if (this.keyword === '')
                    return;
                this.$Progress.start();
                this.$http.get('api/search/category/' + this.keyword).then(function (response) {
                    this.data = response.body;
                    this.items = this.data.data,
                            this.$Progress.finish();
                }, function (response) {
                    console.log(response.body);
                    this.$Progress.fail();
                });
            },
            getId : function (n) {
                n = n + '';
                return n.length >= 5 ? n : new Array(5 - n.length + 1).join('0') + n;
            },
            checkAll : function(){
                if (this.selected.length === this.items.length){
                    this.selected = new Array();
                    this.isSelectAll = false;

                    this.items.forEach(function (item) {
                        document.getElementById(item.id).checked = false;
                    })
                }else{
                    this.isSelectAll = true;
                    var meme = this.selected;
                    this.items.forEach(function (item) {
                        document.getElementById(item.id).checked = true;
                        if (!meme.includes(item.id))
                            meme.push(item.id);
                    })
                }
            },
            checkMe : function(item){
                if (this.selected.includes(item.id)){
                    var i = this.selected.indexOf(item.id);
                    this.selected.splice(i, 1);
                }else{
                    this.selected.push(item.id);
                }
            },

        }
    }
</script>

