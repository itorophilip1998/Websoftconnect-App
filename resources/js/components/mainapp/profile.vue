<template>
    <div id="home" class="px-md-5 p-3 pt-4 " >
        <div class="">
            <div class="row showProfile ">
                <div class="col-md-7  pt-md-3 col-lg-8 px-1 profileScroll   px-md-2 " >
                    <div class="row text-secondary ">
                        <div class="col-12 text-center " v-for="getInfo in friendslist" :key="getInfo.id">
                    <div id="img-modal" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="my-modal-title" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title" id="my-modal-title">Upload Profile Picture</h5>
                                    <button class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form  class="px-2">

                                <div class="modal-body " style="border:2px dashed royalblue">
                                    <div class="text-center">
                                        <label class="font-weight-bold">Choose Image......</label> <br>
                                     <input accept="image/*" @change="previewImage(getInfo.id)" ref="photo"  class=" input-file-image shadow-none border-0 d-inline"  type="file" />

                                    </div>
                                    <br />
                                    <div class="image-preview" v-if="imageData.length > 0">
                                        <img ref="imgDisplay" id="preview" class="preview" :src="imageData" />
                                    </div>
                                </div>
                                <div class="modal-footer border-0">
                                    <div v-if="loading" class="spinner-border text-primary" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <button v-if="!loading" @click="updateProfile()" type="button"
                                        class="btn shadow   btn-primary"  >
                                        Upload
                                        <i class="fa fa-upload" ></i>
                                    </button>

                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                            <div class="Img rounded-lg shadow-sm pt-2" :style="{ backgroundImage: `url(${getInfo.profiles.photo ||'../../images/bg.png'})` }">
                     <button v-if="getInfo.id == profile[0].id" type="button" data-toggle="modal" data-target="#img-modal" title="Upload Image"
                    class="btn btn-dark btn-sm ml-1"> Edit photo <i class="fa fa-camera" aria-hidden="true"></i>
                    </button>
                       <div v-if="getInfo.id == profile[0].id" type="button" data-toggle="modal" data-target="#img-modal" title="Upload Image"
                    class=" ">  &emsp;
                    </div>
                                <a :href="`${getInfo.profiles.photo ||'../../images/avater.png'}`"><img
                                        id="logoShow" class="shadow-sm"
                                        :src="`${getInfo.profiles.photo ||'../../images/avater.png'}`" /></a>

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
                        <div class="col-12 others" v-for="(profile,index) in friendslist" :key="index+10">
                            <!-- navbar -->
                            <nav class="bg-white border-left border-right" >
                                <div   class="nav nav-tabs mt-0 " id="nav-tab" role="tablist">
                                    <a  class="getTap nav-item nav-link active  px-4 " id="nav-about-tab" data-toggle="tab"
                                        href="#nav-about" role="tab" aria-controls="nav-about"
                                        aria-selected="true">
                                        <i title="about" class="d-inline d-lg-none fa fa-user" aria-hidden="true"></i>
                                        <span class="d-none d-lg-inline">About</span>
                                    </a>
                                    <a   class="getTap2 nav-item nav-link  px-4 " id="nav-photos-tab" data-toggle="tab"
                                        href="#nav-photos" role="tab" aria-controls="nav-photos"
                                        aria-selected="true">
                                        <i title="photos" class="d-inline d-lg-none fa fa-file-image-o" aria-hidden="true"></i>
                                        <span class="d-none d-lg-inline">Photos</span>

                                    </a>
                                    <router-link v-if="followData=='Unfriend'" :to="`/chat/${profile.name}`" class="getTap2 nav-item nav-link btn text-primary   px-4 " id="nav-timeline-tab" data-toggle="tab"
                                        role="tab" aria-controls="nav-timeline" >
                                        <i title="chat" class="d-inline d-lg-none fa fa-comments" aria-hidden="true"></i>
                                        <span class="d-none d-lg-inline">Chat</span>

                                    </router-link>
                                    <router-link to="/home" class="getTap2 nav-item text-capitalize nav-link btn text-primary   px-4" id="nav-timeline-tab" data-toggle="tab"
                                        role="tab" aria-controls="nav-timeline" >
                                        <i title="home" class="d-inline d-lg-none fa fa-home" aria-hidden="true"></i>
                                        <span class="d-none d-lg-inline">Home</span>
                                    </router-link>


                                        <button v-if="profile.id != authUser.id" @click="followToggle(profile.id)" class="getTap2 px-3 nav-item nav-link text-primary  px-md-4">
                                          <i title='Unfriend' v-if="followData=='Unfriend'" class="fa fa-user-circle d-inline d-lg-none " aria-hidden="true"></i>
                                          <i title='Requested' v-if="followData=='Requested'" class="fa fa-user-times d-inline d-lg-none " aria-hidden="true"></i>
                                          <i title='Request' v-if="followData=='Request'" class="fa fa-user-plus d-inline d-lg-none " aria-hidden="true"></i>
                                          <i title='Accept' v-if="followData=='Accept request'" class="fa fa-mars-stroke  d-inline d-lg-none " aria-hidden="true"></i>
                                         <span class="d-none d-lg-inline">
                                           {{ followData }}
                                        </span>


                                        </button>
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
                                                @onSelect="onSelect" class="form-control custom-select"
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
                                                    <input type="date" class="form-control col-sm-8 col-lg-8 " v-model="profileData.dob">
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
                                                        class="form-control col-sm-8 col-lg-8  custom-select d-block ">
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
                                                data-target="#my-field-me" data-toggle="collapse" title="edit"
                                                class="fa fa-pencil text-muted btn-sm btn"></i>
                                            <div id="my-field-me" class="collapse">
                                                <form v-on:submit.prevent="updateProfile">
                                                    <select v-model="profileData.field" id="my-select"
                                                        class=" form-control col-sm-8 col-lg-8 d-block  custom-select">
                                                        <option >Android</option>
                                                        <option>BackEnd</option>
                                                        <option>FrontEnd</option>
                                                        <option>UI/UX</option>
                                                        <option>Others</option>
                                                    </select>
                                                    <button data-target="#my-field-me" data-toggle="collapse" type="submit"
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
                                                    <input type="text" class="form-control col-sm-8 col-lg-8 "
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
                                                    <country-select v-model="country" :countryName='countryName'  @input="selectcountry(country)" class="custom-select d-block  form-control col-sm-8 col-lg-8 " :country="country" topCountry="NG" />
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
                                                    <region-select v-model="region" class="form-control custom-select d-block  col-sm-8 col-lg-8 " :regionName="regionName" :defaultRegion='regionNames' :countryName='countryName' @input="selectregion(region)" :country="country"  :region="region" />
                                                    <button data-target="#my-city" data-toggle="collapse"
                                                        type="submit"
                                                        class="btn-sm btn btn-primary mt-1">update</button>
                                                </form>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <div class="tab-pane fade show  shadow-sm pt-2 text-center" id="nav-photos" role="tabpanel"
                                aria-labelledby="nav-photos-tab" style="background: white !important;">
                                <div class="row  " >
                                    <div  class="col-md-4 zoom col-xl-3 col-sm-4 col-6 p-2" v-for="(photo, index) in photos" :key="index">
                                            <a :href="photo.photo_name" style="cursor:default;" > <img  class=" shadow rounded-lg" :src="photo.photo_name" style="width:100%;height: 200px;" alt=""></a>
                                    </div>
                                </div>

                            </div>

                            </div>

                        </div>

                    </div>
                </div>
                <div class='col-md-5 col-lg-4 p-0 py-3 timlineScroll px-md-2'>
                    <div class="tab-pane fade show active " id="list-all" role="tabpanel" aria-labelledby="list-all-list">
                        <!-- show all -->
              <div class="post pt-md-3 rounded-lg bg-primary shadow-sm p-1 text-center"><h6 class="text-white  text-capitalize font-weight-bold">{{friendname}}'s Posts <i class="fa fa-newspaper-o" aria-hidden="true"></i></h6></div>

              <div class="text-center" v-if="posts==''">
                <i class="text-secondary fa fa-newspaper fa-5x"></i>
            <h1 class="text-secondary">No Post Found <br> </h1>
            <small class="text-muted">be the first to Post</small>
            </div>
              <div class="show-all" v-for="post in posts" :key="post.id">

               <div class="card shadow-sm mt-3 p-2 text-secondary">
                   <div class="ml-2">
                       <h6><router-link  :to="`/profile/${post.user.name}`"><img id="logo"  :class="`${(post.isOnline) ? 'border-info' : 'border-1'}`"  :src="`${post.user.profiles.photo ||'../../images/avater.png'}`" alt=""></router-link>
                      <b> <router-link :to="`/profile/${post.user.name}`" class="">{{post.user.profiles.first_name}} {{post.user.profiles.last_name}}&ensp;<span style="font-size: 12px;"  class="text-secondary  font-weight-lighter">
                  <i class="fa fa-globe" aria-hidden="true"></i> {{post.category}}</span>  </router-link></b>

                      <span class="dropdown p-0" v-if="post.user_id==friendslist[0].id">
                          <button @click="editPost(post)" class="btn float-right text-secondary " id="my-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
                          <span class="dropdown-menu shadow-sm p-0 " aria-labelledby="my-dropdown">
                               <a  v-if="post.user_id != friendslist[0].id" class="dropdown-item   border-bottom py-2"   ><i  class="fa fa-user-times  text-secondary" aria-hidden="true"></i> Block this User</a>
                <a  v-if="post.user_id == friendslist[0].id" @click="deletePost(post)" class="dropdown-item   border-bottom py-2"    ><i  class="fa fa-trash text-secondary" aria-hidden="true"></i> Delete</a>
                <a v-if="post.picture" :href="`${post.picture}`" class="dropdown-item   border-bottom py-2" download="" ><i  class="fa fa-download text-secondary" aria-hidden="true"></i> Download Image</a>
                <router-link v-if="post.user_id == friendslist[0].id" :to="`/editpost/${post.id}`" class="dropdown-item border-bottom py-2 "   ><i  class="fa fa-edit text-secondary" aria-hidden="true"></i> Edit </router-link>
                <a  v-if="post.user_id != friendslist[0].id" class="dropdown-item   border-bottom py-2"   ><i  class="fa fa-times border text-secondary" aria-hidden="true"></i> Report this Post</a>
                <router-link :to="`/post/${post.id}`" class="dropdown-item border-bottom py-2 "   ><i  class="fa fa-eye text-secondary" aria-hidden="true"></i> View </router-link>

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
                    <!-- only one image -->
                    <div v-if="post.picture.length ==1" class="p-0">
                      <div v-for="item in  post.picture"  class="p-0" :key="item.id">
                        <a :href="`${item}`" ><img class="rounded-lg postImg  " :src="`${item}`"  alt=""></a>
                     </div >
                    </div >

                        <!--two images -->
                    <div v-if="post.picture.length ==2" class="row  m-0 p-0">
                      <div v-for="(item,id) in  post.picture"  class="col-6 " style="padding:1px" :key="id">
                        <a :href="`${item}`"><img class="postImg border rounded-lg"  :src="`${item}`"  alt=""></a>
                     </div>
                   </div>
                        <!--three images -->
                    <div v-if="post.picture.length ==3"  class="row  m-0 p-0  " >
                      <div  class="col-6 " style="padding:1px">
                        <div class="row " >
                            <div class="col-12">
                              <a :href="`${post.picture[0]}`" ><img class="rounded-lg border postImg "  :src="`${post.picture[0]}`"  alt=""></a>
                            </div>
                            <div class="col-12 mt-1">
                              <a :href="`${post.picture[1]}`" ><img class="rounded-lg border postImg "  :src="`${post.picture[1]}`"  alt=""></a>
                            </div>
                        </div>
                     </div>
                     <div class="col-6 m-auto">
                        <a :href="`${post.picture[2]}`" ><img class="rounded-lg border postImg  "  :src="`${post.picture[2]}`"  alt=""></a>
                     </div>
                   </div>

                     <!--four images -->
                     <div v-if="post.picture.length ==4"  class="row  m-0 p-0  " >
                        <div  class="col-6 " style="padding:1px">
                          <div class="row " >
                              <div class="col-12">
                                <a :href="`${post.picture[0]}`" ><img class="rounded-lg border  w-100"  :src="`${post.picture[0]}`"  alt=""></a>
                              </div>
                              <div class="col-12 mt-1">
                                <a :href="`${post.picture[1]}`" ><img class="rounded-lg border w-100 "  :src="`${post.picture[1]}`"  alt=""></a>
                              </div>
                          </div>
                       </div>
                       <div  class="col-6 " style="padding:1px">
                        <div class="row " >
                            <div class="col-12">
                              <a :href="`${post.picture[2]}`" ><img class="rounded-lg border w-100 "  :src="`${post.picture[2]}`"  alt=""></a>
                            </div>
                            <div class="col-12 mt-1">
                              <a :href="`${post.picture[3]}`" ><img class="rounded-lg border postImg "  :src="`${post.picture[3]}`"  alt=""></a>
                            </div>
                        </div>
                     </div>

                     </div>

                        <!--five images and above -->
                        <div v-if="post.picture.length >= 5"  class="row  m-0 p-0  " >
                            <div  class="col-6 " style="padding:1px">
                              <div class="row " >
                                  <div class="col-12">
                                    <a :href="`${post.picture[0]}`" ><img class="rounded-lg border postImg"  :src="`${post.picture[0]}`"  alt=""></a>
                                  </div>
                                  <div class="col-12 mt-1">
                                    <a :href="`${post.picture[1]}`" ><img class="rounded-lg border postImg "  :src="`${post.picture[1]}`"  alt=""></a>
                                  </div>
                              </div>
                           </div>
                           <div  class="col-6 " style="padding:1px">
                            <div class="row " >
                                <div class="col-12">
                                  <a :href="`${post.picture[2]}`" ><img class="rounded-lg border postImg"  :src="`${post.picture[2]}`"  alt=""></a>
                                </div>
                                <div class="col-12 mt-1">
                                  <a :href="`/post/${post.id}`" >
                                      <div class="myOverlay  h-100 rounded-lg" style="background: rgba(0,0,0,0.4);position: absolute;width:83%;">
                                        <h2 class="text-white " style="margin: 50% auto;">
                                                +{{ post.picture.length -3}}
                                        </h2>
                                      </div>
                                        <img class="rounded-lg border postImg "  :src="`${post.picture[3]}`"  alt="">
                                    </a>
                                </div>
                            </div>
                         </div>

                         </div>


           </div>
         </div>


                   </div>
                  <div>
                       <small v-if="post.comments != ''">{{post.comments.length}} Comments</small>
                       <router-link :to="`/reactions/${post.id}`" v-if="post.likes != '' || post.loves != '' "    class="float-right text-muted" style="cursor:pointer;opacity: 70%;">
                               <!-- auth -->
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
                           <button data-title="like" @click="likePost(post.id)" id="likeBtn" class="btn mx-md-2 mx-3 mx-lg-4  mx-sm-5  btn-sm"  style="color:grey; opacity:65%;">
                              <i class="fa fa-thumbs-up text-primary" aria-hidden="true">
                                 <span v-if="post.id==liked.post_id && liked.user_id==profile[0].id" v-for="liked in post.likes" :key="liked.id">
                                      <small class="font-weight-bold" style="font-size: 10px;"> liked</small>
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

                           <button data-title="comment" class="btn btn-sm  mx-md-2  mx-lg-4  mx-3 mx-sm-5"  :data-target="`#my-${post.id}`" style="color:grey; opacity:70%" data-toggle="collapse" aria-expanded="false" aria-controls="my-collapse"><i class="fa fa-comments-o" aria-hidden="true"></i></button>
                            <div :id="`my-${post.id}`"  class="collapse text-justify">
                                  <div class="title border-top pt-2">
                                      <h6>Comment</h6>
                                              <div class="commnetBox p-2">
                                          <form @submit.prevent="postComment(post.id)">
                                              <div class="row">
                                              <div class="form-group w-100 pl-2 p-2  border-bottom">
                                                  <router-link  :to="`/profile/${profile[0].name}`" class="">
                                                  <img id="commentImg" :src="`${profile[0].profiles.photo ||'../../images/avater.png'}`" alt=""  style="width:29px !important;height:29px !important;" > </router-link>
                                                <textarea @input="inpuTQuerry(`id_${post.id}`)" v-model="comment.commentText" class="bg-white  p-3 shadow-sm "
                                                style="background: whitesmoke;margin-bottom: -10px !important;max-height: 100px;border-radius:10px !important"  rows="2" placeholder="comment here..." ref="commentBox"></textarea>

                                                    <button v-if="comment.commentText && inputMe" class="btn p-1 position-relative  text-primary btn-sm" type="submit" style="z-index: 0;margin: 0 0 0 -40px;"><i class="fa fa-send" style="font-size: 17px;"></i></button>

                                  <input  accept="image/*"  :id="`id_${post.id}`"  @change="commentImgs(post.id)"  ref="commentBoxImg"
                                  class="input-file-image position-relative    shadow-sm border-primary border"
                                  type="file"  style=" height: 20px !important;width: 20px !important;z-index: 0;margin: -30px 0 10px 180px;"    />
                                              </div>
                                          </div>
                                          </form>

                                         <div class="row p-0 mt-2" v-for="comments in getComments" :key="comments.id" v-if="post.id==comments.post_id">
                                               <div class="col-2 pr-0">
                                                  <router-link  :to="`/profile/${comments.user.name}`" class="">
                                                  <img id="commentImg" class="float-right" :src="`${comments.user.profiles.photo ||'../../images/avater.png'}`" alt=""  style="width:29px !important;height:29px !important;" > </router-link>
                                               </div>
                                               <div class="col-10 "   >
                                                   <div  @mouseover="commentor(comments.id)" @mouseout="removeCommentor(comments.id)" style="width: fit-content;max-width: 100%;border-radius:15px !important" class="rounded-lg shadow-sm border comment commentMsg p-2">
                                                       <small> <router-link  :to="`/profile/${comments.user.name}`"> <b>{{comments.user.profiles.first_name}} {{comments.user.profiles.last_name}}</b> </router-link></small> <br>
                                                       <truncate v-if="comments.comment != null" collapsed-text-class="collapsed truncate" action-class="customClass font-weight-bold" clamp="Show more" :length="100" less="Show less" :text="`${comments.comment}`">
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
                    </div>
                </div>
            </div>
        </div>




    </div>
</template>

<script>
    import moment from 'moment';
    import VueCountryCode from 'vue-country-code';
    import truncate from 'vue-truncate-collapsed';
    export default {
        components: {
            truncate,
            moment,
            VueCountryCode,
        },
        data() {
            return {
                inputMe:false,
                 loading:false,
                country: '',
                  region: '',
                regionName:true,
                countryName:true,
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
                photos:[],
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
                getSubmit:'',
                followData:''

            };
        },
        mounted() {
            this.refresh()

              Echo.private(`notification`)
             .listen('Notification',(e)=>{
              this.refresh()
             })

        },
        methods: {
            commentor(id){
              let data=`bg-${id}`
              document.getElementById(data).style.display="block"
            },
            removeCommentor(id){
              let data=`bg-${id}`
              document.getElementById(data).style.display="none"
            },
            commentImgs(id) {
                let input = event.target;
                this.comment.commentText=''
                this.comment.commentImg = input.files[0];

                let reader = new FileReader();
                reader.onload = e => {
                    this.imageData = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
                this.postComment(id)
            },

            inpuTQuerry(id)
            {
                if (this.comment.commentText != '') {
                  document.getElementById(id).style.display='none'
                  this.inputMe=true;

                }
                else{
                  document.getElementById(id).style.display='block'
                  this.inputMe=false;
                }

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
            followToggle(id)
            {
              axios.post(`${this.$baseUrl}/freinds`,{id}).then((res) => {
                 if (res.data.message=='requested') {
                            this.followData="Requested"
                        }
                        else if(res.data.message=='No request'){
                            this.followData="Request"
                        }
                        else if(res.data.message=='friend') {
                        this.followData="Unfriend"
                       }
              })
            },
         refresh()
            {
                try {
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

                axios.get(`${this.$baseUrl}/freinds/${result.data[0].id}`).then((res) => {
                        if (res.data.message=='requested') {
                            this.followData="Requested"
                        }
                        else if(res.data.message=='No request'){
                            this.followData="Request"
                        }
                        else if(res.data.message=='friend') {
                        this.followData="Unfriend"
                       }
                        else if(res.data.message=='accept') {
                        this.followData="Accept request"
                       }
              })
                 axios.get(`${this.$baseUrl}/photos/${result.data[0].id}`).then((respond) => {
                 this.photos = respond.data

            })
                axios.get(`${this.$baseUrl}/post/`+  result.data[0].id).then((res) => {
                this.posts = res.data
            })

            });
            axios.get(`${this.$baseUrl}/comment`).then((res) => {
                this.getComments = res.data
             });
              } catch (error) {
                      console.log(error)
                }
            },
            selectcountry(country)
            {
                try {
                    this.regionNames=country
                    this.profileData.country=country
                } catch (error) {
                    console.log(error)

                }
            },
            selectregion(region)
            {
               try {
                this.profileData.city=region
               } catch (error) {
                console.log(error)

               }
            },
            onSelect({name, iso2, dialCode}) {
               try {
                this.dialCode=`+${dialCode}`;
               } catch (error) {
                    console.log(error)
               }
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
            deletePost(data)
            {
             axios.post(`${this.$baseUrl}/deletePost`,data).then((res) => {
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
                document.getElementById(`id_${id}`).style.display='block'
                    this.inputMe=false;
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
                let close=document.getElementsByClassName('modal-backdrop')[0];
               let modal=document.getElementById('img-modal');
               let body=document.getElementsByTagName('body')[0];


                this.loading=true
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
                    let audio=new Audio('http://soundbible.com/mp3/Air Plane Ding-SoundBible.com-496729130.mp3');
                    audio.play();
                this.loading=false
                close.style.display="none"
               modal.style.display="none"
               body.classList.remove('modal-open')
                }).catch((error)=>{
                this.loading=false
                close.style.display="none"
               modal.style.display="none"
               body.classList.remove('modal-open')
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
#home{
    background:rgb(223 225 226) !important;
}
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
        height: 90vh;
    }
}
@media only screen and (max-width: 767px) {
.showProfile{
 overflow-y: scroll;
        overflow-x: hidden;
        height: 100vh;
        padding-bottom:40px !important;
}
    .timlineScroll,.profileScroll
    {
        overflow: hidden !important;
    }

}

.commentMsg:hover,.postMsg:hover
    {
        background: whitesmoke;
    }
</style>
