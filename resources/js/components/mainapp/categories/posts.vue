<template>
    <div  >
          <div class="text-center" v-if="posts=''">
        <i class="text-secondary fa fa-newspaper fa-5x"></i>
    <h1 class="text-secondary">No Post Found <br> </h1>
    <small class="text-muted">be the first to Post</small>
    </div>
    <div class="show-all" v-for="post in posts" :key="post.id">
    <div class="card shadow-sm mb-3 p-2 text-secondary">
     <div class="ml-2">
         <h6><router-link  :to="`/profile/${post.user.name}`">
         <img id="logo" :class="`${(post.isOnline) ? 'border-info' : 'border-1'}`" :src="`${post.user.profiles.photo ||'../../../images/avater.png'}`" alt=""></router-link>
        <b> <router-link :to="`/profile/${post.user.name}`" class="">{{post.user.profiles.first_name}} {{post.user.profiles.last_name}}&ensp;<span style="font-size: 12px;"  class="text-secondary  font-weight-lighter">
    <i class="fa fa-globe" aria-hidden="true"></i> {{post.category}}</span>  </router-link></b>

        <span class="dropdown p-0" v-if="post.user_id==profile[0].id">
            <button @click="editPost(post.id)" class="btn float-right text-secondary " id="my-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
            <span class="dropdown-menu shadow-sm p-0 " aria-labelledby="my-dropdown">
                <a @click="deletePost(post.id)" class="dropdown-item   border-bottom py-2" ><i  class="fa fa-trash text-secondary" aria-hidden="true"></i> Delete</a>
                <router-link  :to="`/editpost/${post.id}`" class="dropdown-item border-bottom py-2 " ><i  class="fa fa-edit text-secondary" aria-hidden="true"></i> Edit </router-link>
            </span>
        </span>
        <small style="font-size: 9px;line-height: 0;margin-left: 11%;" class="font-weight-lighter d-block font-italic">{{ timer(post.created_at)}}</small>
    </h6>

     </div>
     <div class="card-body p-2 postMsg">
         <p class="card-text mt-1 ">

             <truncate collapsed-text-class="collapsed " action-class="customClass font-weight-bold " clamp="Show more" :length="100" less="Hide some"
             :text="post.body">
             </truncate>
         </p>
         <div v-if="post.picture != ''" class="pb-0 mb-0">
           <div class="postImgContaniner text-center p-0 ">
               <a :href="`${baseUrl}/storage/${post.picture}`"><img class="rounded-lg postImg border" :src="`${baseUrl}/storage/${post.picture}`"  alt=""></a>
           </div>
         </div>

     </div>
    <div>
         <small v-if="post.comments != ''">
             {{post.comments.length}}
              Comments</small>
         <router-link  :to="`/reactions/${post.id}`" v-if="post.likes != '' || post.loves != '' "    class="float-right text-muted" style="cursor:pointer;opacity: 70%;">
                <!-- auth -->
            <span v-for="love in post.loves" :key="love.id" v-if="love.user_id == profile[0].id">
                 you
                  <span v-if="post.likes.length + post.loves.length > 2 ">and {{post.likes.length + post.loves.length -1}} others</span>
                  <span v-if="post.likes.length + post.loves.length == 2">and {{post.likes.length + post.loves.length -1}} other</span>

             </span>
             <span v-for="like in post.likes" :key="like.id" v-if="like.user_id == profile[0].id">
                 you
                 <span v-if="post.likes.length + post.loves.length > 2 ">and {{post.likes.length + post.loves.length -1}} others</span>
                  <span v-if="post.likes.length + post.loves.length == 2">and {{post.likes.length + post.loves.length -1}} other</span>

             </span>

        <i v-if="post.loves != ''" class="fa fa-heart text-danger" aria-hidden="true"> </i><i v-if="post.likes != ''" class="fa fa-thumbs-up text-primary" aria-hidden="true"></i></router-link>

    </div>

     <div class="p-0">
         <div class="action-box text-center border-top p-0">
             <button title="like" @click="likePost(post.id)" id="likeBtn" class="btn mx-md-2 mx-3 mx-lg-4  mx-sm-5  btn-sm likebtn"  style="color:grey; opacity:65%;">
                <i class="fa fa-thumbs-up text-primary" aria-hidden="true">
                   <span v-if="post.id==liked.post_id && liked.user_id==profile[0].id" v-for="liked in post.likes" :key="liked.id">
                        <small class="font-weight-bold" style="font-size: 10px;"> liked</small>
                   </span>
                </i>

             </button>
             <button title="love" @click="lovePost(post.id)" id="loveBtn" class="btn  mx-md-2 mx-3 mx-lg-4  mx-sm-5 btn-sm lovebtn" style="color:grey; opacity:65%" >
                <i  class="fa fa-heart text-danger" aria-hidden="true">
                 <span v-if="post.id==loved.post_id && loved.user_id==profile[0].id" v-for="loved in post.loves" :key="loved.id">
                        <small class="font-weight-lighter" style="font-size: 10px;"> loved</small>
                  </span>
                </i>
            </button>
            <button @click="deleteLikeLove(post.id)" title="dislike/unlove" class="btn btn-sm  mx-md-2 mx-3 mx-sm-5 unlikebtn" style="color:grey; opacity:65%"><i class="fa fa-thumbs-down" aria-hidden="true"></i></button>
             <button title="comment" class="btn btn-sm  mx-md-2  mx-lg-4  mx-3 mx-sm-5"  :data-target="`#my-${post.id}`" style="color:grey; opacity:70%" data-toggle="collapse" aria-expanded="false" aria-controls="my-collapse"><i class="fa fa-comments-o" aria-hidden="true"></i></button>
              <div :id="`my-${post.id}`"  class="collapse text-justify">
                    <div class="title border-top pt-2">
                        <h6>Comment</h6>
                                <div class="commnetBox p-2">
                            <form @submit.prevent="postComment(post.id)">
                                <div class="row">
                                <div class="form-group w-100 pl-2 p-2  border-bottom">
                                    <router-link  :to="`/profile/${profile[0].name}`" class="">
                                    <!-- <img id="commentImg" :src="`${profile[0].profiles.photo ||'../../../images/avater.png'}`" alt=""  style="width:29px !important;height:29px !important;" >  -->
                                </router-link>
                                  <textarea v-model="comments.commentText" class=" bg-white p-3 pr-5 border  "
                                  style="background: whitesmoke;margin-bottom: -10px !important;max-height: 100px;border-radius:10px"  rows="2" placeholder="write your comment... " ref="commentBox"></textarea>
                                  <button class="btn p-1 position-relative  text-primary btn-sm" type="submit" style="left: -50px; z-index: 0;"><i class="fa fa-send" style="font-size: 17px;"></i></button>
                                  <input  accept="image/*"  @change="commentImg(post.id)"  ref="commentBoxImg"
                                  class="input-file-image position-relative    shadow-sm border-primary border"
                                  type="file"  style="margin-bottom: -10px !important;margin-left: -48px; height: 20px !important;width: 20px !important;"    />
                                  <div v-if="imageData" class="  d-inline mt-1 " style="position: absolute; margin-left: -70px;width: 42px;height: 46px;">
                                    <img :src="imageData" alt="" class="comment rounded-lg shadow w-100 h-100">
                                </div>
                                <small v-if="imageData" @click="imageData=false" class=" bg-dark text-white  text-center   rounded-circle" style="cursor: pointer;position: absolute; margin-left: -37px;margin-top: -5px;width: 15px;height: 15px;">x</small>

                                </div>
                            </div>
                            </form>

                           <div class="row p-0" v-for="comments in comment" :key="comments.id" v-if="post.id==comments.post_id" >
                                 <div class="col-2 pr-0">
                                    <router-link  :to="`/profile/${comments.user.name}`" class=""><img id="commentImg" class="float-right" :src="`${comments.user.profiles.photo ||'../../../images/avater.png'}`" alt=""  style="width:29px !important;height:29px !important;" > </router-link>
                                 </div>
                                 <div class="col-10 mb-3" >
                                     <div style="width: fit-content;max-width: 100%;border-radius:10px" class=" shadow  comment commentMsg pl-1 pr-3 pb-2 ">
                                         <small class="font-weight-bold "> <router-link  :to="`/profile/${comments.user.name}`">{{comments.user.profiles.first_name}} {{comments.user.profiles.last_name}}</router-link></small> <br>
                                          <truncate v-if="comments.comment != null && comments.comment != 'undefined'" collapsed-text-class="collapsed " action-class="customClass font-weight-bold" clamp="Show more" :length="100" less="Hide some" :text="`${comments.comment}`">
                                        </truncate>
                                         <a :class="`${(comments.picture ==null) ? 'd-none' : ''}`"
                                         v-if="comments.picture !='' || comments.picture !=null" :href="`${baseUrl}/storage/${comments.picture}`"><img id="getCommentImg" class="border p-0 shadow-sm rounded-lg" style="width: 70px !important;height:100px border-radius: 10px;" v-if="comments.picture !=''" :src="`${baseUrl}/storage/${comments.picture}`" alt=""></a> <br>
                                        <div class="reply p-0 m-0" >
                                        <small style="font-size: 9px;" class=" font-weight-lighter font-italic p-0 m-0">{{ timer(comments.created_at)}}</small>  <br>
                                            <button @click="deleteComment(comments.id)" class="btn p-1 mx-0  btn-sm " style="color:lightgray;"  title="delete" v-if="comments.user_id==profile[0].id"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            <router-link :to="`/editcomment/${comments.id}`" class="btn p-1 mx-0   btn-sm" style="color:lightgray;"  title="edit" v-if="comments.user_id==profile[0].id"><i class="fa fa-pencil" aria-hidden="true"></i></router-link>

                  </div>
                 </div>
                </div>
               </div>
             </div>
           </div>
        </div>
    </div>
 </div>
</div>

    </div>
                <FlashMessage  position="right bottom"  ></FlashMessage>

    </div>
</template>


<script>
    import moment from 'moment';
import truncate from 'vue-truncate-collapsed';
    export default {
        // props:['newPost'],
    components:{
        truncate,
        moment,
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
                comments: {
                        commentImg: '',
                        commentText: '',
               },
                friendsLists:{},
                imageData: '',
                postsLike:'',
                postsComment:'',
                postsLove:'',
                postedIid:'',
                closeModal:'',

            }
        } ,
        created() {

            // mount all get for post
            this.$store.dispatch('posts');

            // get all users Data
            this.$store.dispatch('profile');
            this.$store.dispatch('friendslist');

             // get all Reaction
            this.$store.dispatch('comment');
            this.$store.dispatch('getLike');
            this.$store.dispatch('getLove');


      },
      mounted() {
      },
        computed:{
       //return all get Post computed properties
        posts()
        {
        //     get: function () {
        //         return this.$store.state.posts;
        //     },
        //     set: function (newValue) {
        //     this.$store.state.posts= newValue
        //     }
            try {
                return this.$store.state.posts;
            } catch (error) {

            }
        },

        // return all get Users Data
        profile()
        { return this.$store.state.profile;},
        friendslist()
        { return this.$store.state.friendslist;},

       // get all Reaction
        comment()
        { return this.$store.state.comment;},
        getLike()
        { return this.$store.state.getLike;},
        getLove()
        { return this.$store.state.getLove;},
        },
        methods:{

            refresh()
            {  // mount all get for post
            this.$store.dispatch('posts');

            // get all users Data
            this.$store.dispatch('profile');
            this.$store.dispatch('friendslist');

             // get all Reaction
            this.$store.dispatch('comment');
            this.$store.dispatch('getLike');
            this.$store.dispatch('getLove');
             this.getPost.picture=""
            },
            timer(time) {
              return moment(time).fromNow();
            },
            playSound1()
            {
               let audio=new Audio('http://soundbible.com/mp3/Air Plane Ding-SoundBible.com-496729130.mp3');
                    audio.play();
            },
            playSound2()
            {
                let audio=new Audio('http://soundbible.com/mp3/light-switch-pull-chain-daniel_simon.mp3');
                    audio.play();
            },
            deleteComment(id){
                axios.delete(`${this.$baseUrl}/comment/` + id).then((res) => {
                    this.playSound1()
               });
                this.refresh()
            },


            likePost(id)
            {
                 const formData = new FormData();
                 formData.append('islike',1);
                  formData.append('post_id', id);
                 axios.post(`${this.$baseUrl}/like`, formData).then((res) => {
                        this.playSound2()
                })
                this.refresh()
            },
            lovePost(id)
            {
                   const formData = new FormData();
                    formData.append('islove',1);
                    formData.append('post_id', id);
                    axios.post(`${this.$baseUrl}/love`, formData).then((res) => {
                       this.playSound2();
               })
                this.refresh()

            },
            commentImg(id) {
                let input = event.target;
                this.comments.commentImg = input.files[0];
                let reader = new FileReader();
                reader.onload = e => {
                    this.imageData = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
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
            deletePost(id)
            {
             axios.delete(`${this.$baseUrl}/post/`+id).then((res) => {
              this.playSound1()
            })
                this.refresh()
            },    deleteLikeLove(id)
            {
                axios.delete(`${this.$baseUrl}/like/`+id);
                axios.delete(`${this.$baseUrl}/love/`+id);
                this.playSound2()
                this.refresh()
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
                    formData.append('picture', this.comments.commentImg);
                    formData.append('comment', this.comments.commentText);
                    formData.append('post_id', id);
                    let config = { headers: { 'Content-Type': 'multipart/form-data' } }
                    axios.post(`${this.$baseUrl}/comment`, formData,config).then((res) => {
                    this.playSound1()
                     this.flashMessage.success({
                    html:  `<span class="p-2" style="border-left:5px solid grey;color:whitesmoke">Commented Successfully!
                        </span>`,
                    time: 5000,
                })
                }).catch(error => {
            if (error.response.status == 422 || error.response.status == 429){
                this.errors = error.response.data.errors;
               if(error.response.data.errors.picture)
               {
                this.flashMessage.error({
                    html:  `<span class="p-2" style="border-left:5px solid grey;color:whitesmoke">${error.response.data.errors.picture[0]}
                        </span>`,
                    time: 5000,
                });
               }
               if(error.response.data.errors.comment)
               {
                this.flashMessage.error({
                    html:  `<span class="p-2" style="border-left:5px solid grey;color:whitesmoke">${error.response.data.errors.comment[0]}
                        </span>`,
                    time: 5000,
                });
               }
              }
              else{
                this.flashMessage.error({
                    html:  `<span class="p-2" style="border-left:5px solid grey;color:whitesmoke">Can't post comment, try again later
                        </span>`,
                    time: 5000,
                });
              }
        });
                this.comments.commentImg = "";
                this.comments.commentText= "";
                this.imageData= "";
                this.refresh()

            }
        },
    }
</script>

<style  lang="scss" scoped>
textarea,textarea:focus
{
  border:1px solid rgb(192, 195, 248) !important;
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
     background-image: url('../../../images/avater.png');
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
        width: 35px;
        height: 35px;
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
        /* height: 100vh; */
    }

    .showBox::-webkit-scrollbar {
        display: none;
    }

    .active-friends::-webkit-scrollbar,textarea::-webkit-scrollbar, .postBox>form::-webkit-scrollbar {
        display: none;
    }
       .listBox,.bg{
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



   .tab-content
     {
       overflow: scroll;
       height: 100vh;
       background: #dfe1e2 !important;
     }
     .action-box>button {
       margin-left: 28px  ;
       margin-right: 28px ;
    }
    .createPost{
        border-radius:5px;
        padding-top: 0px !important;
        background:red !important

    }
    .listBox,.bg{
       background: lightgrey !important;

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
          background: #dfe1e2 !important;
      }

    }

</style>
