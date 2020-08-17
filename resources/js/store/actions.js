import axios from 'axios'
let baseUrl='http://localhost:8000'
// action to get all posts
export const posts=({commit})=>{
    axios.get(`${baseUrl}/post`).then((respond) => {
        commit('POSTS',respond.data)
    })}


 // action to get all Users Data
 export const profile=({commit})=>{
    axios.get(`${baseUrl}/profile`).then((respond) => {
        commit('PROFILE',respond.data)
    })}
 export const friendslist=({commit})=>{
    axios.get(`${baseUrl}/friendslist`).then((respond) => {
        commit('FRIENDSLIST',respond.data)
    })}

 // action to get all Reactions
 export const comment=({commit})=>{
    axios.get(`${baseUrl}/comment`).then((respond) => {
        commit('COMMENT',respond.data)

    })}

     export const getLike=({commit},user_id)=>{
        axios.get(`${baseUrl}/like/${user_id}`).then((respond) => {
            commit('LIKE',respond.data)
    })}
    export const getLove=({commit},user_id)=>{
        axios.get(`${baseUrl}/love/${user_id}`).then((respond) => {
            commit('LOVE',respond.data)
    })}




