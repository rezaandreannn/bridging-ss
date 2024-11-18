 // Get the canvas and context
 const canvas = document.getElementById('drawingCanvas');
 const ctx = canvas.getContext('2d');

 // Variable to track if user is drawing
 let drawing = false;

 // Start drawing when mouse is pressed
 canvas.addEventListener('mousedown', (event) => {
     drawing = true;
     ctx.beginPath();
     ctx.moveTo(event.offsetX, event.offsetY); // Move to the mouse position
 });

 // Draw when mouse moves
 canvas.addEventListener('mousemove', (event) => {
     if (drawing) {
         ctx.lineTo(event.offsetX, event.offsetY);
         ctx.stroke(); // Draw the line
     }
 });

 // Stop drawing when mouse is released
 canvas.addEventListener('mouseup', () => {
     drawing = false;
     updateImage(); // Update the displayed image after drawing
 });

 // Function to update the displayed image
 function updateImage() {
     const dataURL = canvas.toDataURL(); // Get the canvas content as a data URL
     document.getElementById('outputImage').src = dataURL; // Set it as the source for the <img> element
 }

 // Clear the canvas when the clear button is clicked
 document.getElementById('clearCanvasButton').addEventListener('click', () => {
     ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear the canvas
     document.getElementById('outputImage').src = ''; // Clear the displayed image
 });