<template>
    <div  class="pt-4 pt-md-5"> 
  <div  class="show-all col-md-10 col-lg-8 p-0 m-auto col-12" v-for="post in posts" :key="post.id" >
  <div class="card shadow mb-3 p-2 text-secondary" :id="`post_${post.id}`">
   <div class="ml-2">
      
       <h6><router-link  :to="`/profile/${post.user.name}`">
       <img id="logo" :class="`${(post.isOnline) ? 'border-info' : 'border-1'}`" :src="`${post.user.profiles.photo}`" alt="">
                                <small  v-if="post.isOnline"  class="fa position-absolute fa-circle text-success online" aria-hidden="true"></small>
       </router-link>
      <b> <router-link :to="`/profile/${post.user.name}`" class="">{{post.user.profiles.first_name}} {{post.user.profiles.last_name}}&ensp;<span style="font-size: 12px;"  class="text-secondary  font-weight-lighter">
  <i class="fa fa-globe" aria-hidden="true"></i> {{post.category}}</span>  </router-link></b>

<!-- Auth User Dropdown -->

      <span class="dropdown p-0"   >
          <button @click="editPost(post.id)" class="btn float-right text-secondary " id="my-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
          <span class="dropdown-menu shadow-sm p-0 " aria-labelledby="my-dropdown">
              <a  v-if="post.user_id != profile[0].id" class="dropdown-item   border-bottom py-2"   ><i  class="fa fa-user-times  text-secondary" aria-hidden="true"></i> Block this User</a>
              <a  v-if="post.user_id == profile[0].id" @click="deletePost(post)" class="dropdown-item   border-bottom py-2"    ><i  class="fa fa-trash text-secondary" aria-hidden="true"></i> Delete</a>
              <a v-if="post.picture" :href="`${post.picture}`" class="dropdown-item   border-bottom py-2" download >
                    
                   <i  class="fa fa-download text-secondary" aria-hidden="true"></i> Download Image 

                </a>
              <router-link v-if="post.user_id == profile[0].id" :to="`/editpost/${post.id}`" class="dropdown-item border-bottom py-2 "   ><i  class="fa fa-edit text-secondary" aria-hidden="true"></i> Edit </router-link>
              <a  v-if="post.user_id != profile[0].id" class="dropdown-item   border-bottom py-2"   ><i  class="fa fa-times border text-secondary" aria-hidden="true"></i> Report this Post</a> 
                <router-link to="/" class="dropdown-item  border-bottom py-2 bg-white text-secondary"   ><i  class="fa fa-home" aria-hidden="true"></i> Home </router-link>


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
         <div class="postImgContaniner text-center p-0 row m-0 ">  
                <div v-for="item in  post.picture"  class="col-12 col-md-6 m-0" :key="item.id"> 
                  <a :href="`${item}`" ><img class="rounded-lg postImg   mb-1 border" :src="`${item}`"  alt=""></a>    
               </div >   

         </div>
       </div>  

   </div>
    <div>
       <small v-if="post.comments != ''">
           {{post.comments.length}}
            Comments</small>
       <router-link  :to="`/reactions/${post.id}`" v-if="post.likes != '' || post.loves != '' || post.laugh != '' "    class="float-right text-muted" style="cursor:pointer;opacity: 70%;">
         
          <span v-for="love in post.loves" :key="love.id" v-if="love.user_id == profile[0].id">
               you
                <span v-if="post.likes.length + post.laugh.length + post.loves.length > 2 ">and {{post.likes.length + post.laugh.length + post.loves.length -1}} others</span>
                <span v-if="post.likes.length + post.laugh.length + post.loves.length == 2">and {{post.likes.length + post.laugh.length + post.loves.length -1}} other</span>

           </span>
           <span v-for="like in post.likes" :key="like.id" v-if="like.user_id == profile[0].id">
               you
               <span v-if="post.likes.length + post.laugh.length + post.loves.length > 2 ">and {{post.likes.length + post.laugh.length + post.loves.length -1}} others</span>
                <span v-if="post.likes.length + post.laugh.length + post.loves.length == 2">and {{post.likes.length + post.laugh.length + post.loves.length -1}} other</span>

           </span>

           <span v-for="laugh in post.laugh" :key="laugh.id" v-if="laugh.user_id == profile[0].id">
               you
               <span v-if="post.likes.length + post.laugh.length + post.loves.length > 2 ">and {{post.likes.length + post.laugh.length + post.loves.length -1}} others</span>
                <span v-if="post.likes.length + post.laugh.length + post.loves.length == 2">and {{post.likes.length + post.laugh.length + post.loves.length -1}} other</span>

           </span>

      <i v-if="post.loves != ''" class="fa  " aria-hidden="true">💗</i><i v-if="post.likes != ''" class="fa fa-thumbs-up text-primary" aria-hidden="true"></i><i v-if="post.laugh != ''" class="fa " aria-hidden="true">😅</i>

  </router-link>

  </div> 
   <div class="p-0">
       <div class="action-box text-center border-top p-0">
           <button data-title="like" @click="likePost(post.id)" id="likeBtn" class="btn mx-md-2 mx-3 mx-lg-4  mx-sm-5  btn-sm likebtn"  style="color:grey; opacity:65%;">

              <i style="font-size: 19px !important;" :class="`fa fa-thumbs-up text-primary`" aria-hidden="true">
                 <span v-if="post.id==liked.post_id && liked.user_id==profile[0].id" v-for="liked in post.likes" :key="liked.id">
                      <small class="font-weight-bold text-secondary" style="font-size: 10px;"> Liked</small>
                 </span>
              </i>


           </button>
           <button data-title="love" @click="lovePost(post.id)" id="loveBtn" class="btn  mx-md-2 mx-3 mx-lg-4  mx-sm-5 btn-sm lovebtn" style="color:grey; opacity:65%" >
              <i  class="fa" aria-hidden="true">💗
               <span v-if="post.id==loved.post_id && loved.user_id==profile[0].id" v-for="loved in post.loves" :key="loved.id">
                      <small class="font-weight-lighter" style="font-size: 10px;"> Loved</small>
                </span>
              </i>
          </button>
           <button @click="reactToPost(post.id)" data-title="react" class="btn btn-sm  mx-md-2 mx-3 mx-sm-5 unlikebtn" style="color:grey; opacity:65%">

                <i class="fa " aria-hidden="true">😅</i>
                <span v-if="post.id==laugh.post_id && laugh.user_id==profile[0].id" v-for="laugh in post.laugh" :key="laugh.id">
                  <small class="font-weight-lighter" style="font-size: 10px;"> Haha</small>
                 </span>
              </button>

           <button  data-title="comment" class="btn btn-sm  mx-md-2  mx-lg-4  mx-3 mx-sm-5"  :data-target="`#my-${post.id}`" style="color:grey; opacity:70%" data-toggle="collapse" aria-expanded="false" aria-controls="my-collapse"><i class="fa fa-comments-o" aria-hidden="true"></i></button>
            <div :id="`my-${post.id}`"  class="collapse text-justify">
                  <div   class="title border-top pt-2">
                      <h6>Comment</h6>
                              <div class="commnetBox p-2">
                          <form @submit.prevent="postComment(post.id)">
                              <div class="row">
                              <div class="form-group w-100 pl-2 p-2  border-bottom">
                                  <router-link  :to="`/profile/${profile[0].name}`" class="">
                                  <img id="commentImg" :src="`${profile[0].profiles.photo ||'../../../images/avater.png'}`" alt=""  style="width:29px !important;height:29px !important;" >
                              </router-link>
                                <textarea    @input="inpuTQuerry(`id_${post.id}`)"  v-model="comments.commentText" class=" bg-white p-3 pr-5 border  "
                                style="background: whitesmoke;margin-bottom: -10px !important;max-height: 100px;border-radius:10px"  rows="2" placeholder="write your comment... " ref="commentBox"></textarea>
                                <button v-if="comments.commentText && inputMe" class="btn p-1 position-relative  text-primary btn-sm" type="submit" style="z-index: 0;margin: 0 0 0 -40px;"><i class="fa fa-send" style="font-size: 17px;"></i></button>

                                <input     accept="image/*"  :id="`id_${post.id}`"  @change="commentImg(post.id)"  ref="commentBoxImg"
                                class="input-file-image position-relative    shadow-sm border-primary border"
                                type="file"  style=" height: 20px !important;width: 20px !important;z-index: 0;margin: -30px 0 10px 220px;"    />

                              </div>
                          </div>
                          </form>

                         <div class="row p-0" v-for="comments in comment" :key="comments.id" v-if="post.id==comments.post_id" >
                               <div class="col-2 pr-0">
                                  <router-link  :to="`/profile/${comments.user.name}`" class=""><img id="``commentImg" class="float-right border rounded-circle" :src="`${comments.user.profiles.photo ||'../../../images/avater.png'}`" alt=""  style="width:29px !important;height:29px !important;" > </router-link>
                               </div>
                               <div  class="col-10 mb-3"  >
                                   <div @mouseover="commentor(comments.id)" @mouseout="removeCommentor(comments.id)" style="width: fit-content;max-width: 100%;border-radius:15px" class=" shadow-sm border  comment commentMsg p-2 ">
                                       <small  class="font-weight-bold "> <router-link  :to="`/profile/${comments.user.name}`">{{comments.user.profiles.first_name}} {{comments.user.profiles.last_name}}</router-link></small> <br>
                                        <truncate v-if="comments.comment != null && comments.comment != 'undefined' && comments.comment !='' " collapsed-text-class="collapsed " action-class="customClass font-weight-bold" clamp="Show more" :length="100" less="Hide some" :text="`${comments.comment}`">
                                      </truncate>
                                      <a  :class="`rounded-lg ${(comments.picture ==null) ? 'd-none' : 'd-block'}`"
                                      v-if="comments.picture" :href="`${baseUrl}/storage/${comments.picture}`"><img id="getCommentImg" class="border p-0 shadow-sm rounded-lg" style="width: 70px !important;height:90px;border-radius: 10px;" v-if="comments.picture !=''" :src="`${baseUrl}/storage/${comments.picture}`" alt=""></a>

                                      <div  :id="`bg-${comments.id}`" class="reply p-0 m-0" style="display: none;" >
                                      <small style="font-size: 9px;" class=" font-weight-lighter font-italic p-0 m-0">{{ timer(comments.created_at)}}</small>  <br>
                                          <button @click="deleteComment(comments.id)" class="btn p-0 mx-0  btn-sm " style="color:lightgray;"  title="delete" v-if="comments.user_id == profile[0].id"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                          <router-link   :to="`/editcomment/${comments.id}`" class="btn p0  mx-0   btn-sm" style="color:lightgray;"  title="edit" v-if="comments.user_id == profile[0].id"><i class="fa fa-pencil" aria-hidden="true">
                                        </i></router-link>
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
      <FlashMessage  position="right bottom"></FlashMessage>

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
                inputMe:false,
                viewMe:false,
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
                posts:[]

            }

        } ,
        created() {
            this.refresh() 

      },
      mounted() { 
              
             Echo.private(`notification`)
             .listen('Notification',(e)=>{
               this.refresh()
             });
             this.getChatUsers() 
             

      },  
        methods:{
       

            getChatUsers()
             {
                 Echo.join('chat')
                 .here((users)=>{
                    this.$store.dispatch('posts');
                  console.log([users,'all'])
                 })
                 .joining((users)=>{
                    this.$store.dispatch('posts');
                  console.log([users,'join'])
                 })
                 .leaving((users)=>{
                    this.$store.dispatch('posts');
                   console.log([users,'remove'])
                   this.refresh()
                 })
             }, 
            refresh()
            {  
                // profile
                axios.get(`${this.$baseUrl}/profile`).then((res) => {
                                this.profile=res.data
                                console.log(this.profile)
                        })
                // mount all get for post
                axios.get(`${this.$baseUrl}/getpost/${this.$route.params.name}`).then((res) => {
                                this.posts=res.data
                                console.log(this.posts)
                        })
            },
            inpuTQuerry(id)
            {
                if (this.comments.commentText != '') {
                  document.getElementById(id).style.display='none'
                  this.inputMe=true;

                }
                else{
                  document.getElementById(id).style.display='block'
                  this.inputMe=false;
                }

            },
            commentor(id){
              let data=`bg-${id}`
              document.getElementById(data).style.display="block"
            },
            removeCommentor(id){
              let data=`bg-${id}`
              document.getElementById(data).style.display="none"
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
            reactToPost(id)
            {
                   const formData = new FormData();
                    formData.append('islaugh',1);
                    formData.append('post_id', id);
                    axios.post(`${this.$baseUrl}/laugh`, formData).then((res) => {
                       this.playSound2();
               })
                this.refresh()
            },
            commentImg(id) {
                let input = event.target;
                this.comments.commentText=''
                this.comments.commentImg = input.files[0];

                let reader = new FileReader();
                reader.onload = e => {
                    this.imageData = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
                this.postComment(id)
            },

            deletePost(data)
            {
             axios.post(`${this.$baseUrl}/deletePost`,data).then((res) => {
              this.playSound1()
              router.push('/')
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
                document.getElementById(`id_${id}`).style.display='block'
                    this.inputMe=false;
                    const formData = new FormData();
                    formData.append('picture', this.comments.commentImg);
                    formData.append('comment', this.comments.commentText);
                    formData.append('post_id', id);
                    let config = { headers: { 'Content-Type': 'multipart/form-data' } }
                    axios.post(`${this.$baseUrl}/comment`, formData,config).then((res) => {
                    this.playSound1()  
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
             document.getElementById(`id_${id}`).value=''
                this.comments.commentImg = "";
                this.comments.commentText= "";
                this.imageData= "";
                this.refresh()

            }
        },
    }
</script>

<style  lang="scss" scoped>

.online{
    font-size: 9px;
    margin-left: -10px;
    margin-top: 25px;
    background:white;
    border-radius:50%
}
.friendSelect:hover .online{
    border: none !important;

}
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
        border-radius: 2px !important;
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
         background: rgb(248, 248, 248);
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

