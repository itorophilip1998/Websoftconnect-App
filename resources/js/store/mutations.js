
//  mutation to get all post
export const POSTS=(state,posts)=>{
    state.posts=posts
}

// mutation to get all users Data
export const PROFILE=(state,profile)=>{
    state.profile=profile
}
export const FRIENDSLIST=(state,friendslist)=>{
    state.friendslist=friendslist
}
// mutation to get all Reactions
export const COMMENT=(state,comment)=>{
    state.comment=comment
}
export const LIKE=(state,getLike)=>{
    state.getLike=getLike
}
export const LOVE=(state,getLove)=>{
    state.getLove=getLove
}
