<template>
    <div class="p-md-5 text-dark Edit ">
           <!-- reactons -->
         <h3>Reactions <i class="fa fa-smile-o" aria-hidden="true"></i>
         <router-link to="/home" class="btn shadow-sm float-right" title="Home"><i class="fa fa-home text-muted" aria-hidden="true"></i></router-link></h3> <hr>
<br>
<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link  text-secondary px-3 active" id="nav-all-tab" data-toggle="tab" href="#nav-all" role="tab" aria-controls="nav-all" aria-selected="true"> <span v-if="getLike.length !=0 || getLove.length !=0">{{getLike.length + getLove.length}}</span> Reactions</a>
    <a  class="nav-item nav-link  text-secondary px-3 " id="nav-like-tab" data-toggle="tab" href="#nav-like" role="tab" aria-controls="nav-like" aria-selected="true"> <span v-if="getLike.length !=0">{{getLike.length}}</span> Like <i class="fa fa-thumbs-up text-primary" aria-hidden="true"></i> </a>
    <a  class="nav-item nav-link text-secondary px-3 " id="nav-love-tab" data-toggle="tab" href="#nav-love" role="tab" aria-controls="nav-love" aria-selected="true"><span v-if="getLove.length !=0">{{getLove.length}}</span> Love  <i class="fa fa-heart text-danger" aria-hidden="true"></i></a>
    </div>
    </nav>
    <div class="tab-content bg-white h-50 shadow" id="nav-tabContent ">
    <div class="tab-pane fade p-3 show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
      <div class="list-group" v-for="like in getLike" :key="like.id">
        <a class="px-1">
                <h6 class="p-0"><router-link  :to="`/profile/${like.user.name}`" class=""><img id="logo" :src="`${like.user.profiles.photo ||'../../../images/avater.png'}`" alt=""></router-link>
            <b> <router-link  :to="`/profile/${like.user.name}`" class="">{{like.user.profiles.first_name}} {{like.user.profiles.last_name}}</router-link></b> <i class="fa fa-thumbs-up float-right text-primary" aria-hidden="true"></i></h6>
            </a>
    </div>
    <div class="list-group py-0" v-for="love in getLove" :key="love.id">
        <a class="px-1">
                <h6 class="p-0"><router-link  :to="`/profile/${love.user.name}`" class=""><img id="logo" :src="`${love.user.profiles.photo ||'../../../images/avater.png'}`" alt=""></router-link>
            <b> <router-link  :to="`/profile/${love.user.name}`"  class="">{{love.user.profiles.first_name}} {{love.user.profiles.last_name}}</router-link></b> <i class="fa fa-heart float-right text-danger" aria-hidden="true"></i> </h6>
            </a>
    </div>
    </div>
    <div class="tab-pane fade show p-3 " id="nav-like" role="tabpanel" aria-labelledby="nav-like-tab">
     <div class="list-group" v-for="like in getLike" :key="like.id">
        <a class="px-1">
                <h6 class="p-0"><router-link  :to="`/profile/${like.user.name}`" class=""><img id="logo" :src="`${like.user.profiles.photo ||'../../../images/avater.png'}`" alt=""></router-link>
            <b> <router-link  :to="`/profile/${like.user.name}`"class="">{{like.user.profiles.first_name}} {{like.user.profiles.last_name}}</router-link></b> <i class="fa fa-thumbs-up float-right text-primary" aria-hidden="true"></i></h6>
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
        }
    },
    created() {
      axios.get(`/post/${this.$route.params.name}/edit`).then((res) => {
                    this.post=res.data
                 axios.get(`${this.$baseUrl}/love/` + this.$route.params.name).then((res) => {
                this.getLove = res.data });
                axios.get(`${this.$baseUrl}/like/` + this.$route.params.name).then((res) => {
                this.getLike = res.data });
     });
    },
    methods: {
        playSound1()
            {
               let audio=new Audio('http://soundbible.com/mp3/Air Plane Ding-SoundBible.com-496729130.mp3');
                    audio.play();
            },
        previewImage() {
                let input = event.target;
                this.post[0].picture=input.files[0]
                let reader = new FileReader();
                reader.onload = e => {
                    this.imageData = e.target.result;

                };
                reader.readAsDataURL(input.files[0]);
            },

            updatePost(id) {
                     const formData = new FormData();
                    formData.append('picture',  this.post[0].picture);
                    formData.append('body', this.post[0].body);
                    formData.append('category',  this.post[0].category);
                    formData.append('post',  id);
                    formData.append('_method', 'PUT');
                  let config = { headers: { 'Content-Type': 'multipart/form-data' } }
                axios.post(`${this.$baseUrl}/post/`+ id, formData,config).then((res) => {
                   this.playSound1()
                })
                this.post.body='';
                this.post.category='';
                this.post.picture='';
                this.$router.push('/home');
            },
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

