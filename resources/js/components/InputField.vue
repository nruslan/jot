<template>
    <div class="relative pb-4">
        <label :for="name" class="text-blue-500 pt-2 uppercase text-xs font-bold absolute">{{ label }}</label>
        <input :id="name" type="text" :placeholder="placeholder" v-model="value" @input="updateField()" class="pt-8 w-full border-b text-gray-900 focus:outline-none focus:border-blue-400" :class="errorClassObject()">
        <p class="text-red-600 text-sm" v-text="errorMessage()">errors</p>
    </div>
</template>

<script>
    export default {
        name: "InputField",

        props: [
            'name', 'label', 'placeholder', 'errors', 'data'
        ],

        data: function() {
            return {
                value: ''
            }
        },

        computed: {
            hasError: function() {
                return this.errors && this.errors[this.name] && this.errors[this.name].length > 0;
            }
        },

        methods: {
            updateField: function() {
                this.clearErrors(this.name);
                this.$emit('update:field', this.value)
            },

            errorMessage: function() {
                if(this.hasError) {
                    return this.errors[this.name][0];
                }
            },

            clearErrors: function() {
                if(this.hasError) {
                    this.errors[this.name] = null;
                }
            },

            errorClassObject: function() {
                return {
                    'error-field': this.hasError
                }
            }
        },

        watch: {
            data: function(val) {
                this.value = val
            }
        }
    }
</script>

<style scoped>
    .error-field {
        @apply .border-red-500 .border-b-2
    }
</style>