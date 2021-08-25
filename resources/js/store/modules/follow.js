export default {
 namespaced: true,
 state: {
     following_check: false,
 },
 mutations: {
   follow_action(state, id) {
     const array = ["/user/users/", id, "/follow"];
     const path = array.join('')
     axios.post(path).then(res => {
     }).catch(function(error) {
       console.log(error)
     })
   },
   follow_check(state, id) {
     var array = ["/user/users/", id, "/follow_check"];
     let url = array.join('')
     axios.get(url).then(res => {
       if(res.data == 1) {
         state.following_check = true
       } else {
         state.following_check = false
       }
     }).catch(function(error) {
       console.log(error)
     })
   }
 },
 actions: {
   follow({commit}, id) {
     commit('follow_action', id)
   },
   follow_check({commit}, id) {
     commit('follow_check', id)
   }
 }
}