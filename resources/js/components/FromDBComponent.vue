<template>
<div>
    <div>
        <h1 style = "color:green">List of Persons currently in the database:&nbsp;</h1>
    </div>
    <div>
        <button style = "background-color:green" @click = "getAllPersons">ShowAll</button>
    </div>
    <br>
    <div style = "color:green">
        <ul>
            <li v-for = "person in persons" :key = "person.name">
                Name: {{ person['name'] }} <br> 
                City: {{person['address']['city'] }} <br> 
                Phone Number: {{person['phoneNumber']}}
            </li>
        </ul>
    </div>
    <br>
    <div style = "color:red">
        <input v-model = "newId" placeholder="ID">
        <button style = "background-color:pink" @click = "deletePerson">Delete Person</button>
        <br> 
    </div>
    <div>
        <p>Person id {{ this.newId }} will be deleted.</p>
    </div>
</div>
</template>

<script>
export default {
    name:"FromDBComponent",
    data() {
        return{ 
            newId:'',
            persons:[],
            personId:[
                {id: '0'}
            ],
        }
    },
    mounted() {
            console.log('Component mounted.')
    },
    methods: {
        deletePerson: function(){
            this.personId.push({id: this.newId})
        },
        getAllPersons: function(){
            const requestOptions = {
                    method: 'GET',
                    headers: { 'Content-Type': 'application/json' },
                };
            fetch('https://penne.test/api/persons', requestOptions)
            .then(response => response.json())
            .then(data => {
                this.persons = data
                console.log(this.persons[0])
            })
        }
    }
}
</script>