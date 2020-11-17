<template>

 <div class=" text-dark bg" >
        <div class="overlay  pt-4 ">
        <div class="row">
            <br>
            <div class="col-12 col-md-8  m-auto rounded-lg bg-white note">
         <h2 class="p-md-0 p-3 pt-3" >
             <div v-if="!seeSearch" class="notify">
                 Notifications
             <i @click="seeSearch=true" title="search" class="fa btn p-0 text-muted fa-search float-right" aria-hidden="true"></i>
            </div>
            <div v-if="seeSearch" class="search ">
             <input type="text" v-model="search" @mouseleave="seeSearch=false" class="form-control" placeholder="Search" >
            </div>
             </h2>
       <h6 class="p-2">
                  <span v-if="all.length">New</span>
                  <span v-else>No Notification</span>
                       <button v-if="all.length" @click="deleteAll()" title="Clear Notification" class="btn btn-sm text-danger fa fa-trash float-right shadow-sm "></button>
                     <router-link to="/"><button title="Home" class="btn btn-sm fa fa-home float-right shadow-sm "></button></router-link></h6>
                <div class="scrooler container border-top">
                    <div   :class="`card mb-2 mt-1 ${(item.visited)? 'bg-white border' :'card2' } shadow-sm  zoom`" v-for="(item, index) in filterAll" :key="index"  :id="`myCard_${item.id}`"  @click="goToCard(item.id,item.data_id,item.type)" >
                    <div class="card-body p-1 row">
                            <div class="col-2 pr-0 pl-3 col-md-1 ">
                                     <img :src="item.user.profiles.photo" class="rounded-pill shadow border" style="width: 40px;height: 40px;" >
                             <b>  <i v-if="item.type=='liked'" class="fa text-white shadow  p-1 rounded-circle bg-primary fa-thumbs-up" style="width:20px;height:20px;position: absolute;left: 25px;top: 25px;" aria-hidden="true"></i>
                            <i v-if="item.type=='Loved'" class="fa text-white shadow p-1 rounded-circle bg-danger fa-heart" style="width:20px;height:20px;position: absolute;left: 25px;top: 25px;" aria-hidden="true"></i>
                            <i v-if="item.type=='post'" class="fa text-white shadow  p-1 rounded-circle bg-secondary fa-newspaper-o" style="width:20px;height:20px;position: absolute;left: 25px;top: 25px;" aria-hidden="true"></i>
                            <i v-if="item.type=='comment'" class="fa text-white shadow  p-1 rounded-circle bg-success fa-comments" style="width:20px;height:20px;position: absolute;left: 25px;top: 25px;" aria-hidden="true"></i>
                            <i v-if="item.type=='reacted'" class="fa text-white shadow  p-1 rounded-circle   " style="width:20px;height:20px;position: absolute;left: 20px;top: 25px;font-size:17px" aria-hidden="true">😅</i>
                            <i v-if="item.type=='profile'" class="fa fa-user  shadow  p-1 rounded-circle   " style="width:20px;height:20px;position: absolute;left: 25px;top: 25px;font-size:17px" aria-hidden="true"></i>
                            </b>

                            </div>
                        <h6 class="card-title col-8 p-0 pl-1 pl-md-3 pl-lg-2 ">
                         <b>
                           {{ item.user.profiles.first_name }} {{item.user.profiles.last_name }}
                        </b>
                            <span class="">{{ item.title }} {{ time(item.created_at) }}</span>
                        </h6>

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
export default {
data() {
    return {
        all:[],
        unSeen:[],
        authUser:{},
        data:{
            _method:"PUT",
        },
        seeSearch:false,
        search:''
    }
},
mounted() {
    this.notify()
   Echo.private(`notification`)
             .listen('Notification',(e)=>{
                this.notify()
             });

},
computed:{
     filterAll()
    {
        return this.all.filter((item) => {
       return  item.user.profiles.first_name.toLowerCase().match(this.search)
                  ||
          item.user.profiles.last_name.toLowerCase().match(this.search)
                  ||
          item.title.toLowerCase().match(this.search)
                  ||
          item.created_at.toLowerCase().match(this.search)
      })
    }
},
methods: {

    time(time)
    {
        return moment(time).fromNow();
    },
    notify() {
    axios.get(`${this.$baseUrl}/notify`).then((res) => {
     this.all=res.data.all
     this.unSeen=res.data.unSeen
     this.authUser=res.data.authUser
})
},
goToCard(data,id,value)
    {

             let e = "myCard_"+data;
             let myCard=document.getElementById(e);
            axios.post(`${this.$baseUrl}/notify/${data}`,this.data).then((res) => {
                    myCard.style.background='white'

            })
            switch (value) {
                case 'chat':
                this.$router.push(`/post/${id}`);
                    break;
                case 'profile':
                this.$router.push(`/profile/${id}`);
                    break;
                default:
                this.$router.push(`/post/${id}`);
                    break;
            }

                axios.post(`${this.$baseUrl}/notify`).then((res) => {
             })

    },
    deleteAll()
    {
         axios.delete(`${this.$baseUrl}/notify/data`).then((res) => {
           this.notify()

          })
    }
}
}
</script>

<style scoped lang="scss">
#home{
    background:rgba(0, 0, 0, 0.5);
    height: 100vh;
}
.scrooler
{
    height: 100vh;
    overflow-y: scroll;
    z-index: 0;

}
.card{
    cursor: pointer;
}
.card2{
    background:rgba(0, 0, 0, 0.137);

}
.fa-user
{
    color: rgb(228, 218, 218);
    // border: 1px solid whitesmoke;
    background: rgb(179, 153, 102);
}

.zoom:hover {
    -ms-transform: scale(1.1); /* IE 9 */
    -webkit-transform: scale(1.1); /* Safari 3-8 */
    transform: scale(1.1);
    z-index: 2 !important;
  }
//
</style>
