<template>
    <app-layout title="ChildrenFile">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Header
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                
                <div id="demo">
                    <div v-show="testfile"><test></test></div>
                    <div @mouseover="mouseOver">Show Test File</div>
                </div>
                   
                </div>
            </div>
        </div>

        <test></test>
    </app-layout>
</template>

<script>

    import AppLayout from './../Layouts/AppLayout'
    import Welcome from './../Jetstream/Welcome'
    import Test from './../Pages/Test'

    export default {
        components: {
            AppLayout,
            Welcome,
            Test,
        },
        data() {
            return {
                testfile: false
            }
        },
        methods: {
        mouseOver: function(){
            this.testfile = !this.testfile;   
        }
    }
    }
</script>
