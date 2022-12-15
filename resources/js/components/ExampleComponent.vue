<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <Lukz />
</template>

<script>
import Lukz from './Lukz.vue'

    export default {
        mounted() {
            // alert('Component mounted.')
        },
        components: {
            Lukz
        }
    }
</script>
