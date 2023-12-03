<?php
$conn = new mysqli("localhost", "root", "", "hotel_database");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the ROOM and ROOM_RATE tables using JOIN
$sql = "SELECT USER.first_name, EMPLOYEE.salary 
        FROM USER 
        INNER JOIN EMPLOYEE ON USER.user_id = EMPLOYEE.employee_id";

$result = $conn->query($sql);


$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        .available {
            color: green;
        }
        .unavailable {
            color: red;
        }
    </style>
</head>
<body>
    <!-- App bar -->
    <div class="topnav">
        <span class="menu" onclick="openNav()">&#9776;</span>
        <label class="hotel-name"><a href="home.html">The Hotel</a></label>
        <div class="get-room">
          <a href="roomList.php">GET A ROOM</a>
        </div>
        <!-- Profile Icon and Link to Login Page -->
        <div class="profile-pic">
          <a id="profileLink" href=""><img src="profile-pic.png" id="profile-pic" alt="Profile" /></a>
        </div>
      </div>
      <!-- Side bar -->
      <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="home.html">Home</a>
        <a href="roomList.php">Get a room</a>
        <a id="loginLink" href="login.html">Login</a>
        <a href="#">About</a>
        <a href="#">Services</a>
        <a href="#">Contact</a>
		<a href="roomManagement.php">Room Management</a>
        <a id="logoutLink" href="javascript:void(0)" style="display: none;" onclick="logout()">Logout</a>
      </div>

    <div class="room-container" id="roomContainer">
    </div>
<body>
    <table>
        <tr>
            <th>First Name</th>
            <th>Salary</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["first_name"] . "</td>";
                echo "<td>$" . $row["salary"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No data available.</td></tr>";
        }
        ?>
    </table>
     <!-- Button to edit employee info linked to roomManagement.html -->
     <a href="employeeManagement.html">
        <button>Edit Employee Info</button>
    </a>
</body>
</html>