<template>
    <Head title="Test" />

    <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                   <h1>Test File:<small>children data </small>{{name}}</h1>
                </div>
            </div>
        </div>

</template>

<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Head,
            Link,
        },

        data() {
            return {
                name: "Zahid Akbar"
            }
        },
    })
</script>
