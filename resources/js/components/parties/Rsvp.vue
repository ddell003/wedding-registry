<template>
<div>
    <div data-app>
        <v-row justify="center">
            <v-card>
                <v-toolbar dark color="primary" class="pinkText">
                    <v-toolbar-title >Disclaimer</v-toolbar-title>
                    <v-spacer></v-spacer>

                </v-toolbar>
                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12" sm="12" md="12" lg="12">
                                <p>Some Covid Disclaimer</p>
                            </v-col>
                        </v-row>

                    </v-container>
                </v-card-text>
            </v-card>
            <br>
        </v-row>
        <br>
        <v-row justify="center">
            <v-card>
                <v-toolbar dark color="primary" class="pinkText">
                    <v-toolbar-title >Rsvp To Our Wedding</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-toolbar-items>
                        <v-btn dark text @click="save()" class="pinkText">Save</v-btn>
                    </v-toolbar-items>
                </v-toolbar>

                <v-card-text>
                    <v-container>
                        <h4 class="shrink blue--text title">Details</h4>
                        <v-divider></v-divider>
                        <v-row>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field label="Party Name" v-model="form.name" required></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field label="Email*"  v-model="form.email"  required></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field label="Password*" type="password" v-model="form.password" required></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field label="Street" v-model="form.street"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field label="Street 2" v-model="form.street2"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field label="City" v-model="form.city"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field label="State" v-model="form.state"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field label="Zip" v-model="form.zip"></v-text-field>
                            </v-col>
                        </v-row>
                        <h4 class="shrink blue--text title">RSVP</h4>
                        <v-divider></v-divider>
                        <v-row>
                            <v-col cols="12" sm="4" md="3" v-if="user.admin == 1">
                                <span>Can Attend Rehearsal Dinner</span>
                                <v-select
                                    v-model="form.rehearsal"
                                    :items="yesNo"
                                    item-text="name"
                                    item-value="value"
                                ></v-select>

                            </v-col>
                            <v-col cols="12" sm="4" md="3" v-if="form.rehearsal">
                                <span>Will be attending Rehearsal Dinner</span>
                                <v-select
                                    v-model="form.rsvp.rehearsal"
                                    :items="yesNo"
                                    item-text="name"
                                    item-value="value"
                                ></v-select>
                            </v-col>
                            <v-col cols="12" sm="4" md="3">
                                <span>Will be attending Ceremony</span>
                                <v-select
                                    v-model="form.rsvp.ceremony"
                                    :items="yesNo"
                                    item-text="name"
                                    item-value="value"
                                ></v-select>
                            </v-col>
                            <v-col cols="12" sm="4" md="3">
                                <span>Will be attending Reception</span>
                                <v-select
                                    v-model="form.rsvp.reception"
                                    :items="yesNo"
                                    item-text="name"
                                    item-value="value"
                                ></v-select>
                            </v-col>
                            <v-col cols="12" sm="4" md="3">
                                <span>Response May Change</span>
                                <v-select
                                    v-model="form.rsvp.response_may_change"
                                    :items="yesNo"
                                    item-text="name"
                                    item-value="value"
                                ></v-select>
                            </v-col>


                        </v-row>

                        <h4 class="shrink blue--text title">Add Users</h4>
                        <v-divider></v-divider>
                        <v-row v-for="(user, index) in form.users" style="border:1px #777 dashed; margin-bottom:3px">
                            <v-col cols="12" sm="6" md="6">
                                <v-text-field label="Full Name" v-model="form.users[index].name" required></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                                <v-text-field label="Any Allergies" v-model="form.users[index].allergies"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6">
                                <v-radio-group v-model="form.users[index].meal_id" label="Meal Option:" @change="mealChanged(form.users[index])">
                                    <v-radio
                                        name="meal"
                                        v-for="(meal, index) in meals"
                                        :label=" `${meal.name} - ${meal.description}` "
                                        :value="meal.id"
                                    ></v-radio>
                                </v-radio-group>
                            </v-col>
                        </v-row>

                        <v-row>
                            <v-btn rounded style="background-color:#dcf4e6; color:#f67e7d" class="pull-right" @click="addUser()">
                                Add New User
                            </v-btn>
                        </v-row>

                        <v-divider></v-divider>
                    </v-container>

                </v-card-text>
                <v-card-actions dark color="primary" style="background-color: #dcf4e6">
                    <v-spacer></v-spacer>
                    <v-btn text @click="save()" class="pinkText">Save</v-btn>
                </v-card-actions>
            </v-card>

        </v-row>
    </div>
</div>
</template>

<script>
    export default {
        name: "Rsvp",
        props : ['user', 'party'],
        data() {
            return {
                test: false,
                showDialog:false,
                yesNo:[{name:'Yes', value:1}, {name:'No', value:0}],
                form:{
                    id:null,
                    name:'',
                    email:'',
                    street:'',
                    street2:'',
                    city:'',
                    state:'',
                    zip:'',
                    users:[{id:null, name:'', allergies:'', party_lead:'', meal_id:null}],
                    rehearsal:null,
                    rsvp:{
                        attending:null,
                        rehearsal:null,
                        ceremony:null,
                        reception:null,
                        response_may_change:null
                    }

                },
                blankForm:{
                    id:null,
                    name:'',
                    email:'',
                    street:'',
                    street2:'',
                    city:'',
                    state:'',
                    zip:'',
                    users:[],
                    rehearsal:0,
                    rsvp:{
                        attending:null,
                        rehearsal:null,
                        ceremony:null,
                        reception:null,
                        response_may_change:null
                    }

                },
                meals:[],
                headers:null,
                radioGroup: 1,
            };
        },
        methods: {
            close(){
                this.form = this.blankForm
                this.$root.$emit('closeParty', {message:'message'})
                console.log('close the form emitter', this.form)
            },
            mealChanged(user){
                console.log('meal changed', user)
            },
            addUser(){
                console.log('adding new user...')
                this.form.users.push({id:null, name:'', allergies:'', party_lead:'', meal_id:null})
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
            save(){
                console.log('submitting form', this.form)
                if(this.form.users.length == 0){
                    console.log('need users')
                    return
                }

                if(this.form.rsvp.reception || this.form.rsvp.ceremony){
                    this.form.rsvp.attending = 1
                }
                else{
                    this.form.rsvp.attending = 0
                }

                let url = '/api/party'
                //seeing if we are saving or updating
                if(this.form.id){
                    window.axios.put(url+'/'+this.party.id, this.form, this.headers).then(({ data }) => {
                        console.log('form updated',data.data)
                        this.$root.$emit('partyUpdated', {party:data.data})

                    }).catch(error => {
                        console.log('processing error message', error)
                        console.log('error message', error.response.data)
                        this.alertMessage = "Could not process payment! Make Sure the data you entered is correct! \r\n"+error+"<br>"+error.response.data.substring(0,300)
                        this.submitDisabled = false
                        this.submitting = false
                    });
                }
                else{
                    window.axios.post(url, this.form, this.headers).then(({ data }) => {
                        console.log('form updated',data.data)
                        this.$root.$emit('newParty', {party:data.data})

                    }).catch(error => {
                        console.log('processing error message', error)
                        console.log('error message', error.response.data)
                        this.alertMessage = "Could not process payment! Make Sure the data you entered is correct! \r\n"+error+"<br>"+error.response.data.substring(0,300)
                        this.submitDisabled = false
                        this.submitting = false
                    });
                }



            },
            setUpFormFromData(party){
                this.form = this.party
                if(! this.form.rsvp){
                    this.form.rsvp = this.blankForm.rsvp
                }
                console.log('the party', this.party)
            }
        },
        mounted(){
            this.showDialog = this.show
            if(this.user){
                this.setHeaders()
                this.getMenu()
            }

            if(this.party){
                this.setUpFormFromData(this.party)
                this.form = this.party
            }

            console.log('the data', this.show)

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
