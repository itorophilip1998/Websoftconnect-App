
<template>
<div>

	<div class="container-contact100">
		<div class="wrap-contact100">
			<div class="contact100-form validate-form">
				<span class="contact100-form-title text-primary">
					Contact Us <i class="fa fa-phone" aria-hidden="true"></i>
				</span>

				<label class="label-input100" for="first-name">Tell us your name <span class="text-danger">*</span></label>
				<div class="wrap-input100 rounded-lg shadow rs1-wrap-input100 validate-input" data-validate="Type first name">
					<input id="first-name" class="input100" type="text" v-model="data.first_name" placeholder="First name">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 shadow rounded-lg rs2-wrap-input100 validate-input" data-validate="Type last name">
					<input class="input100" type="text"  v-model="data.last_name" placeholder="Last name">
					<span class="focus-input100"></span>
				</div>

				<label class="label-input100" for="email">Enter your email <span class="text-danger">*</span></label>
				<div class="wrap-input100 shadow rounded-lg validate-input" data-validate = "Valid email is required: ex@abc.xyz">
					<input id="email" class="input100" type="text"  v-model="data.email" placeholder="Eg. example@email.com">
					<span class="focus-input100"></span>
				</div>

				<label class="label-input100 " for="phone">Enter phone number</label>
				<div class="wrap-input100 shadow rounded-lg">
					<input id="phone" class="input100" type="text"  v-model="data.phone" placeholder="Eg. +1 800 000000">
					<span class="focus-input100"></span>
				</div>

				<label class="label-input100" for="message">Message <span class="text-danger">*</span></label>
				<div class="wrap-input100 shadow validate-input" data-validate = "Message is required">
					<textarea id="message" class="input100"  v-model="data.message" placeholder="Write us a message"></textarea>
					<span class="focus-input100"></span>
				</div>

				<div class="container-contact100-form-btn">
					<button type="button"  @click="contactus"   class="contact100-form-btn bg-primary shadow rounded-lg w-100">
						Send Message
					</button>
				</div>
			</div>

			<div class="contact100-more flex-col-c-m bg10" style='z-index:00 !important' >
                <span class="contact100-form-title block text-white">
					About Us <i class="fa fa-user" aria-hidden="true"></i>
				</span>
             <div class="flex-col size2">
						<span class="txt1 p-b-20">
							Our Mission
						</span>
                    </div>
                    <span class="txt2">
                           Our mission is to create and develop young
                           developers with our own ideas and experience
                           in tech by sharing problems and also giving the solution.
						</span>
				<div class="flex-w size1 p-b-47">
					<div class="txt1 p-r-25">
						<span class="lnr fa fa-user"></span>
					</div>

					<div class="flex-col size2">
						<span class="txt1 p-b-20">
							Developer
						</span>

						<span class="txt2">
                            Design and developed by <br> <b>Itoro Emmanuel Philip</b>,
                           <br> Fullstack Developer, Work @ Stathub Innovation hub
						</span>
					</div>
				</div>

				<div class="dis-flex size1 p-b-47">
					<div class="txt1 p-r-25">
						<span class="lnr fa fa-phone"></span>
					</div>

					<div class="flex-col size2">
						<span class="txt1 p-b-20">
							Lets Talk
						</span>

						<span class="txt3  text-info">
						  <a href="https://github.com/itorophilip1998"><i class="fa fa-github fa-2x" aria-hidden="true"></i> </a>
						  <a href="https://web.facebook.com/itoro.philip.148/"><i class="fa fa-facebook fa-2x" aria-hidden="true"></i></a>
						  <a href="https://www.linkedin.com/in/itoro-philip-b40a29196/"><i class="fa fa-linkedin fa-2x" aria-hidden="true"></i></a>
						 <a href="https://twitter.com/philip_itoro"><i class="fa fa-twitter fa-2x" aria-hidden="true"></i></a>
						</span>
					</div>
				</div>

				<div class="dis-flex size1 p-b-47">
					<div class="txt1 p-r-25">
                        <span class="lnr fa fa-shopping-bag"></span>

					</div>

					<div class="flex-col size2">
						<span class="txt1 p-b-20">
							General / Company Support
						</span>

						<span class="txt3">
						  <a href="emailto:https://websoftcompanyLtd@gmail.com" class="fa fa-envelope" aria-hidden="true"> websoftcompanyLtd@gmail.com</a>
						</span>
					</div>


				</div>
			</div>
		</div>
	</div>



	<div id="dropDownSelect1"></div>
            <FlashMessage   position="right bottom"  ></FlashMessage>

</div>
</template>

<script>
export default {
data() {
    return {
       data:{
        first_name:'',
        last_name:'',
        email:'',
        message:'',
        phone:'',
       }
    }
},
methods: {
  playSound1()
            {
               let audio=new Audio('http://soundbible.com/mp3/Air Plane Ding-SoundBible.com-496729130.mp3');
                    audio.play();
            },
   contactus(){
      const data={
        'first_name':this.data.first_name,
        'last_name':this.data.last_name,
        'email':this.data.email,
        'message':this.data.message,
        'phone':this.data.phone
       }
   axios.post(`${this.$baseUrl}/contactus`,data).then((res)=>{
       this.contactus=res.data
           this.playSound1();
       this.flashMessage.success({
                    html:  `<span class="p-2" style="border-left:5px solid grey;color:whitesmoke">Updated Successfully!
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

   }
},

}

</script>

<style lang="scss" scoped>
.text-info
{
    .fa
    {
        margin:6px;
        font-size:20px !important;
    }
}
	/* @import "./vendor/bootstrap/css/bootstrap.min.css"; */
    /* @import "./fonts/font-awesome-4.7.0/css/font-awesome.min.css"; */
    @import "./fonts/Linearicons-Free-v1.0.0/icon-font.min.css";
    @import "./vendor/animate/animate.css";
    @import "./vendor/css-hamburgers/hamburgers.min.css";
    @import "./vendor/animsition/css/animsition.min.css";
    @import "./vendor/select2/select2.min.css";
    @import "./vendor/daterangepicker/daterangepicker.css";
    @import "./css/util.css";
    @import "./css/main.css";

    .bg10{
        background-image: url(./images/bg-01.jpg);

    }
</style>
