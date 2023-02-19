import axios from 'axios'

const api = axios.create({
    baseURL: window.appUrl + '/api',
})

export default api
