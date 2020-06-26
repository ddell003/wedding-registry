<template>
<div>
    <h1>in book list</h1>
    <v-alert type="warning" :value="true">
        Vuetify was installed properly
    </v-alert>

        <div class="row">
            <div class="col-8">
                <h3>My Reading List <v-btn class="btn btn-primary" right small dark @click="save()">Primary</v-btn></h3>

                <table class="table table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Sport</th>
                        <th scope="col">Order</th>
                    </tr>
                    </thead>
                    <draggable v-model="list" tag="tbody" :sort="true" :component-data="getComponentData()">
                        <tr v-for="item in list" :key="item.name">
                            <td scope="row"> {{ item.id }}</td>
                            <td>{{ item.name }}</td>
                            <td>{{ item.sport }}</td>
                            <td>{{ item.order }}</td>
                        </tr>
                    </draggable>
                </table>
            </div>
        </div>

</div>

</template>

<script>
    import draggable from "vuedraggable";
    export default {
        name: "BookList",
        components: {
            draggable
        },
        methods: {
            save(){
                console.log('savingggggg', this.list);
            },
            handleChange(event) {
                console.log('changed', this.list);
                //console.log('changed', event);
            },
            inputChanged(value) {
                this.activeNames = value;
                console.log(value)
            },
            getComponentData() {
                return {
                    on: {
                        change: this.handleChange,
                        input: this.inputChanged
                    },
                    attrs:{
                        wrap: true
                    },
                    props: {
                        value: this.activeNames
                    }
                };
            }
        },
        computed: {
            draggingInfo() {
                return this.dragging ? "under drag" : "";
            }
        },
        data() {
            return {
                list: [
                    { id: 1, name: "Abby", sport: "basket", order:1},
                    { id: 2, name: "Brooke", sport: "foot", order:3},
                    { id: 3, name: "Courtenay", sport: "volley", order:2 },
                    { id: 4, name: "David", sport: "rugby", order:4 }
                ],
                dragging: false
            };
        }
    }
</script>

<style scoped>
    .button {
        margin-top: 35px;
    }
    .handle {
        float: left;
        padding-top: 8px;
        padding-bottom: 8px;
    }
    .close {
        float: right;
        padding-top: 8px;
        padding-bottom: 8px;
    }
    input {
        display: inline-block;
        width: 50%;
    }
    .text {
        margin: 20px;
    }
</style>
