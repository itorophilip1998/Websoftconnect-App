<template>
     <div class=" text-dark bg" >
<div class="overlay p-md-5 pt-4">


           <div class="Edit  rounded-lg p-md-3 p-1 " >


<br>
    <nav class="bg-white rounded-lg   ">
        <!-- reactons -->
         <h5 class="  p-2">People who reacted <i class="fa fa-smile-o" aria-hidden="true"></i>
         <router-link to="/home" class="btn shadow-sm float-right" title="Home"><i class="fa fa-home " aria-hidden="true"></i></router-link></h5>
    <div class="nav nav-tabs rounded-lg " id="nav-tab" role="tablist">
    <a class="nav-item nav-link  text-secondary px-3 active" id="nav-all-tab" data-toggle="tab" href="#nav-all" role="tab" aria-controls="nav-all" aria-selected="true"  > <span v-if="getLike.length !=0 || getLove.length !=0 || getLaugh.length !=0">All {{getLike.length + getLove.length + getLaugh.length}}</span></a>
    <a  class="nav-item nav-link  text-secondary px-3 " id="nav-like-tab" data-toggle="tab" href="#nav-like" role="tab" aria-controls="nav-like" aria-selected="true" v-if="getLike.length"> <span v-if="getLike.length !=0"><i class="fa fa-thumbs-up text-primary" aria-hidden="true"></i> {{getLike.length}}</span>  </a>
    <a  class="nav-item nav-link text-secondary px-3 " id="nav-love-tab" data-toggle="tab" href="#nav-love" role="tab" aria-controls="nav-love" aria-selected="true" v-if="getLove.length"><span v-if="getLove.length !=0">💗 {{getLove.length}}</span></a>
    <a  class="nav-item nav-link text-secondary px-3 " id="nav-laugh-tab" data-toggle="tab" href="#nav-laugh" role="tab" aria-controls="nav-laugh" aria-selected="true" v-if="getLaugh.length"><span v-if="getLaugh.length !=0">😅 {{getLaugh.length}}</span></a>
    </div>
    </nav>
    <div class="tab-content bg-white   h-50 shadow" id="nav-tabContent ">
    <div class="tab-pane fade p-3 show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
      <div class="list-group" v-for="like in getLike" :key="like.id">
        <a class="px-1">
                <h6 class="p-0"><router-link  :to="`/profile/${like.user.name}`" class=""><img id="logo" :src="`${like.user.profiles.photo}`" alt=""></router-link>
            <b> <router-link  :to="`/profile/${like.user.name}`" class="">{{like.user.profiles.first_name}} {{like.user.profiles.last_name}}</router-link></b> <i class="fa fa-thumbs-up float-right text-primary" aria-hidden="true"></i></h6>
            </a>
    </div>
    <div class="list-group py-0" v-for="love in getLove" :key="love.id">
        <a class="px-1">
                <h6 class="p-0"><router-link  :to="`/profile/${love.user.name}`" class=""><img id="logo" :src="`${love.user.profiles.photo}`" alt=""></router-link>
            <b> <router-link  :to="`/profile/${love.user.name}`"  class="">{{love.user.profiles.first_name}} {{love.user.profiles.last_name}}</router-link></b> <i class="fa fa-heart float-right text-danger" aria-hidden="true"></i> </h6>
            </a>
    </div>
    <div class="list-group py-0" v-for="laugh in getLaugh" :key="laugh.id">
        <a class="px-1">
                <h6 class="p-0"><router-link  :to="`/profile/${laugh.user.name}`" class=""><img id="logo" :src="`${laugh.user.profiles.photo}`" alt=""></router-link>
            <b> <router-link  :to="`/profile/${laugh.user.name}`"  class="">{{laugh.user.profiles.first_name}} {{laugh.user.profiles.last_name}}</router-link></b> <i class="fa  float-right" aria-hidden="true">😅</i> </h6>
            </a>
    </div>
    </div>
    <div class="tab-pane fade show p-3 " id="nav-like" role="tabpanel" aria-labelledby="nav-like-tab">
     <div class="list-group" v-for="like in getLike" :key="like.id">
        <a class="px-1">
                <h6 class="p-0"><router-link  :to="`/profile/${like.user.name}`" class=""><img id="logo" :src="`${like.user.profiles.photo ||'../../../images/avater.png'}`" alt=""></router-link>
            <b> <router-link  :to="`/profile/${like.user.name}`" class="">{{like.user.profiles.first_name}} {{like.user.profiles.last_name}}</router-link></b> <i class="fa fa-thumbs-up float-right text-primary" aria-hidden="true"></i></h6>
            </a>
    </div>
    </div>
    <div class="tab-pane fade show p-3 " id="nav-love" role="tabpanel" aria-labelledby="nav-love-tab">
    <div class="list-group py-0" v-for="love in getLove" :key="love.id">
        <a class="px-1">
                <h6 class="p-0"><router-link  :to="`/profile/${love.user.name}`" class=""><img id="logo" :src="`${love.user.profiles.photo ||'../../../images/avater.png'}`" alt=""></router-link>
            <b> <router-link  :to="`/profile/${love.user.name}`" class="">{{love.user.profiles.first_name}} {{love.user.profiles.last_name}}</router-link></b> <i class="fa fa-heart float-right text-danger" aria-hidden="true"></i> </h6>
            </a>
    </div>
    </div>
    <div class="tab-pane fade show p-3 " id="nav-laugh" role="tabpanel" aria-labelledby="nav-laugh-tab">
        <div class="list-group py-0" v-for="laugh in getLaugh" :key="laugh.id">
            <a class="px-1">
                    <h6 class="p-0"><router-link  :to="`/profile/${laugh.user.name}`" class=""><img id="logo" :src="`${laugh.user.profiles.photo}`" alt=""></router-link>
                <b> <router-link  :to="`/profile/${laugh.user.name}`"  class="">{{laugh.user.profiles.first_name}} {{laugh.user.profiles.last_name}}</router-link></b> <i class="fa  float-right" aria-hidden="true">😅</i> </h6>
                </a>
        </div>
    </div>
    </div>
    </div>
</div>

     </div>
</template>
<script>
export default {
    data() {
        return {
                baseUrl:'http://localhost:8000',
            getLove:{},
            getLike:{},
            getLaugh:{}
        }
    },
    mounted() {
      axios.get(`/post/${this.$route.params.name}/edit`).then((res) => {
                    this.post=res.data
                 axios.get(`${this.$baseUrl}/love/` + this.$route.params.name).then((res) => {
                this.getLove = res.data });
                axios.get(`${this.$baseUrl}/like/` + this.$route.params.name).then((res) => {
                this.getLike = res.data });
                axios.get(`${this.$baseUrl}/laugh/` + this.$route.params.name).then((res) => {
                this.getLaugh = res.data

                 });
     });
    },
    methods: {


    },
}
</script>
<style lang="scss" scoped>
   #logo,
    #profilePix {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        border: 3px solid lightgrey;
    }
 .preview {
        width: 200px !important;
        height: 200px !important;
        border: 5px solid silver;
    }

.Edit
{
    padding: 40px 10px;
}
  .input-file-image::-webkit-file-upload-button{
      display: none;
  }
 .input-file-image
 {
     background-image: url('../../../images/avater.png');
     background-repeat: no-repeat;
     background-size: cover;
     height: 27px;
     width: 27px;
     border-radius: 5px;
     cursor: pointer;
 }
   @media only screen and (min-width: 768px) {
       .Edit
       {
           width: 70%;
           margin: auto;
       }
   }

</style>

