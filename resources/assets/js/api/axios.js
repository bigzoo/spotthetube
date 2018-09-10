'use strict';
class Api {
    constructor (){
        // Using already initialised axios instance by laravel in bootstrap.js
        this.axios = window.axios;
    }

    async get(url, data = {}) {
        try {
            return await this.axios.get(`api/${url}`,{
                params: data
            })
        }
        catch (e) {
            console.log('Axios error: ', e);
        }
    }
}

export default Api;