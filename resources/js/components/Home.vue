<template>
    <v-container>
        <v-card class="ma-5">
            <v-card-title>
                <h3 class="mt-3"><strong>Calendar</strong></h3>
            </v-card-title>
            <v-divider class="mt-n3"></v-divider>
            <v-card-text>
                <v-row>
                    <v-col cols="12" md="4">
                        <p><strong>Event</strong></p>
                        <v-text-field v-model="eventName" outlined dense append-icon="mdi-calendar-star"></v-text-field>
                        <v-row>
                        <v-col cols="12" md="6">
                            <p><strong>From</strong></p>
                                <v-menu
                                    v-model="menuFrom"
                                    :close-on-content-click="false"
                                    :nudge-right="40"
                                    transition="scale-transition"
                                    offset-y
                                    min-width="290px"
                                >
                                    <template v-slot:activator="{ on, attrs }">
                                    <v-text-field
                                        v-model="dateFrom"
                                        append-icon="mdi-calendar"
                                        readonly
                                        v-bind="attrs"
                                        v-on="on"
                                        outlined
                                        dense
                                    ></v-text-field>
                                    </template>
                                    <v-date-picker
                                    v-model="dateFrom"
                                    @input="menuFrom = false"
                                    ></v-date-picker>
                                </v-menu>
                        </v-col>
                        <v-col cols="12" md="6">
                            <p><strong>To</strong></p>
                                <v-menu
                                    v-model="menuTo"
                                    :close-on-content-click="false"
                                    :nudge-right="40"
                                    transition="scale-transition"
                                    offset-y
                                    min-width="290px"
                                >
                                    <template v-slot:activator="{ on, attrs }">
                                    <v-text-field
                                        v-model="dateTo"
                                        append-icon="mdi-calendar"
                                        readonly
                                        v-bind="attrs"
                                        v-on="on"
                                        outlined
                                        dense
                                    ></v-text-field>
                                    </template>
                                    <v-date-picker
                                    v-model="dateTo"
                                    @input="menuTo = false"
                                    ></v-date-picker>
                                </v-menu>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12" md="12">
                            <v-row>
                                <v-checkbox v-model="chkMon" class="ml-2" label="Mon"></v-checkbox>
                                <v-checkbox v-model="chkTue" class="ml-2" label="Tue"></v-checkbox>
                                <v-checkbox v-model="chkWed" class="ml-2" label="Wed"></v-checkbox>
                                <v-checkbox v-model="chkThu" class="ml-2" label="Thu"></v-checkbox>
                                <v-checkbox v-model="chkFri" class="ml-2" label="Fri"></v-checkbox>
                                <v-checkbox v-model="chkSat" class="ml-2" label="Sat"></v-checkbox>
                                <v-checkbox v-model="chkSun" class="ml-2" label="Sun"></v-checkbox>
                            </v-row>
                        </v-col>
                    </v-row>
                    <v-btn color="primary" @click="generateDates()"><strong>SAVE</strong></v-btn>
                    </v-col>
                    <v-col cols="12" md="8">
                        <v-simple-table>
                            <thead>
                                <tr>
                                    <th colspan="3"><h1>{{headerName}}</h1></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(array,x) in arrDates" :key="x">
                                    <td v-if="array.Event != null && array.Event != ''" style="background-color:#BAEEEF" width="10">{{array.Day}}</td>
                                    <td v-else width="10">{{array.Day}}</td>
                                    <td v-if="array.Event != null && array.Event != ''" style="background-color:#BAEEEF" width="200">{{array.DayName}}</td>
                                    <td v-else width="200">{{array.DayName}}</td>
                                    <td v-if="array.Event != null && array.Event != ''" style="background-color:#BAEEEF">{{array.Event}}</td>
                                    <td v-else>{{array.Event}}</td>
                                </tr>
                            </tbody>
                        </v-simple-table>
                    </v-col>
                </v-row>

            </v-card-text>
        </v-card>
    </v-container>
</template>

<script>
import moment from 'moment'
export default {
    data (){
        return{
            modal: false,
            dateFrom: moment().format("YYYY-MM-DD"),
            dateTo: moment().format("YYYY-MM-DD"),
            menuFrom: false,
            menuTo: false,
            headerName: null,
            arrDates:[],
            eventName: null,
            chkMon:false,
            chkTue:false,
            chkWed:false,
            chkThu:false,
            chkFri:false,
            chkSat:false,
            chkSun:false,
            option:{
                position: 'topRight',
                transitionIn: 'fadeInUp',
                transitionOut: 'fadeOut',
                timeout: 2000
            }
        }
    },
    methods:{
        saveRecords(){
            axios.post("/saveRecords",{ record: this.arrDates}).then(res => {
                this.$toast.success("Event Successfully Saved ","SUCCESS",this.option)
            }).catch(err => {
                console.log(err)
            })
        },
        generateDates(){
            this.arrDates = []

            // var from = moment(this.dateFrom).format("YYYY/MM/DD")
            // var to = moment(this.dateTo).format("YYYY/MM/DD")
            // if(moment(from).format("MM") != moment(to).format("MM")){
            //     this.headerName = moment(from).format("MMMM") + " " + moment(from).format("YYYY") + " - "+moment(to).format("MMMM") + " " + moment(to).format("YYYY")
            // }else{
            //     this.headerName = moment(from).format("MMMM") + " " +  moment(from).format("YYYY")
            // }

            // if(from > to){
            //     this.$toast.warning("Invalid Date Parameter","WARNING",this.option)
            //     return false
            // }else{
            //     for(var i = from;from <= to;from = moment(from).add(1,'day').format("YYYY/MM/DD")){
            //         this.arrDates.push({
            //             Day : moment(from).format("DD"),
            //             DayName: moment(from).format("dddd").substring(0,3),
            //             Month: moment(from).format("MMMM"),
            //             Event: null,
            //             Date : moment(from).format("YYYY/MM/DD")})
            //     }
            // }

            var from = moment(new Date(this.dateFrom)).format("YYYY/MM/DD")
            var to = moment(new Date(this.dateTo)).format("YYYY/MM/DD")


            if(from > to){
                this.$toast.warning("Invalid Date Parameter","WARNING",this.option)
                return false
            }else{
                for(var i = from;from <= to;from = moment(new Date(from)).add(1,'day').format("YYYY/MM/DD")){
                    this.arrDates.push({
                        Day : moment(new Date(from)).format("DD"),
                        DayName: moment(new Date(from)).format("dddd").substring(0,3),
                        Month: moment(new Date(from)).format("MMMM"),
                        Event: null,
                        Date : moment(new Date(from)).format("YYYY/MM/DD")})
                }
            }

            if(moment(new Date(from)).format("MM") != moment(new Date(to)).format("MM")){
                this.headerName = moment(new Date(from)).format("MMMM") + " " + moment(new Date(from)).format("YYYY") + " - " + moment(new Date(to)).format("MMMM") + " " + moment(new Date(to)).format("YYYY")
            }else{
                this.headerName = moment(new Date(from)).format("MMMM") + " " +  moment(new Date(from)).format("YYYY")
            }
            this.saveEvents()
        },
         saveEvents(){
            var mon = 0,tue = 0,wed = 0,thu = 0,fri = 0,sat = 0,sun = 0
            var length = this.arrDates.length

            if(this.eventName == null || this.eventName == ""){
                this.$toast.warning("Please add event","WARNING",this.option)
                return false
            }
            if(this.chkMon == true){
                mon = 1
            }
            if(this.chkTue == true){
                tue = 1
            }
            if(this.chkWed == true){
                wed = 1
            }
            if(this.chkThu == true){
                thu = 1
            }
            if(this.chkFri == true){
                fri = 1
            }
            if(this.chkSat == true){
                sat = 1
            }
            if(this.chkSun == true){
                sun = 1
            }
            if(mon == 0 && tue == 0 && wed == 0 && thu == 0 && fri == 0 && sat == 0 && sun == 0){
                this.$toast.warning("Please select Days","WARNING",this.option)
                return false
            }
            for(var i = 0;i < length;i++){
                if(mon == 1){
                    if(this.arrDates[i].DayName == 'Mon'){
                        this.arrDates[i].Event = this.eventName
                    }
                }
                if(tue == 1){
                    if(this.arrDates[i].DayName == 'Tue'){
                        this.arrDates[i].Event = this.eventName
                    }
                }
                if(wed == 1){
                    if(this.arrDates[i].DayName == 'Wed'){
                        this.arrDates[i].Event = this.eventName
                    }
                }
                if(thu == 1){
                    if(this.arrDates[i].DayName == 'Thu'){
                        this.arrDates[i].Event = this.eventName
                    }
                }
                if(fri == 1){
                    if(this.arrDates[i].DayName == 'Fri'){
                        this.arrDates[i].Event = this.eventName
                    }
                }
                if(sat == 1){
                    if(this.arrDates[i].DayName == 'Sat'){
                        this.arrDates[i].Event = this.eventName
                    }
                }
                if(sun == 1){
                    if(this.arrDates[i].DayName == 'Sun'){
                        this.arrDates[i].Event = this.eventName
                    }
                }
            }
            this.saveRecords()
        }
    }
}
</script>
