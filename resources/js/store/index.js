import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    status: '',
    token: localStorage.getItem('token') || '',
    user : JSON.parse(localStorage.getItem('userInfo')) || 'User',
  },
  mutations: {
    auth_request(state){
        state.status = 'loading'
      },
      auth_success(state, token, user){
        state.status = 'success'
        state.token = token
        state.user = user
      },
      auth_error(state){
        state.status = 'error'
      },
      logout(state){
        state.status = ''
        state.token = ''
      },
      changePicture(state){
        state.user = JSON.parse(localStorage.getItem('userInfo'))
      }
  },
  actions: {
    login({commit}, user){
        return new Promise((resolve, reject) => {
          commit('auth_request')
          axios({url: '/api/login', data: user, method: 'POST' })
          .then(resp => {
            const token = resp.data.access_token
            const {id, user_name, first_name, last_name, email, user_photo_url} = resp.data.user
            //console.log(id, user_name, email)
            localStorage.setItem('token', token)
            localStorage.setItem('userInfo', JSON.stringify({id: id, first_name:first_name, last_name:last_name,user_name: user_name, email:email, user_photo_url:user_photo_url}))
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
            commit('auth_success', token, {id: id, user_name: user_name, email:email})
            resolve(resp)
          })
          .catch(err => {
            commit('auth_error')
            localStorage.removeItem('token')
            localStorage.removeItem('userInfo')
            reject(err)
          })
        })
    },
    logout({commit}){
        return new Promise((resolve, reject) => {
          commit('logout')
          localStorage.removeItem('token')
          localStorage.removeItem('userInfo')
          delete axios.defaults.headers.common['Authorization']
          resolve()
        })
      },
      picture({commit}){
        commit('changePicture')
      }

  },
  getters : {
    isLoggedIn: state => !!state.token,
    authStatus: state => state.status,
    userInfo: state => state.user
  }
})