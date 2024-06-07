<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Color Chooser</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinycolor/1.4.2/tinycolor.min.js"></script>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            transition: background-color 0.5s ease;
        }

        .color-container {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        h2 {
            color: #333;
        }

        label {
            font-size: 18px;
            margin-bottom: 10px;
            display: block;
        }

        input[type="color"] {
            padding: 10px;
            border: none;
            border-radius: 4px;
            outline: none;
        }

        p {
            margin-top: 20px;
            font-size: 16px;
            color: #555;
        }

        .color-selected {
            background-color: #b3e0ff;
        }

        #colorInfo {
            margin-top: 20px;
        }
    </style>
</head>
<body id="body">

    <div class="color-container" id="colorContainer">
        <h2>Color Chooser</h2>

        <label for="colorPicker">Choose a color:</label>
        <input type="color" id="colorPicker" onchange="showColor()">

        <p id="selectedColor">Selected color will be displayed here.</p>
        <div id="colorInfo"></div>
    </div>

    <script>
        function showColor() {
            var selectedColor = document.getElementById("colorPicker").value;
            document.getElementById("selectedColor").innerHTML = "Selected color: " + selectedColor;

            document.getElementById("body").style.backgroundColor = selectedColor;

            document.getElementById("colorContainer").classList.add("color-selected");

            showColorInfo(selectedColor);
        }

        function showColorInfo(color) {
            var colorInfoElement = document.getElementById("colorInfo");
            var colorObject = tinycolor(color);

            var colorInfoHTML = "<h3>Color Information</h3>";
            colorInfoHTML += "<p>Hex: " + colorObject.toHexString() + "</p>";
            colorInfoHTML += "<p>RGB: " + colorObject.toRgbString() + "</p>";
            colorInfoHTML += "<p>HSL: " + colorObject.toHslString() + "</p>";

            colorInfoElement.innerHTML = colorInfoHTML;
        }
    </script>

</body>
</html>
