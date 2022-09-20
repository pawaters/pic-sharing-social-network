
//selectors

const videoPlayer = document.querySelector("#player");
const canvasElement = document.querySelector("#canvas");
const captureButton = document.querySelector("#capture-btn");

//1) get the video stream

const startMedia = () => {
    if (!("mediaDevices" in navigator)) {
      navigator.mediaDevices = {};
    }

    // constraint of getUserMedia - to define if audio and video tracks required
    // common getUserMedia errors: user denied access, user plugs after, already used by another app
    if (!("getUserMedia" in navigator.mediaDevices)) {
        // If the browser does not support video capturing, we try to create the object 
        // using the features webkitGetUserMedia or mozGetUserMedia
        navigator.mediaDevices.getUserMedia = constraints => {
          const getUserMedia =
            navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
        
          if (!getUserMedia) {
            return Promise.reject(new Error("getUserMedia is not supported"));
          } else {
            return new Promise((resolve, reject) =>
              getUserMedia.call(navigator, constraints, resolve, reject)
            );
          }
        };
      }

    navigator.mediaDevices
        .getUserMedia({ video: true })
        .then(stream => {
        videoPlayer.srcObject = stream;
    });
};

// 2) Capture the video in canvas

captureButton.addEventListener("click", event => {
    // returns drawing context on the canvas
    const context = canvasElement.getContext("2d");
    // Draw the image on the canvas
    context.drawImage(videoPlayer, 0, 0, canvas.width, canvas.height);


    // return a data URL containing a representation of the image. Easier to save.
    let picture = canvasElement.toDataURL();
});

// 3) Add sticker

window.addEventListener("load", event => startMedia());