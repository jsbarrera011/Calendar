<template>
<div>
    <v-navigation-drawer
      v-model="drawer"
      app
    >
     <v-list dense>
      <v-list-item-group
        color="primary"
      >
        <v-list-item @click="gotoCalendar()">
          <v-list-item-icon>
            <v-icon>mdi-calendar</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title class="ml-2">CALENDAR</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list-item-group>
    </v-list>
    </v-navigation-drawer>

    <v-app-bar app color ="#404146">
      <v-app-bar-nav-icon dark @click="drawer = !drawer"></v-app-bar-nav-icon>

      <v-toolbar-title></v-toolbar-title>

    </v-app-bar>
</div>
</template>

<script>
export default {
    data (){
        return{
            drawer: false
        }
    },
    methods:{
        gotoCalendar(){
            this.$router.push('/').catch(err => {
            })
        }
    },
}
</script>
