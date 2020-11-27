<template>
<div>
    <div>
        <h1 style = "color:blue">List of Persons currently in the database:&nbsp;</h1>
    </div>
    <div style = "color:red">
        <button style = "background-color:blue" @click = "getAllPersons">ShowAll</button>
    </div>
    <br>
    <div style = "color:green">
        <ul>
            <li v-for = "person in persons" :key = "person.name">
                Name: {{ person.name }}<!--, age: {{person.age}}, Id: {{person.personId}}-->
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
                    //headers: { 'Content-Type': 'application/json' },
                };
            fetch('https://penne.test/api/persons', requestOptions)
            .then(response => {
                const contentType = response.headers.get('content-type')
                if (!contentType || !contentType.includes('application/json')) {
                    throw new TypeError("Oops, we haven't got JSON!")
                }
                return response.json();
            })
            //.then(response=> response.json())
            .then(data => {
                this.persons = response.data
                console.log("Persons: " + this.persons)
            })
            .catch(error => console.error(error))
        }
    }
}
</script>