class RequestService {
    constructor () {
        this.API_PATH = "http://localhost:62454/src/php/api";
    }

    execute (message, data) {
        switch (message) {
            case "categories_get":
                return this.getIt("/category/read.php", data);
            case "tools_get":
                return this.getIt("/tool/read.php", data);
        }
    }

    getIt (pathLocation, data) {
        let filterParams = "";
        if (data) {
            for (let key in data) {
                filterParams += "&" + key + "=" + data[key];
            }

            filterParams = "?" + filterParams.substr(1, filterParams.length - 1);
        }

        return fetch(this.API_PATH + pathLocation + filterParams)
        .then(response => {
            return response.json();
        })
        .catch(error => {
            console.log(error);

            throw error;
        });
    }

    postIt (pathLocation, data) {
        return fetch(this.API_PATH + pathLocation, {

        })
        .then(response => {
            return response.json();
        })
        .catch(error => {
            console.log(error);

            throw error;
        });
    }
};

export default RequestService;