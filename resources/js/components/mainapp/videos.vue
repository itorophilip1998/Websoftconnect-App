<template>
       <div class=" text-dark bg" >
        <div class="overlay p-lg-4 pt-4">
           <div class="Edit bg-white  col-md-9 col-12 col-lg-8 m-md-auto p-0 " >

             <div class="p-1 pl-2 border-bottom">
               <h4>Videos
                   <router-link to="/" class="fa fa-home float-right" aria-hidden="true"></router-link>
                 </h4>
             </div>

             <div class="output row m-0 border-top p-1  p-md-2 ">
            <div class="card p-1 col-12 col-md-9 col-lg-7 mx-auto mb-3 shadow" v-for="video in videos" :key="video.id">
                <div class="card-header border-bottom-0 p-1 bg-white">
                  <h6><router-link  :to="`/profile/${video.user.name}`">
                        <img id="logo" :class="`${(video.isOnline) ? 'border-info' : 'border-1'}`" :src="`${video.user.profiles.photo}`" alt="">
                                 <small  v-if="video.isOnline"  class="fa position-absolute fa-circle text-success online" aria-hidden="true"></small>
                        </router-link>
                       <b> <router-link :to="`/profile/${video.user.name}`" class="">{{video.user.profiles.first_name}} {{video.user.profiles.last_name}}&ensp;<span style="font-size: 12px;"  class="text-secondary  font-weight-lighter">
                   <i class="fa fa-globe" aria-hidden="true"></i> {{video.category}}</span>  </router-link></b>

               <!-- Auth User Dropdown -->
                       <span class="dropdown p-0" >
                           <button  class="btn float-right text-secondary " id="my-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
                           <span class="dropdown-menu shadow-sm p-0 " aria-labelledby="my-dropdown">
                               <a  v-if="video.user_id != profile[0].id" class="dropdown-item   border-bottom py-2"   ><i  class="fa fa-user-times  text-secondary" aria-hidden="true"></i> Block this User</a>
                               <a  v-if="video.user_id == profile[0].id" @click="deletePost(video)" class="dropdown-item   border-bottom py-2"    ><i  class="fa fa-trash text-secondary" aria-hidden="true"></i> Delete</a>
                               <a v-if="video.name" :href="`${video.name}`" class="dropdown-item   border-bottom py-2" download="" ><i  class="fa fa-download text-secondary" aria-hidden="true"></i> Download Video</a>
                               <a  v-if="video.user_id != profile[0].id" class="dropdown-item   border-bottom py-2"   ><i  class="fa fa-times border text-secondary" aria-hidden="true"></i> Report this Post</a>
                               <a :href="video.name" class="dropdown-item border-bottom py-2 "   ><i  class="fa fa-eye text-secondary" aria-hidden="true"></i> View </a>
                           </span>
                           </span>

                       <small style="font-size: 9px;line-height: 0;margin-left: 11%;" class="font-weight-lighter d-block font-italic">{{ timer(video.created_at)}}</small>
                 </h6>
                </div>

                <div class="card-body p-1">
                    <p class="card-text">
                            <truncate collapsed-text-class="collapsed " action-class="customClass font-weight-bold " clamp="Show more" :length="100" less="Hide some"
                            :text="video.description">
                            </truncate>
                    </p>
                    <div class="videoBox  m-auto ">
                        <video width="100%"  controls>
                            <source :src="video.name" class="m-0 rounded-lg shadow " type="video/ogg">
                    </video>
                    </div>
                </div>
                <div class="card-footer bg-white p-1">
                    <div class="row m-0">
                        <div class="col-12 p-0" v-if="comment">
                          <input @keydown.enter="send(video.name,video.user.id)" type="text" v-model="reply.messages"  @mouseleave="comment=!comment" class="form-control" :placeholder="`reply to ${video.user.profiles.first_name}`">
                          <i class="fa fa-paper-plane text-primary btn" aria-hidden="true"></i>
                        </div>
                        <div v-if="!comment" class="col-6 p-0 text-center text-dark click">
                            30m Viewers
                         </div>
                        <a v-if="!comment"  @click="comment=!comment" class="col-6 p-0 text-dark text-center border-right click" >
                            <i @click="send(video.name,video.user.id)" class="fa fa-comments-o" aria-hidden="true"></i> Reply
                        </a>

                    </div>
                </div>
            </div>
      </div>
           </div>
         </div>
       </div>
</template>



<script>
    import moment from 'moment';
import truncate from 'vue-truncate-collapsed';

export default {
    components:{
        truncate,
        moment,
    },
data() {
  return {
    videos:[],
    profile:[],
    comment:false,
    reply:{
      friend_id:'',
      user_id:'',
      messages:'',
      picture:'',
      replyObj:''
    }

  }
},
created(){
    this.refresh()
},
mounted() {

         Echo.private(`notification`)
             .listen('Notification',(e)=>{
               this.refresh()
             });
             this.getChatUsers()

},

methods: {
    Goto(name)
    {
        console.log(name)
        location.href='/chat/' +name;

    },
    send(name,friend_id){
                    const formData = new FormData();
                    formData.append('friend_id',friend_id);
                    formData.append('messages', this.reply.messages);
                    formData.append('replyObj', name);
                    let config = { headers: { 'Content-Type': 'multipart/form-data' } }
                    axios.post(`${this.$baseUrl}/chat/${post_id}`, formData,config).then((res) => {
                   let audio=new Audio('http://soundbible.com/mp3/Air Plane Ding-SoundBible.com-496729130.mp3');
                    audio.play();
                    })
                    this.reply.messages=""
    },

   refresh()
    {
         axios.get(`${this.$baseUrl}/video`).then((result) => {
                this.videos = result.data.video;
             });
         axios.get(`${this.$baseUrl}/profile`).then((result) => {
                this.profile = result.data;
             });
    },

    timer(time) {
              return moment(time).fromNow();
            },
    getChatUsers()
             {
                 Echo.join('chat')
                 .here((users)=>{
                    this.refresh()
                  console.log([users,'all'])
                 })
                 .joining((users)=>{
                    this.refresh()
                  console.log([users,'join'])
                 })
                 .leaving((users)=>{
                    this.refresh()
                   console.log([users,'remove'])
                 })
             },

 }
}
</script>
<style lang="scss" scoped>
.click:hover{
  background: whitesmoke;
  cursor: pointer;
  border:1px solid skyblue !important;
  border-radius: 5px;
}
.online{
    font-size: 9px;
    margin-left: -14px;
    margin-top: 25px;
    background:white;
    border-radius:50%;
    border:2px solid white

}
.Edit{
    overflow-y:scroll !important;
    height:100vh;
}
.fa-paper-plane{
    position: absolute;
    top: 4px;
    left: 90%;

}
.output{

    background:lightgrey;
    padding-bottom:60px !important;
}
.Edit::-webkit-scrollbar{
    display:none !important;
}
.card{
    border-radius: 7px;
}

 #app
 {
        padding: 50px 20px ;
 }
@media only screen and (min-width: 768px) {
 #app
 {
        padding: 50px 20% ;
 }
}
#logo,
    #profilePix {
        width:35px;
        height:35px;
        border-radius: 50%;
        border: 3px solid lightgrey;
    }

</style>
