<template>
    <div>
        
        <div class="container mt-5">

            <div class="card mb-3 text-white bg-dark">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img    :src="'/images/fotos-users/'+user.foto" alt="" 
                                class="card-img"
                                v-if="user.faker == '0'">
                        <img    :src="user.foto" alt="" 
                                class="card-img"
                                v-else>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{user.name}} {{user.lastname}}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                <small class="badge badge-success font-italic text-white" style="width: 3rem;">rol: </small>
                                {{user.role}}
                            </h6>
                            <a class="card-link">
                                <i  class="fa fa-email fa-1x text-success">
                                </i>
                                {{user.email}}
                            </a>
                            <a class="card-link">
                                <i  class="fa fa-phone fa-1x text-success">
                                </i>
                                {{user.phone}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</template>

<script>

    import Vuetable from "vuetable-2";
    import VuetablePagination from "../utils/VuetablePaginationBootstrap4.vue";
    import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
    import CssConfig from "../utils/TableStyles";
    import VueEvents from 'vue-events'
    Vue.use(VueEvents)

    export default {
        props:['user'],
        components: {
            Vuetable,
            VuetablePagination,
            VuetablePaginationInfo,
        },
        data() {
            return {
                
            }
        },
        created() {

        },
        computed: {
        },
        methods: {

        },

        mounted() {
        },

    }
</script>