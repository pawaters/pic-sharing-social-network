

const videoPlayer = document.querySelector("#player");
const canvasElement = document.querySelector("#canvas");
const captureButton = document.querySelector("#capture-btn");

const startMedia = () => {
 
    navigator.mediaDevices
        .getUserMedia({ video: true })
        .then(stream => {
        videoPlayer.srcObject = stream;
    });

    captureButton.addEventListener("click", event => {
        //creates the object needed
        const context = canvasElement.getContext("2d");
        // draws in canvas
        context.drawImage(videoPlayer, 0, 0, canvas.width, canvas.height);
    });
};

// 2) Capture the video in canvas

captureButton.addEventListener("click", event => {
    // returns drawing context on the canvas
    const context = canvasElement.getContext("2d");
    // Draw the image on the canvas
    context.drawImage(videoPlayer, 0, 0, canvas.width, canvas.height);

    // return a data URL containing a representation of the image. Easier to save.
    let canvasUrl = canvasElement.toDataURL();
			
    // add canvasUrl to the form hidden input
	document.getElementById("webcam-file").value = canvasUrl;

});

window.addEventListener("load", event => startMedia());