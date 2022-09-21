const videoPlayer = document.querySelector("#player");
const canvasElement = document.querySelector("#canvas");
const captureButton = document.querySelector("#capture-btn");

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
        /* videoPlayer.style.display = "block"; */
    });

    captureButton.addEventListener("click", event => {
        //creates the object needed
        const context = canvasElement.getContext("2d");
        // draws in canvas
        context.drawImage(videoPlayer, 0, 0, canvas.width, canvas.height);

        // Convert the imae to a data-URL so it can be sabed
        let picture = canvasElement.toDataURL();

    });
}

window.addEventListener("load", event => startMedia());