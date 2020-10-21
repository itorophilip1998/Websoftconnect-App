
//toggle
let toggleIn=document.getElementById('toggleIn');
let toggleOut=document.getElementById('toggleOut');
function toggleInAction()
{
    toggleIn.style.display="none"
    toggleOut.style.display="block"
}
function toggleOutAction()
{
    toggleIn.style.display="block"
    toggleOut.style.display="none"
}
// title message
 let message=document.getElementById('message');
 function messageM() {
     switch (document.title) {
         case 'WebsoftConnect | Login':
             message.innerText="Welcome Back!";
             break;
         case 'WebsoftConnect | Register':
             message.innerText="Welcome \n To \n WebsoftConnect";
             break;
         case 'WebsoftConnect | Email':
            message.innerHTML=`<i class="fa fa-envelope " aria-hidden="true"></i> ${message.innerText="Send Mail"}`;
             break;
         case 'WebsoftConnect | Reset':
            message.innerHTML=`<i class="fa fa-unlock " aria-hidden="true"></i> ${message.innerText="Reset Password"}`;
             break;
         case 'WebsoftConnect | Verify':
            message.innerHTML=`<i class="fa fa-envelope-open " aria-hidden="true"></i> ${message.innerText="Verify Account"}`;
             break;
         case 'WebsoftConnect | Create Profile':
            message.innerHTML=`<i class="fa fa-user-circle " aria-hidden="true"></i> ${message.innerText="Create Profile"}`;
             break;
         case 'Error':
            message.innerHTML=`<i class="fa fa-bug" aria-hidden="true"></i> ${message.innerText="Error Occurred"}`;
             break;
         default:
            message.innerText="WebsoftConnect";

             break;
     }

}
messageM();
// desktop
 let show=document.getElementById('show');
 let hide=document.getElementById('hide');
 let rules=document.getElementById('rules');
 let rules1=document.getElementById('rules1');
 let rules2=document.getElementById('rules2');
 let rules3=document.getElementById('rules3');
 let password=document.getElementById('password');
 let email=document.getElementById('email');
 let name=document.getElementById('name');
 let submitBtn1=document.getElementById('submitBtn1');
 let submitBtn2=document.getElementById('submitBtn2');

function nameAction() {
    passwordAction();
}
function emailAction() {
    passwordAction();
}
function passwordAction() {
  try {
        // Length validation
    if(password.value.length >=8)
    {
        rules1.style.display="none"
    }
    // empty value
    if(password.value=="")
    {
        rules1.style.display="block"
        rules2.style.display="block"
        rules3.style.display="block"
    }
    // number validation

let str= password.value;
let numRegex = /[0-9]/g;
let number = str.match(numRegex);

// string validation
let capRegex = /[A-Z]/g;
let smallRegex = /[a-z]/g;
let capital = str.match(capRegex);
let small = str.match(smallRegex);

if (small && password.value.length >=8 && capital && number && name.value !='' && email.value !='' && password.value !='') {
    submitBtn1.style.display="none"
    submitBtn2.style.display="block"
 }
 else{
    submitBtn1.style.display="block"
    submitBtn2.style.display="none"
 }
if(number)
{
    rules2.style.display="none"
}
else
{
    rules2.style.display="block"

}
    if(capital && small)
    {
        rules3.style.display="none"
        submitBtn.disabled='true'

    }
    else{
        rules3.style.display="block"

    }

  } catch (error) {
       console.log(error)

  }

}
function passwordActionClick() {
    rules.style.display="block"
}

function showAction() {
    hide.style.display="block";
    show.style.display="none";
    password.type="text";
}

function hideAction() {
    hide.style.display="none";
    show.style.display="block";
    password.type="password";

}



// mobile
let showM=document.getElementById('showM');
let hideM=document.getElementById('hideM');
let rulesM=document.getElementById('rulesM');
let rules1M=document.getElementById('rules1M');
let rules2M=document.getElementById('rules2M');
let rules3M=document.getElementById('rules3M');
let passwordM=document.getElementById('passwordM');
let emailM=document.getElementById('emailM');
let nameM=document.getElementById('nameM');
let submitBtn1M=document.getElementById('submitBtn1M');
let submitBtn2M=document.getElementById('submitBtn2M');

function nameActionM() {
   passwordActionM();
}
function emailActionM() {
   passwordActionM();
}
function passwordActionM() {
 try {
       // Length validation
   if(passwordM.value.length >=8)
   {
       rules1M.style.display="none"
   }
   // empty value
   if(passwordM.value=="")
   {
       rules1M.style.display="block"
       rules2M.style.display="block"
       rules3M.style.display="block"
   }
   // number validation

let str= passwordM.value;
let numRegex = /[0-9]/g;
let number = str.match(numRegex);

// string validation
let capRegex = /[A-Z]/g;
let smallRegex = /[a-z]/g;
let capital = str.match(capRegex);
let small = str.match(smallRegex);

if (small && passwordM.value.length >=8 && capital && number && nameM.value !='' && emailM.value !='' && passwordM.value !='') {
   submitBtn1M.style.display="none"
   submitBtn2M.style.display="block"
   rulesM.style.display="none"
}
else{
   submitBtn1M.style.display="block"
   submitBtn2M.style.display="none"
   rulesM.style.display="block"

}


if(number)
{
   rules2M.style.display="none"
}
else{
    rules2M.style.display="block"

}
   if(capital && small)
   {
       rules3M.style.display="none"

   }
   else
   {
    rules3M.style.display="block"

   }

 } catch (error) {
      console.log(error)

 }

}
function passwordActionClickM() {
   rulesM.style.display="block"
}

function showActionM() {
   hideM.style.display="block";
   showM.style.display="none";
   passwordM.type="text";
}

function hideActionM() {
   hideM.style.display="none";
   showM.style.display="block";
   passwordM.type="password";

}

// Auto load Mobile
passwordActionM();
passwordAction();

