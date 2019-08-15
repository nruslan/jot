<template>
    <div>
        <input type="text" placeholder="search" id="searchTerm" v-model="searchTerm" @input="search" class="w-64 mr-6 bg-gray-200 border rounded">
    </div>
</template>

<script>
    import _ from "lodash";
    export default {
        name: "SearchBar",

        data: function () {
            return {
                searchTerm: '',
                results: ''
            }
        },

        methods: {
            search: _.debounce(function(e) {
                if(this.searchTerm.length < 3) {
                    return;
                }
                axios.post('/api/search', { searchTerm: this.searchTerm })
                    .then(response => {
                        this.results = response.data.data;
                    })
                    .catch(error => {
                        console.log(error.response);
                    });
            }, 300)

        }
    }
</script>
