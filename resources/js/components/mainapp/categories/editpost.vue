<template>
    <div class="p-md-5 text-dark">
            <!-- Edit Post -->
               <div class="Edit">
                     <h2 >Edit Post <i class="fa fa-edit"></i></h2>
                            <form v-on:submit.prevent="updatePost(post[0].id)">
                            <div class="">
                                <label for="Categories">Choose Category:</label> <br>
                                <select ref="postCategory" v-model="post[0].category"  id="my-select" class="custom-select shadow-em" aria-placeholder="">
                                    <option> <span class="text-danger">*{{post[0].category}}*</span></option>
                                    <option>Andriod</option>
                                    <option>BackEnd</option>
                                    <option>FrontEnd</option>
                                    <option>UI/UX</option>
                                    <option>Others</option>
                                  </select>
                                  <br><br>

                                  <textarea v-model="post[0].body"  id="my-textarea" placeholder="Edit Your Post"  class="shadow-em form-control"   rows="5" ref="postBody"></textarea>
                                    <br>
                                    <span>Choose File</span>
                                    <input accept="image/*" @change="previewImage" ref="postImg"  class="form-control input-file-image shadow-sm"  type="file" /> <br>
                                    <div  v-if="post[0].picture != '' && imageData==''">
                                        <img alt="Invalid Image Or NO Image,please input a valid Image"  ref="imgDisplay" id="preview" :src="`${baseUrl}/storage/${post[0].picture}`"  class="preview rounded-lg mb-3" />
                                    </div>
                                    <div  v-else>
                                        <img  ref="imgDisplay" id="preview"  class="preview m-auto rounded-lg mb-3" :src="imageData" />
                                    </div>
                                    <br>
                            </div>
                            <div class="modal-footer">
                                <router-link class="btn shadow" to="/home">Back</router-link>
                                <button class="btn btn-primary shadow " type="submit">Update</button>
                            </div>
                           </form>
               </div>

    </div>
</template>
<script>
export default {
    data() {
        return {
            baseUrl:'http://localhost:8000',
            post:{},
            imageData:'',
        }
    },
    mounted() {
      axios.get(`${this.$baseUrl}/post/${ this.$route.params.name}/edit`).then((res) => {
                    this.post=res.data
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
                this.post[0].picture=input.files[0]
                let reader = new FileReader();
                reader.onload = e => {
                    this.imageData = e.target.result;

                };
                reader.readAsDataURL(input.files[0]);
            },

            updatePost(id) {
                     const formData = new FormData();
                    formData.append('picture',  this.post[0].picture);
                    formData.append('body', this.post[0].body);
                    formData.append('category',  this.post[0].category);
                    formData.append('post',  id);
                    formData.append('_method', 'PUT');
                  let config = { headers: { 'Content-Type': 'multipart/form-data' } }
                axios.post(`${this.$baseUrl}/post/`+ id, formData,config).then((res) => {
                   this.playSound1()
                })
                this.post.body='';
                this.post.category='';
                this.post.picture='';
                this.$router.push('/home');
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
           width: 40%;
           margin: auto;
       }
   }
</style>

