<template>
    <app-layout title="Product">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manage Product
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                   
                    <button @click="openModal()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Create New Product</button>
                    <table class="table-fixed w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 w-20">No.</th>
                                <th class="px-4 py-2">Product Name</th>
                                <th class="px-4 py-2">Categorey Name</th>
                                <th class="px-4 py-2">Price</th>
                                <th class="px-4 py-2">Description</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="row in data">
                                <td class="border px-4 py-2">{{ row.id }}</td>
                                <td class="border px-4 py-2">{{ row.product_name }}</td>
                                <td class="border px-4 py-2">{{ row.categorey.categorey_name }}</td>
                                <td class="border px-4 py-2">{{ row.price }}</td>
                                <td class="border px-4 py-2">{{ row.description }}</td>
                                <td class="border px-4 py-2">
                                    <button @click="edit(row)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mr-3 rounded">Edit</button>
                                    <button @click="deleteRow(row)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mr-3 rounded">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    

                    <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
                      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        
                        
                        <!-- This element is to trick the browser into centering the modal contents. -->
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                          <form>
                          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="">
                                  <div class="mb-4">
                                      <label for="exampleSelected" class="block text-gray-700 text-sm font-bold mb-2">Categorey Name:</label>
                                       <select v-model="form.categorey_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleSelected">
                                            <option disabled value="">Please select Categorey</option>
                                            <option v-for="row in categorey" v-bind:value="row.id">{{row.categorey_name}}</option>                           
                                        </select>
                                      </div>

                                  <div class="mb-4">
                                      <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Product Name:</label>
                                      <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Product Name" v-model="form.product_name">
                                  </div>

                                  <div class="mb-4">
                                      <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Product Price:</label>
                                      <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput2" placeholder="Enter Product Price" v-model="form.price">
                                  </div>

                                  <div class="mb-4">
                                      <label for="exampleFormControlInput3" class="block text-gray-700 text-sm font-bold mb-2">Product Description:</label>
                                      <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput3" placeholder="Enter Product Description" v-model="form.description">
                                  </div>
                            </div>
                          </div>
                          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                              <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" v-show="!editMode" @click="save(form)">
                                Save
                              </button>
                            </span>
                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                              <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" v-show="editMode" @click="update(form)">
                                Update
                              </button>
                            </span>
                            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                              
                              <button @click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Cancel
                              </button>
                            </span>
                          </div>
                          </form>
                          
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
        props: ['data', 'categorey', 'errors'],
        data() {
            return {
                editMode: false,
                isOpen: false,
                form: {
                    categorey_id: null,
                    product_name: null,
                    price: null,
                    description: null,
                },
            }
        },
        methods: {
            openModal: function () {
                this.isOpen = true;
            },
            closeModal: function () {
                this.isOpen = false;
                this.reset();
                this.editMode=false;
            },
            reset: function () {
                this.form = {
                    categorey_name: null,
                    publication_status: null,
                }
            },
            save: function (data) {
                this.$inertia.post('/products', data)
                this.reset();
                this.closeModal();
                this.editMode = false;
            },
            edit: function (data) {
                this.form = Object.assign({}, data);
                this.editMode = true;
                this.openModal();
            },
            update: function (data) {
                data._method = 'PUT';
                this.$inertia.post('/products/' + data.id, data)
                this.reset();
                this.closeModal();
            },
            active: function (data) {
                if (!confirm('Are you sure want to Active Categorey?')) return;
                data._method = 'PUT';
                this.$inertia.post('/active/' + data.id, data)
            },
            inactive: function (data) {
                if (!confirm('Are you sure want to In-active Categorey?')) return;
                data._method = 'PUT';
                this.$inertia.post('/inactive/' + data.id, data)
            },
            deleteRow: function (data) {
                if (!confirm('Are you sure want to remove Categorey?')) return;
                data._method = 'DELETE';
                this.$inertia.post('/products/' + data.id, data)
                this.reset();
                this.closeModal();
            }
        }
    }
</script>