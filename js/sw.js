if("serviceWorker" in navigator){
    navigator.serviceWorker.register("/sw.js", {
        scope: "/",
    }).then(register=>{
        if(register.installing){
            console.log("sw.js is installing ...");
        }else if(register.waiting){
            console.log("sw.js is wating for activation ...");
        }else if(register.active){
            console.log("sw.js is active!");
        }
    });
}


navigator.serviceWorker.ready.then( registration => {
    registration.active.postMessage("Hi service worker");
});