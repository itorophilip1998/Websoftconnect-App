<template>
  <div id="home " class="pt-3 p-0 home"  >
      <div class="row p-0 m-0" >
          <div class="col-md-12 bg p-0 p-mb-1" >
              <div id="category" class="container-fluid py-0 px-0 pt-2" >
               <div class="row bg m-0">
                <div class="col-md-3 listBox p-0  shadow-sm"  >
                    <div class="list-group shadow " id="list-tab"   role="tablist">
                      <a class="  list-group-item list-group-item-action bg-secondary text-white" style="padding: 15px;"  id="list-all-list">
                        <router-link to="/search/posts"><input style="padding-right:62px;" type="text" v-model="search" class="rounded-lg form-control input " placeholder="Search for solutions"></router-link>
                        <button style="margin:-32.5px 10px 0px 0px ;" class="btn  btn-sm btn-primary d-md-none rounded-lg  float-right" type="button" data-toggle="modal" data-target="#my-modal" title="Create">
                        Write <u>&ensp;<i class="fa fa-pencil" aria-hidden="true"></i></u> </button>
                      </a>
                    </div>
                    <div class="text-secondary shadow-sm rounded-lg mt-1 friendsList border bg-white" >

                     <ul class="active-friends ml-0 pl-0  py-0 " style="overflow: scroll !important;">
                        <!-- Friends -->
                        <div v-if="users.freinds.length" class="px-3 shadow-sm d-none d-md-block">Friends</div>
                            <li  class="mt-1 friendSelect pl-2 " v-for="friendsList  in users.freinds.slice(0,4)" :key="friendsList.id"  @dblclick='urlToUser(friendsList.user.name)'>
                                  <small><router-link  :to="`/profile/${friendsList.user.name}`" class="">
                                    <img  :class="`${(friendsList.isOnline) ? 'border-info' : 'border-1'}`"  id="logo"  :src="`${friendsList.user.profiles.photo}`" alt="">
                                  <small  v-if="friendsList.isOnline"  class="fa position-relative d-inline d-md-none fa-circle text-success online" aria-hidden="true" style="margin: 10px 0px 0px -10px;top: 10px;"></small>
                                  <small  v-if="friendsList.isOnline"  class="fa position-absolute d-none d-md-inline fa-circle text-success online" aria-hidden="true"></small>

                                </router-link>
                                  <b><span  :to="`/profile/${friendsList.user.name}`" class="d-md-inline-block  d-none  pl-2" style="font-size: 15px;opacity:90%">{{friendsList.user.profiles.first_name}} {{friendsList.user.profiles.last_name}}</span>
                                    <span @click.once='removeUser(friendsList.id)' class="badge d-none d-md-block badge-primary float-right p-1 m-1">Unfriend</span></b>
                                    <span @click.once='removeUser(friendsList.id)' class="badge badge-primary d-block d-md-none  p-1">Unfriend</span></b>
                                </small>
                            </li>
                            <router-link  :to="`/search/users`" v-if="users.freinds.length >= 4"  class="text-center Dlink d-none d-md-block p-1 m-2 rounded-lg text-primary shadow-sm  " style="background: rgb(240, 242, 245);">See All..</router-link>

                        <!-- Request -->
                        <div  v-if="users.request.length" class="px-3 shadow-sm d-none d-md-block mt-2">Freinds Request</div>
                           <li  class="mt-1 friendSelect pl-2 d-none d-md-block" v-for="request in users.request.slice(0,4)" :key="request.id"  @click='urlToNotify(`#myCard_${request.id}`)'>
                                  <small>
                                    <router-link  :to="`/notification#n${request.id}`" class="">
                                     <img :class="`${(request.isOnline) ? 'border-info' : 'border-1'}`"   id="logo"  :src="`${request.user.profiles.photo}`" alt="">
                                </router-link>
                                  <b><span  :to="`/notification#n${request.id}`" class="d-md-inline-block  d-none  pl-2" style="font-size: 15px;opacity:90%">{{request.user.profiles.first_name}} {{request.user.profiles.last_name}}</span>
                                </b>
                                </small>
                            </li>
                            <router-link  :to="`/notification`" v-if="users.request.length >= 4"  class="text-center Dlink d-none d-md-block p-1 m-2 rounded-lg text-primary shadow-sm  " style="background: rgb(240, 242, 245);">See All..</router-link>
                                <!-- Suggested -->
                        <div  v-if="users.suggested.length" class="px-3 shadow-sm d-none d-md-block mt-2">Suggested Freinds</div>
                        <!-- {{ users.suggested }} -->
                       <li  class="mt-1 friendSelect pl-2 d-none d-md-block" v-for="request in users.suggested" :key="request.id"  @click='urlProfile(request.user.profiles.first_name)'  >
                               <router-link  :to="`/profile/${request.user.profiles.first_name}`">
                                  <img  id="logo"  :src="`${request.user.profiles.photo}`" alt="">
                               <b><span  class="d-md-inline-block  d-none  pl-2" style="font-size: 15px;opacity:90%">{{request.user.profiles.first_name}}  {{request.user.profiles.last_name}}</span>
                                   </b>
                             </router-link>
                         </li>
                        </ul>
                    </div>
                  <!-- create Post -->
                   <div id="my-modal"   ref="createModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                             <form  v-on:submit.prevent="showPost " class="shadow-none ">
                                <div class="modal-body  px-0">
                                    <h5 class="text-center text-secondary">?? Ask <span class="text-primary">Question</span> Or give <span class="text-danger">Solution</span> <i class="fa fa-book" aria-hidden="true"></i></h5>
                                    <hr class="">
                                      <div class="items p-3">
                                        <label for="Categories">Choose Category <span class="text-danger">*</span></label> <br>
                                        <select v-model="getPost.category" id="my-select" class="custom-select shadow-sm rounded-lg " aria-placeholder="">
                                            <option selected value="" >Select Category</option>
                                            <option >Android</option>
                                            <option>BackEnd</option>
                                            <option>FrontEnd</option>
                                            <option>UI/UX</option>
                                            <option>Others</option>
                                          </select>
                                          <br><br>
                                          <div class="row text-secondary">
                                              <div class="col-12 mb-3">
                                                <label for="body">Write here <i class="fa fa-arrow-down" aria-hidden="true"></i></label>
                                                <textarea
                                                id="my-textarea"  placeholder="Write here......."   class=" shadow-sm form-control "  rows="4"
                                                v-model="getPost.body"></textarea>
                                              </div>
                                              <div class="col-11 border-primary rounded-lg m-auto p-1 text-center" style="border: 4px dashed;">

                                                <label for="image">Choose Picture</label>
                                                <input id="photo_data" multiple accept="image/png, image/jpeg, image/bmp, image/jpg, image/PNG"  @change="previewImage('image')"   ref="photo"
                                                class="form-control input-file-image shadow d-inline" type="file" style="width: 30px !important;height: 30px;" />
                                              </div>
                                          </div>
                                            <br>
                                          <div class="image-preview  text-center" v-if="imageData.length > 0">
                                            <img ref="imgDisplay" style="width: 150px;height: 180px;" id="preview" class="preview m-auto rounded-lg" :src="imageData" />
                                          </div>
                                      </div>
                                </div>
                                <div class="modal-footer">

                                    <div v-if="load" class="spinner-border text-primary" role="status">
                                        <span class="sr-only"> Loading...</span>
                                    </div>
                                   <!-- <button type="button" class="btn btn-secondary" >Close</button> -->
                                    <button  v-if="!load"   class="btn   shadow w-50 col" data-dismiss="modal" >Cancel</button>
                                    <button  v-if="!load"   class="btn btn-primary  col shadow w-50" type="submit">Post</button>
                                </div>
                               </form>
                          </div>
                      </div>
                  </div>

                  </div>
              <div class="col-md-6  createPost p-0" >

                <div class="tab-content createPost mx-md-0 pt-0" id="nav-tabContent" style="padding: 1px;">
                    <div class="video">
                            <ul class="pl-0 pt-2 scrollVideo">
                                <li class="storycontainer text-center   position-relative" style="margin-top:8px !important">
                                <a style="cursor:pointer;" data-toggle="modal" data-target="#addVideo" class="d-block text-info">
                                        <img class="storypix"  :src="`${profile[0].profiles.photo ||'../../images/avater.png'}`" alt="">
                                      <i class="fa fa-plus-circle text-primary  rounded-circle bg-white" aria-hidden="true" style="border: 4px solid white;position: relative;top: -9px;font-size: 20px;" ></i> <br>
                                      <small class="text-primary" style="font-size:9px" >Add Video</small>
                                 </a>
                                    <div class="modal fade" id="addVideo" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header p-2">
                                                <h5 class="modal-title text-secondary">Add Video</h5>
                                            </div>
                                            <div class="modal-body text-left  ">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="Categories">Choose Category <span class="text-danger">*</span></label> <br>
                                                        <select v-model="videoM.category" id="my-select" class="custom-select shadow-sm rounded-lg " aria-placeholder="">
                                                            <option selected value="" >Select Category</option>
                                                            <option >Android</option>
                                                            <option>BackEnd</option>
                                                            <option>FrontEnd</option>
                                                            <option>UI/UX</option>
                                                            <option>Others</option>
                                                          </select>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <label for="body">Description <i class="fa fa-arrow-down" aria-hidden="true"></i></label>
                                                        <textarea
                                                        id="my-textarea"  placeholder="Write here......."   class=" shadow-sm form-control "  rows="4"
                                                        v-model="videoM.description"></textarea>
                                                    </div>


                                                    <div class="col-11 text-center m-auto p-3  " style="border:4px dashed #3490DC;margin-top: 15px !important;border-radius:5px" >
                                                <span>Choose Video</span> <br>
                                                         <input accept="video/*" @change="previewImage('video')" ref="photo" class="form-control input-file-image shadow-sm d-inline" type="file" style="width: 50px !important;height: 50px;background: url(https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQqq5ltRQ5Lw76-z5DKbEqEgjuBnQ2U-orZJQ&usqp=CAU);background-size:cover" />
                                                         <small class="d-block">
                                                              Maximuim Video Size is 25mb <br>
                                                              Must be file type of: mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts
                                                         </small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer p-1">
                                                <div v-if="load" class="spinner-border text-primary" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                                <button v-if="!load" type="button" class="btn btn-sm shadow btn-secondary" data-dismiss="modal">Close</button>
                                                <button v-if="!load" type="button" @click="uploadVideo()" class="btn btn-sm shadow btn-primary">Upload</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                </li>

                                <li @click="loadVideo(video)" class="storycontainer  text-center  mt-2" style="cursor:pointer;background:rgba(0,0,0,0.7);"  v-for="video in videos" :key="video.id">
                                    <img :src="video.user.profiles.photo" id="logo2" alt="">
                                        <video class="storypix2" :src="`${video.name}`" download></video>
                                        <small class="names text-left d-block">
                                            {{ video.user.profiles.first_name}} <br>
                                            {{ video.user.profiles.last_name}}
                                        </small>
                                </li>


                            </ul>
                            <router-link to="/videos" class="float-right load pl-3 p-2 text-primary d-none d-md-block">Load More..</router-link>
                            <div   class="text-center Dlink  p-1 m-2 rounded-lg text-primary shadow-sm  d-block d-md-none" style="background: rgb(219, 226, 241);"><router-link to="/videos">See All.. </router-link></div>
                    </div>
                    <hr>
                         <div class="tab-pane fade show  mx-lg-5 px-xl-5 active" id="list-all" role="tabpanel" aria-labelledby="list-all-list">
                       <div v-if="loading && !alert.status" class="newPost bg-white mb-2 p-2 rounded-lg shadow">
                            <div class="spinner-border text-primary"  role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                                   <span class="text-primary pl-2">  Loading Your New Post</span>
                         </div>
                         <div id="me"  v-if="!loading && alert.status" :class="`alert ${alert.color}  alert-dismissible fade show`" role="alert">

                             <strong>{{ alert.title }} </strong> {{alert.body}}
                         </div>
                         <div class=" ">
                             <!-- <input @change="read" id="my-input"   type="file" multiple name=""> -->
                         </div>
                          <!-- show all -->
                            <posts></posts>
                        </div>
               </div>
              </div>
            <div class="col-md-3  d-none d-md-block bg-white postBox p-0 ">
            <!-- create Post -->
                <form  v-on:submit.prevent="showPost " class="pt-2 ">
                <div class="modal-body  px-0">
                    <h5 class="text-center text-secondary">?? Ask <span class="text-primary">Question</span> Or give <span class="text-danger">Solution</span> <i class="fa fa-book" aria-hidden="true"></i>
                    </h5>
                    <hr class="">
                    <div class="items px-3 py-1">
                        <label for="Categories">Choose Category <span class="text-danger">*</span></label> <br>
                        <select v-model="getPost.category" id="my-select" class="custom-select shadow  rounded-lg " aria-placeholder="">
                            <option selected value="">Select Category</option>
                            <option >Android</option>
                            <option>BackEnd</option>
                            <option>FrontEnd</option>
                            <option>UI/UX</option>
                            <option>Others</option>
                          </select>
                          <br><br>
                          <div class="row text-dark">
                              <div class="col-12 mb-3">
                                <label for="body">Write here <i class="fa fa-arrow-down" aria-hidden="true"></i></label>
                                <textarea
                                id="my-textarea"  placeholder="Write here......."   class=" shadow form-control "  rows="4"
                                v-model="getPost.body"></textarea>
                              </div>
                              <div class="col-11 m-auto p-1 text-center  border-primary rounded-lg" style="border:4px dashed">
                                <label for="image">Choose Picture</label>
                                <input id="photo_data" accept="image/png, image/jpeg, image/bmp, image/jpg, image/PNG"    @change="inputMultiple()"  multiple  ref="photo"
                                class="form-control input-file-image shadow d-inline" type="file" style="width: 35px !important;height: 35px;" />

                              </div>
                               <div class="col-12 mt-2">
                              <button  class="btn float-right w-100 rounded-lg  shadow btn-primary" type="submit" >Post</button>
                               </div>
                          </div>
                          <div class="image-preview p-2 text-center" v-if="imageData.length > 0">
                              <hr class="mt-1">
                            <img ref="imgDisplay" style="width:150px !important;height:150px !important" id="preview" class="preview m-auto rounded-lg" :src="imageData" />
                          </div>
                      </div>
                </div>
               </form>
           </div>
        </div>
          </div>
   </div>
           </div>
           <FlashMessage   position="left bottom"></FlashMessage>
       </div>
</template>

<script>
import moment from 'moment';
import truncate from 'vue-truncate-collapsed';
import posts from './categories/posts';
    export default {
    components:{
        truncate,
        moment,
        posts
    },
        data() {
            return {
                baseUrl:'http://localhost:8000',
                editCommentData:[],
                editPostData:{},
                getPost: {
                    body: '',
                    picture: '',
                    category: '',
                },
                friendsLists:[],
                imageData: '',
                postsLike:'',
                postsComment:'',
                postsLove:'',
                postedIid:'',
                closeModal:'',
                alert:{
                    title:'',
                    body:'',
                    color:'',
                    status:false
                },
                search:'',
                close:true,
                loading:false,
                load:false,
                id:'1',
                newPost:{},
                name:'',
                videos:[],
                videoM:{
                    description:'',
                    category:''
                },
                users:{},
                items:[]


            }
        },beforeMount() {
            this.video();
            this.userListed();

            // mount all get for post
            this.$store.dispatch('posts');
            // get all users Data
            this.$store.dispatch('profile');
            this.$store.dispatch('friendslist');
      },

      watch: {


      },
        computed:{

            followToggle(id)
            {
              axios.post(`${this.$baseUrl}/freinds`,{id}).then((res) => {

              })
            },
        // return all get Users Data
        profile()
        { return this.$store.state.profile;},
        friendslist()
        { return this.$store.state.friendslist;},

       // get all Reaction
        posts()
        {
            return this.$store.state.posts;
        },


         },
         mounted() {
              Echo.private(`notification`)
             .listen('Notification',(e)=>{
              this.refresh()
             })
         },
        methods:{
            inputMultiple(){
                let input = event.target.files;
                if (!input.length) {
                    return false
                }
                for (let index = 0; index < input.length; index++) {
                    this.items.push(input[index])
                }

            },
            getChatUsers()
             {
                 Echo.join('chat')
                 .here((users)=>{
                    this.userListed();
                  console.log(users)
                 })
                 .joining((users)=>{
                    this.userListed();
                  console.log(users)
                })
                 .leaving((users)=>{
                    this.userListed();
                 console.log(users)
                 })
             },
            urlToUser(name)
            {
              this.$router.push(`/profile/${name}`)
            },
            urlToNotify(id)
            {
              this.$router.push(`/notification${id}`)
            },
            urlProfile(id)
            {
              this.$router.push(`/profile/${id}`)
            },
             refresh()
             {
                 // mount all get for post
            this.$store.dispatch('posts');

            // get all users Data
            this.$store.dispatch('profile');
            this.$store.dispatch('friendslist');
            this.closeModal='modal';
            this.getPost.body='';
            this.getPost.category='';
            this.getPost.picture='';
            this.imageData='';
            this.userListed();
            this.video();
             },
             video()
             {
                  axios.get(`${this.$baseUrl}/video`).then((res) => {
                      this.videos=res.data.video
                  })
             },
              userListed()
             {
                  axios.get(`${this.$baseUrl}/freinds`).then((res) => {
                      this.users=res.data
                  })
             },
             //unfreind user......
             removeUser(id)
             {
                  axios.delete(`${this.$baseUrl}/freinds/${id}`).then((res) => {
                    this.refresh()
                  })
             },

            previewImage(data) {
                let input = event.target;
                if (data=='video') {
                this.name = input.files[0];
                }
                else
                {
                this.getPost.picture = input.files[0];
                let reader = new FileReader();
                reader.onload = e => {
                    this.imageData = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
                }

            },

            loadVideo(video)
            {
             location.href=video.name;
            },
            uploadVideo()
            {
                let close=document.getElementsByClassName('modal-backdrop')[0];
               let modal=document.getElementById('addVideo');
               let body=document.getElementsByTagName('body')[0];
               this.load=true
               const formData = new FormData();
                formData.append('name', this.name);
                formData.append('description', this.videoM.description);
                formData.append('category', this.videoM.category);
                let config = { headers: { 'Content-Type': 'multipart/form-data' } }
                    axios.post(`${this.$baseUrl}/video`, formData,config).then((res) => {
                      this.video();
                let audio=new Audio('http://soundbible.com/mp3/Air Plane Ding-SoundBible.com-496729130.mp3');
                    audio.play();
                    this.load=false
                    close.style.display="none"
                    modal.style.display="none"
                   body.classList.remove('modal-open')
                    console.log(res)
                    })
                    this.videoM.description=""
                    this.name=""
                    this.videoM.category=""

            },
            showPost() {
                let close=document.getElementsByClassName('modal-backdrop')[0];
               let modal=document.getElementById('my-modal');
               let body=document.getElementsByTagName('body')[0];

                this.loading=true
                this.load=true
                this.alert.status=false

                const formData = new FormData();
                for (let index = 0; index < this.items.length; index++) {
                    formData.append('picture[]', this.items[index]);
                }
                    formData.append('body', this.getPost.body);
                    formData.append('category', this.getPost.category);
                    let config = { headers: { 'Content-Type': 'multipart/form-data' } }
                    axios.post(`${this.$baseUrl}/post`, formData,config).then((res) => {
                   let audio=new Audio('http://soundbible.com/mp3/Air Plane Ding-SoundBible.com-496729130.mp3');
                    audio.play();
                    this.loading=false
                    this.load=false
                    this.alert.status=true
                    this.alert.body="Posted Successfully!"
                    this.alert.title="Posted!"
                    this.alert.color='alert-primary'
                    this.items=[]

                }).catch((error) => {
                    this.loading=false
                    this.load=false
                    this.alert.status=true
            if (error.response.status == 422){
               this.alert.body="Make sure you write your Post message or attach picture"
               this.alert.title="Required Input!"
               this.alert.color='alert-danger'
              }
              else{
                this.alert.body="Can't post now, Try again later"
                this.alert.title="No Internet Connection"
                this.alert.color='alert-warning'
              }
            });
                close.style.display="none"
                modal.style.display="none"
                body.classList.remove('modal-open')

                this.refresh()
            },
            updatePost(id) {
                     const formData = new FormData();
                    formData.append('picture',  this.getPost.picture);
                    formData.append('body', this.getPost.body);
                    formData.append('category',  this.getPost.category);
                    formData.append('_method', 'PUT');
                  let config = { headers: { 'Content-Type': 'multipart/form-data' } }
                axios.post(`${this.$baseUrl}/post/`+ id, formData,config).then((res) => {
                    let audio=new Audio('http://soundbible.com/mp3/Air Plane Ding-SoundBible.com-496729130.mp3');
                    audio.play();
                })
                this.refresh()
                this.closeModal='modal';
            },
            commentEditor(comments){
                this.editCommentData=comments;
                console.log(this.editCommentData)
            },
            editPost(post)
            {
                    this.editPostData=post;
                    console.log(this.editPostData);
            },
            postComment(id) {
                    const formData = new FormData();
                    formData.append('picture', this.comment.commentImg);
                    formData.append('comment', this.comment.commentText);
                    formData.append('post_id', id);
                    let config = { headers: { 'Content-Type': 'multipart/form-data' } }
                    axios.post(`${this.$baseUrl}/comment`, formData,config).then((res) => {
                    let audio=new Audio('http://soundbible.com/mp3/Air Plane Ding-SoundBible.com-496729130.mp3');
                    audio.play();
                    console.log(res.data)
                })
               this.refresh()
               this.comment.commentImg= "";
               this.comment.commentText= "";
               this.imageData= "";
            }
        },
    }
</script>

<style  lang="scss" scoped>
    .load{
        position: relative;
         margin:-70px 0px 0px 0px;
         background: rgb(219, 226, 241);
         border: 1px solid lightgrey;
         border-right:none;
         padding: 4px;
         cursor: pointer;
         border-top-left-radius: 30px;
         border-bottom-left-radius: 30px;

    }
.scrollVideo
{
    overflow-x: scroll;
     width:100% ;
    display: inline-flex !important;

}
.online{
    font-size: 9px;
    margin-left: -10px;
    margin-top: 30px;
    background:white;
    border-radius:50%
}
.friendSelect:hover .online{
    background:transparent;


}

.storypix
{
    border-radius: 10px;
    width: 80px;
    height: 80px;
}
.storypix2
{
    border-radius: 10px;
    width: 80px;
    height: 130px;
    margin-top: -43px;
}
.storycontainer
{
    border-radius: 10px;
    width: 80px;
    height: 130px;
    background-color: white;
    list-style: none;
    display: inline-block;
    margin-left: 7px;
}
#logo2
{
    width: 40px;
    height: 40px;
    border:3px solid rgb(90, 128, 243);
    border-radius:50%;
    position: relative;
    margin:3px 0 0 -20px;
}
.names
{
    position: relative;
   font-size: 10px;
     top: -55px;
    color: white;
    text-shadow: 1px 1px black;
    padding-left: 2px;

}
.input
{
    background: #F8F9FA !important;
}

    .commentMsg:hover,.postMsg:hover
    {
        background: whitesmoke;
    }

    .getCommentImg{
        width: 200px !important;
    }
  #commentImg{
      width: 30px;
      border-radius: 50%;
      border: 2px solid lightgrey;
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
      color: transparent;
     cursor: pointer;
 }


textarea{
    resize: none;
}
.z0 {
        z-index: 0;
        height: 34px;
        font-size: 12px;
    }
    #logo,
    #profilePix {
        width:45px;
        height:45px;
        border-radius: 50%;
        border: 3px solid lightgrey;

    }
    .preview {
        width: 200px !important;
        height: 200px !important;
        border: 5px solid silver;
    }
    /* .card-footer,  */

    .card {
        border-radius: 12px !important;
    }

    .action-box{
        button{
           margin-left: 10px ;
           margin-right: 10px;
      .fa {
        font-size: 16px !important;
        }

    }
}
    .active-friends>li {
        list-style-type: none;
        padding: 2px;
    }

    .active-friends {
        overflow: scroll;
        width: 100%;
        -ms-overflow-style: none !important;
    }

    .showBox,.friendsList {
        -ms-overflow-style: none !important;
        overflow-y: scroll;
    }

    .showBox::-webkit-scrollbar {
        display: none;
    }

    .active-friends::-webkit-scrollbar,textarea::-webkit-scrollbar, .postBox>form::-webkit-scrollbar {
        display: none;
    }
      .listBox,.bg{
       background: white;

      }
      .postBox>form{
         overflow: scroll;
         /* height: 100vh; */
      }
      .postImg{
            width: 100%;
      }
      .postImgContaniner
      {
         background: whitesmoke;
      }
a:hover{
text-decoration: none;
}
    @media only screen and (min-width: 768px) {
        .friendsList
        {
        height: 90vh !important;
        -ms-overflow-style: none !important;
        overflow-y: scroll;
        /* opacity: 70%; */
        background: #ffffff !important;
         a{
             color: grey;
         }

        }

        .tab-content,.listBox,.friendsList{
         height: 100vh;

      }
        .friendSelect:hover, .friendSelect:active
        {
            background:rgb(147, 160, 168) ;
            cursor: pointer;
            color: whitesmoke !important;
            a{
            color: whitesmoke !important;

            }
        }
        .friendSelect
        {
            padding: 5px;
            border-radius: 10px;
            border: 1px solid whitesmoke;
            border-top:none;


        }

   .tab-content
     {
       overflow: scroll;
       height: 100vh;
     }
     .action-box>button {
       margin-left: 28px  ;
       margin-right: 28px ;
    }
    .createPost{
        border-radius:5px;
        padding-top: 0px !important;
         background:#dfe1e2 !important;

    }
    .listBox,.bg{
       background: rgb(240, 243, 243) !important;

      }

    }


    @media only screen and (max-width: 767px) {


        .active-friends {
            display: inline-flex !important;

        }
          .postImg{
            width: 100% !important;
      }
      .tab-content,.listBox,.active-friends{
          padding-left: 10px ;
          padding-right: 10px ;
         overflow-x: hidden !important;

      }



    }
    body{
background:white
}
.createPost{
         background:#dfe1e2 !important;
         overflow-x: hidden !important;
}
@media only screen and (max-width: 767px){

        .home{
           overflow-y: scroll !important;
           height:100vh;

          }

      }
</style>
