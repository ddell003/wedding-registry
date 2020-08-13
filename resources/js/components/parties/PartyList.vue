<style>
    .v-application .secondary {
        background-color: #5cbbf6 !important;
        border-color: #5cbbf6 !important;
    }
    .text-warning {
        color: #8a6d3b !important;
    }
</style>
<template>
    <div>
        <div class="alert alert-warning" role="alert" v-if="alertMessage">
            Please email parkerdell94@gmail.com with a screen shot of the below error message in red.
        </div>
        <party v-if="addParty" :show="addParty" :user="user" :party="currentParty"></party>
        <h2>Party List
            <v-btn rounded color="primary" style="float:right" class="pull-right"
                   @click="addParty = true" dark>
                Add New Party
            </v-btn>
        </h2>



        <v-data-table
            :headers="tHeaders"
            :items="parties"
            :items-per-page="15"
            class="elevation-1"
            loading
            loading-text="Loading... Please wait"
        >
            <template v-slot:item.rsvp="{ item }">
                <span class="text-success" v-if="item.rsvp && (item.rsvp.ceremony == 1 || item.rsvp.reception == 1)">Yes</span>
                <span class="text-danger" v-else>No</span>
                <br v-if="item.rsvp && item.rsvp.response_may_change">
                <span class="text-warning" style="color: #8a6d3b" v-if="item.rsvp && item.rsvp.response_may_change">Response May Change</span>
            </template>
            <template v-slot:item.users="{ item }">
                <v-list-item v-for="user in item.users" :key="user.id">
                    <v-list-item-content>
                        <v-list-item-subtitle>{{user.name}}</v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>

            </template>
            <template v-slot:item.count="{ item }">
                {{item.users.length}}

            </template>
            <template v-slot:item.actions="{ item }">

                <v-btn color="secondary" rounded dark style="background-color: #5cbbf6" @click="addParty = true; currentParty=item;">
                    <v-icon>mdi-pencil</v-icon> Edit
                </v-btn>
                <v-btn rounded color="primary" style="background-color: #f44336"
                       @click="deleteParty(item)" dark>
                    Delete
                </v-btn>

            </template>
        </v-data-table>
    </div>

</template>

<script>
    import Party from './Party.vue';

    export default {
        name: "PartyList",
        components: {
            party: Party,
        },
        props : ['user'],
        methods: {
            setHeaders(){
                this.headers = {
                    headers:{
                        Authorization: 'Bearer ' + this.user.api_token,
                    },
                }
            },
            getParties(){
                console.log('getting parties')
                let url = '/api/party'
                window.axios.get(url, this.headers).then(({ data }) => {
                    this.loading = false
                    this.parties = data.data


                }).catch(error => {
                    console.log('processing error message', error)
                    console.log('error message', error.response.data)
                    this.alertMessage = "Could not process payment! Make Sure the data you entered is correct! \r\n"+error+"<br>"+error.response.data.substring(0,300)
                    this.submitDisabled = false
                    this.submitting = false
                });
            },
            deleteParty(party){
                console.log('deleteing party', party)
               //lets make the delete call
                let url = '/api/party/'+party.id
                window.axios.delete(url, this.headers).then(({ data }) => {
                    console.log('submitted request', data)
                    //remove party from list
                    for(let i = 0; i < this.parties.length; i++){
                        if(this.parties[i].id == party.id){
                            this.parties.splice(i, 1)
                            break
                        }
                    }
                }).catch(error => {
                    console.log('processing error message', error)
                    console.log('error message', error.response.data)
                    this.alertMessage = "Could not process payment! Make Sure the data you entered is correct! \r\n"+error+"<br>"+error.response.data.substring(0,300)
                    this.submitDisabled = false
                    this.submitting = false
                });

            },
            closeForm(item){
                console.log('recieved close form event')
                this.currentParty = null
                this.addParty = false
            },
            partyUpdated(party){
                //update party in list
                for(let i = 0; i < this.parties.length; i++){
                    if(this.parties[i].id == party.id){
                        this.parties[i] = party
                        break
                    }
                }
            },

        },
        computed: {
            draggingInfo() {
                return this.dragging ? "under drag" : "";
            }
        },
        mounted(){
            this.setHeaders()
            this.getParties()

            this.$root.$on('closeParty', (item) => {
                console.log('new methodd added')
                this.closeForm(item)
            })

            this.$root.$on('newParty', (item) => {
                console.log('new party added', item.party)
                this.parties.push(item.party)
                this.closeForm(item)
            })

            this.$root.$on('partyUpdated', (item) => {
                console.log('party updated', item.party)
                this.partyUpdated(item.party)
                this.closeForm(item)
            })


        },
        data() {
            return {
                loading:true,
                parties:[],
                addParty:false,
                currentParty:null,
                tHeaders: [
                    {text: 'Party Name', align: 'start', sortable: true, value: 'name',},
                    { text: 'Email', value: 'email' },
                    { text: 'RSVP', value: 'rsvp' },
                    { text: 'Guests', value: 'users' },
                    { text: 'Count', value: 'count' },
                    { text: 'Actions', value: 'actions' },

                ],
                dragging: false,
                headers:null,
                alertMessage:null,
                dialog: false,
            };
        }
    }

</script>

<style scoped>

</style>
