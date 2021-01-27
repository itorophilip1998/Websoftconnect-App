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
                        <video width="100%"  controls @play="playVideo(video)">
                            <source :src="video.name"  class="m-0 rounded-lg shadow " type="video/ogg">
                    </video>
                    </div>
                </div>
                <div class="card-footer bg-white p-1">
                    <div class="row m-0">
                        <div class="col-12 p-0" style="display: none;" :id="`bg${video.id}`">
                          <input @keydown.enter="sendData(video.name,video.user.id,video.id)" type="text" v-model="reply.messages"  @mouseleave="closeReply(video.id,reply.messages)" class="form-control" :placeholder="`reply to ${video.user.profiles.first_name}`">
                          <i class="fa fa-paper-plane text-primary btn" aria-hidden="true"  @click="sendData(video.name,video.user.id,video.id)" ></i>
                        </div>
                        <div   class="col-6 p-0 text-center text-dark click" :id="`bg2${video.id}`">

                          <!-- Button trigger modal -->
                          <button type="button" class="btn text-dark  btn-sm" data-toggle="modal" :data-target="`#modelId${video.id}`">
                            <span v-if="video.viewers.length==0">No Viewer</span>
                            <span v-if="video.viewers.length==1">1 Viewer</span>
                            <span v-if="video.viewers.length > 1">{{video.viewers.length}} Viewers</span>
                          </button>

                          <!-- Modal -->
                          <div class="modal fade" :id="`modelId${video.id}`" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title">Viewers</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                              </button>
                                      </div>
                                      <div class="modal-body">
                                          <div v-if="!video.viewers.length">
                                                <h2 class="text-center text-primary">
                                                    No Viewer Yet
                                                   <div class="text-center">
                                                    <i class="fa fa-eye-slash fa-2x" aria-hidden="true"></i>
                                                   </div>
                                                </h2>
                                          </div>
                                     <div v-if="video.viewers.length" v-for="viewer in video.viewers" class="border rounded-lg p-1 text-left mb-1 shadow-sm" :key="viewer.id" >  <h6 class="m-0">
                                             <img id="logo"   :src="`${viewer.user.profiles.photo}`" alt="">
                                            <b> <router-link :to="`/profile/${viewer.user.name}`" >
                                                {{viewer.user.profiles.first_name}} {{viewer.user.profiles.last_name}}&ensp;
                                                 <small class="text-dark">{{ timer(viewer.created_at) }} </small>
                                                </router-link>
                                                </b>
                                                </h6>
                                            </div>


                                      </div>
                                  </div>
                              </div>
                          </div>
                         </div>
                        <a   @click="openReply(video.id)" v-if="profile[0].id != video.user.id" class="col-6 p-0 text-dark text-center border-left click" :id="`bg3${video.id}`" >
                            <i class="fa fa-comments-o" aria-hidden="true"></i> Reply
                        </a>
                        <a :href="video.name" @click="playVideo(video)"  v-if="profile[0].id == video.user.id" class="col-6 p-0 text-dark text-center border-left click"  >
                            <i class="fa fa-tv" aria-hidden="true"></i> View
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
   playVideo(video)
    {
        const formData = new FormData();
        formData.append('user_id',video.user.id);
        formData.append('viewer_id', this.profile[0].id);
        formData.append('video_id', video.id);
        axios.post(`${this.$baseUrl}/view`, formData).then((res) => {
        let audio=new Audio('http://soundbible.com/mp3/Air Plane Ding-SoundBible.com-496729130.mp3');
        audio.play();
        })
    },
    openReply(id)
    {
        let bg = document.getElementById(`bg${id}`).style.display="block"
        let bg2 = document.getElementById(`bg2${id}`).style.display="none"
        let bg3 = document.getElementById(`bg3${id}`).style.display="none"
    },

    closeReply(id,reply)
    {
       if (!reply) {
        let bg = document.getElementById(`bg${id}`).style.display="none"
       let bg2 = document.getElementById(`bg2${id}`).style.display="block"
       let bg3 = document.getElementById(`bg3${id}`).style.display="block"
       }
    },

    Goto(name)
    {
        console.log(name)
        location.href='/chat/' +name;

    },
    sendData(name,friend_id,id){
                    const formData = new FormData();
                    formData.append('friend_id',friend_id);
                    formData.append('messages', this.reply.messages);
                    formData.append('replyObj', name);
                    let config = { headers: { 'Content-Type': 'multipart/form-data' } }
                    axios.post(`${this.$baseUrl}/chat`, formData,config).then((res) => {
                   let audio=new Audio('http://soundbible.com/mp3/Air Plane Ding-SoundBible.com-496729130.mp3');
                    audio.play();
                    })
                    this.reply.messages=""
                    this.openReply(id)
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
