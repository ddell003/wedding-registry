<template>
    <div>
        <v-container fluid>
            <v-row justify="center">


                <v-expansion-panels accordion multiple>
                    <v-expansion-panel  v-for="(item, index) in items" style="width:900px">

                        <v-expansion-panel-header style="width:900px; text-align: left;">{{item.question}}</v-expansion-panel-header>
                        <v-expansion-panel-content style="max-width:900px;"><span v-html="item.answer"></span> </v-expansion-panel-content>

                    </v-expansion-panel>
                </v-expansion-panels>

            </v-row>
        </v-container>
    </div>
</template>

<script>
    export default {
        name: "FAQ",
        props : [],
        data() {
            return {
                yesNo:[{name:'Yes', value:1}, {name:'No', value:0}],
                blankMeal:{
                    id:null,
                    name:'',
                    description:'',
                    gluten_free:'',
                },
                items:[],
            };
        },
        methods: {
            setFaq(){
                this.items = [
                    {
                        question:'Current Virginia Policies',
                        answer:'<ul>' +
                            '<li>In door gathering up to 250 people</li>'+
                            '<li>Masks required indoor unless eating at table</li>'+
                            '<li>Social distancing of 6 feet</li>'+
                            '</ul>'
                    },
                    {
                        question:'When should I RSVP by?',
                        answer:'<ul><li>Please RSVP by October 19, 2020. We would love to hear from you before that if you are able!</li>' +
                            '<li>We understand that your RSVP may be tentative due to COVID-19.  If you have specific questions or ideas that would help you feel more comfortable at our wedding, please send me an email at: katie.lynne13@gmail.com</li></ul>'
                    },
                    {
                        question:'What time should I arrive at the ceremony?',
                        answer:'The church will be open as of 2:30PM. Please arrive by 2:50PM at the latest!'
                    },
                    {
                        question:'Can I bring a date?',
                        answer:'Social distancing is somewhat limiting the size of our party but please do reach out if you would like to bring a plus one and it was not included in your invitation.'
                    },
                    {
                        question:'Are kids welcome??\n?',
                        answer:'We\'ve invited some children that are we personally know and love. Your invitation lists the specific people we have accounted for from your household.'

                    },
                    {
                        question:'Is there a dress code?',
                        answer:'Semi-formal or Dressy-casual. Wear something you feel awesome in!'
                    },
                    {
                        question:'Is there parking for the ceremony or reception?',
                        answer:'Yes! There is ample parking at both locations!'
                    },
                    {
                        question:'I have a food allergy, can I make a special request?',
                        answer:'Please, please, please do!! We have planned with our caterer to offer a vegetarian, dairy-free, and gluten-free meals. You can indicate your needs on the RSVP form.'
                    },
                ]
            }

        },
        mounted(){
            this.setFaq()
        }
    }
</script>

<style scoped>

</style>
