<template>
    <div id="home" class="px-md-5 p-3 pt-4 " style="background:#F8F9FA;">
        <div class="">
            <div class="row showProfile ">
                <div class="col-md-7  pt-md-3 col-lg-8 px-1 profileScroll   px-md-2 " >
                    <div class="row text-secondary ">
                        <div class="col-12 text-center " v-for="getInfo in friendslist" :key="getInfo.id">
                    <div id="img-modal" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="my-modal-title" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="my-modal-title">Upload Image</h5>
                                    <button class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form v-on:submit.prevent="updateProfile()">

                                <div class="modal-body">
                                    <div class="text-center">
                                        <label class="font-weight-bold">Choose Image......</label> <br>
                                     <input accept="image/*" @change="previewImage(getInfo.id)" ref="photo"  class=" input-file-image shadow-none border-0"  type="file" />

                                    </div>
                                    <br />
                                    <div class="image-preview" v-if="imageData.length > 0">
                                        <img ref="imgDisplay" id="preview" class="preview" :src="imageData" />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit"
                                        class="btn btn-sm shadow   btn-primary"  >
                                        Upload
                                        <i class="fa fa-upload" ></i>
                                    </button>
                                    <button data-dismiss="modal"
                                        class="btn btn-sm shadow"  >

                                        Close

                                    </button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                            <div class="Img rounded-lg shadow-sm pt-2  " :style="{ backgroundImage: `url(${baseUrl}/storage/${getInfo.profiles.photo ||'../../images/bg.png'})` }">
                     <button v-if="getInfo.id == profile[0].id" type="button" data-toggle="modal" data-target="#img-modal" title="Upload Image"
                    class="btn btn-dark btn-sm ml-1"> Edit photo <i class="fa fa-camera" aria-hidden="true"></i>
                    </button>
                       <div v-if="getInfo.id != profile[0].id" type="button" data-toggle="modal" data-target="#img-modal" title="Upload Image"
                    class=" ">  &emsp;
                    </div>
                                <a :href="`${baseUrl}/storage/${getInfo.profiles.photo ||'../../images/avater.png'}`"><img
                                        id="logoShow" class="shadow-sm"
                                        :src="`${baseUrl}/storage/${getInfo.profiles.photo ||'../../images/avater.png'}`" /></a>

                            </div>

                            <div class="registration text-capitalize mt-1 bg-white  border rounded-top p-2   pb-2 mb-0">
                                <br><br><br>
                                <h4 style="color:rgb(100, 93, 93) !important" class="text-capitalize ">
                                    <b>{{getInfo.profiles.first_name}} {{getInfo.profiles.last_name}}
                                        <i style="font-size:13px;" @click='getData(getInfo.profiles)'
                                            v-if="getInfo.id == authUser.id" data-target="#my-name"
                                            data-toggle="collapse" title="edit"
                                            class="fa fa-pencil text-muted btn-sm btn"></i>
                                        <div id="my-name" class="collapse text-center">
                                            <form v-on:submit.prevent="updateProfile()">
                                                <input type="text" class="form-control w-25 d-inline"
                                                    v-model="profileData.first_name" maxlength="12">
                                                <input type="text" class="form-control w-25 d-inline"
                                                    v-model="profileData.last_name" maxlength="12">
                                                <button type="submit" data-target="#my-name" data-toggle="collapse"
                                                    class="btn-sm btn btn-primary mt-1">update</button>
                                            </form>
                                        </div>
                                    </b></h4>

                                <div class="status"><span>{{getInfo.profiles.status}}
                                        <i @click='getData(getInfo.profiles)' v-if="getInfo.id == authUser.id"
                                            data-target="#my-status" data-toggle="collapse" title="edit"
                                            class="fa fa-pencil text-muted btn-sm btn"></i>
                                        <div id="my-status" class="collapse text-justify">
                                            <form v-on:submit.prevent="updateProfile()">
                                                <textarea maxlength="200" type="text" class="form-control" v-model="profileData.status"
                                                    rows="3"></textarea>
                                                <button type="submit" data-target="#my-status" data-toggle="collapse"
                                                    class="btn-sm btn btn-primary mt-1">update</button>
                                            </form>
                                        </div>
                                    </span></div>
                                <span></span>
                                <!-- GuestUser -->

                            </div>
                        </div>
                        <div class="col-12 others" v-for="profile in friendslist" :key="profile.id">
                            <!-- navbar -->
                            <nav class="bg-white border-left border-right" >
                                <div   class="nav nav-tabs mt-0 " id="nav-tab" role="tablist">
                                    <a style="background:whitesmoke !important;" class="getTap nav-item nav-link active mr-2 px-md-5" id="nav-about-tab" data-toggle="tab"
                                        href="#nav-about" role="tab" aria-controls="nav-about"
                                        aria-selected="true">About</a>
                                    <router-link :to="`/chat/${profile.name}`" class="getTap2 nav-item nav-link btn text-primary mx-2 px-md-5 " id="nav-timeline-tab" data-toggle="tab"
                                        role="tab" aria-controls="nav-timeline" >Chat</router-link>
                                    <router-link to="/home" class="getTap2 nav-item text-capitalize nav-link btn text-primary  mx-2 px-md-5" id="nav-timeline-tab" data-toggle="tab"
                                        role="tab" aria-controls="nav-timeline" >home</router-link>
                                </div>
                            </nav>
                            <div class="tab-content border  " id="nav-tabContent " >
                                <div class="tab-pane fade show active shadow-sm " id="nav-about" role="tabpanel"
                                    aria-labelledby="nav-about-tab" style="background: white !important;">

                                    <div class="fields p-1">
                                        <div class=""><span> <i> More About {{profile.name}} </i></span> </div>
                                        <br >
                                        <h5 class="text-primary "  v-if="id==profile.id"> ID Number<i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></h5>
                                        <span v-if="id==profile.id"><b>{{profile.name}}{{profile.id}}</b> <br>
                                            <small class="pl-3">This Id Number is personally for you alone,dont expose it</small>
                                        </span>
                                        <hr  v-if="id==profile.id">
                                        <h5 class="text-primary "> Username <i class="fa fa-file-text"
                                                aria-hidden="true"></i></h5>
                                        <span> {{profile.name}}
                                        </span>
                                        <hr>
                                        <h5 class="text-primary"> Email <i class="fa fa-envelope"
                                                aria-hidden="true"></i></h5>
                                        <span> {{profile.email}}</span>

                                        <hr>
                                        <h5 class="text-primary"> Phone <i class="fa fa-phone" aria-hidden="true"></i>
                                        </h5>
                                        <span> {{profile.profiles.phone || '+234'}}
                                            <i @click='getData(profile.profiles)' v-if="profile.id == authUser.id"
                                                data-target="#my-phone" data-toggle="collapse" title="edit"
                                                class="fa fa-pencil text-muted btn-sm btn"></i>
                                            <div id="my-phone" class="collapse">
                                                <form v-on:submit.prevent="updateProfile">
                                                  <div class="row">

                                               <div class="col-2">
                                                <VueCountryCode
                                                @onSelect="onSelect" class="form-control"
                                                :preferredCountries="['ng']">
                                           </VueCountryCode>
                                               </div>
                                               <div class="col-8">
                                                <input type="text" class="form-control" v-model="profileData.phone"
                                                minlength="11" maxlength="11">
                                               </div>

                                                  </div>

                                                    <button type="submit" data-target="#my-phone" data-toggle="collapse"
                                                        class="btn-sm btn btn-primary mt-1">update</button>
                                                </form>
                                            </div>
                                        </span>

                                        <hr>
                                        <h5 class="text-primary"> Date of Birth <i class="fa fa-birthday-cake"
                                                aria-hidden="true"></i></h5>
                                        <span> {{ dob(profile.profiles.dob)}}
                                            <i @click='getData(profile.profiles)' v-if="profile.id == authUser.id"
                                                data-target="#my-dob" data-toggle="collapse" title="edit"
                                                class="fa fa-pencil text-muted btn-sm btn"></i>
                                            <div id="my-dob" class="collapse">
                                                <form v-on:submit.prevent="updateProfile">
                                                    <input type="date" class="form-control" v-model="profileData.dob">
                                                    <button type="submit" data-target="#my-dob" data-toggle="collapse"
                                                        class="btn-sm btn btn-primary mt-1">update</button>
                                                </form>
                                            </div>
                                        </span>
                                        <hr>
                                        <h5 class="text-primary"> Gender <i class="fa fa-male" aria-hidden="true"></i>
                                        </h5>
                                        <span> {{profile.profiles.gender || '-------------'}}
                                            <i @click='getData(profile.profiles)' v-if="profile.id == authUser.id"
                                                data-target="#my-gender" data-toggle="collapse" title="edit"
                                                class="fa fa-pencil text-muted btn-sm btn"></i>
                                            <div id="my-gender" class="collapse">
                                                <form v-on:submit.prevent="updateProfile">
                                                    <select v-model="profileData.gender" id="my-select"
                                                        class=" form-control custom-select">
                                                        <option>Male</option>
                                                        <option>Female</option>
                                                    </select>
                                                    <button data-target="#my-gender" data-toggle="collapse"
                                                        type="submit"
                                                        class="btn-sm btn btn-primary mt-1">update</button>
                                                </form>
                                            </div>
                                        </span>
                                        <hr>
                                        <h5 class="text-primary"> Field of Expertise <i class="fa fa-thermometer-full"
                                                aria-hidden="true"></i></h5>
                                        <span> {{profile.profiles.field || '-------------'}}
                                            <i @click='getData(profile.profiles)' v-if="profile.id == authUser.id"
                                                data-target="#my-field" data-toggle="collapse" title="edit"
                                                class="fa fa-pencil text-muted btn-sm btn"></i>
                                            <div id="my-field" class="collapse">
                                                <form v-on:submit.prevent="updateProfile">
                                                    <select v-model="profileData.field" id="my-select"
                                                        class=" form-control custom-select">
                                                        <option >Android</option>
                                                        <option>BackEnd</option>
                                                        <option>FrontEnd</option>
                                                        <option>UI/UX</option>
                                                        <option>Others</option>
                                                    </select>
                                                    <button data-target="#my-field" data-toggle="collapse" type="submit"
                                                        class="btn-sm btn btn-primary mt-1">update</button>
                                                </form>
                                            </div>
                                        </span>
                                        <hr>

                                        <h5 class="text-primary"> Website <i class="fa fa-maxcdn"
                                                aria-hidden="true"></i></h5>
                                        <span> {{profile.profiles.website || "www.example.com"}}
                                            <i @click='getData(profile.profiles)' v-if="profile.id == authUser.id"
                                                data-target="#my-website" data-toggle="collapse" title="edit"
                                                class="fa fa-pencil text-muted btn-sm btn"></i>
                                            <div id="my-website" class="collapse">
                                                <form v-on:submit.prevent="updateProfile">
                                                    <input type="text" class="form-control"
                                                        v-model="profileData.website">
                                                    <button data-target="#my-website" data-toggle="collapse"
                                                        type="submit"
                                                        class="btn-sm btn btn-primary mt-1">update</button>
                                                </form>
                                            </div>
                                            </span>
                                                <hr>
                                        <h5 class="text-primary"> Nationality <i class="fa fa-flag" aria-hidden="true"></i></h5>
                                        <span> {{profile.profiles.country || '-------------'}}
                                            <i @click='getData(profile.profiles)' v-if="profile.id == authUser.id"
                                                data-target="#my-nationality" data-toggle="collapse" title="edit"
                                                class="fa fa-pencil text-muted btn-sm btn"></i>
                                            <div id="my-nationality" class="collapse">
                                                <form v-on:submit.prevent="updateProfile">
                                                    <country-select v-model="country" countryName='true'  @input="selectcountry(country)" class="form-control" :country="country" topCountry="NG" />
                                                    <button data-target="#my-nationality" data-toggle="collapse"
                                                        type="submit"
                                                        class="btn-sm btn btn-primary mt-1">update</button>
                                                </form>
                                            </div>
                                            </span>

                                                <hr>
                                        <h5 class="text-primary"> City/State <i class="fa fa-map-marker" aria-hidden="true"></i></h5>
                                        <span> {{profile.profiles.city || '-------------'}}
                                            <i @click='getData(profile.profiles)' v-if="profile.id == authUser.id"
                                                data-target="#my-city" data-toggle="collapse" title="edit"
                                                class="fa fa-pencil text-muted btn-sm btn"></i>
                                            <div id="my-city" class="collapse">
                                                <form v-on:submit.prevent="updateProfile">
                                                    <region-select v-model="region" class="form-control" regionName="true" :defaultRegion='regionNames' countryName='true' @input="selectregion(region)" :country="country"  :region="region" />
                                                    <button data-target="#my-city" data-toggle="collapse"
                                                        type="submit"
                                                        class="btn-sm btn btn-primary mt-1">update</button>
                                                </form>
                                            </div>
                                        </span>
                                    </div>
                                </div>


                            </div>

                        </div>

                    </div>
                </div>
                <div class='col-md-5 col-lg-4 p-0 py-3 timlineScroll px-md-2'>
                    <div class="tab-pane fade show active " id="list-all" role="tabpanel" aria-labelledby="list-all-list">
                        <!-- show all -->
              <div class="post pt-md-3 rounded-lg bg-white shadow-sm p-2 text-center"><h5 class="text-secondary  text-capitalize font-weight-bold">{{friendname}}'s Posts <i class="fa fa-newspaper-o" aria-hidden="true"></i></h5></div>

              <div class="text-center" v-if="posts==''">
                <i class="text-secondary fa fa-newspaper fa-5x"></i>
            <h1 class="text-secondary">No Post Found <br> </h1>
            <small class="text-muted">be the first to Post</small>
            </div>
              <div class="show-all" v-for="(post, index) in posts" :key="post.id">

               <div class="card shadow-sm mt-3 p-2 text-secondary">
                   <div class="ml-2">
                       <h6><router-link  :to="`/profile/${post.user.name}`"><img id="logo"  :class="`${(post.isOnline) ? 'border-info' : 'border-1'}`"  :src="`${baseUrl}/storage/${post.user.profiles.photo ||'../../images/avater.png'}`" alt=""></router-link>
                      <b> <router-link :to="`/profile/${post.user.name}`" class="">{{post.user.profiles.first_name}} {{post.user.profiles.last_name}}&ensp;<span style="font-size: 12px;"  class="text-secondary  font-weight-lighter">
                  <i class="fa fa-globe" aria-hidden="true"></i> {{post.category}}</span>  </router-link></b>

                      <span class="dropdown p-0" v-if="post.user_id==profile[0].id">
                          <button @click="editPost(post)" class="btn float-right text-secondary " id="my-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
                          <span class="dropdown-menu shadow-sm p-0 " aria-labelledby="my-dropdown">
                              <a @click="deletePost(post.id)" class="dropdown-item   border-bottom py-2" ><i  class="fa fa-trash text-secondary" aria-hidden="true"></i> Delete</a>
                              <router-link :to="`/editpost/${post.id}`" class="dropdown-item border-bottom py-2 " ><i  class="fa fa-edit text-secondary" aria-hidden="true"></i> Edit </router-link>
                          </span>
                      </span>


                      <small style="font-size: 9px;line-height: 0;margin-left: 11%;" class="font-weight-lighter d-block font-italic">{{ timer(post.created_at)}}</small>
                  </h6>

                   </div>
                   <div class="card-body p-2 postMsg">
                       <p class="card-text mt-1 ">
                           <truncate collapsed-text-class="collapsed " action-class="customClass font-weight-bold " clamp="Show more" :length="100" less="...hide some"
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
                       <small v-if="post.comments != ''">{{post.comments.length}} Comments</small>
                       <router-link :to="`/reactions/${post.id}`" v-if="post.likes != '' || post.loves != '' "    class="float-right text-muted" style="cursor:pointer;opacity: 70%;">
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
                           <button title="like" @click="likePost(post.id)" id="likeBtn" class="btn mx-md-2 mx-3 mx-lg-4  mx-sm-5  btn-sm"  style="color:grey; opacity:65%;">
                              <i class="fa fa-thumbs-up text-primary" aria-hidden="true">
                                 <span v-if="post.id==liked.post_id && liked.user_id==profile[0].id" v-for="liked in post.likes" :key="liked.id">
                                      <small class="font-weight-bold" style="font-size: 10px;"> liked</small>
                                 </span>
                              </i>

                           </button>
                           <button title="love" @click="lovePost(post.id)" id="loveBtn" class="btn  mx-md-2 mx-3 mx-lg-4  mx-sm-5 btn-sm" style="color:grey; opacity:65%" >
                              <i  class="fa fa-heart text-danger" aria-hidden="true">
                               <span v-if="post.id==loved.post_id && loved.user_id==profile[0].id" v-for="loved in post.loves" :key="loved.id">
                                      <small class="font-weight-lighter" style="font-size: 10px;"> loved</small>
                                </span>
                              </i>
                          </button>
                          <button @click="deleteLikeLove(post.id)" title="dislike/unlove" class="btn btn-sm  mx-md-2 mx-3 mx-sm-5" style="color:grey; opacity:65%"><i class="fa fa-thumbs-down" aria-hidden="true"></i></button>
                           <button title="comment" class="btn btn-sm  mx-md-2  mx-lg-4  mx-3 mx-sm-5"  :data-target="`#my-${post.id}`" style="color:grey; opacity:70%" data-toggle="collapse" aria-expanded="false" aria-controls="my-collapse"><i class="fa fa-comments-o" aria-hidden="true"></i></button>
                            <div :id="`my-${post.id}`" @click="getComment(post.id)" class="collapse text-justify">
                                  <div class="title border-top pt-2">
                                      <h6>Comment</h6>
                                              <div class="commnetBox p-2">
                                          <form @submit.prevent="postComment(post.id)">
                                              <div class="row">
                                              <div class="form-group w-100 pl-2 p-2  border-bottom">
                                                  <router-link  :to="`/profile/${profile[0].name}`" class=""><img id="commentImg" :src="`${baseUrl}/storage/${profile[0].profiles.photo ||'../../images/avater.png'}`" alt=""  style="width:29px !important;height:29px !important;" > </router-link>
                                                <textarea v-model="comment.commentText" class="bg-white  p-3 shadow-sm "
                                                style="background: whitesmoke;margin-bottom: -10px !important;max-height: 100px;border-radius:10px !important"  rows="2" placeholder="write your comment... " ref="commentBox"></textarea>
                                                <button class="btn p-1 position-relative text-primary btn-sm" type="submit" style="left: -50px; z-index: 0;"><i class="fa fa-send" style="font-size: 17px;"></i></button>
                                                <input  accept="image/*"  @change="previewImage(post.id)"  ref="commentBoxImg"
                                                class="input-file-image shadow-sm border-primary border"
                                                type="file"  style="margin-bottom: -10px !important;margin-left: -48px; height: 20px !important;width: 20px !important;"    />
                                              </div>
                                          </div>
                                          </form>

                                         <div class="row p-0" v-for="comments in getComments" :key="comments.id" v-if="post.id==comments.post_id">
                                               <div class="col-2 pr-0">
                                                  <router-link  :to="`/profile/${comments.user.name}`" class=""><img id="commentImg" class="float-right" :src="`${baseUrl}/storage/${comments.user.profiles.photo ||'../../images/avater.png'}`" alt=""  style="width:29px !important;height:29px !important;" > </router-link>
                                               </div>
                                               <div class="col-10 "   >
                                                   <div style="width: fit-content;max-width: 100%;" class="rounded-lg shadow-sm comment commentMsg pl-1 pr-3 py-2 ">
                                                       <small> <router-link  :to="`/profile/${comments.user.name}`">{{comments.user.profiles.first_name}} {{comments.user.profiles.last_name}}</router-link></small> <br>
                                                       <truncate v-if="comments.comment != null" collapsed-text-class="collapsed truncate" action-class="customClass font-weight-bold" clamp="Show more" :length="100" less="Show less" :text="`${comments.comment}`">
                                                      </truncate>

                                                      <a :class="`${(comments.picture ==null) ? 'd-none' : ''}`"  :href="`${baseUrl}/storage/${comments.picture}`"   v-if="comments.picture !='' || comments.picture !=null"><img id="getCommentImg" class="border" style="width: 80px !important; border-radius: 10px;" v-if="comments.picture !=''" :src="`${baseUrl}/storage/${comments.picture}`" alt=""></a> <br>
                                                      <small style="font-size: 9px;" class="font-weight-lighter font-italic p-0">{{ timer(comments.created_at)}}</small>
                                                      <div class="reply p-1" >
                                                          <button @click="deleteComment(comments.id)" class="btn p-1 mx-0  btn-sm " style="color:lightgray;"  title="delete" v-if="comments.user_id==profile[0].id"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                          <router-link :to="`/editcomment/${comments.id}`"  class="btn p-1 mx-0   btn-sm" style="color:lightgray;"  title="edit" v-if="comments.user_id==profile[0].id"><i class="fa fa-pencil" aria-hidden="true"></i></router-link>

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
                    </div>
                </div>
            </div>
        </div>




    </div>
</template>

<script>
     import VueCountryCode from "vue-country-code";
    import moment from 'moment';
    import truncate from 'vue-truncate-collapsed';

    export default {
            data: () => ({
            country: '',
            region: ''
            })
            ,
        components: {
            truncate,
            moment,
            VueCountryCode,
        },
        data() {
            return {
                regionNames:'',
                id:'',
                follows:{},
                authUser: {},
                profile: {},
                friendData: [],
                friendslist: {},
                imageData: "",
                profileData: {
                    first_name: '',
                    last_name: '',
                    phone: '',
                    dob: '',
                    gender: '',
                    field: '',
                    photo: '',
                    website: '',
                    status: '',
                    country: '',
                    city: '',
                },
                baseUrl: 'http://localhost:8000',
                status: {},
                friendsLists: {},
                posts: {},
                editCommentData:{
                    comment:'',
                    picture:'',
                },
                editPostData:{
                    body: '',
                    picture: '',
                    category: '',
                },
                Categories: {
                    Android: {},
                    FrontEnd: {},
                    BackEnd: {},
                    UIUX: {},
                    Others: {},
                },
                getPost: {
                    body: '',
                    picture: '',
                    category: '',
                },
                getLike:{},
                getComments:[],
                getLove:{},
                postsLike:'',
                postsComment:'',
                postsLove:'',
                postedIid:'',
                comment:{
                    commentText:'',
                    commentImg:'',
                },
                friendname:'',
                getSubmit:''
            };
        },
        mounted() {
            axios.get(`${this.$baseUrl}/friendslist`).then((respond) => {
                this.friendsLists = respond.data
            })
            axios.get(`${this.$baseUrl}/userinfo`).then((res) => {
                this.authUser = res.data
            })
            axios.get(`${this.$baseUrl}/profile`).then((result) => {
                this.profile = result.data;
                this.id = this.profile[0].id
            });

            axios.get(`${this.$baseUrl}/profile/` + this.$route.params.name).then((result) => {
                this.friendslist = result.data;
                this.friendname=this.friendslist[0].name
                axios.get(`${this.$baseUrl}/post/`+  result.data[0].id).then((res) => {
                this.posts = res.data
            })
            axios.get(`${this.$baseUrl}/follow`).then(response => {
                    this.follows = response.data;
            })

            });
            axios.get(`${this.$baseUrl}/comment`).then((res) => {
                this.getComments = res.data
             });

        },
        methods: {
            refresh()
            {
                axios.get(`${this.$baseUrl}/friendslist`).then((respond) => {
                this.friendsLists = respond.data
            })
            axios.get(`${this.$baseUrl}/userinfo`).then((res) => {
                this.authUser = res.data
            })
            axios.get(`${this.$baseUrl}/profile`).then((result) => {
                this.profile = result.data;
                this.id = this.profile[0].id
            });

            axios.get(`${this.$baseUrl}/profile/` + this.$route.params.name).then((result) => {
                this.friendslist = result.data;
                this.friendname=this.friendslist[0].name
                axios.get(`${this.$baseUrl}/post/`+  result.data[0].id).then((res) => {
                this.posts = res.data
                axios.get(`${this.$baseUrl}/following/`+ result.data[0].id).then(response => {
                    this.following = response.data;
               });
                axios.get(`${this.$baseUrl}/followers/`+ result.data[0].id).then(response => {
                    this.followers = response.data;
               })
                axios.get(`${this.$baseUrl}/follow/`+ result.data[0].id).then(response => {
                    this.status = response.data;
                });

            })
            axios.get(`${this.$baseUrl}/follow`).then(response => {
                    this.follows = response.data;
            })

            });
            axios.get(`${this.$baseUrl}/comment`).then((res) => {
                this.getComments = res.data
             });

            },
            selectcountry(country)
            {
                this.regionNames=country
                this.profileData.country=country
            },
            selectregion(region)
            {
                this.profileData.city=region
            },
            onSelect({name, iso2, dialCode}) {
                this.dialCode=`+${dialCode}`;
          },
            followUser(id)
              {
                 axios.post(`${this.$baseUrl}/follow`,
                 { 'friend_id':id,
                        'user_id':this.authUser.id,
                 }
                 )
                 .then(response=>{
                     this.refresh()
                     let audio=new Audio('http://soundbible.com/mp3/Air Plane Ding-SoundBible.com-496729130.mp3');
                    audio.play();
                })
              },
            timer(time) {
                return moment(time).fromNow();
            },
            deleteLikeLove(id)
            {
                axios.delete(`${this.$baseUrl}/like/`+id);
                axios.delete(`${this.$baseUrl}/love/`+id);
                this.refresh()
                let audio=new Audio('http://soundbible.com/mp3/light-switch-pull-chain-daniel_simon.mp3');
                    audio.play();
            },
            deletePost(id)
            {
             axios.delete(`${this.$baseUrl}/post/`+id).then((res) => {
                 this.refresh()
                let audio=new Audio('http://soundbible.com/mp3/Air Plane Ding-SoundBible.com-496729130.mp3');
                    audio.play();
            })
            },
            dob(time) {
                if (time != null)
              {
                   return moment(time).format("Do MMMM  YYYY");
              }
              else{
                  return '-------------'
              }
            },
            getData(profile) {
                this.profileData = profile;
            },

            previewImage(id) {
                let input = event.target;
                this.editPostData.picture= input.files[0];
                this.profileData.photo = input.files[0];
                this.comment.commentImg = input.files[0];
                this.getPost.picture= input.files[0];
                let reader = new FileReader();
                reader.onload = e => {
                    this.imageData = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
                this.postComment(id)
                this.refresh()
                this.editCommentData.picture= input.files[0];
                console.log(this.profileData.photo )
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
                this.comment.commentText = "";
               this.comment.commentImg = "";
                this.refresh()

            },
            triggerShow() {
                this.profileShower()
            },

            updateProfile() {
                const formData = new FormData();
                formData.append('first_name', this.profileData.first_name);
                formData.append('last_name', this.profileData.last_name);
                formData.append('code', this.dialCode);
                formData.append('phone', this.profileData.phone);
                formData.append('dob', this.profileData.dob);
                formData.append('gender', this.profileData.gender);
                formData.append('field', this.profileData.field);
                formData.append('photo', this.profileData.photo);
                formData.append('website', this.profileData.website);
                formData.append('status', this.profileData.status);
                formData.append('country',  this.profileData.country);
                formData.append('city',  this.profileData.city);
                formData.append('_method', 'PUT');
                let config = { headers: { 'Content-Type': 'multipart/form-data' } }
                let id = this.authUser.id;
                axios.post(`${this.$baseUrl}/profile/` + id, formData, config).then(response => {
                    this.refresh()
                    this.profileEditor()
                    let audio=new Audio('http://soundbible.com/mp3/Air Plane Ding-SoundBible.com-496729130.mp3');
                    audio.play();
                });
                this.getSubmit='modal'
            }
           , deleteComment(id){
                axios.delete(`${this.$baseUrl}/comment/` + id).then((res) => {
                    this.refresh()
                    let audio=new Audio('http://soundbible.com/mp3/Air Plane Ding-SoundBible.com-496729130.mp3');
                    audio.play();
               });
            },
            unfollowUser(id)
            {
                axios.delete(`${this.$baseUrl}/follow/` + id).then((res) => {
                    let audio=new Audio('http://soundbible.com/mp3/Air Plane Ding-SoundBible.com-496729130.mp3');
                    audio.play();
               });
            },
            showallReaction(id)
            {
                this.postedIid=id
                axios.get(`${this.$baseUrl}/love/` + id).then((res) => {
                this.getLove = res.data });
                axios.get(`${this.$baseUrl}/like/` + id).then((res) => {
                this.getLike = res.data });
            },
            likePost(id)
            {
                 const formData = new FormData();
                 formData.append('islike',1);
                  formData.append('post_id', id);
                 axios.post(`${this.$baseUrl}/like`, formData).then((res) => {
                     this.refresh()
                    let audio=new Audio('http://soundbible.com/mp3/light-switch-pull-chain-daniel_simon.mp3');
                    audio.play();
                })
            },
            lovePost(id)
            {
                   const formData = new FormData();
                    formData.append('islove',1);
                    formData.append('post_id', id);
                    axios.post(`${this.$baseUrl}/love`, formData).then((res) => {
                        this.refresh()
                        let audio=new Audio('http://soundbible.com/mp3/light-switch-pull-chain-daniel_simon.mp3');
                    audio.play();
                        })
            },

                showPost() {
                     const formData = new FormData();
                    formData.append('picture', this.getPost.picture);
                    formData.append('body', this.getPost.body);
                    formData.append('category', this.getPost.category);
                  let config = { headers: { 'Content-Type': 'multipart/form-data' } }
                axios.post(`${this.$baseUrl}/post`, formData,config).then((res) => {
                    this.refresh()
                    let audio=new Audio('http://soundbible.com/mp3/Air Plane Ding-SoundBible.com-496729130.mp3');
                    audio.play();
                })
                this.getSubmit='modal'

            },
        }
    }
</script>

<style  lang="scss" scoped>

textarea,textarea:focus
{
  border:1px solid rgb(192, 195, 248) !important;
}

::-webkit-scrollbar {
    display: none !important;


  }

  /* Track */
  ::-webkit-scrollbar-track {
    display: none !important;
  }



  /* Handle */
  ::-webkit-scrollbar-thumb {
    display: none !important;

  }

    .getTap:hover,.getTap:focus,  .getTap2:hover,.getTap2:focus
    {
     background: whitesmoke !important;
    }
    .Img {
        opacity: 95%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: top;
        height:220px;

        button
        { position: relative !important;
            top: 1px;
            display: block;
            opacity: 70%;
            border-radius:8px;

        }

        a {
            position: relative;
            top: 90px;
        }
    }
    .fields
    {
        h5
        {
            padding-left:  15px;
        }
        span
        {
            padding-left:  15px;
        }
    }
    .registration {
        .btn {
            border-radius: 5px;
        }
    }

    #logo {
        width: 160px;
        height: 160px;
        border-radius: 50%;
        border: 6px solid lightgrey;
    }

    #logoShow {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 7px solid lightgrey;
    }

    #preview {
        width: 250px;
        height: 40vh;
        border-radius: 7px;
        border: 6px solid lightgrey;
    }

    input:focus,
    textarea:focus,
    select:focus,
    .input-group-prepend:focus {
        outline: none !important;
        box-shadow: 1px 1px lightgrey !important;
    }

    button:focus {
        outline: none !important;
        box-shadow: none !important;
    }

    #btn {
        font-size: 23px;
        position: absolute;
        margin-top: -50px;
        margin-left: 50px;
    }

    .card-footer>.btn,
    h4 {
        color: #f5f8fa !important;
    }



    /* new */
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


      .tab-content,.createPost,.listBox{
       background: whitesmoke !important;

      }
      .postBox>form{
         overflow: scroll;
         height: 100vh;
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
    .showBox,.timlineScroll,.profileScroll {
        -ms-overflow-style: none !important;
        overflow-y: scroll;
        overflow-x: hidden;
        height: 100vh;

    }
}
@media only screen and (max-width: 767px) {

    .timlineScroll,.profileScroll
    {
        overflow: hidden !important;
    }

}


</style>
