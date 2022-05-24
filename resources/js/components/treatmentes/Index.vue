<template>
    <div>
        <!-- start page title -->
        <div class="row">
            <div v-if="showMessage" class="alert alert-success">
                {{message}}
            </div>

            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">

                            <li class="breadcrumb-item"><a href="/">الرئيسية</a></li>
                            <li class="breadcrumb-item active">المعاملات</li>
                        </ol>
                    </div>
                    <h4 class="page-title">المعاملات</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <h4 class="header-title float-left mb-4">
                        <router-link :to="{ name: 'TreatmentCreate'}" class="btn btn-lg btn-block waves-effect waves-light btn-primary float-end">اضافة معاملة
                            <i class="mdi mdi-plus mr-1"></i>
                        </router-link>
                    </h4>

                    <div class="table-responsive">
                        <table class="table table-bordered table-nowrap mb-0">
                            <thead>
                            <tr>
                                <th scope="col">المعاملة</th>
                                <th scope="col">تاريخ المعاملة</th>
                                <th scope="col">قيمة المعاملة</th>
                                <th scope="col">المحفظة المستخدمة</th>
                                <th scope="col">جهة الاتصال</th>
                                <th scope="col">نوع/حالة المعاملة</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="transaction in transactions" :key="transaction.id">
                                <td scope="row" class="text-muted">{{transaction.notes}}</td>
                                <td>{{transaction.date}}</td>
                                <td>{{transaction.balance}}</td>
                                <td>{{transaction.wallet.name}}</td>
                                <td>{{transaction.contact.name}}</td>
                                <td>
                                    <span v-if="transaction.section.type === 'الدخل'" class="bg-primary rounded font-weight-bold text-white p-2">
                                        {{transaction.section.type}}
                                    </span>
                                    <span v-else class="bg-danger rounded font-weight-bold text-white p-2">
                                        {{transaction.section.type}}
                                    </span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                transactions: [],
                showMessage: false,
                message: '',
            }
        },
        created() {
            this.getTransactions();
        },
        methods: {
            getTransactions(){
                axios.get('/api/transactions')
                    .then(res => {
                        this.transactions = res.data.data
                    }).catch(error => {
                    console.log(error)
                });
            }
        }
    }
</script>
<style>
</style>
