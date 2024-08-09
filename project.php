<?php
include("conect.php");

$uploadSuccess = false;
$errorMessages = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bedrooms = isset($_POST['bedrooms']) ? $_POST['bedrooms'] : null;
    $price = isset($_POST['price']) ? $_POST['price'] : null;
    $area = isset($_POST['area']) ? $_POST['area'] : null;
    $square = isset($_POST['square']) ? $_POST['square'] : null;
    $address = isset($_POST['address']) ? $_POST['address'] : null;
    $latitude = isset($_POST['latitude']) ? $_POST['latitude'] : null;
    $longitude = isset($_POST['longitude']) ? $_POST['longitude'] : null;

    $files = [
        'uploadfile' => $_FILES['uploadfile'],
        'uploadfile1' => $_FILES['uploadfile1'],
        'uploadfile2' => $_FILES['uploadfile2']
    ];

    $uploadDir = __DIR__ . "/uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $filePaths = [];
    foreach ($files as $key => $file) {
        if ($file["error"] == 0) {
            $filename = basename($file["name"]);
            $targetFile = $uploadDir . $filename;
            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                $filePaths[$key] = $targetFile;
            } else {
                $errorMessages[] = "Error uploading file: $filename";
            }
        } else {
            $errorMessages[] = "Error with file upload: " . $file["error"];
        }
    }

    if (empty($errorMessages)) {
        $sql = "INSERT INTO rooms (bedrooms, price, area, square, image, image1, image2, address, latitude, longitude) 
                VALUES ('$bedrooms', '$price', '$area', '$square', '{$filePaths['uploadfile']}', '{$filePaths['uploadfile1']}', '{$filePaths['uploadfile2']}', '$address', '$latitude', '$longitude')";

        if ($conn->query($sql) === TRUE) {
            $uploadSuccess = true;
        } else {
            $errorMessages[] = "Error: " . $conn->error;
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Room</title>  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"/>
    <!-- Include Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
    <style>
        /* Toast container customization */
        .toast-top-right {
            top: 12px;
            right: 12px;
            z-index: 9999;
        }

        /* Toast message box customization */
        .toast {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 15px;
            font-family: 'Arial', sans-serif;
            color: #ffffff; /* Default text color */
        }

        /* Success toast */
        .toast-success {
            background-color: #28a745; /* Green background */
            border-left: 5px solid #218838; /* Darker green border */
        }

        /* Error toast */
        .toast-error {
            background-color: #dc3545; /* Red background */
            border-left: 5px solid #c82333; /* Darker red border */
        }

        /* Info toast */
        .toast-info {
            background-color: #17a2b8; /* Blue background */
            border-left: 5px solid #138496; /* Darker blue border */
        }

        /* Warning toast */
        .toast-warning {
            background-color: #ffc107; /* Yellow background */
            border-left: 5px solid #e0a800; /* Darker yellow border */
        }

        /* Close button customization */
        .toast-close-button {
            color: #ffffff; /* White close button */
            opacity: 0.8;
        }

        .toast-close-button:hover {
            color: #f8f9fa; /* Slightly lighter on hover */
            opacity: 1;
        }

        /* Title styling */
        .toast-title {
            font-weight: bold;
            font-size: 1.2em;
        }

        /* Message text styling */
        .toast-message {
            font-size: 1em;
        }

        /* Customize animations */
        @keyframes slideDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(0);
                opacity: 1;
            }
            to {
                transform: translateY(-100%);
                opacity: 0;
            }
        }

        /* Apply custom animations */
        .toast {
            animation-duration: 0.5s;
            animation-fill-mode: both;
        }

        .toast-slide-in {
            animation-name: slideDown;
        }

        .toast-slide-out {
            animation-name: slideUp;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            background-image: url('../assets/images/house_2.jpg'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="file"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            margin-top: 5px;
            font-size: 16px;
        }

        input[type="file"] {
            cursor: pointer;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="bedrooms">Bedrooms:</label>
        <select name="bedrooms" id="bedrooms">
            <option value="">Select Bedrooms</option>
            <option value="2+ Bedrooms">2+ Bedrooms</option>
            <option value="3+ Bedrooms">3+ Bedrooms</option>
            <option value="4+ Bedrooms">4+ Bedrooms</option>
            <option value="Hall">Hall</option>
        </select>
    </div>
    <div class="form-group">
        <label for="price">Price:</label>
        <input type="text" id="price" name="price">
    </div>
    <div class="form-group">
        <label for="area">Area:</label>
        <select name="area">
            <option value="">Area</option>
            <option value="Madurai">Madurai</option>
            <option value="Sellur">Sellur</option>
            <option value="Trichy">Trichy</option>
            <option value="Salem">Salem</option>
        </select>
    </div>

    
    <div class="from-group">
        <label for="square feet">Latitude</label>
        <input type="text" name="latitude">
        <label for="square feet">Longitude</label>
        <input type="text" name="longitude">
    </div><br> 

    <div class="from-group">
        <label for="square feet">Square Feet</label>
        <input type="text" name="square">
    </div><br>
    <!-- <div class="form-group">
        <label for="category">Category:</label>
        <select name="category">
            <option value="">Category</option>
            <option value="Exterior">Exterior</option>
            <option value="Interior Design">Interior Design</option>
                    </select>
    </div> -->
    
    </div>
    </div>
    <div class="form-group">
        <label for="image1">Image adds:</label>
        <input type="file" id="image1" name="uploadfile">
    </div>
    <div class="form-group">
        <label for="image2">Image of Interior design:</label>
        <input type="file" id="image2" name="uploadfile1">
    </div>
    <div class="form-group">
        <label for="image2">Image of Exterior design</label>
        <input type="file" id="image2" name="uploadfile2">
    </div>
    <div class="form-group">
        <label for="address">Address:</label>
        <input type="text" id="address" name="address">
    </div>
    <button name="submit" type="submit">Add Room</button>
</form>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {
    toastr.options = {
        "debug": false,
        "positionClass": "toast-top-right",
        "onclick": null,
        "fadeIn": 500,
        "fadeOut": 1000,
        "showMethod": "slideDown",
        "hideMethod": "slideUp",
        "showDuration": 300,
        "hideDuration": 300,
        "timeOut": 5000,
        "extendedTimeOut": 1000
    };

    <?php if ($uploadSuccess): ?>
        toastr.success("Files uploaded and record created successfully!");
        setTimeout(function() {
            window.location.href = 'admin.php'; 
        }, 1500);
    <?php elseif (isset($errorMessages) && !empty($errorMessages)): ?>
        <?php foreach ($errorMessages as $errorMessage): ?>
            toastr.error("<?php echo htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8'); ?>");
        <?php endforeach; ?>
    <?php endif; ?>
});
</script>

</body>
</html>

