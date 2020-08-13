<style>
    .blue--text {
        color: #2196f3!important;
        caret-color: #2196f3!important;
    }
</style>
<template>
    <div data-app>
        <v-row justify="center">
            <v-dialog v-model="showDialog" persistent fullscreen hide-overlay transition="dialog-bottom-transition">

                <v-card>
                    <v-toolbar dark color="primary">
                        <v-btn icon dark @click="close()">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                        <v-toolbar-title>Add Item</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-toolbar-items>
                            <v-btn dark text @click="save()">Save</v-btn>
                        </v-toolbar-items>
                    </v-toolbar>

                    <v-card-text>
                        <v-container>
                            <h4 class="shrink blue--text title">Details</h4>
                            <v-divider></v-divider>
                            <v-row>
                                <v-col cols="12" sm="6" md="6">
                                    <v-text-field label="Name" v-model="form.name" required></v-text-field>
                                </v-col>

                                <v-col cols="12" sm="6" md="12">
                                    <v-textarea
                                        label="Description"
                                        v-model="form.description"
                                        required
                                    ></v-textarea>
                                </v-col>
                                <v-col cols="12" sm="6" md="12">
                                    <v-textarea
                                        label="Picture Url"
                                        v-model="form.photo_src"
                                        required
                                    ></v-textarea>
                                </v-col>

                                <v-col cols="12" sm="4" md="3">
                                    <span>Unlimited Claims</span>
                                    <v-select
                                        v-model="form.unlimited_claims"
                                        :items="yesNo"
                                        item-text="name"
                                        item-value="value"
                                    ></v-select>
                                </v-col>

                            </v-row>
                            <h4 class="shrink blue--text title">Add Link</h4>
                            <v-divider></v-divider>
                            <v-row v-for="(item, index) in form.registry_item_urls" style="border:1px #777 dashed; margin-bottom:3px">
                                <v-col cols="12" sm="6" md="6">
                                    <v-text-field label="Name" v-model="form.registry_item_urls[index].name" required></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="6">
                                    <v-text-field label="Description" v-model="form.registry_item_urls[index].description"></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="6">
                                    <v-text-field label="Url" v-model="form.registry_item_urls[index].url" required></v-text-field>
                                </v-col>

                            </v-row>

                            <v-row>
                                <v-btn rounded color="primary" style="float:right" class="pull-right" @click="addItem()" dark>
                                    Add New Url
                                </v-btn>
                            </v-row>

                            <v-divider></v-divider>
                        </v-container>

                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click="close()">Close</v-btn>
                        <v-btn color="blue darken-1" text @click="save()">Save</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-row>
    </div>
</template>

<script>
    export default {
        name: "RegistryItem",
        props : ['show', 'user', 'item'],
        data() {
            return {
                test: false,
                showDialog:false,
                yesNo:[{name:'Yes', value:1}, {name:'No', value:0}],
                form:{
                    id:null,
                    name:'',
                    description:'',
                    photo_src:'',
                    registry_item_urls:[{id:null, name:'', description:'', url:''}],
                    party_id:'',
                    unlimited_claims:0

                },
                blankForm:{
                    id:null,
                    name:'',
                    description:'',
                    photo_src:'',
                    registry_item_urls:[{id:null, name:'', description:'', url:''}],
                    party_id:'',
                    unlimited_claims:0

                },
                headers:null,
                radioGroup: 1,
            };
        },
        methods: {
            close(){
                this.form = this.blankForm
                this.$root.$emit('closeItem', {message:'message'})
                console.log('close the form emitter', this.form)
            },
            addItem(){
                console.log('adding new item...')
                this.form.registry_item_urls.push({id:null, name:'', description:'', url:''})
            },
            setHeaders(){
                this.headers = {
                    headers:{
                        Authorization: 'Bearer ' + this.user.api_token,
                    },
                }
            },
            save(){
                console.log('submitting form', this.form)
                if(this.form.registry_item_urls.length == 0){
                    console.log('need items')
                    return
                }


                let url = '/api/registry_items'
                //seeing if we are saving or updating
                if(this.form.id){
                    window.axios.put(url+'/'+this.item.id, this.form, this.headers).then(({ data }) => {

                        console.log('form updated',data.data)
                        this.$root.$emit('itemUpdated', {item:data.data})
                        this.form = this.blankForm

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
                        this.form = this.blankForm
                        console.log('form updated',data.data)
                        this.$root.$emit('newItem', {item:data.data})

                    }).catch(error => {
                        console.log('processing error message', error)
                        console.log('error message', error.response.data)
                        this.alertMessage = "Could not process payment! Make Sure the data you entered is correct! \r\n"+error+"<br>"+error.response.data.substring(0,300)
                        this.submitDisabled = false
                        this.submitting = false
                    });
                }



            },
            setUpFormFromData(item){
                this.form = item

                console.log('the party', item)
            }
        },
        mounted(){
            this.showDialog = this.show
            if(this.user){
                this.setHeaders()
            }

            if(this.item){
                this.setUpFormFromData(this.item)
            }

            console.log('show modal', this.show)

        }
    }
</script>

<style scoped>

</style>
