<?php
include("conect.php");
$sql = "SELECT COUNT(*) AS rooms FROM rooms";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_projects = $row["rooms"];
} else {
    $total_projects = 0;
}

$sql = "SELECT * FROM rooms";

$result = $conn->query($sql);

$sql = "SELECT COUNT(*) AS applys FROM applys";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_user_applies = $row["applys"];
} else {
    $total_user_applies = 0;

}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset= "UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GOKI BULIDERS Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
      body {
      font-family: Arial, sans-serif;
    }
    .sidebar {
      height: 100%;
      width: 250px;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0;
      transition: 0.5s;
      overflow-x: hidden;
      background: rgb(239,171,237);
      background: linear-gradient(90deg, rgba(239,171,237,1) 0%, rgba(209,127,214,1) 0%, rgba(143,209,222,1) 50%);
     
      padding-top: 20px;
    }
    .sidebar a {
      padding: 16px;
      text-decoration: none;
      font-size: 18px;
      color: white;
      display: block;
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
    main {
    display: flex;
    justify-content: space-between;
}

.title-card {
    background-color: #2e2e2e;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    flex: 1;
    margin-right: 20px;
}

.title-card:last-child {
    margin-right: 0;
}
.molos{
  margin-left: 250px;
}
.button {
  border-radius: 4px;
  background-color: red;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 20px;
  padding: 18px;
  width: 80px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}
.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}
.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -25px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}
.sub1{
    position: absolute;
    top:18%;
    left: 0;
    bottom: 0;
    height: 80%;
}
.item1{
    background-color: rgb(240,128,128);
    width: 200px;
    height: 140px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    border-radius: 20px;
    box-shadow: 2px 3px 5px black;

}
.item1:hover {
  background-color: #f0f0f0; /* Change to your desired hover background color */
  border-radius: 8px; /* Add border-radius for a rounded corner effect */
}
.item2{
    background-color: rgb(0,255,255);
    width: 280px;
    height: 150px;
    margin-left: 30px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    border-radius: 20px;
    box-shadow: 2px 3px 5px black;

}
.item2:hover {
  background-color: #f0f0f0; /* Change to your desired hover background color */
  border-radius: 8px; /* Add border-radius for a rounded corner effect */
}
.item3{
    background-color: rgb(10,255,255);
    width: 220px;
    height: 140px;
    margin-left: 30px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    border-radius: 20px;
    box-shadow: 2px 3px 5px black;
}
.item3:hover {
  background-color: #f0f0f0; /* Change to your desired hover background color */
  border-radius: 8px; /* Add border-radius for a rounded corner effect */
}
.item4{
    background-color: rgb(135,206,250);
    width: 220px;
    height: 140px;
    margin-left: 30px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    border-radius: 20px;
    box-shadow: 2px 3px 5px black;
}
.item4:hover {
  background-color: #f0f0f0; /* Change to your desired hover background color */
  border-radius: 8px; /* Add border-radius for a rounded corner effect */
}
.item5{
    background-color: rgb(240,128,128);
    width: 220px;
    height: 140px;
    margin-left: 30px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    border-radius: 20px;
    box-shadow: 2px 3px 5px black;
}
.item5:hover {
  background-color: #f0f0f0; /* Change to your desired hover background color */
  border-radius: 8px; /* Add border-radius for a rounded corner effect */
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}



  </style>
</head>
<body>

  <div id="mySidenav" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <h4 style="color:white;">GOKI BULIDERS</h4>
  <a href="#dashborad">Dashboard</a>
  <a href="project.php">project</a>
  <a href="job_apply.php">job_apply</a>
  <a href="message.php">Messages</a>
  <a href="user_applys.php">user_applys</a>
  <a href="offermessage.php">offermessage</a>
  <a href="uploadimg.php">uploadingimg</a>
  <a href="imageshowing.php">imageshowing</a>
  <a href="project_list.php">Project_list</a>
</div>
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
<section class="molos">
<div class-="content">
<p>Welcome to the Goki Builders Admin Panel. Use the sidebar to navigate through different sections.</p>
<main>
   <div class="sub2" style="display: flex; justify-content: space-around; align-items: center;">

    
  <div class="item1" style="text-align: center;">
  <i class="fas fa-folder-open fa-3x"></i>
  <p class="heading2">Projects</p>
  <p class="value"><?php echo $total_projects; ?></p>
</div>

   <!-- <div class="item2" style="text-align: center;">
      <i class="fas fa-envelope fa-3x"></i>
      <p class="heading2">Messages</p>
      <p class="value">31</p>
    </div>-->

    
<div class="item3" style="text-align: center;">
 <a href="user_applys.php" ><i class="fas fa-user-plus fa-3x"></i>
  <p class="heading2">User Apply</p>
  <p class="value"><?php echo $total_user_applies; ?></p>
</a>
</div>

<?php 
// $sql3 = "SELECT COUNT(*) AS rooms FROM rooms";
// $results = $conn->query($sql3);

// if ($results->num_rows > 0) {
//     $row = $results->fetch_assoc();
//     $total_user_appliess = $rows["rooms"]; 
//   }else {
//     $total_user_appliesss = 0 ;
//   }
    ?>

<div class="item4" style="text-align: center;">
      <i class="fas fa-folder-open fa-3x"></i>
      <p class="heading2">Upcoming_Projects</p>
      <p class="value"><?php //echo // $total_user_appliess  ?></p>
    </div>
    <div class="item5" style="text-align: center;">
      <i class="fas fa-folder-open fa-3x"></i>
      <p class="heading2">clients</p>
      <p class="value">100</p>
    </div>

  </div>
</main>


    
      <section>
      <div class="logout">
  <a href="logout.php" class="button"><span>Logout<span></a>
</div>
<script>
  function confirmDelete() {
    return confirm("Are you sure you want to delete this room?");
    }
    document.addEventListener("DOMContentLoaded", function() {
    fetch('data.php')
        .then(response => response.json())
        .then(data => {
            // Create Chart for Project Job Apply Messages
            var projectCtx = document.getElementById('projectChart').getContext('2d');
            var projectChart = new Chart(projectCtx, {
                type: 'bar',
                data: {
                    labels: ['Project 1', 'Project 2', 'Project 3', 'Project 4', 'Project 5'],
                    datasets: [{
                        label: 'Messages',
                        data: [10, 20, 30, 40, 50], // Placeholder data, replace with actual data
                        backgroundColor: '#4a90e2'
                    }]
                }
            });

            // Create Chart for User Applications
            var userCtx = document.getElementById('userChart').getContext('2d');
            var userChart = new Chart(userCtx, {
                type: 'bar',
                data: {
                    labels: ['User 1', 'User 2', 'User 3', 'User 4', 'User 5'],
                    datasets: [{
                        label: 'Applications',
                        data: [20, 30, 40, 50, 60], // Placeholder data, replace with actual data
                        backgroundColor: 'blue'
                    }]
                }
            });
        })
        .catch(error => console.log(error));
});
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}



</script>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
