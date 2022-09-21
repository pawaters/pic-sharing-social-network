

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

        // Convert the imae to a data-URL so it can be sabed
        let picture = canvasElement.toDataURL();

          // Save the file by posting it to the server
            fetch("./api/save_image.php", {
                method: "post",
                //converts JS (here data-URL) to JSON
                body: JSON.stringify({ data: picture })
            });

    });
}

window.addEventListener("load", event => startMedia());