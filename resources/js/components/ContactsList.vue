<template>
    <div>
        <div v-if="loading">Loading...</div>
        <div v-else>
            <div v-if="contacts.length === 0">
                <p>no contacts yet. <router-link to="/contacts/create">Add new contact</router-link></p>
            </div>
            <div v-for="contact in contacts" :key="contact.data.contact_id">
                <router-link :to="'/contacts/' + contact.data.contact_id" class="flex items-center border-b border-gray-400 p-4 hover:bg-gray-100">
                    <UserCircle :name="contact.data.name" />
                    <div>
                        <p>{{ contact.data.name }}</p>
                        <p>{{ contact.data.company }}</p>
                    </div>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
    import UserCircle from './UserCircle';
    export default {
        name: "ContactsList",
        components: {
            UserCircle
        },

        props: [
            'endpoint'
        ],

        mounted() {
            axios.get(this.endpoint)
                .then(response => {
                    this.contacts = response.data.data;
                    this.loading = false;
                })
                .catch(errors => {
                    this.loading = false;
                    alert('Unable to fetch contacts');
                });
        },

        data: function() {
            return {
                loading: true,
                contacts: null,
            }
        }
    }
</script>
