<template>
    <div class="content">
        <div class="title m-b-md">{{title}}{{subtitle}}</div>
    </div>
</template>

<script>
    export default{
        name:"Placeholder",
        data() {
            return {
                title:"Coming Soon...",
            };
        },
        props:{
            subtitle: String,
        },
    };
</script>