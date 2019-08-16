<template>
    <div>
        <div v-if="focus" @click="focus = false" class="bg-black opacity-25 absolute right-0 left-0 top-0 bottom-0 z-10"></div>

        <div class="relative z-10"><input type="text" placeholder="search" id="searchTerm" v-model="searchTerm" @input="search" @focus="focus = true" class="w-64 mr-6 bg-gray-200 border rounded"></div>

        <div v-if="focus" class="absolute bg-blue-900 text-white rounded-lg p-4 w-96 right-0 mr-6 mt-2 shadow z-20">
            <div v-if="results == 0">norezults found {{ searchTerm }}</div>
            <div v-for="result in results" :key="result.id" @click="focus = false">
                <router-link :to="result.links.self">
                    <div class="flex items-center">
                        <UserCircle :name="result.data.name"/>
                        <div class="pl-3">
                            <p>{{ result.data.name }}</p>
                            <p>{{ result.data.company }}</p>
                        </div>
                    </div>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
    import _ from "lodash";
    import UserCircle from './UserCircle';
    export default {
        name: "SearchBar",

        components: {
            UserCircle
        },

        data: function () {
            return {
                searchTerm: '',
                focus: false,
                results: []
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
