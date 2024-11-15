const canvas = document.getElementById('drawingCanvas');
const ctx = canvas.getContext('2d');
const signatureData = document.getElementById('signatureData');
let paths = []; // Array to store path history
let currentPath = []; // Array for the current path being drawn
let drawing = false; // Drawing status
let erasing = false; // Erase mode status
const img = new Image(); // Background image object

// Set background image based on gender
const gender = document.getElementById('formPria') ? 'L' : 'P'; // Or read from data-gender
img.src = gender === 'L' ? '/img/lakii.jpg': '/img/wanita.jpg'; // Set appropriate image path

// Load background image
img.onload = () => {
    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
};

// Function to get scaled mouse coordinates
function getMousePos(event) {
    const rect = canvas.getBoundingClientRect();
    const scaleX = canvas.width/rect.width; // Scale factor for X
    const scaleY = canvas.height/rect.height; // Scale factor for Y

    return {
        x: (event.clientX - rect.left) * scaleX
        , y: (event.clientY - rect.top) * scaleY
    };
}

// Function to redraw all paths
function drawPaths() {
    ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear canvas
    ctx.drawImage(img, 0, 0, canvas.width, canvas.height); // Redraw background

    paths.forEach(path => {
        ctx.beginPath();
        path.forEach((point, index) => {
            if (index === 0) {
                ctx.moveTo(point.x, point.y);
            } else {
                ctx.lineTo(point.x, point.y);
            }
        });
        ctx.stroke();
    });
}

// Start drawing or erasing
canvas.addEventListener('mousedown', (event) => {
    drawing = true;
    currentPath = []; // Initialize a new path
    paths.push(currentPath); // Save path in paths array

    const {
        x
        , y
    } = getMousePos(event);
    ctx.beginPath();
    ctx.moveTo(x, y);
    currentPath.push({
        x
        , y
    });
});

// Draw or erase on mouse move
canvas.addEventListener('mousemove', (event) => {
    if (drawing) {
        const {
            x
            , y
        } = getMousePos(event);

        if (erasing) {
            ctx.globalCompositeOperation = 'destination-out'; // Erase mode
            ctx.lineWidth = 10; // Eraser width
        } else {
            ctx.globalCompositeOperation = 'source-over'; // Draw mode
            ctx.lineWidth = 2; // Line width
            ctx.strokeStyle = 'red'; // Line color
        }

        ctx.lineTo(x, y);
        ctx.stroke();

        // Save point in the current path
        currentPath.push({
            x
            , y
        });
    }
});

// End drawing
const endDrawing = () => {
    drawing = false;
    ctx.closePath();
    signatureData.value = canvas.toDataURL(); // Save canvas as data URL
};

canvas.addEventListener('mouseup', endDrawing);
canvas.addEventListener('mouseout', endDrawing); // Stop drawing if cursor leaves canvas

// Undo last drawing
document.getElementById('undoButton').addEventListener('click', () => {
    paths.pop(); // Remove last path
    drawPaths(); // Redraw remaining paths
    signatureData.value = canvas.toDataURL(); // Save updated canvas state
});

// Clear canvas
document.getElementById('clearCanvasButton').addEventListener('click', () => {
    ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear canvas
    ctx.drawImage(img, 0, 0, canvas.width, canvas.height); // Redraw background
    paths = []; // Clear paths array
    signatureData.value = ''; // Reset data URL
});

// Enable draw mode
document.getElementById('drawButton').addEventListener('click', () => {
    erasing = false; // Switch to draw mode
    canvas.style.cursor = 'default'; // Default cursor for drawing
});
