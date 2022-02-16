<template>
    <app-layout title="User">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manage User
            </h2>
        </template>

        <div class="py-12" v-if="isOpen">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                        Selected User
                    </h2>
                    <div class="">
                        <div class="" >

                            <div class="leading-tight" >
                                <center><img class="w-40 h-40 rounded-full object-cover" src="https://picsum.photos/200"/></center>
                                <br>
                                <div class="text-center">{{form.name}}</div>
                                <div class="text-gray-700 text-sm text-center">{{form.email}}</div>
                                <center><button @click="close()" class="bg-green-500 hover:bg-red-700 text-white font-bold py-2 px-4 mr-3 rounded">Unselect User</button></center>
                                 
                            </div>

                        </div>
                    </div>

                    

                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    
                    <div class="col-span-6">
                        <div class="flex items-center mt-2" >
                            
                            <div class="ml-4 leading-tight" v-for="row in data">
                                <center><img class="w-20 h-20 rounded-full object-cover" src="https://picsum.photos/200"/></center>
                                <br>
                                <div class="text-center">{{row.name}}</div>
                                <button @click="show(row)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mr-3 rounded">Select User</button>
                                    
                            </div>

                        </div>
                    </div>

                    

                </div>
            </div>
        </div>

        

    </app-layout>
</template>
<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'
    export default {
        components: {
            AppLayout,
            Welcome,
        },
        props: ['data', 'errors'],
        data() {
            return {
                isOpen: false,
                form: {
                    name: null,
                    email: null,
                },
            }
        },
        methods:{
            close:function(){
                this.isOpen = false,
                this.form = {
                    name: null,
                    email: null,
                }
            },
            show: function (data) {
                this.form = Object.assign({}, data);
                this.isOpen = true;
            },
        }
       
    }
</script>