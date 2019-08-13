<template>
    
</template>

<script>
    export default {
        name: "ContactsShow",

        mounted() {
            axios.get('/api/contacts/' + this.$route.params.id)
                .then(response => {
                    this.contact = response.data.data;
                })
                .catch(errors => {
                    this.errors = errors.response.data.errors;
                    console.log(errors);
                });
        },

        data: function() {
            return {
                contact: null,
            }
        }
    }
</script>
