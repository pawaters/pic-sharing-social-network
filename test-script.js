

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

        // Convert the imae to a data-URL so it can be saved
        let picture = canvasElement.toDataURL();


          // Save the file by posting it to the server
            // fetch("./api/save_image.php", {
            //     method: "post",
            //     //converts JS (here data-URL) to JSON
            //     body: JSON.stringify({ data: picture })
            // });

        /* ALWAYS DO WITH A TEST FILE
        1) how to save picture in DB from canvasElement.toDataURL();
        2) How to get it from there
        3) apply sticker.
        4) design the page.
        When stuck, define step by step.
        
        */

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
    imageData = canvas.toDataURL().replace(/^data:image\/png;base64,/, '');


    // 1) USE XHR to send imageData to POST

    // 2) TAKE POST AND USE THE THE STICKER FUNCTION

});

// 3) Add sticker

window.addEventListener("load", event => startMedia());

//Fetch : https://code-boxx.com/post-form-data-javascript-fetch/