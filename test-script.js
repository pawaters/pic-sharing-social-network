const videoPlayer = document.querySelector("#player");

const startMedia = () => {
    // if (!("mediaDevices" in navigator)) {
    //   navigator.mediaDevices = {};
    // }

    // constraint of getUserMedia - to define if audio and video tracks required
    //
    // if (!("getUserMedia" in navigator.mediaDevices)) {
    //     navigator.mediaDevices.getUserMedia = constraints => {
    //       const getUserMedia =
    //         navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
    
    //       if (!getUserMedia) {
    //         return Promise.reject(new Error("getUserMedia is not supported"));
    //       } else {
    //         return new Promise((resolve, reject) =>
    //           getUserMedia.call(navigator, constraints, resolve, reject)
    //         );
    //       }
    //     };
    //   }

    navigator.mediaDevices
        .getUserMedia({ video: true })
        .then(stream => {
        videoPlayer.srcObject = stream;
        videoPlayer.style.display = "block";
    });
}

window.addEventListener("load", event => startMedia());