<template>
    <div>
        <div class="limiter">
            <div class="container-login100" style="background-image: url('../../images/bg.png');">
                <div class="wrap-login100 pt-5 pb-3">
                    <form class=" validate-form"  @submit.prevent="registerUser">
                        <h4 class="text-secondary">Reset Password</h4>
                        <!-- <div class=" text-secondary mb-3 mt-1 shadow-sm">
                               <div class="alert alert-primary p-2" role="alert">
                                   <i class="fa fa-bell" aria-hidden="true"></i><strong>Please answer the questions below to confirm that you are the rightful owner of this account</strong>
                               </div>
                                <hr>
                        </div> -->
                        <hr>
                          <label for="" class="text-secondary m-1">ID Number</label>
                        <div class="wrap-input100 validate-input mb-3" data-validate = "Username is required">
                            <input class="input100 shadow" type="text" name="username" placeholder="ID" v-model='userDetals.id' required >
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                            </span>
                        </div>
                         
                          <label for="" class="text-secondary m-1">Username</label>
                        <div class="wrap-input100 validate-input mb-3" data-validate = "Username is required">
                            <input class="input100 shadow" type="text" name="username" placeholder="Username" v-model='userDetals.user_name' required >
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-user-circle"></i>
                            </span>
                        </div>
                         <label for="" class="text-secondary m-1">Email Address</label>
                        <div class="wrap-input100 validate-input mb-3" data-validate = "Email is required">
                            <input class="input100 shadow" type="email" name="username" placeholder="Email" v-model='userDetals.email' required >
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-envelope"></i>
                            </span>
                        </div>
                         <label for="" class="text-secondary m-1">New Password</label>
                        <div class="wrap-input100 validate-input mb-3" data-validate = "Email is required">
                            <input class="input100 shadow" type="password" name="phone" placeholder="Password" v-model='userDetals.password' required >
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock"></i>
                            </span>
                        </div>
                         <label for="" class="text-secondary m-1">Confirm Password</label>
                        <div class="wrap-input100 validate-input mb-3" data-validate = "Email is required">
                            <input class="input100 shadow" type="password" name="password" placeholder="Confirm Password" v-model='userDetals.confirmPassword' required >
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                               <i class="fa fa-lock" aria-hidden="true"></i> 
                            </span>
                        </div>



                        <div class="container-login100-form-btn pt-2">
                            <button class="login100-form-btn shadow btn-primary " type="submit">
                                Reset
                            </button>
                        </div>


                        <div class="text-center w-full pt-2 ">
                            <a href="/login" class="txt1 text-secondary" >
                                Not my Account
                                <i class="fa fa-long-arrow-right"></i>
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</template>




<script>
 import Swal from 'sweetalert2'
    export default {
        data() {
            return {
                userDetals: { 
                    email: '',
                    confirmPassword: '',
                    id: '',
                    user_name: '',
                    password: '',
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
            registerUser() {
                  axios.post(`${this.$baseUrl}/passwordreset`, { 
                        id: this.userDetals.id,
                        email: this.userDetals.email,
                        confirmPassword: this.userDetals.confirmPassword,
                        password: this.userDetals.password,
                        user_name: this.userDetals.user_name
                    }).then((register) => {
                          this.message('top-end','success','Reset Password Successfully!',false,1500);
                          window.location='/';
                    }).catch((err) => {
                          this.message('top-end','info','Can`t Reset Password!',false,1500);
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
      border-radius: 10px;
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
      border-radius: 10px;
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
      border-radius: 10px;
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
