const videoPlayer = document.querySelector("#player");
const canvasElement = document.querySelector("#canvas");
const captureButton = document.querySelector("#capture-btn");
const imagePicker = document.querySelector("#image-picker");
const imagePickerArea = document.querySelector("#pick-image");
const newImages = document.querySelector("#newImages");

// Image dimensions
const width = 320;
const height = 240;
let zIndex = 1;

const createImage = (src, alt, title, width, height, className) => {
  let newImg = document.createElement("img");

  if (src !== null) newImg.setAttribute("src", src);
  if (alt !== null) newImg.setAttribute("alt", alt);
  if (title !== null) newImg.setAttribute("title", title);
  if (width !== null) newImg.setAttribute("width", width);
  if (height !== null) newImg.setAttribute("height", height);
  if (className !== null) newImg.setAttribute("class", className);

  return newImg;
};

const startMedia = () => {
  if (!("mediaDevices" in navigator)) {
    navigator.mediaDevices = {};
  }

  if (!("getUserMedia" in navigator.mediaDevices)) {
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
      videoPlayer.style.display = "block";
    })
    .catch(err => {
      imagePickerArea.style.display = "block";
    });
};

// Capture the image, save it and then paste it to the DOM
captureButton.addEventListener("click", event => {
  // Draw the image from the video player on the canvas
  canvasElement.style.display = "block";
  const context = canvasElement.getContext("2d");
  context.drawImage(videoPlayer, 0, 0, canvas.width, canvas.height);

  videoPlayer.srcObject.getVideoTracks().forEach(track => {
    // track.stop();
  });

  // Convert the data so it can be saved as a file
  let picture = canvasElement.toDataURL();

  // Save the file by posting it to the server
  fetch("./api/save_image.php", {
    method: "post",
    body: JSON.stringify({ data: picture })
  })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        // Create the image and give it the CSS style with a random tilt
        //  and a z-index which gets bigger
        //  each time that an image is added to the div
        let newImage = createImage(
          data.path,
          "new image",
          "new image",
          width,
          height,
          "masked"
        );
        console.log(newImage);
        let tilt = -(20 + 60 * Math.random());
        newImage.style.transform = "rotate(" + tilt + "deg)";
        zIndex++;
        newImage.style.zIndex = zIndex;
        newImages.appendChild(newImage);
        canvasElement.classList.add("masked");
      }
    })
    .catch(error => console.log(error));
});

window.addEventListener("load", event => startMedia());
