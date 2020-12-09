<template>
<div>
    <div>
        <h1 style = "color:red">Delete a Person from the database:&nbsp;</h1>
    </div>
    <br>
    <div style = "color:red">
        <input v-model = "theId" placeholder="ID Number">
        <button style = "background-color:red" @click = "onSubmit">Delete Person</button>
        <br> 
    </div>
    <div>
        <p>Person id {{ this.theId }} will be deleted.</p>
    </div>
</div>
</template>

<script>
export default {
    name:"DeleteComponent",
    data() {
        return{ 
            theId:'',
        }
    },
    mounted() {
            console.log('Component mounted.')
    },
    methods: {
        onSubmit: function(){
            this.deletePerson()
            alert('Person with ID ' + this.theId + ' has been deleted.')
            this.theId = ''
        },
        deletePerson: function(){
            const requestOptions = {
                    method: 'DELETE',
                    headers: { 'Content-Type': 'application/json' },
            };
            fetch('https://penne.test/api/persons/' + this.theId, requestOptions)
                .then(response => {
                    if (response.status === 200) {
                    return response.json();
                    } else {
                        throw new Error('Something went wrong on api server!');
                    }
                })
                .then(response => {
                    console.debug(response);
                }).catch(error => {
                console.error(error);
                }); 
        }
    }
}
</script>