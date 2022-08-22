const localUserI = 'userInfo';

export function storageAvailable(type) {
    try {
        var storage = window[type],
            x = '__storage_test__';
        storage.setItem(x, x);
        storage.removeItem(x);
        return true;
    }
    catch(e) {
        return e instanceof DOMException && (
            // everything except Firefox
            e.code === 22 ||
            // Firefox
            e.code === 1014 ||
            // test name field too, because code might not be present
            // everything except Firefox
            e.name === 'QuotaExceededError' ||
            // Firefox
            e.name === 'NS_ERROR_DOM_QUOTA_REACHED') &&
            // acknowledge QuotaExceededError only if there's something already stored
            storage.length !== 0;
    }
}

export function userInfo(){
    return localStorage.getItem(localUserI);
}

export function setUserInfo(user){
    localStorage.setItem(localUserI, user);
}

export async function verify_sesion(){
    var user_loged = userInfo();
    const formData = new FormData();
    for ( var key in user_loged ) {
        formData.append(key, user_loged[key]);
    }
    var req = await fetch('api/Usuario/validar_sesion/',{
        method: 'POST',
        body: formData,
    });
    return await req.json();
}