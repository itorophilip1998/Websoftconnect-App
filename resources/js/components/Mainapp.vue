<template>
   <div id="app">
      <!-- header -->
      <header v-if="$route.path != '/login' && $route.path != '/register'">
         <nav  class="navbar navbar-expand-lg shadow-sm navbar-light bg-light fixed-top text-center p-0" style="border-bottom:2px solid lightgrey !important">
            <button id="close" @click='cancel' title="Close" ref="close" style="display: none;" class="menuitems btn  text-secondary"><i class="fa fa-times" aria-hidden="true"></i></button >
                <button  id="open" ref="open" title="Toggle" @click='toggle' class="menuitems btn   text-secondary"><i  class="fa fa-bars" aria-hidden="true"></i></button>
              <a class="navbar-brand ml-auto ml-md-0 float-left" href="/welcome">
              <img class="logo rounded-circle" src='../images/logo.png'/>
              <span class="text-dark">|</span>  <span class="text-primary">WebSoft</span> <span class="text-secondary">Connect</span>
            </a>

              <router-link class="navbar-brand ml-auto d-none d-md-block" :to="`/profile/${profile[0].name}`">
              <img class="logo rounded-circle border" style="width: 30px !important;height: 30px !important;" :src="`${profile[0].profiles.photo ||'../../images/avater.png'}`"/>
              <small class="text-dark">{{profile[0].name}}</small>
            </router-link>

       </nav>
        <br>
    </header>
          <!-- sidear -->
            <section class="sidebar bg-primary " ref="sidebar">
                <div class="sidebarScroller pt-2">
                    <a class="pt-2 d-block text-center text-capitalize" >
                      <router-link  @click="cancel" :to="`/profile/${profile[0].name}`" :title="`${profile[0].profiles.first_name} ${profile[0].profiles.last_name}`">
                      <img  @click="cancel" style="width: 80px;height: 80px;border: 4px solid silver !important;" class="rounded-circle mr-2" :src="`${profile[0].profiles.photo ||'../../images/avater.png'}`" alt="avatar" /></router-link> <br>

                      <b><span    style="color:whitesmoke;font-size:18px;opacity:90%">{{profile[0].name}}</span></b> <br> <span class="text-dark">{{profile[0].email}}</span>
  <br>            <span style="color:whitesmoke;font-size:12px;" class="text-info font-weight-bold">{{profile[0].profiles.phone}}</span>
                       <br>
                     </a>
                     <hr>
                        <ul class="pl-3">
                            <li @click="cancel">  <router-link  to="/home"  class="link"> <i class="fa fa-home" aria-hidden="true"></i> Home  <small class="badge float-right badge-pill bg-secondary text-white" style="font-size:9px;">{{posts.length}}</small></router-link> </li>
                             <li @click="cancel"> <router-link  :to="`/profile/${profile[0].name}`" class="link"> <i class="fa fa-user-o" aria-hidden="true"></i> Profile  </router-link></li>
                               <li @click="cancel"><router-link  :to="`/chat/${profile[0].name}`" class="link"> <i class="fa fa-comments-o" aria-hidden="true"></i> Chat <small class="badge float-right badge-pill bg-secondary text-white" style="font-size:9px;">{{friends.length}}</small></router-link></li>
                           <li><a data-toggle="collapse" href="#contentId" aria-expanded="false" aria-controls="contentId" class="link"> <i class="fa fa-search" aria-hidden="true"></i> Search</a>
                                  <div class="collapse" id="contentId">
                                        <ul >
                                              <li @click="cancel"><router-link  to="/search/posts" class="link"> <i class="fa fa-newspaper-o" aria-hidden="true"></i> Posts</router-link></li>
                                              <li @click="cancel"><router-link  to="/search/users" class="link"> <i class="fa fa-users" aria-hidden="true"></i> Users</router-link></li>

                                      </ul>
                                   </div>
                               </li>
                              <li @click="cancel"><router-link  to="/premium" class="link"> <i class="fa fa-money" aria-hidden="true"></i>Contribution</router-link></li>

                            </ul>
                              <hr>
                              <ul class="pl-3">

                               <li @click="logout"><button  class="link"> <i class="fa fa-sign-out" aria-hidden="true"></i> Logout</button>  </li>
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
</template>


<script>

    export default {
        data() {
            return {
                profile:{},
                posts:{},
                baseUrl: 'http://localhost:8000',
                chats:{},
                friends:{},
            }
        },
        mounted() {
            axios.get('/profile').then((respond) => {
                this.profile = respond.data
            })
             axios.get('/post').then((res) => {
                this.posts = res.data
            })
              axios.get('/friendslist').then((respond) => {
                this.friends = respond.data
            })

        },
        watch: {
        '$route':{
        handler: (to, from) => {
          document.title = 'WebSoftConnect | '+ to.meta.title
        },
         immediate: true
      }
    },
        methods: {

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
