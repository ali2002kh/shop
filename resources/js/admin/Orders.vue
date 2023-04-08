<template>
    <div class="container m-2">
        <label for="filter" class="form-label lead">Status filter </label>
        <form class="d-flex justify-content-between align-items-center" style="width:200px">
            <select name="filter" id="filter" class="form-control m-1" v-model="filter" @change="getFilteredOrders">
                <option value="all">all</option>
                <option value="0">pending</option>
                <option value="1">sent</option>
                <option value="2">received</option>
            </select>
        </form>
    </div>
    <div class="container mt-2">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">code</th>
                <th scope="col">cost</th>
                <th scope="col">status</th>
                <th scope="col">ordered time</th>
                <th scope="col">info</th>
                <th scope="col">change status</th>
              </tr>
            </thead>
            <tbody>
                <tr v-for="o in orders" :key="o.id">
                    <td>{{ o.code }}</td>
                    <td>{{ o.final_price }}</td>
                    <td>{{ o.status }}</td>
                    <td>{{ jalali (o.ordered_at) }}</td>
                    <td>
                        <button type="button" class="btn btn-secondary m-1" data-bs-toggle="modal" 
                        :data-bs-target="`#orderInfo_${o.id}`"><i class="fa fa-info"></i></button>
                    </td>
                    <td class="d-flex justify-content-between align-items-center">
                        <select name="status" :id="`status_${o.id}`" class="form-control m-1" v-model="o.status_id">
                            <option value="0">pending</option>
                            <option value="1">sent</option>
                            <option value="2">received</option>
                        </select>
                        <button class="btn btn-success m-1"
                        @click.prevent="changeStatus(o)">submit</button> 
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div v-for="o in orders" :key="o.id"
     class="modal fade" :id="`orderInfo_${o.id}`" tabindex="-1" :aria-labelledby="`orderInfoLabel_${o.id}`" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" :id="`orderInfoLabel_${o.id}`">Order information</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="lead">Order</p>
                    <div class="d-flex flex-wrap m-2 justify-content-between align-items-center">
                        <div class="justify-content-start">code : </div>
                        <div class="justify-content-end">{{ o.code }}</div>
                    </div>
                    <div class="d-flex flex-wrap m-2 justify-content-between align-items-center">
                        <div class="justify-content-start">status : </div>
                        <div class="justify-content-end">{{ o.status }}</div>
                    </div>
                    <div class="d-flex flex-wrap m-2 justify-content-between align-items-center">
                        <div class="justify-content-start">shipping cost : </div>
                        <div class="justify-content-end">{{ o.shipping_cost }} toman</div>
                    </div>
                    <div class="d-flex flex-wrap m-2 justify-content-between align-items-center">
                        <div class="justify-content-start">final amount : </div>
                        <div class="justify-content-end">{{ o.final_price }} toman</div>
                    </div>
                    <div class="d-flex flex-wrap m-2 justify-content-between align-items-center">
                        <div class="justify-content-start">ordered time : </div>
                        <div class="justify-content-end">{{ jalali (o.ordered_at) }}</div>
                    </div>
                    <div class="d-flex flex-wrap m-2 justify-content-between align-items-center">
                        <div class="justify-content-start">sent time : </div>
                        <div class="justify-content-end">{{ jalali (o.sent_at) }}</div>
                    </div>
                    <div class="d-flex flex-wrap m-2 justify-content-between align-items-center">
                        <div class="justify-content-start">received time : </div>
                        <div class="justify-content-end">{{ jalali (o.received_at) }}</div>
                    </div>
                    <hr>
                    <p class="lead">User</p>
                    <div class="d-flex flex-wrap m-2 justify-content-between align-items-center">
                        <div class="justify-content-start">name : </div>
                        <div class="justify-content-end">{{ o.user.fname }} {{ o.user.lname }}</div>
                    </div>
                    <div class="d-flex flex-wrap m-2 justify-content-between align-items-center">
                        <div class="justify-content-start">mobile number : </div>
                        <div class="justify-content-end">{{ o.user.number }}</div>
                    </div>
                    <div class="d-flex flex-wrap m-2 justify-content-between align-items-center">
                        <div class="justify-content-start">email : </div>
                        <div class="justify-content-end">{{ o.user.email }}</div>
                    </div>
                    <div class="d-flex flex-wrap m-2 justify-content-between align-items-center">
                        <div class="justify-content-start">telephone number : </div>
                        <div class="justify-content-end">{{ o.telephone }}</div>
                    </div>
                    <div class="d-flex flex-wrap m-2 justify-content-between align-items-center">
                        <div class="justify-content-start">address : </div>
                        <div class="justify-content-end">{{ o.province }} , {{ o.city }} , {{o.address }}</div>
                    </div>
                    <div class="d-flex flex-wrap m-2 justify-content-between align-items-center">
                        <div class="justify-content-start">zip code : </div>
                        <div class="justify-content-end">{{ o.zip_code }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

import moment from "jalali-moment"

export default {
    data() {
        return {
            orders: [],
            filter: 'all',
        }
    },
    created() {
        axios.get('/api/orders')
        .then(response => {
            this.orders = response.data.data
        })
    },  
    methods: {
        async changeStatus(o) {
            axios.post(`/api/change-order-status/${o.id}`, {
                status: o.status_id
            }).then(response => {
                this.getFilteredOrders()
            })
        },

        async getFilteredOrders () {
            if (this.filter == 'all') {
                axios.get('/api/orders')
                .then(response => {
                    this.orders = response.data.data
                })
            } else {
                axios.get(`/api/filtered-orders/${this.filter}`)
                .then(response => {
                    this.orders = response.data.data
                })
            }
        },
        jalali(date) {
            return moment (date).locale("fa").format("YYYY-M-D H:mm:ss")
        }
    },
}
</script>
