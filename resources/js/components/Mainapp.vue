<template>
   <div id="app">


    <div class="before"  v-if="!main">
        <a class="navbar-brand" href="/welcome">
            <img class="logo rounded-circle" src='../images/logo.png'/>
            <span class="text-dark">|</span>  <span class="text-primary">WebSoft</span> <span class="text-secondary">Connect</span>
          </a>
          <br>
          <br>

          <div class="spinner-border text-primary" role="status">
              <span class="sr-only">Loading...</span>
          </div>
        </div>
    <div class="main" id="main" v-if="main">
          <!-- header -->
      <header v-if="$route.path != '/login' && $route.path != '/register'">
        <nav  class="navbar navbar-expand-lg shadow-sm navbar-light bg-light fixed-top text-center p-0" style="border-bottom:2px solid lightgrey !important">
           <button id="close" @click='cancel' title="Close" ref="close" style="display: none;" class="menuitems btn  text-secondary"><i class="fa fa-times" aria-hidden="true"></i></button >
               <button  id="open" ref="open"  @click='toggle' class="menuitems btn   text-secondary"><i  class="fa fa-bars" aria-hidden="true"></i>
               </button>
             <a class="navbar-brand mr-auto ml-md-0 float-left " href="/welcome">
             <img class="logo rounded-circle" src='../images/logo.png'/>
             <span class="text-dark">|</span>  <span class="text-primary">WebSoft</span> <span class="text-secondary">Connect</span>
           </a>
   <div class="ml-auto">
<!-- Example single danger button -->
<div class="btn-group">
   <button   type="button" class="btn btn-sm " >
       <router-link to="/chats"  class="fa fa-comments-o text-primary" aria-hidden="true"></router-link>
       <small v-if="chatNotify.length"  style="font-size:7px;position:absolute;left: 18px;top: 4px;" class="fa fa-circle text-danger" aria-hidden="true"></small>

   </button>
   <button   type="button" class="btn btn-sm " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <router-link v-if="!unSeen.length" to="/notification" class="fa fa-bell" aria-hidden="true"></router-link>
        <i v-else class="fa fa-bell text-primary" aria-hidden="true"></i>

        <small v-if="unSeen.length" style="font-size:7px;position:absolute;left: 18px;top: 4px;" class="fa fa-circle text-danger" aria-hidden="true"></small>
   </button>
   <div class="dropdown-menu " v-if="unSeen.length" style="margin-left: -180px !important;">
     <a class="dropdown-item disabled" href="#"><b>{{ (unSeen.length) ? unSeen.length + " New " : "No " }}  Notification </b> </a>
     <div class="dropdown-divider p-0 m-0"></div>

   <div   :class="`card btn  dropdown-item  ${(item.visited)? 'bg-white ' :'card2' } border-0 Effect`" style="border-bottom: 1px solid whitesmoke !important;" v-for="(item, index) in unSeen.slice(0,4)" :key="index"  :id="`n${item.id}`"   @click="goToCard(item.id,item.data_id,item.type,item.user.profiles.first_name)" >
       <div class="card-body p-1 row">
           <h6 class="card-title col-8 p-0 pl-1 pl-md-3 pl-lg-2 ">
            <b>
              {{ item.user.name}}
           </b>
               <span class="">{{ (item.title=='sent you a friend request') ? 'Requested' : item.title }} <br> {{ time(item.created_at) }}</span>

           </h6>
       </div>
   </div>
     <a @click="postNotify()" class="dropdown-item btn text-primary bg-white text-center">See All...</a>
   </div>
 </div>
    <router-link class="navbar-brand  d-none d-md-inline" :to="`/profile/${profile[0].name}`">
             <img class="logo rounded-circle border" style="width: 30px !important;height: 30px !important;" :src="`${profile[0].profiles.photo ||'../../images/avater.png'}`"/>
             <small class="text-dark">{{profile[0].name}}</small>
           </router-link>
   </div>
      </nav>
       <br>
   </header>
         <!-- sidear -->
           <section class="sidebar bg-primary " ref="sidebar">
               <div class="sidebarScroller pt-2">
                   <a class="pt-2 d-block text-center text-capitalize" >
                     <router-link  @click="cancel" :to="`/profile/${profile[0].name}`" :title="`${profile[0].profiles.first_name} ${profile[0].profiles.last_name}`">
                     <img  @click="cancel" style="width: 80px;height: 80px;border: 4px solid silver !important;" class="rounded-circle mr-2" :src="`${profile[0].profiles.photo}`" alt="avatar" /></router-link> <br>
                     <b><span  style="color:whitesmoke;font-size:18px;opacity:90%">{{profile[0].name}}</span></b> <br> <span class="text-dark">{{profile[0].email}}</span>
                     <br>     <span style="color:whitesmoke;font-size:12px;" class="text-info font-weight-bold">{{profile[0].profiles.phone}}</span>
                      <br>
                    </a>
                    <hr>
                       <ul class="pl-3">
                           <li @click="cancel">  <router-link  to="/home"  class="link"> <i class="fa fa-home" aria-hidden="true"></i> Home  </router-link> </li>
                            <li @click="cancel"> <router-link  :to="`/profile/${profile[0].name}`" class="link"> <i class="fa fa-user-o" aria-hidden="true"></i> Profile  </router-link></li>
                              <li @click="cancel"><router-link  :to="`/chats`" class="link"> <i class="fa fa-comments-o" aria-hidden="true"></i> Chat </router-link></li>
                          <li @click="cancel">
                              <!-- <a data-toggle="collapse" href="#contentId" aria-expanded="false" aria-controls="contentId" class="link"> <i class="fa fa-search" aria-hidden="true"></i> Search</a>
                                 <div class="collapse" id="contentId">
                                       <ul >
                                             <li @click="cancel"><router-link  to="/search/posts" class="link"> <i class="fa fa-newspaper-o" aria-hidden="true"></i> Posts</router-link></li>
                                             <li @click="cancel"><router-link  to="/search/users" class="link"> <i class="fa fa-users" aria-hidden="true"></i> Users</router-link></li>

                                     </ul>
                                  </div> -->
                                  <router-link  to="/search/posts" class="link"> <i class="fa fa-search" aria-hidden="true"></i> Search</router-link>

                              </li>

                           </ul>
                             <hr>
                             <ul class="pl-3">
                              <li @click="logout"><router-link to="/login"  class="link"> <i class="fa fa-sign-out" aria-hidden="true"></i> Logout</router-link>  </li>
                              <hr>
                               <li class="p-0" style="opacity:70%"><span class="text-white">WebSoft</span> <span class="text-secondary">Connect</span> <span class="text-white"> v1</span></li>
                       </ul>

               </div>
           </section>

           <!-- Main section -->
          <main  class=" overflow-hidden ">
               <router-view></router-view>
          </main>

    <div class="overlay" ref="overlay" @click="cancel"></div>


    </div>
     </div>
</template>


<script>
import moment from 'moment';

    export default {
        data() {
            return {
                profile:{},
                posts:{},
                baseUrl: 'http://localhost:8000',
                chats:{},
                friends:{},
                unSeen:{},
                authUser:{},
                chatNotify:[],
                all:{},
                main:false
            }
        },
        created() {
            axios.get('/profile').then((respond) => {
                this.profile = respond.data

            })
             axios.get('/post').then((res) => {
                this.posts = res.data
            })
              axios.get('/friendslist').then((respond) => {
                this.friends = respond.data
            })
            axios.get(`${this.$baseUrl}/chatnotify`).then((respond) => {
                        this.chatNotify = respond.data.notify
                  })
            this.notify()
        },
            mounted() {
           Echo.private(`notification`)
             .listen('Notification',(e)=>{
                this.notify()
             });
             this.main=true


        },
        watch: {
        '$route':{
        handler: (to, from) => {
          document.title = 'WebSoftConnect | '+ to.meta.title;
        },
         immediate: true

      }
    },

        methods: {
            goToCard(data,id,value,profiles)
    {

             let e = "myCard_"+data;
             let myCard=document.getElementById(e);
            axios.post(`${this.$baseUrl}/notify/${data}`,this.data).then((res) => {
                    myCard.style.background='white'

            })
            switch (value) {
                case 'chat':
                this.$router.push(`/post/${id}`);
                    break;
                case 'profile':
                this.$router.push(`/profile/${profiles}`);
                    break;
                case 'freind request':
                this.$router.push(`/profile/${profiles}`);
                    break;
                default:
                this.$router.push(`/post/${id}`);
                    break;
            }

                axios.post(`${this.$baseUrl}/notify`).then((res) => {
             })

    },
            time(time)
    {
        return moment(time).fromNow();
    },
            postNotify()
            {
                axios.post(`${this.$baseUrl}/notify`).then((res) => {

                })
                this.cancel();
               router.push("/notification")
            },

      notify() {
    axios.get(`${this.$baseUrl}/notify`).then((res) => {
     this.unSeen=res.data.unSeen
     this.all=res.data.all
     this.authUser=res.data.authUser
})
},

        logout()
        {
             axios.post(`${this.$baseUrl}/logout`).then((respond) => {
                 window.location='/login';
            })
            this.cancel();
        },
      toggle()
            {
                this.$refs.sidebar.style.display='block';
                this.$refs.open.style.display='none';
                this.$refs.close.style.display='block';
                this.$refs.overlay.style.display='block';
            },
            cancel()
            {
                this.$refs.sidebar.style.display='none';
                this.$refs.open.style.display='block';
                this.$refs.close.style.display='none';
                this.$refs.overlay.style.display='none';

            }
        },
    }
</script>


<style lang="scss" scoped>

    .before{
        text-align: center;
        padding: 25%;
    }
.menuitems{
    font-size: 20px !important ;
}
  a:hover .fa {
         transform: rotateY(180deg);
   }
a
{
 .fa {

    animation-name: btn;
    animation-duration: 3s;
    animation-fill-mode: forwards;
    transition-property: all;
    transition-duration: 1s;
}

@keyframes btn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

}
.logo
{
    width: 30px;

}

    @keyframes myanimation{

       0%{
           left: -200px;
        }
       100%{
           left: 0px;
           }

    }
    ::-webkit-scrollbar
    {
        display: none;
    }
.sidebar{
    display: none;
    background-color: whitesmoke;
    position: fixed;
    z-index: 2;
    height: 100vh;
    width: 250px;
    padding-top: 20px;
    border-right: 1px solid rgb(116, 118, 121);
    animation-name: myanimation;
    animation-duration: 0.4s !important;
    animation-fill-mode:backwards ;
    animation-timing-function: ease;
    animation-iteration-count: 1;

.sidebarScroller
{
   overflow: scroll !important;
   -ms-overflow-style: none !important;
    height: 95vh;
}

    .navbar-brand{
        padding: 20px !important;
        width: 100%;
        border-radius: 2px;
    }
    ul{
            li a {
            display: block;
            width: 100%;
            padding: 10px;
          .fa{
           font-size: 20px;
           margin-right: 8px ;
                }
            }
     li:hover,li:focus{
        &:after {
                position: absolute;
                border: solid transparent;
                content: "";
                pointer-events: none;
                background: whitesmoke;
                width: 1px !important;
                height:100vh;
                border-radius: 50px;
                left: 99%;
                top: -2%;
                }

        }

        li{
            list-style-type: none;
            display: block;
            margin-top:5px;
            font-size: 15px;



            .link:hover,.link:focus{
                background:white;
                color:#3490DC ;
                border-top-right-radius: 0;
                border-bottom-right-radius:0 ;
                text-decoration: none;
                font-family: 'consolas';


            }
            .link{
                color:whitesmoke;
                border-radius: 30px;
                border-top-right-radius: 0;
                border-bottom-right-radius:0 ;
            }



        }
    }

}
.overlay{
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.6);
  z-index: 0;
  display: none;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  cursor: pointer;
  position: fixed;
}
.navbar{
    background: white !important;
}
</style>
