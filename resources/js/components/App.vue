<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <Header :title="title"/>
                    

                    <div class="card-body">
                        Sito in Costruzione
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Header from './Header.vue'
export default {
    name:"App",
    components:{
        Header,
    },
    data(){
        return{
            title:"Work in Progress",
        }
    }
}
</script>
