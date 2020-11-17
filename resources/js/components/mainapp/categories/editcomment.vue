<template>
    <div class=" text-dark bg" >
        <div class="overlay p-md-5 pt-4">
              <div class="Edit bg-white rounded-lg p-md-3 " >
                     <h2 >Edit Comment <i class="fa fa-edit"></i></h2>
                            <form v-on:submit.prevent="updatePost(comment[0].post_id)">
                            <div class="">

                                  <textarea v-model="comment[0].comment"  id="my-textarea" placeholder="Edit Your Post"  class="shadow form-control"   rows="5" ref="postBody"></textarea>
                                    <br>
                                    <span>Choose File</span>
                                    <input accept="image/*" @change="previewImage" ref="postImg"  class="form-control input-file-image shadow-sm"  type="file" /> <br>


                                    <div  v-if="comment[0].picture">
                                        <img v-if="comment[0].picture" alt="No Current Image Available"    id="preview" :src="`${baseUrl}/storage/${comment[0].picture}`"  class="preview rounded-lg mb-3" />
                                    </div>
                                    <div  v-if="imageData">
                                        <img  ref="imgDisplay" id="preview"  class="preview m-auto rounded-lg mb-3" :src="imageData" />
                                    </div>
                                    <br>
                            </div>
                            <div class="modal-footer">
                              <router-link class="btn shadow" to="/home">Back</router-link>
                                <button class="btn btn-primary shadow " type="submit">Update</button>
                            </div>
                           </form>
                <FlashMessage  position="right bottom"  ></FlashMessage>

               </div>

    </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            baseUrl:'http://localhost:8000',
            comment:{},
            imageData:'',
            image:''
        }
    },
    mounted() {
      axios.get(`${this.$baseUrl}/comment/${this.$route.params.name}/edit`).then((res) => {
                    this.comment=res.data
     });
    },
    methods: {
        playSound1()
            {
               let audio=new Audio('http://soundbible.com/mp3/Air Plane Ding-SoundBible.com-496729130.mp3');
               audio.play();
            },
        previewImage() {
                let input = event.target;
                this.image=input.files[0]
                let reader = new FileReader();
                reader.onload = e => {
                    this.imageData = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            },

            updatePost(id) {
                     const formData = new FormData();
                    formData.append('picture',  this.image);
                    formData.append('comment', this.comment[0].comment);
                    formData.append('post_id',  id);
                    formData.append('_method', 'PUT');
                  let config = { headers: { 'Content-Type': 'multipart/form-data' } }
                axios.post(`${this.$baseUrl}/comment/`+ this.comment[0].id, formData,config).then((res) => {
                   this.playSound1()
                this.$router.push('/home');
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
                    html:  `<span class="p-2" style="border-left:5px solid grey;color:whitesmoke">Can't update comment, try again later
                        </span>`,
                    time: 5000,
                });
              }
        });
                this.comment.comment='';
                this.comment.picture='';
            },
    },
}
</script>
<style lang="scss" scoped>
 .preview {
        width: 200px !important;
        height: 200px !important;
        border: 5px solid silver;
    }

.Edit
{
    padding: 40px 10px;
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
   @media only screen and (min-width: 768px) {
       .Edit
       {
           width: 50%;
           margin: auto;
       }
   }
</style>

