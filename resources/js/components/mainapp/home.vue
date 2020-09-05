<template>
  <div id="home " class="pt-3 p-2"  >

      <div class="row p-0" >
          <div class="col-md-12 bg" >
              <div id="category" class="container-fluid py-0 px-2 pt-2" >
               <div class="row bg"  >
                <div class="col-md-3 listBox p-0  shadow-sm"  >
                    <div class="list-group shadow-sm " id="list-tab" role="tablist">
                      <a class=" pb-0 pb-md-2 list-group-item list-group-item-action bg-secondary text-white" id="list-all-list">
                        <router-link to="/search/posts"><input style="padding-right:62px;" type="text" v-model="search" class="rounded-pill form-control input " placeholder="Search for solutions"></router-link>
                        <button style="position: relative;left:-6px;top:-31px" class="btn  btn-sm btn-primary d-md-none rounded-pill  float-right" type="button" data-toggle="modal" data-target="#my-modal" title="Create">Write</button>
                      </a>
                    </div>
                    <div class="text-secondary shadow-sm rounded-lg mt-1 friendsList border bg-white" >
                        <div class="px-3 shadow-sm ">All Users</div>
                        <ul class="active-friends ml-0 pl-0  py-0 " style="overflow: scroll !important;">
                            <li  class="mt-1 friendSelect pl-2" v-for="(friendsList, index) in friendslist" :key="index"  @click='urlToUser(friendsList.name)'  v-if="friendsList.id !=profile[0].id">
                                  <small  ><router-link  :to="`/profile/${friendsList.name}`" class="">
                                    <img id="logo" :class="`${(friendsList.isOnline) ? 'border-info' : 'border-1'}`" :src="`${friendsList.profiles.photo ||'../../images/avater.png'}`" alt="">
                                </router-link>
                                  <b><router-link  :to="`/profile/${friendsList.name}`" class="d-md-inline-block  d-none  pl-2" style="font-size: 15px;opacity:90%">{{friendsList.profiles.first_name}} {{friendsList.profiles.last_name}}</router-link></b>

                                </small>

                            </li>
                        </ul>
                    </div>
                  <!-- create Post -->
                   <div id="my-modal" ref="createModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                             <form  v-on:submit.prevent="showPost " class="shadow-none ">
                                <div class="modal-body  px-0">
                                    <h5 class="text-center text-secondary">?? Ask <span class="text-primary">Question</span> Or give <span class="text-danger">Solution</span> <i class="fa fa-book" aria-hidden="true"></i></h5>
                                    <hr class="">
                                      <div class="items p-3">
                                        <label for="Categories">Choose Category <span class="text-danger">*</span></label> <br>
                                        <select v-model="getPost.category" id="my-select" class="custom-select shadow-sm rounded-pill " aria-placeholder="">
                                            <option >Android</option>
                                            <option>BackEnd</option>
                                            <option>FrontEnd</option>
                                            <option>UI/UX</option>
                                            <option>Others</option>
                                          </select>
                                          <br><br>
                                          <div class="row text-secondary">
                                              <div class="col-12">
                                                <label for="body">Write here <i class="fa fa-arrow-down" aria-hidden="true"></i></label>
                                                <textarea
                                                id="my-textarea"  placeholder="Write here......."   class=" shadow-sm form-control "  rows="4"
                                                v-model="getPost.body"></textarea>
                                              </div>
                                              <div class="col-12">
                                                  <br>
                                                <label for="image">Choose Picture</label>
                                                <input  accept="image/*"  @change="previewImage"   ref="photo"
                                                class="form-control input-file-image shadow-sm" type="file" style="width: 40px !important;height: 40px;" />
                                              </div>
                                          </div>
                                            <br>
                                          <div class="image-preview p-2" v-if="imageData.length > 0">
                                            <img ref="imgDisplay" id="preview" class="preview m-auto rounded-lg" :src="imageData" />
                                          </div>
                                      </div>
                                </div>
                                <div class="modal-footer">
                                    <button v-if="getPost.body !='' && getPost.category !=''" class="btn btn-primary btn-sm shadow" type="submit">Post</button>
                                    <button v-if="getPost.body !='' && getPost.category !=''" class="btn btn-secondary btn-sm shadow" @click="refresh()" data-dismiss="modal">Close</button>
                                </div>
                               </form>
                          </div>
                      </div>
                  </div>
                  <div class="post w-100 mt-2 rounded-lg shadow-lg  text-center d-md-none bg-white"><h5 class="text-secondary text-capitalize font-weight-bold">Posts <i class="fa fa-newspaper-o" aria-hidden="true"></i></h5></div>

                  </div>
              <div class="col-md-6 bg-white createPost p-0">
                <div class="tab-content  mx-md-0 pt-0" id="nav-tabContent" style="padding: 1px;">
                    <div class="video">
                            <ul class="pl-0 pt-2">
                                <li class="storycontainer text-center shadow">
                                    <a style="cursor:pointer;" data-toggle="modal" data-target="#addVideo" class="d-block text-info">
                                        <img id="storypix"  :src="`${profile[0].profiles.photo ||'../../images/avater.png'}`" alt="">
                                      <i class="fa fa-plus-circle  rounded-circle bg-white" aria-hidden="true" style="border: 4px solid white;position: relative;top: -9px;font-size: 20px;" ></i> <br>
                                      <small style="font-size:9px" >Add Video</small>
                                </a>
                                <!-- Modal -->
                                <div class="modal fade" id="addVideo" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header p-2">
                                                <h5 class="modal-title text-secondary">Add Video <i class="fa fa-video-camera" aria-hidden="true"></i></h5>
                                            </div>
                                            <div class="modal-body">
                                                <span>Choose Video</span> <br>
                                                <div class="row">
                                                    <div class="col-3">
                                                         <input accept="image/*"  @change="addVideo()"   ref="photo" class="form-control input-file-image shadow-sm" type="file" style="width: 50px !important;height: 50px;" />
                                                    </div>
                                                    <div class="col-9">
                                                         <video width="100%" autoplay controls>
                                                             <source src="/video.mp4" type="video/mp4">
                                                            </video>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer p-1">
                                                <button type="button" class="btn btn-sm shadow btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-sm shadow btn-primary">Upload</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                </li>
                            </ul>
                    </div>
                    <hr>
                         <div class="tab-pane fade show  mx-lg-5 px-xl-5 active" id="list-all" role="tabpanel" aria-labelledby="list-all-list">
                            <!-- show all -->
                            <posts></posts>
                        </div>



               </div>
              </div>
            <div class="col-md-3  d-none d-md-block postBox p-0 ">
            <!-- create Post -->
                <form  v-on:submit.prevent="showPost " class="border ">
                <div class="modal-body  px-0">
                    <h5 class="text-center text-secondary">?? Ask <span class="text-primary">Question</span> Or give <span class="text-danger">Solution</span> <i class="fa fa-book" aria-hidden="true"></i>
                    </h5>
                    <hr class="">

                    <div class="items p-2">
                        <label for="Categories">Choose Category <span class="text-danger">*</span></label> <br>
                        <select v-model="getPost.category" id="my-select" class="custom-select shadow-sm input rounded-pill " aria-placeholder="">
                            <option >Android</option>
                            <option>BackEnd</option>
                            <option>FrontEnd</option>
                            <option>UI/UX</option>
                            <option>Others</option>
                          </select>
                          <br><br>
                          <div class="row text-dark">
                              <div class="col-12">
                                <label for="body">Write here <i class="fa fa-arrow-down" aria-hidden="true"></i></label>
                                <textarea
                                id="my-textarea"  placeholder="Write here......."   class=" shadow-sm form-control input"  rows="4"
                                v-model="getPost.body"></textarea>
                              </div>
                              <div class="col-12">
                                  <br>
                                <label for="image">Choose Picture</label>
                                <input  accept="image/*"  @change="previewImage"   ref="photo"
                                class="form-control input-file-image shadow-sm" type="file" style="width: 40px !important;height: 40px;" />
                              </div>
                          </div>
                            <br>
                          <div class="image-preview p-2" v-if="imageData.length > 0">
                            <img ref="imgDisplay" id="preview" class="preview m-auto rounded-lg" :src="imageData" />
                          </div>
                          <hr>
                    <button v-if="getPost.body !='' && getPost.category !=''" class="btn float-right btn-sm bg-white  shadow-sm  ml-2" @click="refresh()" >Cancel</button>

                    <button v-if="getPost.body !='' && getPost.category !=''" class="btn float-right btn-sm shadow-sm btn-primary" type="submit" >Post</button>
                   <br>
                      </div>
                </div>


               </form>
           </div>
           <FlashMessage   position="right bottom"  ></FlashMessage>

        </div>
                </div>
                </div>
           </div>

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
                friendsLists:{},
                imageData: '',
                postsLike:'',
                postsComment:'',
                postsLove:'',
                postedIid:'',
                closeModal:'',
                search:'',

            }
        },beforeMount() {
            // mount all get for post
            this.$store.dispatch('posts');
            // get all users Data
            this.$store.dispatch('profile');
            this.$store.dispatch('friendslist');
      },
        computed:{
        // return all get Users Data
        profile()
        { return this.$store.state.profile;},
        friendslist()
        { return this.$store.state.friendslist;},

       // get all Reaction
        posts()
        { return this.$store.state.posts;},
         },
        methods:{
            urlToUser(name)
            {
              this.$router.push(`/profile/${name}`)
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
             },

            previewImage() {
                let input = event.target;
                this.getPost.picture = input.files[0];
                let reader = new FileReader();
                reader.onload = e => {
                    this.imageData = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            },
            showPost() {
                     const formData = new FormData();
                    formData.append('picture', this.getPost.picture);
                    formData.append('body', this.getPost.body);
                    formData.append('category', this.getPost.category);
                    let config = { headers: { 'Content-Type': 'multipart/form-data' } }
                    axios.post(`${this.$baseUrl}/post`, formData,config).then((res) => {
                    let audio=new Audio('http://soundbible.com/mp3/Air Plane Ding-SoundBible.com-496729130.mp3');
                    audio.play();
                    this.refresh()
                     this.flashMessage.success({
                    html:  `<span class="p-2" style="border-left:5px solid grey;color:whitesmoke">Posted Successfully!
                        </span>`,
                    time: 5000,
                });
                }).catch(error => {
            if (error.response.status == 422 || error.response.status == 429){
                this.errors = error.response.data.errors;
               if(error.response.data.errors.first_name)
               {
                this.flashMessage.error({
                    html:  `<span class="p-2" style="border-left:5px solid grey;color:whitesmoke">${error.response.data.errors.first_name[0]}
                        </span>`,
                    time: 5000,
                });
               }
               if(error.response.data.errors.last_name)
               {
                this.flashMessage.error({
                    html:  `<span class="p-2" style="border-left:5px solid grey;color:whitesmoke">${error.response.data.errors.last_name[0]}
                        </span>`,
                    time: 5000,
                });
               }

               if(error.response.data.errors.email)
               {
                this.flashMessage.error({
                    html:  `<span class="p-2" style="border-left:5px solid grey;color:whitesmoke">${error.response.data.errors.email[0]}
                        </span>`,
                    time: 5000,
                });
               }

               if(error.response.data.errors.message)
               {
                this.flashMessage.error({
                    html:  `<span class="p-2" style="border-left:5px solid grey;color:whitesmoke">${error.response.data.errors.message[0]}
                        </span>`,
                    time: 5000,
                });
               }
               if(error.response.data.errors.phone)
               {
                this.flashMessage.error({
                    html:  `<span class="p-2" style="border-left:5px solid grey;color:whitesmoke">${error.response.data.errors.phone[0]}
                        </span>`,
                    time: 5000,
                });
               }
              }
              else{
                this.flashMessage.error({
                    html:  `<span class="p-2" style="border-left:5px solid grey;color:whitesmoke">Can't post contact us, try again later
                        </span>`,
                    time: 5000,
                });
              }
              });
                this.closeModal='modal';
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
                })
                   this.refresh()
               this.comment.commentImg= "";
              this.comment.commentText= "";
            }
        },
    }
</script>

<style  lang="scss" scoped>
#storypix
{
    border-radius: 10px;
    width: 60px;
    height: 60px;
}
.storycontainer
{
    border-radius: 10px;
    width: 60px;
    height: 110px;
    background-color: white;
    list-style: none;
    display: inline-block;
    margin-left: 7px;
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
           padding:0;
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
      .tab-content,.createPost,.listBox,.bg{
       background: whitesmoke;

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
        background: #F8F9FA !important;
         a{
             color: grey;
         }

        }
        .active-friends {
            /* height: 70vh; */
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
            border-radius: 40px;


        }

   .tab-content
     {
       overflow: scroll;
       height: 100vh;
       background: white;
     }
     .action-box>button {
       margin-left: 28px  ;
       margin-right: 28px ;
    }
    .createPost{
        border-radius:5px;
        padding-top: 0px !important;
        background: rgb(245, 245, 245) !important;
    }
    .tab-content,.createPost,.listBox,.bg{
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

      }


    }

</style>
