<template>
  <div id="home" class=" bg-white pt-2">
       <div class="clearfix" >
           <div class="row">
               <div class="col-md-4 shadow-sm p-0" style="background:#F8F9FA;" >
                <div class="people-list" id="people-list">
                    <div class="search  d-md-block d-none py-0 mt-3 mb-3" style="height: 55px;">
                         <i class="fa fa-search text-secondary" aria-hidden="true" style="position: relative;top: 32px;left: 10px;"></i>

                      <input v-model="search" type="text" placeholder="search friends here..." class=" shadow text-secondary m-0 p-2 pl-5 " />

                    </div>
                    <div class="text-secondary pt-4 pt-md-0 m-0  "><h6 class="pl-5 m-0"> All Users</h6>
                        <hr class="my-1 border-white" style="border:1px solid">
                    </div>
                    <ul class="list pt-md-1 pt-2 pr-0 pl-4">
                         <div v-if="friendsListsData==''" class="text-secondary">
                           No User Found <i class="fa fa-eye-slash" aria-hidden="true"></i>
                         </div>
                      <li  class="clearfix  liLink border-top "  v-for="friends in friendsListsData" :key="friends.id"  @click="loadUsersChat(friends.name,friends.id)" v-if="friends.id != profile[0].id">
                            <router-link  :to="`/chat/${friends.name}`"><img :class="`${(friends.isOnline) ? 'border-info' : 'border-1'}`" style="width: 50px;height: 50px;border: 4px solid silver !important;" :src="`${baseUrl}/storage/${friends.profiles.photo ||'../../images/avater.png'}`" alt="avatar" /></router-link>
                            <div class="about d-none d-md-block">
                              <div class="name font-weight-bold text-dark">{{friends.profiles.first_name}} {{friends.profiles.last_name}}</div>
                              <div class="status">
                                  <truncate collapsed-text-class="collapsed truncate " action-class="customClass font-weight-bold " clamp="" :length="20" less=""
                                     :text="friends.profiles.status">
                                     </truncate>
                              </div>

                            </div>

                      </li>
                    </ul>
                  </div>
               </div>
               <div class="col-md-8 p-0">
                <div class="chat shadow-sm" style="background:white !important;">
                    <div class="chat-header shadow-sm clearfix" style="padding:19px" >
                        <router-link  :to="`/profile/${friendData[0].name}`"><img :class="`${(friendData[0].isOnline) ? 'border-info' : 'border-1'}`"  style="width: 50px;height: 50px;border: 4px solid silver !important;" :src="`${baseUrl}/storage/${friendData[0].profiles.photo ||'../../images/avater.png'}`" alt="avatar" /></router-link>
                      <div class="chat-about">
                        <div class="chat-with">Chat with {{friendData[0].profiles.first_name}} {{friendData[0].profiles.last_name}}</div>
                    <div class="chat-num-messages"> {{(getChat.length > 0) ? 'already ' + getChat.length + " messages" : 'No message'}} </div>
                      </div>

                    <a @click="reload()" class="float-right btn text-primary" title="Refresh"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                    </div> <!-- end chat-header -->

                    <div class="chat-history" >
                        <div class="text-center text-secondary" v-if="getChat==''">
                            <a class="pt-2 d-block text-center text-capitalize" >
                                <router-link  :to="`/profile/${friendData[0].name}`" :title="`${friendData[0].profiles.first_name} ${profile[0].profiles.last_name}`"><img style="width: 100px;height: 100px;border: 0px solid silver !important;" class="rounded-circle mr-2 shadow-sm" :src="`${baseUrl}/storage/${friendData[0].profiles.photo ||'../../images/avater.png'}`" alt="avatar" /></router-link> <br>
                                <b><span style="color:grey;font-size:17px;opacity:90%">{{friendData[0].name}}</span></b> <br> <span class="text-secondary">{{profile[0].email}}</span>
                               </a>
                               <hr>
                               <div>
                                   <span > Start Conversation with your new friend</span> <br>
                             <img style="width: 30px;height: 30px;border: 3px  grey !important;" class="rounded-circle mr-2 shadow-sm" :src="`${baseUrl}/storage/${friendData[0].profiles.photo ||'../../images/avater.png'}`" alt="avatar" />
                             <img style="width: 30px;height: 30px;border: 3px grey !important; position: relative;left:-2%" class="rounded-circle mr-2 shadow-sm" :src="`${baseUrl}/storage/${profile[0].profiles.photo ||'../../images/avater.png'}`" alt="avatar" />
                                                <br>
                                                {{friendData[0].profiles.status}}
                               </div>
                        </div>
                      <ul class="pl-md-2">
                        <li class="clearfix " v-for="(chat, index) in getChat" :key="index" >
                          <div :class="` message-data ${(chat.user_id==profile[0].id) ? 'align-right':''}`">

                          </div>
                          <router-link v-if="chat.user_id!=profile[0].id"  :to="`/profile/${chat.user.name}`"><img style="width: 30px;height: 30px;border: 1px solid silver !important;" :src="`${baseUrl}/storage/${chat.user.profiles.photo ||'../../images/avater.png'}`" alt="avatar" /></router-link>

                          <div  :data-target="`#my-collapse${chat.id}`" data-toggle="collapse" :class="`shadow message ${(chat.user_id==profile[0].id) ? 'other-message float-right' :'my-message '} `" :style="`color:${(chat.user_id !=profile[0].id) ? 'whitesmoke':'whitesmoke'}`">

                           <truncate  collapsed-text-class="collapsed truncate" action-class="customClass font-weight-bold " clamp="...Show more" :length="300" less="...Hide some"
                                     :text="chat.messages">
                                     </truncate>

                            <a :href="`${baseUrl}/storage/${chat.picture}`" class="row text-capitalize px-2 " v-if="chat.picture != '' && chat.picture != null" :style="`color:${(chat.user_id !=profile[0].id) ? 'whitesmoke':'whitesmoke'}`">
                                <img style="border-radius: 10px !important;border:3px solid silver !important;height: 100px;width: 100px;" :src="`${baseUrl}/storage/${chat.picture}`" />
                                
                            </a>
                             <div :id="`my-collapse${chat.id}`" class="collapse">
                                <span class="message-data-time" style="font-size:10px;position:relative;color:lightgrey">
                                     <small  class="font-weight-bold p-0 m-0">{{timer(chat.created_at)}}</small> <br>
                                <button v-if="chat.user_id==profile[0].id" title="delete" class="btn fa fa-trash text-white float-right" @click="deleteChat(chat.id)"></button>
                                <button @click="editedChat=chat" v-if="chat.user_id==profile[0].id && chat.messages != null" title="edit" data-toggle="modal" data-target="#editChat"  class="btn fa fa-pencil text-white float-right"></button> 

                            </span>
                            </div>
                          </div>
                        </li>

                      </ul>

                    </div> <!-- end chat-history -->
<!-- Modal -->
<div class="modal fade" id="editChat" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content"> 
            <div class="modal-body "> 
                <h5 class="text-secondary">Edit Message <i class="fa fa-pencil" aria-hidden="true"></i></h5>
                 <form class="p-0 my-0" @submit.prevent="updatedChat(friendData[0].id,profile[0].id,editedChat.id)" v-if="friendData[0].id!=profile[0].id"> 
                    <textarea rows="3" v-model="editedChat.messages" class="shadow text form-control m-0 input" style="padding:23px 40px;border-radius: 14px !important;" name="message-to-send" id="message-to-send"  placeholder="Type your message...." > 
                        </textarea>  
                        <br>   
                    <button type="button" class="btn btn-sm btn-secondary" style="border-radius: 7px !important;" data-dismiss="modal">Close</button> 
                    <button class="btn btn-sm btn-primary" type="submit" style="border-radius: 7px !important;">Update</button> 
                 </form>
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
                   <form @submit.prevent="sendMessage(friendData[0].id,profile[0].id)" v-if="friendData[0].id!=profile[0].id">
                  <input accept="image/*" @change="previewImage(friendData[0].id,profile[0].id)" ref="postImg"  class="form-control input-file-image shadow-none border-0"  type="file" style="position: relative;top: 40px;left: 2%;" />
                  <input  @keydown.enter="sendMessage(friendData[0].id,profile[0].id)" v-model="chat.messages" class="shadow text form-control mt-1 input  " style="padding:23px 40px;border-radius: 14px !important;" name="message-to-send" id="message-to-send"  placeholder="Type your message...." > <br>
                  <button type="submit" class="btn" style="position: relative;top: -78px;font-size: 20px;background:transparent;left: -1%;"><i class="fa fa-send-o" aria-hidden="true"></i></button>
                    </form>
                    </div> <!-- end chat-message -->


                    <!-- Mobile View -->
                    <div class="chat-message mt-2 d-block d-md-none fixed-bottom  shadow-lg border-top clearfix bg-white p-0" style=" height:100px !important;z-index: 0 !important;" >
                        <div class="select " v-if="friendData[0].id==profile[0].id">
                                  <div class="alert alert-success" role="alert">
                                     <i class="fa fa-bell" aria-hidden="true"></i> <strong>Tap any user to Share idea with him/her privately</strong>
                                  </div>
                        </div>
                          <form class="px-2 p-0 " @submit.prevent="sendMessage(friendData[0].id,profile[0].id)" v-if="friendData[0].id!=profile[0].id" >
                         <input accept="image/*" @change="previewImage(friendData[0].id,profile[0].id)" ref="postImg"  class="form-control input-file-image shadow-none border-0 "  type="file" style="position: relative;top: 40px;left: 2%;" />
                         <input  @keydown.enter="sendMessage(friendData[0].id,profile[0].id)" v-model="chat.messages" class="shadow text form-control mt-1 input  " style="padding:23px 40px; border-radius: 7px !important; width:100% !important;" name="message-to-send" id="message-to-send"  placeholder="Type your message...." > <br>
                          <button type="submit" class="btn" style="position: relative;top: -78px;font-size: 20px;background:transparent;left: -1%;"><i class="fa fa-send-o" aria-hidden="true"></i></button>
                           </form>
                           </div> <!-- end chat-message -->

                </div>
               </div>
           </div>



     <!-- end chat -->

  </div> <!-- end container -->

<script id="message-template" type="text/x-handlebars-template">
  <li class="clearfix">
    <div class="message-data align-right">
      <span class="message-data-time" >{{time}}, Today</span> &nbsp; &nbsp;
      <span class="message-data-name" >Olia</span> <i class="fa fa-circle me"></i>
    </div>
    <div class="message other-message float-right">
      {{messageOutput}}
    </div>
  </li>
</script>

<script id="message-response-template" type="text/x-handlebars-template">
  <li>
    <div class="message-data">
      <span class="message-data-name"><i class="fa fa-circle online"></i> Vincent</span>
      <span class="message-data-time">{{time}}, Today</span>
    </div>
    <div class="message my-message">
      {{response}}
    </div>
  </li>
</script>

  </div>
</template>

<script>
    import moment from 'moment';
    import truncate from 'vue-truncate-collapsed';
    export default {
        components: {
            truncate,
            moment,
        },
        data() {
            return {
                getChat:{},
                authUser: {},
                friendsLists: [],
                profile: {},
                baseUrl: 'http://localhost:8000',
                friendData:{},
                chat:  {
                messages:'',
                picture:''
                },
                search:"",
                editedChat:{}

            }
        },
        computed: {
 friendsListsData()
    {
        return this.friendsLists.filter(item => {
           console.log(item.name.match(this.search));
          return item.profiles.first_name.toLowerCase().match(this.search) || item.profiles.last_name.toLowerCase().match(this.search);
      })
    },
        },
        mounted() {
            axios.get(`${this.$baseUrl}/userinfo`).then(res => {
                this.authUser = res.data
            });
             axios.get(`${this.$baseUrl}/friendslist`).then((respond) => {
                this.friendsLists = respond.data
            })
               axios.get(`${this.$baseUrl}/profile`).then((result) => {
                this.profile = result.data;
            });
            axios.get(`${this.$baseUrl}/profile/` + this.$route.params.name).then((result) => {
                this.friendData = result.data;

               axios.get(`${this.$baseUrl}/chat/` + this.friendData[0].id).then((result) => {
                this.getChat = result.data;
               });
            });
        },
         methods: {
             reload()
             {
                // location.reload()
                axios.get(`${this.$baseUrl}/userinfo`).then(res => {
                this.authUser = res.data
            });
             axios.get(`${this.$baseUrl}/friendslist`).then((respond) => {
                this.friendsLists = respond.data
            })
               axios.get(`${this.$baseUrl}/profile`).then((result) => {
                this.profile = result.data;
            });
            axios.get(`${this.$baseUrl}/profile/` + this.$route.params.name).then((result) => {
                this.friendData = result.data;

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
                    let config = { headers: { 'Content-Type': 'multipart/form-data' } }
                    axios.post(`${this.$baseUrl}/chat`, formData,config).then((res) => {
                        let audio=new Audio('http://soundbible.com/mp3/Air Plane Ding-SoundBible.com-496729130.mp3');
                        audio.play();
                           axios.get(`${this.$baseUrl}/chat/` + friend_id).then((result) => {
                        this.getChat = result.data;
                        });
                    })
                     this.reload();


            },
            sendMessage(friend_id,user_id)
            {
                    const formData = new FormData();
                    formData.append('user_id',user_id);
                    formData.append('friend_id',friend_id);
                    formData.append('messages', this.chat.messages);
                    let config = { headers: { 'Content-Type': 'multipart/form-data' } }
                    axios.post(`${this.$baseUrl}/chat`, formData,config).then((res) => {
                        let audio=new Audio('http://soundbible.com/mp3/Air Plane Ding-SoundBible.com-496729130.mp3');
                    audio.play();
                    })
                      axios.get(`${this.$baseUrl}/chat/` + friend_id).then((result) => {
                        this.getChat = result.data;
                      });
                    this.chat.messages='';
                     this.reload();

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
                    const formData = new FormData();
                    formData.append('user_id',user_id);
                    formData.append('friend_id',friend_id);
                    formData.append('messages', this.editedChat.messages);
                    formData.append('_method', "PUT"); 
                    let config = { headers: { 'Content-Type': 'multipart/form-data' } }
                    axios.post(`${this.$baseUrl}/chat/${post_id}`, formData,config).then((res) => {
                        let audio=new Audio('http://soundbible.com/mp3/Air Plane Ding-SoundBible.com-496729130.mp3');
                    audio.play();
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


    body {
        background: #C5DDEB !important;
        font: 14px/20px "Lato", Arial, sans-serif;
        padding: 40px 0;
        color: white;
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
.text,.text:focus
{
  border:1px solid rgb(192, 195, 248) !important;
}

    .clearfix {
        img {
            border-radius: 50% !important;
            border: 3px solid grey !important;
        }
        li {
            list-style-type: none;
        }
    }

    .liLink
    {
        cursor: pointer;
        padding: 5px !important;
    }
    .liLink:focus,.liLink:hover
    {
         background-color: rgb(234, 235, 236) !important;
         border-radius: 30px;
         border: none;
    }
    .people-list {
        width: 100%;


        .search {
            padding: 20px;
        }
        input {
            border-radius: 30px;
            border: none;
            padding: 14px;
            background: whitesmoke;
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
            overflow-y: scroll;
            height: 55vh;
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
                max-width:90%;
                position: relative;
                display:inline-block;
                /* &:after {
                    bottom: 100%;
                    left: 7%;
                    border: solid transparent;
                    content: " ";
                    height: 0;
                    width: 0;
                    position: absolute;
                    pointer-events: none;
                    border-bottom-color:  rgb(107, 118, 128);;
                    border-width: 10px;
                    margin-left: -5px;
                } */
            }
            .my-message {
                background:  rgb(107, 118, 128);
                border-radius: 15px;

            }
            .other-message {
                background: rgb(134, 161, 236);

                /* &:after {
                    border-bottom-color: rgb(134, 161, 236);
                    left: 88%;

                } */
                border-radius: 15px;
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

    @media only screen and (max-width: 767px) {
        .liLink
        {
            border: none !important;
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
                 display: inline-flex !important;
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
