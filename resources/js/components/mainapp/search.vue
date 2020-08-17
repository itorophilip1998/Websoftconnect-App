<template>
  <div id="app" class="">
            <h3 class="text-capitalize  mb-1"> Search {{what}}
                <router-link to="/home" class="btn shadow-sm float-right" title="Home"><i class="fa fa-home text-muted" aria-hidden="true"></i></router-link>
            </h3> <hr>
        <div class="form-group">
            <i class="fa fa-search text-secondary" aria-hidden="true" style="position: relative;top: 38px;font-size: 25px;left: 10px;"></i>
          <input type="text" v-model="search"
            class="form-control px-5 py-4 rounded-pill shadow" name="" id="" aria-describedby="helpId" :placeholder="`Search ${what}`">
        </div>

<div class="output shadow p-3 p-md-3 rounded-lg" v-if="what=='users'">
    <h6 v-if="friendsListsData !=''" class="text-secondary">Names <span class="float-right">Status</span></h6>
   <div v-if="friendsListsData==''" class="text-secondary text-center">
        No User Found <i class="fa fa-eye-slash" aria-hidden="true"></i>
   </div>
    <div v-for="user in friendsListsData" >
        <h6><router-link  :to="`/profile/${user.name}`" :title="`Goto ${user.profiles.first_name} profile`"><img id="logo" :class="`${(user.isOnline) ? 'border-info' : 'border-1'}`" :src="`${baseUrl}/storage/${user.profiles.photo ||'../../../images/avater.png'}`" alt=""></router-link>
            <b> <router-link :to="`/chat/${user.name}`" :title="`Chat with ${user.profiles.first_name}`" class="">{{user.profiles.first_name}} {{user.profiles.last_name}}&ensp;<span style="font-size: 12px;"  class="text-secondary  font-weight-lighter">
                </span>
                </router-link>
                 <i v-if="user.isOnline" style="font-size: 13px;" class="fa fa-circle text-success float-right" aria-hidden="true"></i>
                 <i v-if="!user.isOnline" style="font-size: 13px; color: lightgray;" class="fa fa-circle float-right" aria-hidden="true"></i>
                </b>
                </h6>
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
                 <small v-if="post.loves.length > 0">{{post.loves.length}} <i class="fa fa-heart text-danger" aria-hidden="true"></i></small>
             </div>
         </div> <br>
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
  }
},
mounted() {
        axios.get(`${this.$baseUrl}/friendslist`).then((respond) => {
                this.friendsLists = respond.data
            })
        axios.get(`${this.$baseUrl}/post`).then((res) => {
                this.posts = res.data
            })
},
computed: {
    friendsListsData()
    {
        return this.friendsLists.filter(item => {
           console.log(item.name.match(this.search));
          return item.profiles.first_name.toLowerCase().match(this.search) || item.profiles.last_name.toLowerCase().match(this.search);
      })
    },
    postsData()
    {
        return this.posts.filter(item => {
           console.log(item.body.match(this.search));
          return item.body.toLowerCase().match(this.search) || item.category.toLowerCase().match(this.search);
      })
    },
    what()
    {
     return this.$route.params.name
    }
},
methods: {
   link(id)
   {
       this.$router.push(`/post/${id}`)
   }
 }
}
</script>
<style lang="scss" scoped>
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
 
</style>
