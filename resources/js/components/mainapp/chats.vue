<template>
           <div class=" text-dark bg" >
<div class="overlay p-md-5 pt-2">
            <!-- Edit Post -->
         <div class="Edit bg-white  rounded-lg p-md-3 mt-0 p-1 " >

        <div class="form-group mt-0 p-0" style="margin-top:0px !important">
            <i class="fa fa-search text-secondary" aria-hidden="true" style="position: relative;top: 38px;font-size: 25px;left: 10px;"></i>
          <input type="text" v-model="search"
            class="form-control px-5 py-4 rounded-lg border shadow-sm" name="" id="" aria-describedby="helpId" :placeholder="`Search friends`">
        </div>

<div class="output  p-2 p-md-2 pt-0 rounded-lg" >
   <div v-if="friendsListsData==''" class="text-secondary text-center">
        No User Found <i class="fa fa-eye-slash" aria-hidden="true"></i>
   </div>
   <div v-for="user in friendsListsData" class="border m-0 p-1 rounded-lg btn d-block text-left">
    <router-link class="b"  :to="`/chat/${user.user.name}`" :title="`Goto ${user.user.profiles.first_name} profile`">  <h5 class="m-0">
            <img id="logo" :class="`${(user.isOnline) ? 'border-info' : 'border-1'}`" :src="`${user.user.profiles.photo}`" alt="">
            <small  v-if="user.isOnline"  class="fa position-absolute fa-circle text-success online" aria-hidden="true"></small>

            <b> <router-link :to="`/chat/${user.user.name}`" :title="`Chat with ${user.user.profiles.first_name}`" class="">
                {{user.user.profiles.first_name}} {{user.user.profiles.last_name}}&ensp;
                <span class="status text-secondary font-weight-lighter"  style="font-size: 12px;" v-if="typing && from==user.user.id"  >
                    is {{ typing }}
                  </span>
                 <div class="d-inline d-sm-none">

                  <!-- <div v-for="(item,index) in user.user.chat_notify"  v-if="item.user_id==user.user.id" :key="item.id"> -->
                    <!-- {{ index.last}} -->
                    <span style="font-size: 9px;" class="text-secondary   font-weight-lighter" v-if="user.user.chat_notify.length >=2">{{ user.user.chat_notify.length }} new messages <i class="fa fa-comments" aria-hidden="true"></i></span>
                    <span style="font-size: 9px;" class="text-secondary   font-weight-lighter" v-if="user.user.chat_notify.length ==1">{{ user.user.chat_notify.length }} new message <i class="fa fa-comment" aria-hidden="true"></i></span>
                 </div>
                 <div class="d-none d-sm-inline">
                    <span style="font-size: 12px;" class="text-secondary   font-weight-lighter" v-if="user.user.chat_notify.length >=2">{{ user.user.chat_notify.length }} new messages <i class="fa fa-comments" aria-hidden="true"></i></span>
                    <span style="font-size: 12px;" class="text-secondary   font-weight-lighter" v-if="user.user.chat_notify.length ==1">{{ user.user.chat_notify.length }} new message <i class="fa fa-comment" aria-hidden="true"></i></span>
                 </div>

                <!-- <span v-else style="font-size: 12px;"   class="text-secondary   font-weight-lighter">
                  <span class="d-inline d-lg-none">
                    {{ (user.user.profiles.status.length > 20 ) ? user.user.profiles.status.substring(0,20)+'...' : user.user.profiles.status}}
                  </span>
                  <span class="d-none d-lg-inline">

                    {{ (user.user.profiles.status.length > 50 ) ? user.user.profiles.status.substring(0,50)+'...' : user.user.profiles.status}}
                  </span>
                 </span> -->

                </router-link>
                </b>
                </h5>

            </router-link>

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
    baseUrl: 'http://localhost:8000',
    friendsLists:[],
    posts:[],
    names:[],
    search:'',
    typing:'',
    from:"",
    Notyped:true,
    chatnotify:''
  }
},
mounted() {
       this.refresh()
       Echo.private(`notification`)
             .listen('Notification',(e)=>{
               this.refresh()
             });
             this.getChatUsers()
             this.typeSetter()
             this.data();

},
computed: {
    friendsListsData()
    {
        return this.friendsLists.filter(item => {
          return item.user.profiles.first_name.toLowerCase().match(this.search) || item.user.profiles.last_name.toLowerCase().match(this.search);
      })
    },
},
methods: {
    data(id)
    {
        axios.get(`${this.$baseUrl}/chatnotify/${id}`).then((respond) => {
                this.chatnotify = respond.data.notify
         })
         return id;
    },
    typeSetter()
             {
                Echo.private('chat')
               .listenForWhisper('typing', (e) => {
                 if(e.messages != '' && e.to==this.profile[0].id){
                     this.typing='typing...'
                     this.from=e.from;
                     this.Notyped=false
                 }
                 else if (e.messages != '' && e.to==this.friendData[0].id) {
                    let audio=new Audio(`${this.$baseUrl}/storage/Audio/typing1.mp3`);
                    audio.play();
                }
                 else{
                    this.typing=''
                    this.Notyped=true
                 }
            });
             },
    refresh()
    {
        axios.get(`${this.$baseUrl}/freinds`).then((respond) => {
                this.friendsLists = respond.data.freinds
         })
         axios.get(`${this.$baseUrl}/profile`).then((result) => {
                this.profile = result.data;
             });
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
    .online{
    font-size: 10px;
    margin-left: -19px;
    margin-top: 38px;
    background:white;
    border-radius:50%
}
a{
    text-decoration:none !important;
}
.output{
    overflow-y:scroll !important;
    height:80vh
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
        width:50px;
        height:50px;
        border-radius: 50%;
        border: 3px solid lightgrey;
    }
  @media only screen and (min-width: 768px) {
       .Edit
       {
           width: 60%;
           margin: auto;
       }
   }
</style>
