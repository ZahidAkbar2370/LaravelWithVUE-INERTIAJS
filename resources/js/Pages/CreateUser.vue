<template>
    <app-layout title="Create User">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                User
            </h2>
        </template>

        

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    
                    <button @click="createShow()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3 ">Create User</button>
                    <button @click="indexShow()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">View Users</button>

                </div>
            </div>
        </div>

        <div class="py-12" v-if="createForm">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <form>
                          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="">
                                  <div class="mb-4">
                                      <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                                      <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Name" v-model="form.name">
                                  </div>
                                  <div class="mb-4">
                                      <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                                      <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput2" placeholder="Enter Email" v-model="form.email">
                                  </div>
                                  <div class="mb-4" v-show="!editForm">
                                      <label for="exampleFormControlInput3" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                                      <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput3" placeholder="Enter Password" v-model="form.password">
                                  </div>
                            </div>
                          </div>
                          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                              <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" v-show="!editForm" @click="save(form)">
                                Save
                              </button>
                            </span>
                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                              <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" v-show="editForm" @click="update(form)">
                                Update
                              </button>
                            </span>
                            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                              
                              <button @click="createClose()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Cancel
                              </button>
                              <button @click="reset()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5 ml-4">
                                Reset
                              </button>
                            </span>
                          </div>
                          </form>
                </div>
            </div>
        </div>
    

        <div class="py-12" v-if="indexTable">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                 <table class="table-fixed w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 w-20">No.</th>
                                <th class="px-4 py-2">Title</th>
                                <th class="px-4 py-2">Body</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="row in data">
                                <td class="border px-4 py-2">{{row.id}}</td>
                                <td class="border px-4 py-2">{{row.name}}</td>
                                <td class="border px-4 py-2">{{row.email}}</td>
                                <td class="border px-4 py-2">
                                    <button @click="edit(row)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mr-3 rounded">Edit</button>
                                    <button @click="deleteRow(row)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 mr-3 px-4 rounded">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Welcome from '@/Jetstream/Welcome.vue'

    export default defineComponent({
        components: {
            AppLayout,
            Welcome,
        },
         props: ['data', 'errors'],
        data() {
            return {
                indexTable: false,
                editForm: false,
                createForm: false,
                form: {
                    name: null,
                    email: null,
                    password: null,
                },
            }
        },
        methods:{
            reset: function(){
                this.form = {
                    name:null,
                    email:null,
                    password:null,
                }
            },
            createClose: function(){
                this.createForm = false;
                this.reset();
            },
            createShow: function(){
                this.indexTable = false;
                this.createForm = true;
            },
            indexShow: function(){
                this.createForm = false;
                this.indexTable = true;
            },
            save: function (data) {
                this.$inertia.post('/users', data)
                this.reset();
            },
            edit: function (data) {
                this.form = Object.assign({}, data);
                this.editForm = true;
                this.createShow();
            },
            update: function (data) {
                data._method = 'PUT';
                this.$inertia.post('/users/' + data.id, data)
                this.reset();
                this.createClose();
                this.indexShow();
            },
            deleteRow: function (data) {
                if (!confirm('Are you sure want to remove?')) return;
                data._method = 'DELETE';
                this.$inertia.post('/users/' + data.id, data)
                this.reset();
            }
        }
    })
</script>