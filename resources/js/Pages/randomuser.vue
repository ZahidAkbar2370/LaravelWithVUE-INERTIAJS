<template>
    <app-layout title="randomuser">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gernate Random User
            </h2>
        </template>

    <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <button @click="reload()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Reload</button>
                   <table class="table-fixed w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 w-20">Gender</th>
                                <th class="px-4 py-2 w-20">Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border px-4 py-2">{{ data.gender }}</td>
                                <td class="border px-4 py-2">{{ data.name.title }} {{ data.name.first }} {{ data.name.last }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="py-12">
        	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

	        	<center>

	        	<img class="w-40 h-40 rounded-full object-cover" v-bind:src="data.picture.thumbnail" alt="image" title="new"/>

	        	<div v-show="nameMode">

	        		<span>Hi, My Name is</span>

	        		<h3>
	        			<b>
	        			{{data.name.title}} {{data.name.first}}  {{data.name.last}}
	        			</b>
	        		</h3>

	        	</div>

	        	<div v-show="emailAddressMode">

	        		<span>My Email address is</span>

	        		<h3>
	        			<b>
	        			{{data.email}}
	        			</b>
	        		</h3>

	        	</div>

	        	<div v-show="dobMode">

	        		<span>My Birthdate is</span>

	        		<h3>
	        			<b>
	        			{{data.dob.date}}
	        			</b>
	        		</h3>

	        	</div>

	        	<p>On Click</p>
	        	<button @click="nameShow()" style="margin-left:20px">Name</button>
	        	<button @click="emailAddressShow()" style="margin-left:20px">Email</button>
	        	<button @click="dobShow()" style="margin-left:20px">DOB</button>

	        	<p>On Hover</p>
	        	<button @mouseover="nameMode = true" @mouseleave="nameMode = false" style="margin-left:20px">Name</button>
	        	<button @mouseover="emailAddressMode = true" @mouseleave="emailAddressMode = false" style="margin-left:20px">Email</button>
	        	<button  @mouseover="dobMode = true" @mouseleave="dobMode = false" style="margin-left:20px">DOB</button>
	        	</center>

        	</div>
        </div>
</app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    import AppLayout from './../Layouts/AppLayout'
    import Welcome from './../Jetstream/Welcome'

    export default {
        components: {
            AppLayout,
            Welcome,
        },
        props: ['data', 'errors'],
        data() {
            return {
            
            	columns: [
			        {
			          label: "ID",
			          name: "id",
			          orderable: true
			        },
        		],

                nameMode: false,
                emailAddressMode: false,
                dobMode: false,
            }
        },
        methods:{
        reload: function () {
            this.$inertia.get('/randomuser')
        },
        nameShow:function(){
        	this.nameMode = true;
        	this.emailAddressMode = false;
        	this.dobMode = false;
        },
        emailAddressShow:function(){
        	this.nameMode = false;
        	this.emailAddressMode = true;
        	this.dobMode = false;
        },
        dobShow:function(){
        	this.nameMode = false;
        	this.emailAddressMode = false;
        	this.dobMode = true;
        },
    }
    }
</script>
