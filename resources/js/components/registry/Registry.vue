<template>
    <div>
        <div class="alert alert-warning" role="alert" v-if="alertMessage">
            Please email parkerdell94@gmail.com with a screen shot of the below error message in red.
        </div>
        <registryItem v-if="addParty" :show="addParty" :user="user" :item="currentParty"></registryItem>
        <h2>Registry
            <v-btn rounded color="primary" style="float:right" class="pull-right" v-if="user.admin == 1"
                   @click="addParty = true" dark>
                Add New Item
            </v-btn>
        </h2>
        <v-card>
            <v-card-text>
            <p>
                Here is a list of a few items we liked. Feel free to claim any items you wish to get for us. If you wish to send cash please include it in your card
            </p>
            <address>
                Katie Keifer & Parker Dell<br>
                1100 Patton Farm Rd<br>
                Stuarts Draft VA, 24477<br>
                USA
            </address>
            </v-card-text>
        </v-card>
        <br>

        <v-card v-if="myItems.length > 0">
            <v-list-item two-line>
                <v-list-item-content>
                    <v-list-item-title class="headline blue--text">My Selected Items</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
            <v-data-table
                :headers="tHeaders"
                :items="myItems"
                item-key="id"
                :items-per-page="15"
                :search="search"
                class="elevation-1"
                loading
                loading-text="Loading... Please wait"
            >

                <template v-slot:item.photo_src="{ item }">
                    <img :src="item.photo_src" :alt="item.name">
                </template>
                <template v-slot:item.name="{ item }">
                    <strong>{{item.name}}</strong><br>
                    <em>{{item.description}}</em>
                    <div v-if="user.admin && item.party_id">
                        <br>
                        <em class="text-success">Claimed By: {{item.party.name}}</em>
                    </div>
                </template>
                <template v-slot:item.registry_item_urls="{ item }">
                    <v-list-item v-for="link in item.registry_item_urls" :key="link.id">
                        <v-list-item-content>
                            <v-list-item-subtitle><a :href="link.url">{{link.name}}</a></v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>

                </template>
                <template v-slot:item.actions="{ item }">

                    <v-btn color="secondary" dark style="background-color: #f0ad4e" @click="unClaim(item)">
                        <v-icon>mdi-plus</v-icon> Release Claim
                    </v-btn>


                </template>
            </v-data-table>
        </v-card>
        <br>

        <v-card>
            <v-list-item two-line>
                <v-list-item-content>
                    <v-list-item-title class="headline blue--text">Available Items</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
            <v-text-field
                v-model="search"
                append-icon="mdi-magnify"
                label="Search"
                single-line
                hide-details
            ></v-text-field>

            <v-data-table
                :headers="tHeaders"
                :items="items"
                :items-per-page="15"
                :search="search"
                class="elevation-1"
                loading
                loading-text="Loading... Please wait"
            >

                <template v-slot:item.photo_src="{ item }">
                    <img :src="item.photo_src" :alt="item.name">
                </template>
                <template v-slot:item.name="{ item }">
                    <strong>{{item.name}}</strong><br>
                    <em>{{item.description}}</em>
                    <div v-if="user.admin && item.party_id">
                        <br>
                        <em class="text-success">Claimed By: {{item.party.name}}</em>
                    </div>
                </template>
                <template v-slot:item.registry_item_urls="{ item }">
                    <v-list-item v-for="link in item.registry_item_urls" :key="link.id">
                        <v-list-item-content>
                            <v-list-item-subtitle><a :href="link.url">{{link.name}}</a></v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>

                </template>
                <template v-slot:item.actions="{ item }">
                    <div v-if="user.admin == 1">
                        <v-btn color="secondary" rounded dark style="background-color: #5cbbf6" @click="addParty = true; currentParty=item;">
                            <v-icon>mdi-pencil</v-icon> Edit
                        </v-btn>
                        <v-btn rounded color="primary" style="background-color: #f44336"
                               @click="deleteItem(item)" dark>
                            Delete
                        </v-btn>
                    </div>
                    <div v-else>

                        <v-btn color="secondary" dark style="background-color: #b1ddb2" v-if="item.unlimited_claims == 1">
                            <v-icon>mdi-plus</v-icon> Cant Click Claim
                        </v-btn>
                        <v-btn color="secondary" dark style="background-color: #4caf50" @click="claimItem(item)" v-else>
                            <v-icon>mdi-plus</v-icon> Claim
                        </v-btn>

                    </div>

                </template>
            </v-data-table>
        </v-card>
    </div>

</template>

<script>
    import RegistryItem from './RegistryItem.vue';

    export default {
        name: "Registry",
        components: {
            registryItem: RegistryItem,
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
            unClaim(item){
                console.log('unclaiming item...', item)
                for(let i = 0; i < this.myItems.length; i++){
                    if(this.myItems[i].id == item.id){
                        this.myItems.splice(i, 1)

                        break
                    }
                }
                item.party_id = null
                this.putItem(item, 'items')
            },
            claimItem(item){
              console.log('claiming item...', item)

                for(let i = 0; i < this.items.length; i++){
                    if(this.items[i].id == item.id){
                        this.items.splice(i, 1)
                        break
                    }
                }
                item.party_id = this.user.party_id

                this.putItem(item, 'myItems')

            },
            putItem(item, field){
                let url = '/api/registry_items/'+item.id
                //seeing if we are saving or updating
                window.axios.put(url, item, this.headers).then(({ data }) => {
                    console.log('form updated',data.data)
                    this[field].push(data.data)
                    //return data.data

                }).catch(error => {
                    console.log('processing error message', error)
                    console.log('error message', error.response.data)
                    this.alertMessage = "Could not process payment! Make Sure the data you entered is correct! \r\n"+error+"<br>"+error.response.data.substring(0,300)
                    this.submitDisabled = false
                    this.submitting = false
                });

            },
            sortItems(){
                if(this.user.admin == 1){
                    return
                }

                let availableItems = []
                for(let i = 0; i < this.items.length; i++){

                    //if user claimed item, move it to their array
                    if(this.items[i].party_id == this.user.party_id){
                        this.myItems.push(this.items[i])

                    }
                    else if(! this.items[i].party_id){
                        availableItems.push(this.items[i])
                    }
                }

                this.items = availableItems
            },
            getItems(){
                console.log('getting registry')
                let url = '/api/registry_items'
                window.axios.get(url, this.headers).then(({ data }) => {
                    this.loading = false
                    this.items = data.data
                    this.sortItems()


                }).catch(error => {
                    console.log('processing error message', error)
                    console.log('error message', error.response.data)
                    this.alertMessage = "Could not process payment! Make Sure the data you entered is correct! \r\n"+error+"<br>"+error.response.data.substring(0,300)
                    this.submitDisabled = false
                    this.submitting = false
                });
            },
            deleteItem(item){
                console.log('deleteing item', item)
                //lets make the delete call
                let url = '/api/registry_items/'+item.id
                window.axios.delete(url, this.headers).then(({ data }) => {
                    console.log('submitted request', data)
                    //remove party from list
                    for(let i = 0; i < this.items.length; i++){
                        if(this.items[i].id == item.id){
                            this.items.splice(i, 1)
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
            itemUpdated(item){
                //update party in list
                for(let i = 0; i < this.items.length; i++){
                    if(this.items[i].id == item.id){
                        this.items[i] = item
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
            console.log('in the registry', this.user)
            this.setHeaders()
            this.getItems()

            this.$root.$on('closeItem', (item) => {
                console.log('new methodd added')
                this.closeForm(item)
            })

            this.$root.$on('newItem', (item) => {
                console.log('new party added', item.item)
                this.items.push(item.item)
                this.closeForm(item)
            })

            this.$root.$on('itemUpdated', (item) => {
                console.log('item updated', item.item)
                this.closeForm(item.item)
                this.itemUpdated(item.item)

            })


        },
        data() {
            return {
                loading:true,
                search:'',
                items:[],
                myItems:[],
                addParty:false,
                currentParty:null,
                tHeaders: [
                    {text: 'Picture', align: 'start', sortable: true, value: 'photo_src',},
                    { text: 'Item', value: 'name' },
                    { text: 'Links', value: 'registry_item_urls' },
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
    .blue--text {
        color: #2196f3!important;
        caret-color: #2196f3!important;
    }
    .v-application .secondary {
        background-color: #5cbbf6 !important;
        border-color: #5cbbf6 !important;
    }
    .text-warning {
        color: #8a6d3b !important;
    }
</style>
