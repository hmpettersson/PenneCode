<template>
<div>
    <div>
        <h1 style = "color:blue">List of Persons currently in the database:&nbsp;</h1>
    </div>
    <br>
    <div style = "color:green">
        <ul>
            <li v-for = "(person, index) in persons" :key = 'index'>{{person.name}}</li>
        </ul>
    </div>
    <br>
    <div style = "color:red">
        <input v-model = "deletePerson" placeholder="Person ID">
        <button @click = "deletePerson">Delete Person</button>
        <br>
        <p>PersonID {{newPersonID}} deleted.</p> 
    </div>
</div>
</template>

<script>
export default {
    name:"FromDBComponent",
    data: { //original version har data() och returnar ett objekt
        persons:[
            {name: 'Star'},
            {name: 'Dust'}
        ],
        personID:[
            {id: 0}
        ],
        newPersonID:''
        // return {
        //     personId ='',
        //};
    },
    mounted() {
            console.log('Component mounted.')
    },
    methods: {
        deletePerson: function(){
            return this.personID.push({id: this.newPersonID})
            this.newPersonID = ''
        }
        // getInputPersonId(){
        //     return this.personId;   
        // }
    }
}
</script>