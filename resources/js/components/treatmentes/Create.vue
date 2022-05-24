<template>
    <div>
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/">الرئيسية</a></li>
                            <li class="breadcrumb-item"><router-link :to="{ name: 'TreatmentIndex'}">المعاملات</router-link></li>
                            <li class="breadcrumb-item active">اضافة معاملة</li>
                        </ol>
                    </div>
                    <h4 class="page-title">اضافة معاملة جديدة</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row justify-content-md-center">
            <div class="col-8">
                <div class="card-box">
                    <div class="row ">
                        <div class="col">
                            <form  @submit.prevent="storeTreatment">

                                <div class="row">
                                    <div class="col-4">
                                        <label for="balance">قيمة المعاملة</label>
                                        <input v-model="form.balance" id="balance" name="balance" type="text"  class="form-control" required >
                                    </div>

                                    <div class="col-4">
                                        <label for="currency">نوع العملة</label>
                                        <select v-model="form.currency" id="currency" class="custom-select mb-2" >
                                            <option disabled value="selected">اختر العملة</option>
                                            <option value="شيكل">شيكل</option>
                                            <option value="دولار">دولار</option>
                                            <option value="دينار">دينار</option>
                                        </select>
                                    </div>

                                    <div class="col-4">
                                        <label for="wallet">المحفظة</label>
                                        <select v-model="form.wallet_id" id="wallet" class="custom-select mb-3">
                                            <option disabled value="selected">اختر المحفظة</option>
                                            <option v-for="wallet in wallets" :key="wallet.id" :value="wallet.id">
                                                {{wallet.name}}/ الرصيد:{{wallet.balance}}
                                            </option>
                                        </select>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-4">
                                        <label for="type">نوع المعاملة</label>
                                        <select v-model="form.type_id" @change="getSections()"  class="custom-select" name="type" id="type">
                                            <option disabled value="selected">اختر نوع المعاملة</option>
                                            <option value="الدخل">الدخل</option>
                                            <option value="المصروف">المصروف</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="section">القسم الرئيسي</label>
                                        <select v-model="form.section_id" @change="getSubSections()"  class="custom-select"  id="section">
                                            <option disabled value="selected">اختر القسم</option>
                                            <option v-for="section in sections" :key="section.id" :value="section.id">
                                                {{section.name}}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="subsection">القسم الفرعي</label>
                                        <select v-model="form.subsection_id" class="custom-select" id="subsection">
                                            <option disabled value="selected">اختر القسم</option>
                                            <option v-for="subsection in subsections" :key="subsection.id" :value="subsection.id">
                                                {{subsection.name}}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-6">
                                        <label>التاريخ</label>
                                        <Datepicker  v-model="form.date"></Datepicker>
                                    </div>

                                    <div class="col-6">
                                        <label for="contact_id">جهات الاتصال</label>
                                        <select v-model="form.contact_id" id="contact_id" class="custom-select mb-3">
                                            <option disabled value="selected">اختر جهة الاتصال</option>
                                            <option v-for="contact in contacts" :key="contact.id" :value="contact.id">
                                                {{contact.name}}
                                            </option>
                                        </select>
                                    </div>



                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="notes">الملاحظات</label>
                                        <textarea v-model="form.notes" rows="3"  class="form-control" id="notes" required></textarea>
                                    </div>
                                </div>


                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-lg btn-danger btn-block waves-effect waves-light">اضافة</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import moment from "moment";
    import Datepicker from '@vuepic/vue-datepicker';
    import '@vuepic/vue-datepicker/dist/main.css'

    export default {
        components: {Datepicker},
        data() {
            return {
                wallets: [],           //countries
                sections: [],          //states
                subsections: [],       //departments
                contacts: [],          //cities
                form: {
                    balance: '',
                    currency: 'selected',
                    wallet_id: 'selected',
                    type_id: 'selected',
                    section_id: 'selected',
                    subsection_id: 'selected',
                    contact_id: 'selected',
                    notes: '',
                    date: null,
                }
            }
        },
        created() {
            this.getWallets();
            this.getContacts();
        },
        methods: {
            getWallets() {
                axios.get('/api/transactions/wallets')
                    .then(res => {
                        this.wallets = res.data;
                        console.log(this.wallets);
                    }).catch(error => {
                    console.log(error)
                });
            },
            getContacts() {
                axios.get('/api/transactions/contacts')
                    .then(res => {
                        this.contacts = res.data;
                        console.log(this.contacts)
                    }).catch(error => {
                    console.log(error)
                });
            },
            getSections() {
                axios.get('/api/transactions/' + this.form.type_id + "/sections")
                    .then(res => {
                        this.sections = res.data;
                        console.log(this.sections)
                    }).catch(error => {
                    console.log(error)
                });
            },
            getSubSections() {
                axios.get('/api/transactions/' + this.form.section_id + "/subsections")
                    .then(res => {
                        this.subsections = res.data;
                        console.log(this.subsections)
                    }).catch(error => {
                    console.log(error)
                });
            },
            storeTreatment() {
                let data = {
                    'balance': this.form.balance,
                    'currency': this.form.currency,
                    'wallet_id': this.form.wallet_id,
                    'type': this.form.type_id,
                    'section_id': this.form.section_id,
                    'subsection_id': this.form.subsection_id,
                    'notes': this.form.notes,
                    'date': this.format_date(this.form.date),
                    'contact_id': this.form.contact_id,
                };
                axios.post('/api/transactions', data)
                    .then(res => {
                        this.$router.push({name: 'TreatmentIndex'})
                    }).catch(error => {
                    console.log(error)
                });
            },
            format_date(value) {
                if (value) {
                    return moment(String(value)).format('YYYYMMDD');
                }
            }
        }
    }
</script>

<style>

</style>
