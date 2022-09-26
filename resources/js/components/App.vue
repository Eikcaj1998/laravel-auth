<template>
    <div class="content"><Placeholder :subtitle="subtitle"/></div>
</template>

<script>
    import Placeholder from "./Placeholder"
    export default{
        name:"App",
        components:{
            Placeholder
        },
        data(){
            return{
                subtitle:"or just wait",
            }
        }
    };
</script>