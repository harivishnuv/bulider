<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goki Builders Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
      font-family: Arial, sans-serif;
    }
    .sidebar {
      height: 100%;
      width: 250px;
      position: fixed;
      top: 0;
      left: 0;
      background-color: #343a40;
      padding-top: 20px;
    }
    .sidebar a {
      padding: 15px;
      text-decoration: none;
      font-size: 18px;
      color: white;
      display: block;
    }
    .sidebar a:hover {
      background-color: #575d63;
    }
    .content {
      margin-left: 250px;
      padding: 20px;
    }
    .filter-container {
      margin-bottom: 20px;
    }
    .logo {
      display: flex;
      align-items: center;
      padding-bottom: 20px;
    }
    .logo img {
      width: 40px;
      margin-right: 10px;
    }
    .logout {
      position: absolute;
      bottom: 10px;
      left: 10px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }
    th {
      background-color: #343a40;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    </style>
</head>
<body>

<div class="sidebar">
    <h4 style="color: white;">Goki Builders</h4>
    <a href="admin.php">Dashboard</a>
    <a href="project.php">Projects</a>
    <a href="job_apply.php">Job Apply</a>
    <a href="message.php">Messages</a>
    <a href="user_applys.php">User_Applys</a>
    <a href="offermessage.php">Offermessage</a>
    <a href="uploadimg.php">Uploading Image</a>
    <a href="imageshowing.php">imageshowing</a>
</div>

<section>
    <div class="content">
        <h2>Uploaded Images</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>2D Floor Plans:</th>
                    <th>3D Elevation Design</th>
                    <th>Completed Projects:</th>
                    <th>Construction Execution:</th>
                    <th>Interior Execution:</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("conect.php");

                $sql = "SELECT * FROM uploaded_images  WHERE deleteset='N'";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><img src="../admins/uploads/<?php echo $row['image']; ?> " style="width: 100px; height: auto;" ></td>
                        <td><img src="../admins/uploads/<?php echo $row['image1']; ?> " style="width: 100px; height: auto;"></td>
                        <td><img src="../admins/uploads/<?php echo $row['image2']; ?> " style="width: 100px; height: auto;"></td>
                        <td><img src="../admins/uploads/<?php echo $row['image3']; ?> " style="width: 100px; height: auto;"></td>
                        <td><img src="../admins/uploads/<?php echo $row['image4']; ?> " style="width: 100px; height: auto;"></td>


                        <td>
                          <a href="imageshowsdel.php?id=<?php echo $row['id']; ?>"><button class="btn btn-danger btn-sm">Delete</button></a>
                        </td>
                      </tr>
                      <?php
                      }
                    $result->free();
                } else {
                    echo "<tr><td colspan='2'>No images found.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</section>

</body>
</html>
