<template>
           <div class=" text-dark bg" >
<div class="overlay p-md-5 pt-4">
            <!-- Edit Post -->
         <div class="Edit bg-white rounded-lg p-md-3 p-1 " >
            <h3 class="text-capitalize  mb-1"> Search {{what}}
                <router-link to="/home" class="btn shadow-sm float-right" title="Home"><i class="fa fa-home text-muted" aria-hidden="true"></i></router-link>
                <a   @click="searches('users')" class="btn shadow-sm float-right" title="users">
                <i class="fa fa-users text-muted" aria-hidden="true"></i>
                  <small class="text-primary" >{{ friendsListsData.length}}</small>
                </a>

                <a   @click="searches('posts')" class="btn shadow-sm float-right" title="posts">
                <i class="fa fa-newspaper-o text-muted" aria-hidden="true"></i>
                <small class="text-danger" >{{ postsData.length}}</small>
                </a>
            </h3> <hr>
        <div class="form-group">
            <i class="fa fa-search text-secondary" aria-hidden="true" style="position: relative;top: 38px;font-size: 25px;left: 10px;"></i>
          <input type="text" v-model="search"
            class="form-control px-5 py-4 rounded-lg border shadow" name="" id="" aria-describedby="helpId" :placeholder="`Search ${what}`">
        </div>

<div class="output  p-3 p-md-3 rounded-lg" v-if="what=='users'">
    <h6 v-if="friendsListsData !=''" class="text-secondary">Names <span class="float-right">Status</span></h6>
   <div v-if="friendsListsData==''" class="text-secondary text-center">
        No User Found <i class="fa fa-eye-slash" aria-hidden="true"></i>
   </div>
   <div v-for="user in friendsListsData" class="border m-0 p-1 rounded-lg btn d-block text-left">
    <router-link  :to="`/profile/${user.name}`" :title="`Goto ${user.profiles.first_name} profile`">  <h6 class="m-0">
            <img id="logo" :class="`${(user.isOnline) ? 'border-info' : 'border-1'}`" :src="`${user.profiles.photo}`" alt="">
            <b> <router-link :to="`/profile/${user.name}`" :title="`Chat with ${user.profiles.first_name}`" class="">
                {{user.profiles.first_name}} {{user.profiles.last_name}}&ensp;<span style="font-size: 12px;"  class="text-secondary  font-weight-lighter">
                </span>
                 <i v-if="user.isOnline" style="margin-top: 15px !important;font-size: 13px;" class="fa fa-circle text-success float-right " aria-hidden="true"></i>
                 <i v-if="!user.isOnline" style="margin-top: 15px !important;font-size: 13px; color: lightgray;" class="fa fa-circle float-right " aria-hidden="true"></i>
                </router-link>
                </b>
                </h6>
            </router-link>

    </div>
</div>
<div class="output  p-3 p-md-3 rounded-lg" v-if="what=='posts'">
    <div v-if="postsData==''" class="text-secondary text-center">
        No Posts Found <i class="fa fa-eye-slash" aria-hidden="true"></i>
   </div>
    <div v-for="post in postsData" style="cursor: pointer;"  @click="link(post.id)">
         <div class="card shadow">
             <div class="card-body">
                 <router-link :to="`/post/${post.id}`"><h5 class="card-title">{{post.category}}</h5></router-link>
                 <p class="card-text">{{post.body}}</p>
                 <small>posted By <router-link :to="`/profile/${post.user.name}`">{{post.user.profiles.first_name}}  {{post.user.profiles.last_name}}</router-link></small> <br>
                 <small v-if="post.comments.length > 0">{{post.comments.length}} <i class="fa fa-comments text-muted" aria-hidden="true"></i>  &emsp;</small>
                 <small v-if="post.likes.length > 0">{{post.likes.length}} <i class="fa fa-thumbs-up text-primary" aria-hidden="true"></i> &emsp;</small>
                 <small v-if="post.loves.length > 0">{{post.loves.length}} <i class="fa fa-heart text-danger" aria-hidden="true"></i> &emsp;</small>
                 <small v-if="post.laugh.length > 0">{{post.laugh.length}} <i class="fa " aria-hidden="true">😅</i> &emsp;</small>
             </div>
         </div> <br>
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
    what:'',
  }
},
mounted() {
       this.what=this.$route.params.name
       this.refresh()
       Echo.private(`notification`)
             .listen('Notification',(e)=>{
               this.refresh()
             });
             this.getChatUsers()

},
computed: {
    friendsListsData()
    {
        return this.friendsLists.filter(item => {
          return item.profiles.first_name.toLowerCase().match(this.search) || item.profiles.last_name.toLowerCase().match(this.search);
      })
    },
    postsData()
    {
        return this.posts.filter(item => {
          return item.body.toLowerCase().match(this.search) || item.category.toLowerCase().match(this.search);
      })
    },

},
methods: {
    refresh()
    {
        axios.get(`${this.$baseUrl}/friendslist`).then((respond) => {
                this.friendsLists = respond.data
         })
        axios.get(`${this.$baseUrl}/post`).then((res) => {
                this.posts = res.data
        })
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
    searches(data){
        this.$router.push(`/search/${data}`)
        this.what=this.$route.params.name

    },
   link(id)
   {
       this.$router.push(`/post/${id}`)
       this.what=this.$route.params.name
   }
 }
}
</script>
<style lang="scss" scoped>
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
   a{
       text-decoration: none !important;
   }
</style>
