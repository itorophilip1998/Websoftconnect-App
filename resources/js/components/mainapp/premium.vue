<template>
    <div >
           <div class="search text-center ">
                   <h4 class="text-secondary">Quick Search</h4>
                <input type="text" v-model="search" placeholder="Search here ..." class="form-control rounded-pill shadow p1-2 pr-4 px-md-5">
                <i class="fa fa-search btn text-secondary " aria-hidden="true"></i>
                <div class="get shadow-sm border-1">
                      <div v-for="item in posts" :key="item.id">
    {{ item }}
</div>
                </div>
           </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            serach:''
        }
    },
    mounted() {
        this.$store.dispatch('posts');
    },
    computed: {

        posts()
        {
           return this.$store.state.posts;
        },

    },
}
</script>
<style lang="scss" scoped>
div.search
{
    padding: 30% 10%;
    i.fa-search
    {
        position: relative;
        top:-30px;
        left:42%;
    }
}

    @media only screen and (min-width: 768px) {
        i.fa-search
    {
        left:46% !important;
    }
    div.search
{
    padding: 20% 25% !important;
}

}
</style>
