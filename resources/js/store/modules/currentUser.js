// import axios from "axios"
// import router from '../../routers'
// const state = {
//     status: '',
//     token: localStorage.getItem('token') || '',
//     user: {}
// }
// const actions = {
x
//     // },
//     // loginUser({}, user){
//     //     axios
//     //     .post('/api/login', {
//     //         user_name: user.user_name,
//     //         password: user.password
//     //     })
//     //     .then(response => {
//     //         if(response.data.access_token){
//     //             //guardar token
//     //             localStorage.setItem('token', response.data.access_token)
//     //             router.push({
//     //                 name: 'Dashboard'
//     //             })
//     //         } else{

//     //         }
//     //     })
//     // }
//     login({commit}, user){
//         return new Promise((resolve, reject) => {
//           commit('auth_request')
//           axios({url: '/api/login', data: user, method: 'POST' })
//           .then(resp => {
//             const token = resp.data.access_token
//             const user = resp.data.user
//             localStorage.setItem('token', token)
//             axios.defaults.headers.common['Authorization'] = token
//             commit('auth_success', token, user)
//             resolve(resp)
//           })
//           .catch(err => {
//             commit('auth_error')
//             localStorage.removeItem('token')
//             reject(err)
//           })
//         })
//     }
// }
// const mutations = {
//     // setUser(state, data){
//     //     state.user = data
//     // }
//     auth_request(state){
//         state.status = 'loading'
//       },
//       auth_success(state, token, user){
//         state.status = 'success'
//         state.token = token
//         state.user = user
//       },
//       auth_error(state){
//         state.status = 'error'
//       },
//       logout(state){
//         state.status = ''
//         state.token = ''
//       },
// }
// const getters = {
//     isLoggedIn: state => !!state.token,
//     authStatus: state => state.status,
// }

// export default {
//     namespaced: true,
//     state,
//     actions,
//     mutations,
//     getters
// }