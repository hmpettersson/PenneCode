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
</div>
</template>

<script>
export default {
    name:"FromDBComponent",
    data() {
        return{ 
            persons:[],
        }
    },
    mounted() {
            console.log('Component mounted.')
    },
    methods: {
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