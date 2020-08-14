<template>
<div>
    <div data-app>
        <v-container fluid>
            <v-col cols=“12” lg=“12”>
            <v-card class="mx-auto">
                <v-toolbar dark color="primary" class="pinkText">
                    <v-toolbar-title >Update Available Meals</v-toolbar-title>
                </v-toolbar>

                <v-card-text>
                    <v-container>
                            <v-card v-for="(meal, index) in meals" style="border:1px #777 dashed; margin-bottom:5px">
                                <v-card-text>
                                    <v-container>
                                        <v-row>
                                        <v-col cols="12" sm="6" md="6" lg="6">
                                            <v-text-field label="Name" v-model="meal.name" required></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" lg="6">
                                            <v-select
                                                v-model="meal.gluten_free"
                                                :items="yesNo"
                                                item-text="name"
                                                item-value="value"
                                                label="Gluton Free"
                                            ></v-select>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="12">
                                            <v-text-field label="Description" v-model="meal.description"></v-text-field>
                                        </v-col>
                                        </v-row>

                                    </v-container>
                                </v-card-text>
                                <v-card-actions dark color="primary" style="background-color: #ccc">

                                    <v-btn rounded style="background-color:#dcf4e6; color:#f67e7d" class="pull-right" @click="saveMeal(meal)">Save {{meal.id}}</v-btn>
                                    <v-spacer></v-spacer>
                                    <v-btn rounded style="background-color:#dcf4e6; color:#f67e7d" class="pull-right" @click="deleteMeal(meal, index)">Delete </v-btn>
                                </v-card-actions>
                            </v-card>


                        <v-row>
                            <v-btn rounded style="background-color:#dcf4e6; color:#f67e7d" class="pull-right" @click="addMeal()">
                                Add Meal
                            </v-btn>
                        </v-row>

                        <v-divider></v-divider>
                    </v-container>

                </v-card-text>
            </v-card>
            </v-col>

        </v-container>
    </div>
</div>
</template>

<script>
    export default {
        name: "MealList",
        props : ['user'],
        data() {
            return {
                yesNo:[{name:'Yes', value:1}, {name:'No', value:0}],
                blankMeal:{
                    id:null,
                    name:'',
                    description:'',
                    gluten_free:'',
                },
                meals:[],
            };
        },
        methods: {
            addMeal(){
                console.log('adding new meal...')
                this.meals.push(this.blankMeal)
            },
            setHeaders(){
                this.headers = {
                    headers:{
                        Authorization: 'Bearer ' + this.user.api_token,
                    },
                }
            },
            getMenu(){
                console.log('getting menu')
                let url = '/api/meal'
                window.axios.get(url, this.headers).then(({ data }) => {
                    this.loading = false
                    this.meals = data.data


                }).catch(error => {
                    console.log('processing error message', error)
                    console.log('error message', error.response.data)
                });
            },
            deleteMeal(meal, index){



                this.meals.splice(index, 1)

                if(! meal.id){
                   return
                }
                //need to make delete call if id
                let url = '/api/meal'
                //seeing if we are saving or updating
                if(meal.id){
                    window.axios.delete(url+'/'+meal.id, this.headers).then(({ data }) => {
                        console.log('meal deleted')

                    }).catch(error => {
                        console.log('processing error message', error)
                        console.log('error message', error.response.data)
                        this.alertMessage = "Could not process payment! Make Sure the data you entered is correct! \r\n"+error+"<br>"+error.response.data.substring(0,300)
                        this.submitDisabled = false
                        this.submitting = false
                    });
                }
            },
            saveMeal(meal){
                console.log('submitting meal', meal)
                if(meal.name == ''){
                    console.log('need name')
                    return
                }


                let url = '/api/meal'
                //seeing if we are saving or updating
                if(meal.id){
                    window.axios.put(url+'/'+meal.id, meal, this.headers).then(({ data }) => {
                        console.log('meal updated',data.data)

                    }).catch(error => {
                        console.log('processing error message', error)
                        console.log('error message', error.response.data)
                        this.alertMessage = "Could not process payment! Make Sure the data you entered is correct! \r\n"+error+"<br>"+error.response.data.substring(0,300)
                        this.submitDisabled = false
                        this.submitting = false
                    });
                }
                else{
                    window.axios.post(url, meal, this.headers).then(({ data }) => {
                        console.log('meal updated',data.data)
                    }).catch(error => {
                        console.log('processing error message', error)
                        console.log('error message', error.response.data)
                        this.alertMessage = "Could not process payment! Make Sure the data you entered is correct! \r\n"+error+"<br>"+error.response.data.substring(0,300)
                        this.submitDisabled = false
                        this.submitting = false
                    });
                }



            },
        },
        mounted(){
            if(this.user){
                this.setHeaders()
                this.getMenu()
            }
        }
    }
</script>

<style scoped>
    .blue--text {
        color: #2196f3!important;
        caret-color: #2196f3!important;
    }
    .theme--dark.v-toolbar.v-sheet {
        background-color: #dcf4e6;
    }
    .pinkText{
        color:#f67e7d
    }
</style>
