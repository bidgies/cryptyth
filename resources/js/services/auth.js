import axios from 'axios'

const baseUrl = '/api/auth'

export default {

  login: (login, password) => {
    return axios.post(`${baseUrl}/login`, {
      login,
      password,
    }).then((response) => {
      return response.data;
    });
  },

  getCurrentUser: () => {
    return axios.get(`${baseUrl}/user`).then((response) => {
      if(!response.data.id) {
        return null;
      }
      return response.data;
    })
  },

  logout: () => {
    return axios.get(`${baseUrl}/logout`);
  }

}
