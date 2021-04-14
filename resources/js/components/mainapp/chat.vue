<template>
  <div id="home" class=" bg-white pt-2" v-if='followData=="Unfriend"'>
       <div class="clearfix" >
           <div class="row">
               <div class="col-md-3 shadow-sm p-0 names"  >
                <div class="people-list" id="people-list">
                    <div class="search  d-md-block d-none py-0 mt-3 mb-3" style="height: 55px;">
                         <i class="fa fa-search text-secondary" aria-hidden="true" style="position: relative;top: 32px;left: 10px;"></i>

                      <input v-model="search" type="text" placeholder="search friends here..." class=" shadow text-secondary m-0 p-2 pl-5 " />
                    </div>
                    <div  class="text-secondary d-md-none pt-3 pt-md-0 m-0  ">
                        <hr class="my-1 border-white d-md-block d-none" style="border:1px solid">
                    </div>
                    <ul class="list pt-md-1 pt-2 pr-0 pl-4">
                         <div v-if="friendsListsData==''" class="text-secondary">
                           No User Found <i class="fa fa-eye-slash" aria-hidden="true"></i>
                         </div>
                        <li  class="clearfix  liLink border-top "  v-for="friends in friendsListsData" :key="friends.id"  @click="loadUsersChat(friends.user.name,friends.id)" v-if="friends.user.id != profile[0].id">
                            <router-link  :to="`/chat/${friends.user.name}`">
                                <img :class="`${(friends.isOnline) ? 'border-info' : 'border-1'}`"  style="width: 50px;height: 50px;" :src="`${friends.user.profiles.photo}`" alt="avatar" />
                            </router-link>
                            <div class="about d-none d-md-block">
                              <div class="name font-weight-bold text-dark">
                                  {{friends.user.profiles.first_name}} {{friends.user.profiles.last_name}}
                                </div>
                                <div class="status" id='typed' v-if="typing && from==friendData[0].id " >
                                    {{ typing }}
                                      </div>
                              <div v-else class="status">
                              <small  v-if="friends.isOnline"  class="fa position-absolute fa-circle text-success online" aria-hidden="true"></small>
                                    <!-- 9<sup>+</sup><i class="fa fa-comments-o text-danger" aria-hidden="true"></i> -->
                              </div>
                            </div>
                      </li>
                    </ul>
                  </div>
               </div>
               <div class="col-md-6 p-0">
                <div class="chat shadow-sm" style="background:white !important;">
                    <div class="chat-header px-4 px-md-2  pb-1 shadow-sm clearfix" style="padding:19px" >
                        <router-link  :to="`/profile/${friendData[0].name}`"><img :class="`${(friendData[0].isOnline) ? 'border-info' : 'border-1'}`"  style="width: 50px;height: 50px;border: 4px solid silver !important;" :src="`${friendData[0].profiles.photo ||'../../images/avater.png'}`" alt="avatar" /></router-link>
                      <div class="chat-about">
                        <div class="chat-with">Chat with {{friendData[0].profiles.first_name}} {{friendData[0].profiles.last_name}}</div>
                    <div class="chat-num-messages" id='typed' v-if="typing && from==friendData[0].id " >
                      {{ typing }}
                        </div>
                    <div class="chat-num-messages" id='Notyped'
                    v-else > {{(getChat.length > 0) ? 'already ' + getChat.length + " messages" : 'No message'}} </div>
                      </div>
          <div class="dropdown open pt-1">
              <button class=" float-md-right fa fa-ellipsis-v d-none d-md-inline  px-2 ml-5 ml-md-0 " type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="false">
                      </button>
              <button style="left: 91% !important" class="position-absolute  d-inline d-md-none fa fa-ellipsis-v px-2   " type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="false">
                      </button>
              <div class="dropdown-menu" aria-labelledby="triggerId">
                    <a @click="reload()" class=" btn  dropdown-item" title="Refresh"><i class="fa fa-refresh" aria-hidden="true"></i> Refresh</a>
                    <a data-toggle="modal" data-target="#vioceCall" class="btn d-block d-md-none  dropdown-item"
                     aria-hidden="true">
                    <i class="fa fa-phone p-0"></i>  Vioce Call
                    </a>
                    <a data-toggle="modal" data-target="#vioceCall" class="btn d-block d-md-none  dropdown-item"
                     aria-hidden="true">
                    <i class="fa fa-video-camera p-0"></i>  Video Call
                    </a>
                     <a class="dropdown-item btn" @click="clearChat()" ><i class="fa fa-user-times" aria-hidden="true"></i> Block User</a>
                     <a class="dropdown-item btn " @click="clearChat()" ><i class="fa   fa-times border" aria-hidden="true"></i> Report User</a>
              </div>
          </div>
                    </div> <!-- end chat-header -->

                    <div class="chat-history" id="chat" v-chat-scroll>
                        <div class="text-center text-secondary" v-if="getChat==''">
                            <a class="pt-2 d-block text-center text-capitalize" >
                                <router-link  :to="`/profile/${friendData[0].name}`" :title="`${friendData[0].profiles.first_name} ${profile[0].profiles.last_name}`">
                                <img style="width: 100px;height: 100px;border: 0px solid silver !important;" class="rounded-circle mr-2 shadow-sm" :src="`${friendData[0].profiles.photo}`" alt="avatar" /></router-link> <br>
                                <b><span style="color:grey;font-size:17px;opacity:90%">{{friendData[0].name}}</span></b> <br> <span class="text-secondary">{{profile[0].email}}</span>
                               </a>
                               <hr>
                               <div>
                                   <span > Start Conversation with your new friend</span> <br>
                             <img style="width: 30px;height: 30px;border: 3px  grey !important;" class="rounded-circle mr-2 shadow-sm" :src="`${friendData[0].profiles.photo ||'../../images/avater.png'}`" alt="avatar" />
                             <img style="width: 30px;height: 30px;border: 3px grey !important; position: relative;left:-2%" class="rounded-circle mr-2 shadow-sm" :src="`${profile[0].profiles.photo ||'../../images/avater.png'}`" alt="avatar" />
                                                <br>
                                                {{friendData[0].profiles.status}}
                               </div>
                        </div>
                      <ul class="pl-md-2">
                        <li class="clearfix " v-for="(chat, index) in getChat" :key="index" >
                          <div :class="` message-data ${(chat.user_id==profile[0].id) ? 'align-right':''}`">

                          </div>
                          <router-link v-if="chat.user_id!=profile[0].id"  :to="`/profile/${chat.user.name}`">
                            <img style="width: 30px;height: 30px;border: 1px solid silver !important;" :src="`${chat.user.profiles.photo ||'../../images/avater.png'}`" alt="avatar" /></router-link>

                          <div  :data-target="`#my-collapse${chat.id}`" data-toggle="collapse"
                          :class="`shadow message py-1   ${(chat.user_id==profile[0].id) ? 'other-message float-right' :'my-message '} `"
                          :style="`color:${(chat.user_id !=profile[0].id) ? 'whitesmoke':'whitesmoke'}`">

                           <truncate  collapsed-text-class="collapsed truncate" action-class="customClass font-weight-bold " clamp="...Show more" :length="300" less="...Hide some"
                                     :text="chat.messages">
                                     </truncate>

                            <a :href="`${chat.picture}`" class="row text-capitalize px-2 " v-if="chat.picture != '' && chat.picture != null" :style="`color:${(chat.user_id !=profile[0].id) ? 'whitesmoke':'whitesmoke'}`">
                                <img style="border-radius: 10px !important;border:3px solid silver !important;height: 100px;width: 100px;" :src="`${chat.picture}`" />
                            </a>
                              <!-- <audio  :src="chat.audio"  v-if="chat.audio  && chat.audio != ''" controls></audio> -->
                              <div v-if="chat.audio  && chat.audio != ''">
                                <audio controls :class="`${(chat.user_id==profile[0].id) ? 'meAud' :'  youAud'}`" >
                                    <source :src="chat.audio" >
                                  </audio>
                              </div>
                             <div :id="`my-collapse${chat.id}`" class="collapse">
                                <span class="message-data-time" style="font-size:10px;position:relative;color:lightgrey">
                                     <small  class="font-weight-bold p-0 m-0">{{timer(chat.created_at)}}</small> <br>
                                <button v-if="chat.user_id==profile[0].id" title="delete" class="btn fa fa-trash text-white float-right" @click="deleteChat(chat.id)"></button>
                                <button @click="editedChat=chat" v-if="chat.user_id==profile[0].id && chat.messages != null" title="edit" data-toggle="modal" data-target="#editChat"  class="btn fa fa-pencil text-white float-right"></button>
                            </span>
                            </div>
                          </div>
                        </li>

                        <li class="clearfix mb-3" v-if="typing && from==friendData[0].id ">
                            <div class="pt-3 row pl-3" >
                                <img style="width: 30px;height: 30px;border: 1px solid silver !important;" class="rounded-circle mr-2 shadow-sm d-inline" :src="`${friendData[0].profiles.photo}`" alt="avatar" /></router-link> <br>

                                <span class="d-inline my-message p-1 text-white" >
                                    <i class="fa fa-circle da" aria-hidden="true" style="color: rgb(222, 135, 189);"></i>
                                    <i class="fa fa-circle da" aria-hidden="true" style="color: burlywood;"></i>
                                    <i class="fa fa-circle da" aria-hidden="true" style="color: rgb(135, 187, 222);"></i>
                                    <i class="fa fa-circle da" aria-hidden="true" style="color: rgb(152, 222, 135);"></i>
                                    <i class="fa fa-circle da" aria-hidden="true" style="color: rgb(161, 135, 222);"></i>
                                </span>
                            </div>
                        </li>

                      </ul>
                    </div> <!-- end chat-history -->
  <!-- vioce call -->
  <div class="modal fade" id="vioceCall" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-success" >
            <div class=" text-center  head p-2 ">
                <h5 class="modal-title text-white">{{ profile[0].name }}</h5>
                <span style="color:whitesmoke">Calling . . .
                </span>
            </div>
            <div class="body">
            <img class="d-block d-md-none"  style="width: 100%; height:400px; border-radius: 0px;border: none;" :src="`${friendData[0].profiles.photo}`" alt="avatar" />
            <img class="d-none d-md-block" style="width: 100%; height:500px; border-radius: 0px;border: none;" :src="`${friendData[0].profiles.photo}`" alt="avatar" />
             <button type="button" class="btn btn-secondary muteCall fa  fa-phone fa-3x rounded-circle text-white bg-danger" data-dismiss="modal"></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for edit -->
<div class="modal fade" id="editChat" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body ">
                <h5 class="text-secondary">Edit Message <i class="fa fa-pencil" aria-hidden="true"></i></h5>
                 <form class="p-0 my-0" @submit.prevent="updatedChat(friendData[0].id,profile[0].id,editedChat.id)" v-if="friendData[0].id!=profile[0].id">
                    <textarea rows="3" v-model="editedChat.messages" class="shadow text form-control m-0 input" style="padding:23px 40px;border-radius: 14px !important;border: 1px solid royalblue !important;" name="message-to-send" id="message-to-send"  placeholder="Type your message...." >
                        </textarea>
                        <br>
                         <div v-if="load" class="spinner-border text-primary" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                    <button v-if="!load" type="button" class="btn btn-sm btn-secondary" style="border-radius: 7px !important;" data-dismiss="modal">Close</button>
                    <button v-if="!load" class="btn btn-sm btn-primary" type="submit" style="border-radius: 7px !important;">Update</button>
                 </form>
            </div>

        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="emojiId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Emojis</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <!-- <Emoji @click="selectedEmoji" width="100%" height="100%" class="Dlink" searchLabel="Search Emoji"/> -->
                <VueEmoji></VueEmoji>
            </div>
        </div>
    </div>
</div>

                    <!-- Desktop View -->
             <div class="chat-message d-none d-md-block shadow-lg border-top clearfix pt-0 pt-md-0 " >
                 <div class="select" v-if="friendData[0].id==profile[0].id">
                           <div class="alert alert-success" role="alert">
                              <i class="fa fa-bell" aria-hidden="true"></i> <strong>Tap any user to Share idea with him/her privately</strong>
                           </div>
                 </div>

                   <div  v-if="friendData[0].id!=profile[0].id" class="p-0 m-0" >


                  <!--  -->
                  <div class="dropdown">
                      <a id="my-dropdown text-secondary" class=" fa fa-paperclip fa-2x"
                      style="cursor: pointer;position: relative;top: 21px;left: 2%; height: 30px !important;"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                      <div class="dropdown-menu data-parent border-secondary " aria-labelledby="my-dropdown" style="border: size 2px !important;min-width: 10px !important; ">
                          <a class="dropdown-item data-child " >
                            <!-- <input accept="image/*" @change="previewImage(friendData[0].id,profile[0].id)" ref="postImg"  class="form-control input-file-image shadow-none d-inline border"  type="file" style=" height: 30px !important;" /> -->

                          </a>
                          <a class="dropdown-item data-child bg-white " >
                            <input accept="image/*" title="Open images" @change="previewImage(friendData[0].id,profile[0].id)" ref="postImg"  class="form-control input-file-image shadow-none d-inline border  -secondary  rounded-circle"  type="file"  />
                             <i class="fa fa-smile-o Dlink text-secondary fa-2x" data-toggle="modal" data-target="#emojiId"  title="EMOjis"  aria-hidden="true"></i>

                          </a>
                      </div>
                  </div>
                  <input  @mouseout="noMessage('typing')"  @input="message(friendData[0].id,profile[0].id,'typing')"
                   @keydown.enter="sendMessage(friendData[0].id,profile[0].id)"
                   v-model="chat.messages" class="shadow text  form-control  input"
                    style="margin-top: -18px;padding:23px 40px;border-radius: 10px !important;font-size: large;" name="message-to-send" id="message-to-send"  placeholder="Type your message...." >

                  <!-- <a  data-toggle="modal" data-target="#audio" href="#" class="fa fa-microphone   fa-2x text-secondary"  aria-hidden="true"> -->
                    <vue-record-audio v-if="!chat.messages != ''"
                    id="recorder" @stream="onStream" @result="onResult"
                    style="position: relative; top: -54px;left:90%;
                    background:rgb(133, 158, 233) !important;height: 50px !important;width: 50px !important;" /></a>
                  <br>
                  <button v-if="chat.messages != ''" type="button" @click="sendMessage(friendData[0].id,profile[0].id)" class="btn" style="position: relative;top: -78px;font-size: 20px;background:transparent;left: -1%;"><i class="fa fa-send text-primary" aria-hidden="true"></i></button>
                    </div>
                    </div> <!-- end chat-message -->


                    <!-- Mobile View -->
                    <div class="chat-message mt-2 d-block d-md-none fixed-bottom  shadow-lg border-top clearfix bg-white p-0" style="z-index: 0 !important; height: 57px;" >
                        <div class="select " v-if="friendData[0].id==profile[0].id">
                        <div class="alert alert-success" role="alert">
                            <i class="fa fa-bell" aria-hidden="true"></i> <strong>Tap any user to Share idea with him/her privately</strong>
                        </div>
                        </div>
                          <div class="px-2 p-0" v-if="friendData[0].id!=profile[0].id" >
                            <div class="dropdown">
                                <a id="my-dropdown  text-secondary" class=" fa fa-paperclip fa-2x"
                                style="cursor: pointer;position: absolute;top: 15px;left: 15px; height: 30px !important;"
                                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                <div class="dropdown-menu data-parent border-secondary" aria-labelledby="my-dropdown" style="border: size 1px;min-width: 10px !important; " >

                                    <a class="dropdown-item data-child bg-white " >
                                      <input accept="image/*" @change="previewImage(friendData[0].id,profile[0].id)" ref="postImg"  class="form-control input-file-image shadow-none d-inline border-secondary  rounded-circle"  type="file"  />
                                      <i class="fa fa-smile-o Dlink text-secondary fa-2x" data-toggle="modal" data-target="#emojiId"  title="EMOjis"  aria-hidden="true"></i>
                                      <!-- <VueEmoji></VueEmoji> -->
                                    </a>
                                </div>
                            </div>
                         <input  @mouseout="noMessage('typing')"  @input="message(friendData[0].id,profile[0].id,'typing')"     @keydown.enter="sendMessage(friendData[0].id,profile[0].id)" v-model="chat.messages" class=" text form-control   mt-1 input rounded-lg "
                          style="padding:23px 40px;  width:100% !important;border: none;" name="message-to-send" id="message-to-send"  placeholder="Type your message...." >
                       <vue-record-audio v-if="!chat.messages != ''"
                       id="recorder2" @stream="onStream" @result="onResult"
                       style="position: absolute; top: 9px;left:86%;
                       background:rgb(133, 158, 233) !important;height: 45px !important;width: 45px !important;" /></a>
                         <br>
                          <button v-if="chat.messages != ''"  type="button"  @click="sendMessage(friendData[0].id,profile[0].id)" class="btn" style="position: relative;top: -78px;font-size: 20px;background:transparent;left: -1%;"><i class="fa fa-send text-primary" aria-hidden="true"></i></button>
                           </div>
                           </div> <!-- end chat-message -->

                </div>
               </div>
               <div class="border-left d-md-block pl-0 d-none profile col-md-3 details"  >
                        <header class="pt-5 mt-5 text-center ">
                            <img style="width: 180px;height: 180px;border: 0px solid silver !important;" class="rounded-circle mr-2 shadow" :src="`${friendData[0].profiles.photo ||'../../images/avater.png'}`" alt="avatar" /></router-link> <br>

                        </header>
                        <section >
                         <div class="bg-white mt-4 text-center p-4   ">

                             <a data-toggle="modal" data-target="#vioceCall" class="fa fa-phone btn fa-2x bg-success rounded-circle text-white" aria-hidden="true"></a>
                             <a href="#" class="fa fa-video-camera btn fa-2x bg-primary rounded-circle  text-white" aria-hidden="true"></a>
                             <hr>
                           <h1 style="color:grey;font-size:17px;opacity:90%"> <b>{{friendData[0].name}}</b></h1>
                            <span class="text-secondary">{{profile[0].email}}</span>
                           <h1 style="color:grey;font-size:17px;opacity:90%"> <b>{{friendData[0].profiles.phone}}</b></h1>

                         </div>
                         <div class="bg-white pl-2 pt-3">
                           <hr class="m-0">

                           <p style="color:grey;font-size:17px;opacity:90%" class="text-center pb-5 mb-3"> {{friendData[0].profiles.status}}</p>

                         </div>
                        </section>
               </div>
           </div>



     <!-- end chat -->

  </div> <!-- end container -->


  </div>
</template>

<script>
//    import { VueChatEmoji, emojis } from 'vue-chat-emoji'
   import VueEmoji from 'emoji-vue'
    import moment from 'moment';
    import truncate from 'vue-truncate-collapsed';
    export default {
        components: {
            truncate,
            moment,
            // Emoji:VueChatEmoji
            VueEmoji

        },
        data() {
            return {
                notify:[],
                getChat:{},
                authUser: {},
                friendsLists: [],
                profile: {},
                baseUrl: 'http://localhost:8000',
                friendData:{},
                chat:  {
                messages:'',
                picture:'',
                audio:'',
                },
                search:"",
                editedChat:{},
                typing: '',
                load:false,
                from:"",
                Notyped:true,
                activeUsers:{},
                followData:'',
            }

        },

        computed: {
            checkNotify(id)
            {
                return this.notify
            },
 friendsListsData()
    {
        return this.friendsLists.filter(item => {
               axios.get(`${this.$baseUrl}/chatnotify/${item.user_id}`).then((respond) => {
                        this.notify = respond.data.notify
                  })
          return item.user.profiles.first_name.toLowerCase().match(this.search) || item.user.profiles.last_name.toLowerCase().match(this.search);
      })
    },
        },
        mounted() {
          this.reload()
         this.echo()
         this.typeSetter()
         this.getChatUsers()
         this.getAllEmojis()

        },
         methods: {
             onStream()
             {
                let recorder=document.getElementById('recorder');
                let recorder2=document.getElementById('recorder2');
                recorder.style.background='rgb(235, 57, 57)'
                recorder2.style.background='rgb(235, 57, 57)'
                this.message(this.friendData[0].id,this.profile[0].id,'recording')

             },
             getAllEmojis() {
                    console.log(emojis.all()); // [{...}]
                    this.emojifyString("Here is your 🎂.") /* => Here is your :birthday_cake:.*/
                    this.unEmojifyString("Here is your :birthday_cake:.") /* Here is your 🎂.*/
                },
                unEmojifyString(str) {
                    console.log(emojis.decodeEmoji(str))
                },
                emojifyString(str) {
                    console.log(emojis.encodeEmoji(str));
                },
             selectedEmoji(args) {
                console.log(args);
                this.chat.messages+=args.emoji
            },
            onResult (blob) {
                let recorder=document.getElementById('recorder');
                let recorder2=document.getElementById('recorder2');
                recorder.style.background='rgb(133, 158, 233)'
                recorder2.style.background='rgb(133, 158, 233)'
                var url = URL.createObjectURL(blob);
                var fileName = 'Aud';
                var fileObject = new File([blob], fileName, {
                             type: 'audio/wav',
                     });
            this.chat.audio=fileObject
           this.sendMessage(this.friendData[0].id,this.profile[0].id);

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
            }).listenForWhisper('recording', (e) => {
                 if(e.messages != '' && e.to==this.profile[0].id){
                     this.typing='recording...'
                     this.from=e.from;
                     this.Notyped=false
                     console.log('recording')

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
             getChatUsers()
             {
                 Echo.join('chat')
                 .here((users)=>{
               this.reload()
                  console.log(users)


                 })
                 .joining((users)=>{
                    this.reload()
                  console.log(users)
             })
                 .leaving((users)=>{
                    this.reload()
                 console.log(users)


                 })
             },
           message(Mto,Mfrom,data){

            Echo.private('chat')
                .whisper(data, {
                    messages: 'recording',
                    to: Mto,
                    from: Mfrom,
                },
             );
            },
        noMessage(data)
        {
            Echo.private('chat')
                .whisper(data, {
                    messages: '',
                    to: '',
                    from: '',
                },
             );
        }  ,


             echo(){
             Echo.private(`notification`)
             .listen('Notification',(e)=>{
               this.reload()
             });
            },
             reload()
             {
               axios.get(`${this.$baseUrl}/userinfo`).then(res => {
               this.authUser = res.data
             });
             axios.get(`${this.$baseUrl}/freinds`).then((respond) => {
                this.friendsLists = respond.data.freinds
             })

               axios.get(`${this.$baseUrl}/profile`).then((result) => {
                this.profile = result.data;
             });
             axios.get(`${this.$baseUrl}/profile/` + this.$route.params.name).then((result) => {
                this.friendData = result.data;
                axios.get(`${this.$baseUrl}/freinds/${result.data[0].id}`).then((res) => {
                        if (res.data.message=='requested') {
                            this.followData="Requested"
                            location.href='/'
                        }
                        else if(res.data.message=='No request'){
                            this.followData="Request"
                            location.href='/'
                        }
                        else if(res.data.message=='friend') {
                        this.followData="Unfriend"
                }
            })

               axios.get(`${this.$baseUrl}/chat/` + this.friendData[0].id).then((result) => {
                this.getChat = result.data;
               });
            });
             },
            timer(time) {
              return moment(time).fromNow();
            },
            previewImage(friend_id,user_id) {
                let input = event.target;
                this.chat.picture= input.files[0];
                const formData = new FormData();
                    formData.append('user_id',user_id);
                    formData.append('friend_id',friend_id);
                    formData.append('picture', this.chat.picture);
                    // formData.append('messages', '-Photo-');


                    let config = { headers: { 'Content-Type': 'multipart/form-data' } }
                    axios.post(`${this.$baseUrl}/chat`, formData,config).then((res) => {
                        let audio=new Audio('http://soundbible.com/mp3/Air Plane Ding-SoundBible.com-496729130.mp3');
                        audio.play();
                           this.getChat.push(res.data)
                    })
                    //  this.reload();
            },
            sendMessage(friend_id,user_id)
            {
                    const formData = new FormData();
                    formData.append('user_id',user_id);
                    formData.append('friend_id',friend_id);
                    formData.append('messages', this.chat.messages);
                    formData.append('audio', this.chat.audio);
                    let config = { headers: { 'Content-Type': 'multipart/form-data' } }
                    axios.post(`${this.$baseUrl}/chat`, formData,config).then((res) => {
                   this.getChat.push(res.data)
                   let audio=new Audio(`${this.$baseUrl}/storage/Audio/1_second_tone.mp3`);
                    audio.play();

                    })
                    this.chat.messages='';
                    this.chat.audio='';
                    this.noMessage('typing')
                    this.noMessage('recording')

            },

        load(userLists) {
                this.$router.push('/chat/' + userLists.id);
            },
            listCount() {
                return this.userList.length;
            },
            loadUsersChat(name,id)
            {
                this.$router.push(`/chat/${name}`);
                axios.get(`${this.$baseUrl}/chat/` + id).then((result) => {
                this.getChat = result.data;
               });
                axios.get(`${this.$baseUrl}/profile/` + this.$route.params.name).then((result) => {
                this.friendData = result.data;

               });
                     this.reload();

            },
            deleteChat(id)
            {
                  axios.delete(`${this.$baseUrl}/chat/${id}`).then((res) => {
                   let audio=new Audio('http://soundbible.com/mp3/Air Plane Ding-SoundBible.com-496729130.mp3');
                    audio.play();
                    })
                     this.reload();
            },

            updatedChat(friend_id,user_id,post_id)
            {
               let close=document.getElementsByClassName('modal-backdrop')[0];
               let modal=document.getElementById('editChat');
               let body=document.getElementsByTagName('body')[0];
                this.load=true
                    const formData = new FormData();
                    formData.append('user_id',user_id);
                    formData.append('friend_id',friend_id);
                    formData.append('messages', this.editedChat.messages);
                    formData.append('_method', "PUT");
                    let config = { headers: { 'Content-Type': 'multipart/form-data' } }
                    axios.post(`${this.$baseUrl}/chat/${post_id}`, formData,config).then((res) => {
                        let audio=new Audio('http://soundbible.com/mp3/Air Plane Ding-SoundBible.com-496729130.mp3');
                    audio.play();
                     this.load=false
                      close.style.display="none"
                    modal.style.display="none"
                   body.classList.remove('modal-open')

                    })
                      axios.get(`${this.$baseUrl}/chat/` + friend_id).then((result) => {
                        this.getChat = result.data;
                      });
                    this.editedChat.messages='';
                     this.reload();

            }


        },

    }
</script>

<style lang="scss" scoped>


 /* @import '../../../../node_modules/vue-chat-emoji/dist/vue-chat-emoji.esm.css';  */


.meAud::-webkit-media-controls-panel{
       background-color: #86a1ec !important;
       border:none;
}

    .youAud::-webkit-media-controls-panel{
       background-color: #6b7680 !important;
       border:none;
}
audio::-webkit-media-controls-enclosure {
    border-radius: 5px;
    background-color: none !important;

}
audio::-webkit-media-controls-volume-slider-container,
audio::-webkit-media-controls-current-time-display,
audio::-webkit-media-controls-toggle-closed-captions-button,
audio::-webkit-media-controls-volume-slider{
    color:white;
}

audio::-webkit-media-controls-time-remaining-display,
audio::-webkit-media-controls-mute-button,
audio::-webkit-media-controls-volume-slider-container,
audio::-webkit-media-controls-volume-slider,
audio::-webkit-media-controls-seek-back-button,
audio::-webkit-media-controls-seek-forward-button,
audio::-webkit-media-controls-fullscreen-button,
audio::-webkit-media-controls-rewind-button,
audio::-webkit-media-controls-return-to-realtime-button,
audio::-webkit-media-controls-toggle-closed-captions-button,
audio::-webkit-media-controls-toggle-closed-captions-button,
audio::-webkit-media-controls-return-to-realtime-button,
audio::-webkit-media-controls-rewind-button
{
display:none;
}

audio {
    width: 200px;
    height: 25px;
   }
    .muteCall
    {
        position: absolute;
       top: 80%;
       left: 50%;
       padding: 7px 13px 7px 13px !important;
        border: none !important;

    }
    .fa-phone
    {
        padding: 7px 10px 7px 10px;
    }
    .fa-video-camera
    {
        padding: 6px 6px 6px 6px;
    }

.data-child{
 display: inline !important;
 padding: 0px 1px 0px 1px;
 /* border-right:1px solid red; */
}
.data-parent{
    padding: 2px !important;
}




    a{
        text-decoration: none;
    }
    .online{
    font-size: 10px;
    margin-left: -19px;
    margin-top: 7px;
    background:white;
    border-radius:50%
}
    .details
    {
        height: 100vh;
        overflow-y: scroll;
    }
    @import url(https://fonts.googleapis.com/css?family=Lato:400,700);
    $green: #86BB71;
    $blue: #94C2ED;
    $orange: #E38968;
    $gray: #92959E;
    *,
    *:before,
    *:after {
        box-sizing: border-box;
    }
    .da{
        font-size: 9px;
        margin-right: 3px;
    }

#home{
    background:rgb(223 225 226) !important;
}
    body {
       background:rgb(223 225 226) !important;
        font: 14px/20px "Lato", Arial, sans-serif;
        padding: 40px 0;
        color: white;
    }
    .profile,.names{
        background:rgb(223 225 226) !important;
    }
    .input-file-image::-webkit-file-upload-button{
      display: none;
  }
 .input-file-image
 {
     background-image: url('../../images/avater.png');
     background-repeat: no-repeat;
     background-size: cover;
     height: 27px;
     width: 27px;
     border-radius: 5px;
     cursor: pointer;
 }
.text,.text:focus,.text:hover
{
  border:none !important;
  box-shadow:none !important;
}

    .clearfix {
        img {
            border-radius: 50% ;
            border: 3px solid grey ;
        }
        li {
            list-style-type: none;
        }
    }

    .liLink
    {
        cursor: pointer;
        padding: 5px !important;
        background: rgb(250, 249, 249);
    }
    .liLink:focus,.liLink:hover
    {
         background-color:rgb(224, 225, 231) !important;
         border-radius: 30px;
         a{
            color:white !important;
         }
    }
    .people-list {
        width: 100%;


        .search {
            padding: 20px;
        }
        input {
            border-radius: 10px;
            border: none;
            padding: 14px;
            background: white;
            width: 100%;
            height: 40px;
            font-size: 14px;
        }
        .fa-search {
            position: relative;
            left: -25px;
            color: silver;
        }
        ul {
            height: 80vh;
            overflow: scroll;

            li {
                padding-bottom: 20px;
            }
        }

        img {
            float: left;
        }
        .about {
            float: left;
            margin-top: 8px;
        }
        .about {
            padding-left: 8px;
        }
        .status {
            color: $gray;
        }
    }

    .chat {
        width: 100%;
        float: left;
        background: #F2F5F8;
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
        color: #434651;
        .chat-header {
            padding: 20px;
            img {
                float: left;
            }
            .chat-about {
                float: left;
                padding-left: 10px;
                margin-top: 6px;
            }
            .chat-with {
                font-weight: bold;
                font-size: 16px;
            }
            .chat-num-messages {
                color: $gray;
            }
            .fa-star {
                float: right;
                color: #D8DADF;
                font-size: 20px;
                margin-top: 12px;
            }
        }
        .chat-history {
            padding: 30px 30px 20px;
            overflow-y: scroll !important;
            overflow-x: hidden !important;
            height: 72vh !important;
            -ms-overflow-style: none !important;
            .message-data {
                margin-bottom: 15px;
            }
            .message-data-time {
                color: lighten($gray, 8%);
                padding-left: 6px;
            }
            .message {
                color: white;
                padding: 10px 14px;
                line-height: 26px;
                font-size: 16px;
                border-radius: 7px;
                margin-bottom: -10px ;
                max-width:80%;
                position: relative;
                display:inline-block;

            }
            .my-message {
                background:  rgb(107, 118, 128);
                border-radius: 7px;
                border-bottom-left-radius:0px !important;


            }
            .other-message {
                background: rgb(134, 161, 236);
                border-top-right-radius:0px !important;
                border-radius: 10px;
            }
        }
        .chat-message {
            padding: 30px;

            .input {
                border: 1px solid lightgrey;
                font: 14px/22px "Lato", Arial, sans-serif;
                margin-bottom: 10px;
                border-radius: 5px;
                resize: none;
                border-radius: 40px;
            }
            .fa-file-o,
            .fa-file-image-o {
                font-size: 16px;
                color: gray;
                cursor: pointer;
            }
            button {
                float: right;
                color: $blue;
                font-size: 16px;
                text-transform: uppercase;
                border: none;
                cursor: pointer;
                font-weight: bold;
                background: #F2F5F8;
                &:hover {
                    color: darken($blue, 7%);
                }
            }
        }
    }

    .online,
    .offline,
    .me {
        margin-right: 3px;
        font-size: 10px;
    }

    .online {
        color: $green;
    }

    .offline {
        color: $orange;
    }

    .me {
        color: rgb(134, 161, 236) !important;
    }

    .align-left {
        text-align: left;
    }

    .align-right {
        text-align: right;
    }

    .float-right {
        float: right;
    }

    .clearfix:after {
        visibility: hidden;
        display: block;
        font-size: 0;
        content: " ";
        clear: both;
        height: 0;
    }
     @media only screen and (max-width: 330px) and (min-width: 300px)
     {
         .chat-history {
            padding: 10px 5px 10px 5px!important;
   }

     }

     /* mobile */
    @media only screen and (max-width: 767px) {
        .liLink:focus,.liLink:hover
    {
      background: none !important;
    }
        .liLink
        {
            border: none !important;
            background: transparent !important;
        }
        .list{
           padding-top: -30px !important;
           background-color:white !important;

        }
   .chat-history {
            padding: 10px 10px 10px 15px!important;
   }
        .name,
        .status {
            display: none !important;
        }
        .chat-header
        {
            padding:2px 5px 2px 20px!important;
            border-top: 2px solid white !important;
        }
        .chat-history
        {
           ul{padding: 5px !important;}
        }
         .people-list   {



             ul{
                 /* display: inline-flex !important; */
         display: none !important;

                 padding: 0px 0px 0px 14px !important;
                 margin: 0px !important;
                  height: 70px !important;
                  width:100% ;
                  overflow-x: scroll;
                  -ms-overflow-style: none !important;

                li
             {
                 padding: 1px !important;
                 margin: 2px !important;

             }
             }
         }
    }
    @media only screen and (min-height: 600px) and (max-height: 800px)  {
        .chat-history {
            height: 52vh !important;
        }
    }
    @media only screen and (min-height: 500px) and  (max-height: 599px){
        .chat-history {
            height: 48vh !important;
        }
    }
    @media only screen and (min-width: 768px) {
        .chat-history {
            height: 67vh !important;
        }
      .input-file-image
      {
        left: 1% !important;
      }
}

</style>
