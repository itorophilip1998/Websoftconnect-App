<template>
    <div>
        <div class="limiter">
            <div class="container-login100" style="background-image: url('../../images/bg.png');">
                <div class="wrap-login100 pt-5 pb-3">
                    <form class="login100-form validate-form"  @submit.prevent="loginUser">
                        <div class="login100-form-avatar shadow-lg">
                            <img src="../../images/avater.png" alt="AVATAR" >
                        </div>

                        <span class="login100-form-title pt-2 pb-2 text-secondary">
                            SignIn
                        </span>

                        <div class="wrap-input100 validate-input mb-2" data-validate = "Username is required">
                            <input class="input100 shadow" type="email" name="username" placeholder="Email" v-model='loginDetails.email' required >
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-envelope"></i>
                            </span>
                        </div>

                        <div class="wrap-input100 validate-input mb-2" data-validate = "Password is required">
                            <i title="Show Password" style="top:17px;position:absolute;left:90%;" @click="passwordShow()" id="passwordShowId" class="fa fa-eye text-secondary btn" aria-hidden="true"></i>
                            <i title="Hide Password" style="top:17px;position:absolute;left:90%;display:none" @click="passwordSecured()" id="passwordSecuredId" class="fa fa-eye-slash text-secondary btn" aria-hidden="true"></i>


                            <input class="input100 shadow pr-5" id='password' type="password" name="pass" placeholder="Password" v-model='loginDetails.password' required >
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock"></i>
                            </span>

                        </div>

                        <div class="container-login100-form-btn pt-2">
                            <button class="login100-form-btn shadow btn-primary" type="submit">
                                Signin
                            </button>
                        </div>

                        <div class="text-center w-full pt-2 pb-2">
                            <a href="/reset" class="txt1 text-secondary">
                                Forgot   Password?
                            </a>
                        </div>

                        <div class="text-center w-full pt-2 pb-2">
                            <a href="/register" class="txt1 text-secondary">
                                Create new account
                                <i class="fa fa-long-arrow-right"></i>
                            </a>
                        </div>
                    </form>
                    <div class="pt-4 text-center ">
                       <span class="text-secondary">OR</span>  <br>
                       <button class="btn  text-dark" @click="github()"><i class="fa shadow-sm p-3  rounded-pill  fa-github" aria-hidden="true"></i></button> &emsp;
                         <button class="btn  text-danger"><i class="fa shadow-sm p-3 rounded-pill fa-google" aria-hidden="true"></i></button>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import facebookLogin from 'facebook-login-vuejs'
 import GoogleLogin from 'vue-google-login';
 import { WebCam } from "vue-web-cam";
 import Swal from 'sweetalert2'

    export default {
    components: {
        facebookLogin,
        GoogleLogin,
          WebCam
    },
        data() {
            return {

                loginDetails: {
                    name: '',
                    email: '',
                    }
            }
        },
        methods: {
            message(place,logo,topic,btn,time){
            Swal.fire({
            position: place,
            icon: logo,
            title: topic,
            showConfirmButton: btn,
            timer: time
            })
            },
            passwordSecured()
            {
             let password=document.getElementById('password');
             let passwordSecuredId=document.getElementById('passwordSecuredId');
             let passwordShowId=document.getElementById('passwordShowId');
             passwordShowId.style.display='block'
             passwordSecuredId.style.display='none'
             password.type='password';
            },
             passwordShow(){
             let password=document.getElementById('password');
             let passwordSecuredId=document.getElementById('passwordSecuredId');
             let passwordShowId=document.getElementById('passwordShowId');
             passwordShowId.style.display='none'
             passwordSecuredId.style.display='block'
             password.type='text';
            },
   github(){
      axios.get(`${this.$baseUrl}/login/github`).then(result => {
      console.log(result.data)
    });
   },
    loginUser() {
        const data = {
            email: this.loginDetails.email,
            password: this.loginDetails.password
        }
        axios.post(`${this.$baseUrl}/login`, data).then(result => {
         this.message('top-end','success','Login Successfully!',false,1500);
          window.location='/';
        }).catch((err) => {
         this.message('top-end','info','Can`t Login, try later',false,1500);
        });
            }

        }
    }

</script>

<style scoped>


/*//////////////////////////////////////////////////////////////////
[ RESTYLE TAG ]*/

* {
	margin: 0px;
	padding: 0px;
	box-sizing: border-box;
}

body, html {
	height: 100%;
    font-family: Montserrat-Regular, sans-serif;
}

/*---------------------------------------------*/
a {
	font-family: Montserrat-Regular;
	font-size: 14px;
	line-height: 1.7;
	color: #666666;
	margin: 0px;
	transition: all 0.4s;
	-webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
}

a:focus {
	outline: none !important;
}

a:hover {
	text-decoration: none;
  color: #fff;
}

/*---------------------------------------------*/
h1,h2,h3,h4,h5,h6 {
	margin: 0px;
}

p {
	font-family: Montserrat-Regular;
	font-size: 14px;
	line-height: 1.7;
	color: #666666;
	margin: 0px;
}

ul, li {
	margin: 0px;
	list-style-type: none;
}


/*---------------------------------------------*/
input {
	outline: none;
	border: none;
}

textarea {
  outline: none;
  border: none;
}

textarea:focus, input:focus {
  border-color: transparent !important;
}

input:focus::-webkit-input-placeholder { color:transparent; }
input:focus:-moz-placeholder { color:transparent; }
input:focus::-moz-placeholder { color:transparent; }
input:focus:-ms-input-placeholder { color:transparent; }

textarea:focus::-webkit-input-placeholder { color:transparent; }
textarea:focus:-moz-placeholder { color:transparent; }
textarea:focus::-moz-placeholder { color:transparent; }
textarea:focus:-ms-input-placeholder { color:transparent; }

input::-webkit-input-placeholder { color: #999999; }
input:-moz-placeholder { color: #999999; }
input::-moz-placeholder { color: #999999; }
input:-ms-input-placeholder { color: #999999; }

textarea::-webkit-input-placeholder { color: #999999; }
textarea:-moz-placeholder { color: #999999; }
textarea::-moz-placeholder { color: #999999; }
textarea:-ms-input-placeholder { color: #999999; }

/*---------------------------------------------*/
button {
	outline: none !important;
	border: none;
}

button:hover {
	cursor: pointer;
}

iframe {
	border: none !important;
}




























/*//////////////////////////////////////////////////////////////////
[ Utility ]*/
.txt1 {
  font-family: Montserrat-Regular;
  font-size: 16px;
  color: #cccccc;
  line-height: 1.4;
}

.bo1 {
  border-bottom: 1px solid #999999;
}

.hov1:hover {
  border-color: #d33f8d;
}


/*//////////////////////////////////////////////////////////////////
[ login ]*/

.limiter {
  width: 100%;
  margin: 0 auto;
}

.container-login100 {
  width: 100%;
  min-height: 100vh;
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  padding: 15px;
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;

  position: relative;
  z-index: 1;
}

.container-login100::before {
  content: "";
  display: block;
  position: absolute;
  z-index: -1;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  background:white !important;
  opacity: 0.9;
}

.wrap-login100 {
  width: 390px;
  background: transparent;
}



/*------------------------------------------------------------------
[  ]*/
.login100-form {
  width: 100%;
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
}

.login100-form-title {
    font-family: Montserrat-ExtraBold;
      font-size: 30px;
      line-height: 1.2;
      text-align: center;
      font-weight: 800;
      width: 100%;
      display: block;
      background: -webkit-linear-gradient(#333333,#3bcaca,rgb(4, 107, 121),rgb(20, 20, 78));
      -webkit-background-clip: text !important;
      -webkit-text-fill-color:transparent !important;
}

/*---------------------------------------------*/
.login100-form-avatar {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  overflow: hidden;
  margin: 0 auto;
}
.login100-form-avatar img {
  width: 100%;
}


/*---------------------------------------------*/
.wrap-input100 {
  position: relative;
  width: 100%;
  z-index: 1;
}

.input100 {
  font-family: Montserrat-Bold;
  font-size: 15px;
  line-height: 1.2;
  color: #333333;

  display: block;
  width: 100%;
  background: #fff;
  height: 50px;
  border-radius: 25px;
  padding: 0 30px 0 53px;
}


/*------------------------------------------------------------------
[ Focus ]*/
.focus-input100 {
  display: block;
  position: absolute;
  border-radius: 25px;
  bottom: 0;
  left: 0;
  z-index: -1;
  width: 100%;
  height: 100%;
  box-shadow: 0px 0px 0px 0px;
  color: rgba(0,91,234, 0.6);
}

.input100:focus + .focus-input100 {
  -webkit-animation: anim-shadow 0.5s ease-in-out forwards;
  animation: anim-shadow 0.5s ease-in-out forwards;
}

@-webkit-keyframes anim-shadow {
  to {
    box-shadow: 0px 0px 80px 30px;
    opacity: 0;
  }
}

@keyframes anim-shadow {
  to {
    box-shadow: 0px 0px 80px 30px;
    opacity: 0;
  }
}

.symbol-input100 {
  font-size: 15px;
  color: #999999;

  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  align-items: center;
  position: absolute;
  border-radius: 25px;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 100%;
  padding-left: 30px;
  pointer-events: none;

  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}

.input100:focus + .focus-input100 + .symbol-input100 {
  color: #00c6fb;
  padding-left: 23px;
}


/*------------------------------------------------------------------
[ Button ]*/
.container-login100-form-btn {
  width: 100%;
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.login100-form-btn {
  font-family: Montserrat-Bold;
  font-size: 15px;
  line-height: 1.5;
  width: 100%;
  height: 50px;
  border-radius: 25px;
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 0 25px;
  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
  position: relative;
  z-index: 1;
}

.login100-form-btn::before {
  content: "";
  display: block;
  position: absolute;
  z-index: -1;
  width: 100%;
  height: 100%;
  border-radius: 25px;
  top: 0;
  left: 0;
  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
  opacity: 0;
}

.login100-form-btn:hover {
  background: rgb(97, 95, 95);
  color: #fff;
}
i.fa-facebook:hover
{
    background: royalblue !important;
    color: whitesmoke !important;
}
i.fa-google:hover
{
    background: rgb(201, 30, 44) !important;
    color: whitesmoke !important;
}

.login100-form-btn:hover:before {
  opacity: 1;
}

/*------------------------------------------------------------------
[ Button sign in with ]*/
.btn-face,
.btn-google {
  font-family: Raleway-Bold;
  font-size: 16px;
  line-height: 1.2;

  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  justify-content: center;
  align-items: center;
  width: calc((100% - 10px) / 2);
  height: 40px;
  border-radius: 3px;
  border: 1px solid #e6e6e6;
  background-color: #fff;

  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}


.btn-face {
  color: #3b5998;
}

.btn-face i {
  font-size: 20px;
  margin-right: 10px;
  padding-bottom: 1px;
}

.btn-google {
  color: #555555;
}

.btn-google img {
  width: 19px;
  margin-right: 10px;
  padding-bottom: 1px;
}


.btn-face:hover,
.btn-google:hover {
  border-color: #d33f8d;
}



/*------------------------------------------------------------------
[ Alert validate ]*/

.validate-input {
  position: relative;
}

.alert-validate::before {
  content: attr(data-validate);
  position: absolute;
  max-width: 70%;
  background-color: white;
  border: 1px solid #c80000;
  border-radius: 14px;
  padding: 4px 25px 4px 10px;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -moz-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  -o-transform: translateY(-50%);
  transform: translateY(-50%);
  right: 8px;
  pointer-events: none;

  font-family: Montserrat-Bold;
  color: #c80000;
  font-size: 13px;
  line-height: 1.4;
  text-align: left;

  visibility: hidden;
  opacity: 0;

  -webkit-transition: opacity 0.4s;
  -o-transition: opacity 0.4s;
  -moz-transition: opacity 0.4s;
  transition: opacity 0.4s;
}

.alert-validate::after {
  content: "\f06a";
  font-family: FontAwesome;
  display: block;
  position: absolute;
  color: #c80000;
  font-size: 15px;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -moz-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  -o-transform: translateY(-50%);
  transform: translateY(-50%);
  right: 13px;
}

.alert-validate:hover:before {
  visibility: visible;
  opacity: 1;
}

@media (max-width: 992px) {
  .alert-validate::before {
    visibility: visible;
    opacity: 1;
  }
}

/*//////////////////////////////////////////////////////////////////
[ responsive ]*/

@media (max-width: 576px) {
  .wrap-login100 {
    padding-top: 80px;
    padding-left: 15px;
    padding-right: 15px;
  }
}

</style>
