Object.size = function(obj) {
    var size = 0,
      key;
    for (key in obj) {
      if (obj.hasOwnProperty(key)) size++;
    }
    return size;
  };
  
getCall = async(url, params, token) =>{
    const requestOptions = {
        method: "GET",
        headers: {
            'Accept': 'application/json',
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': token
        }
    };

    const response = await fetch(url+(Object.size(params) > 0 ? '?' + ( new URLSearchParams( params ) ).toString():''), requestOptions);
    return response;
}

postCall = async (url, data, token) => {
    const requestOptions = {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify(data)
    };

    const response = await fetch(url, requestOptions);
    return response;
}

putCall = async (url, data, token) => {
    const requestOptions = {
        method: "PUT",
        headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify(data)
    };

    const response = await fetch(url, requestOptions);
    return response;
}

deleteCall = async (url, token) => {
    const requestOptions = {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json',
        }
    };

    const response = await fetch(url, requestOptions);
    return response;
}